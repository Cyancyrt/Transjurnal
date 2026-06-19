<?php

namespace App\Http\Controllers\Translator;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    /**
     * Display a listing of translator orders.
     */
    public function index(Request $request)
    {
        $orders = Order::with([
                'user',
                'service'
            ])
            ->where('translator_id', auth()->id())

            ->when(
                $request->search,
                fn ($query) =>
                    $query->where(
                        'title',
                        'like',
                        '%' . $request->search . '%'
                    )
            )

            ->when(
                $request->status,
                fn ($query) =>
                    $query->where(
                        'status',
                        $request->status
                    )
            )

            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view(
            'translator.orders.index',
            compact('orders')
        );
    }
    public function accept(Order $job)
    {
        if (
            $job->translator_id !== null ||
            $job->status !== 'open'
        ) {
            return back()->with(
                'error',
                'Job is no longer available.'
            );
        }

        $job->update([
            'translator_id' => auth()->id(),
            'status' => 'in_progress'
        ]);

        return redirect()
            ->route(
                'translator.orders.work',
                $job
            )
            ->with(
                'success',
                'Job accepted successfully.'
            );
    }

    /**
     * Not used by translator.
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Not used by translator.
     */
    public function store(Request $request)
    {
        abort(404);
    }

    /**
     * Display order details.
     */
    public function show(Order $order)
    {
        $this->authorizeOrder($order);

        $order->load([
            'user',
            'service'
        ]);

        return view(
            'translator.orders.show',
            compact('order')
        );
    }

    /**
     * Edit order.
     * Redirect to workspace.
     */
    public function edit(Order $order)
    {
        return redirect()->route(
            'translator.orders.work',
            $order
        );
    }

    /**
     * Not used.
     */
    public function update(
        Request $request,
        Order $order
    ) {
        abort(404);
    }

    /**
     * Release order.
     */
    public function destroy(Order $order)
    {
        $this->authorizeOrder($order);

        $order->update([
            'translator_id' => null,
            'status'        => 'pending'
        ]);

        return redirect()
            ->route('translator.orders.index')
            ->with(
                'success',
                'Order released successfully.'
            );
    }

    /**
     * Workspace page.
     */
    public function work(Order $order)
    {
        $this->authorizeOrder($order);

        $order->load([
            'user',
            'service',
            'review.user'
        ]);

        return view(
            'translator.orders.work',
            compact('order')
        );
    }

    /**
     * Update order status.
     */
    public function updateStatus(
        Request $request,
        Order $order
    ) {
        $this->authorizeOrder($order);

        $request->validate([
            'status' => [
                'required',
                'in:pending,accepted,in_progress,revision,completed,cancelled'
            ]
        ]);

        $order->update([
            'status' => $request->status
        ]);

        return back()->with(
            'success',
            'Order status updated.'
        );
    }

    /**
     * Upload translated file.
     */
    public function upload(
        Request $request,
        Order $order
    ) {
        $this->authorizeOrder($order);

        $request->validate([
            'translated_file' => [
                'required',
                'file',
                'mimes:pdf,doc,docx',
                'max:20480'
            ]
        ]);

        if (
            $order->translated_file &&
            Storage::disk('public')->exists(
                $order->translated_file
            )
        ) {
            Storage::disk('public')->delete(
                $order->translated_file
            );
        }

        $path = $request
            ->file('translated_file')
            ->store(
                'translations',
                'public'
            );

        $order->update([
            'translated_file' => $path,
            'status'          => 'completed'
        ]);

        return redirect()
            ->route(
                'translator.orders.show',
                $order
            )
            ->with(
                'success',
                'Translation uploaded successfully.'
            );
    }

    /**
     * Authorization helper.
     */
    private function authorizeOrder(
        Order $order
    ) {
        abort_if(
            $order->translator_id !== Auth::id(),
            403,
            'Unauthorized'
        );
    }
}