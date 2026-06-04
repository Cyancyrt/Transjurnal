<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Service;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::where(
            'user_id',
            auth()->id()
        )->latest()->get();

        return view(
            'user.orders.index',
            compact('orders')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::all();

        return view(
            'user.orders.create',
            compact('services')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'source_language' => 'required',
            'target_language' => 'required',
            'service_id' => 'required',
            'journal_file' => 'required|mimes:pdf|max:10240',
        ]);

        $path = $request
            ->file('journal_file')
            ->store('journals','public');

        $service = Service::findOrFail(
            $request->service_id
        );

        Order::create([
            'user_id' => auth()->id(),
            'service_id' => $service->id,

            'title' => $request->title,
            'description' => $request->description,

            'source_language'
                => $request->source_language,

            'target_language'
                => $request->target_language,

            'journal_file'
                => $path,

            'price'
                => $service->base_price,

            'status'
                => 'pending'
        ]);

        return redirect()
            ->route('user.orders.index')
            ->with(
                'success',
                'Order created successfully.'
            );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
