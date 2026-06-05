<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with([
                'translator',
                'service'
            ])
            ->where(
                'user_id',
                auth()->id()
            )
            ->latest()
            ->paginate(12);

        return view(
            'user.orders.index',
            compact('orders')
        );
    }

    public function create()
    {
        $services = Service::all();

        return view(
            'user.orders.create',
            compact('services')
        );
    }

   public function store(Request $request)
    {
        $request->validate([

            'service_id' => [
                'required',
                'exists:services,id'
            ],

            'field' => [
                'required',
                'string',
                'min:3',
                'max:255'
            ],

            'title' => [
                'required',
                'string',
                'min:5',
                'max:255'
            ],

            'description' => [
                'required',
                'string',
                'min:20',
                'max:5000'
            ],

            'source_language' => [
                'required',
                'string',
                'different:target_language'
            ],

            'target_language' => [
                'required',
                'string'
            ],

            'journal_file' => [
                'required',
                'file',

                /*
                * PDF
                * DOC
                * DOCX
                * TXT
                */
                'mimes:pdf,doc,docx,txt',

                /*
                * 10 MB
                */
                'max:10240'
            ]
        ], [

            'service_id.required' =>
                'Please select a translation service.',

            'service_id.exists' =>
                'Selected service is invalid.',

            'field.required' =>
                'Academic field is required.',

            'title.required' =>
                'Journal title is required.',

            'description.required' =>
                'Please provide a project description.',

            'description.min' =>
                'Description must contain at least 20 characters.',

            'source_language.different' =>
                'Source and target languages cannot be the same.',

            'journal_file.required' =>
                'Please upload your journal file.',

            'journal_file.mimes' =>
                'Only PDF, DOC, DOCX, and TXT files are allowed.',

            'journal_file.max' =>
                'File size must not exceed 10 MB.'
        ]);

        $service = Service::findOrFail(
            $request->service_id
        );

        $file = $request->file(
            'journal_file'
        );

        $fileName =
            time()
            . '_'
            . uniqid()
            . '.'
            . $file->getClientOriginalExtension();

        $journalFile = $file->storeAs(
            'journals',
            $fileName,
            'public'
        );

        Order::create([

            'user_id' => auth()->id(),

            'service_id' => $service->id,

            'field' => $request->field,

            'title' => $request->title,

            'description' => $request->description,

            'source_language' => $request->source_language,

            'target_language' => $request->target_language,

            'journal_file' => $journalFile,

            'price' => $service->base_price,

            'status' => 'open'
        ]);

        return redirect()
            ->route('user.orders.index')
            ->with(
                'success',
                'Translation request submitted successfully.'
            );
    }

    public function show(Order $order)
    {
        abort_if(
            $order->user_id !== auth()->id(),
            403
        );

        $order->load([
            'translator',
            'service'
        ]);
        // dd($order);

        return view(
            'user.orders.show',
            compact('order')
        );
    }

    public function edit(Order $order)
    {
        abort_if(
            $order->user_id !== auth()->id(),
            403
        );

        if ($order->status !== 'open') {
            return redirect()
                ->route('user.orders.index')
                ->with(
                    'error',
                    'Only open orders can be edited.'
                );
        }

        $services = Service::all();

        return view(
            'user.orders.edit',
            compact(
                'order',
                'services'
            )
        );
    }

    public function update(
        Request $request,
        Order $order
    ) {
        abort_if(
            $order->user_id !== auth()->id(),
            403,
            'Unauthorized access.'
        );

        if ($order->status !== 'open') {

            return redirect()
                ->route('user.orders.show', $order)
                ->with(
                    'error',
                    'This order can no longer be modified because it has already been processed.'
                );
        }

        $validated = $request->validate([

            'service_id' => [
                'required',
                'exists:services,id'
            ],

            'field' => [
                'required',
                'string',
                'min:3',
                'max:255'
            ],

            'title' => [
                'required',
                'string',
                'min:5',
                'max:255'
            ],

            'description' => [
                'required',
                'string',
                'min:20',
                'max:5000'
            ],

            'source_language' => [
                'required',
                'string',
                'different:target_language'
            ],

            'target_language' => [
                'required',
                'string'
            ],

            'journal_file' => [
                'nullable',
                'file',
                'mimes:pdf,doc,docx,txt',
                'max:10240'
            ]

        ], [

            'service_id.required' =>
                'Please select a translation service.',

            'service_id.exists' =>
                'Selected service is invalid.',

            'field.required' =>
                'Academic field is required.',

            'title.required' =>
                'Journal title is required.',

            'description.required' =>
                'Description is required.',

            'description.min' =>
                'Description must contain at least 20 characters.',

            'source_language.different' =>
                'Source language and target language cannot be the same.',

            'journal_file.mimes' =>
                'Only PDF, DOC, DOCX and TXT files are allowed.',

            'journal_file.max' =>
                'File size must not exceed 10 MB.'
        ]);

        DB::beginTransaction();

        try {

            $service = Service::findOrFail(
                $validated['service_id']
            );

            if ($request->hasFile('journal_file')) {

                if (
                    $order->journal_file &&
                    Storage::disk('public')
                        ->exists($order->journal_file)
                ) {
                    Storage::disk('public')
                        ->delete($order->journal_file);
                }

                $file = $request->file(
                    'journal_file'
                );

                $filename =
                    time()
                    . '_'
                    . uniqid()
                    . '.'
                    . $file->getClientOriginalExtension();

                $validated['journal_file'] =
                    $file->storeAs(
                        'journals',
                        $filename,
                        'public'
                    );
            }

            $validated['price'] =
                $service->base_price;

            $order->fill([

                'service_id' =>
                    $validated['service_id'],

                'field' =>
                    $validated['field'],

                'title' =>
                    $validated['title'],

                'description' =>
                    $validated['description'],

                'source_language' =>
                    $validated['source_language'],

                'target_language' =>
                    $validated['target_language'],

                'price' =>
                    $validated['price'],

                'journal_file' =>
                    $validated['journal_file']
                    ?? $order->journal_file
            ]);

            $order->save();

            DB::commit();

            return redirect()
                ->route(
                    'user.orders.show',
                    $order
                )
                ->with(
                    'success',
                    'Translation request updated successfully.'
                );

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Failed to update order. Please try again.'
                );
        }
    }
    public function destroy(Order $order)
    {
        abort_if(
            $order->user_id !== auth()->id(),
            403
        );

        if (
            in_array(
                $order->status,
                [
                    'in_progress',
                    'completed'
                ]
            )
        ) {
            return back()->with(
                'error',
                'This order cannot be deleted.'
            );
        }

        if (
            $order->journal_file &&
            Storage::disk('public')
                ->exists(
                    $order->journal_file
                )
        ) {
            Storage::disk('public')
                ->delete(
                    $order->journal_file
                );
        }

        if (
            $order->translated_file &&
            Storage::disk('public')
                ->exists(
                    $order->translated_file
                )
        ) {
            Storage::disk('public')
                ->delete(
                    $order->translated_file
                );
        }

        $order->delete();

        return redirect()
            ->route(
                'user.orders.index'
            )
            ->with(
                'success',
                'Order deleted successfully.'
            );
    }
    public function completedTranslations()
    {
        $translations = Order::with([
                'translator',
                'service'
            ])
            ->where(
                'user_id',
                auth()->id()
            )
            ->where(
                'status',
                'completed'
            )
            ->latest()
            ->paginate(12);

        return view(
            'user.translations.index',
            compact('translations')
        );
    }
}