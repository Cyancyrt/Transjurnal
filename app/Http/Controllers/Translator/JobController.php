<?php

namespace App\Http\Controllers\Translator;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $profile = Auth::user()->translatorProfile;

        /*
        |--------------------------------------------------------------------------
        | Recommended Jobs
        |--------------------------------------------------------------------------
        */

        $recommendedJobs = collect();

        if (
            $profile &&
            !empty($profile->expertise)
        ) {

            $recommendedJobs = Order::with([
                    'user',
                    'service'
                ])
                ->whereNull('translator_id')
                ->where('status', 'open')

                ->where(function ($query) use ($profile) {

                    $query->where(
                        'field',
                        'like',
                        '%' . $profile->expertise . '%'
                    );

                })

                ->latest()
                ->take(6)
                ->get();
        }

        /*
        |--------------------------------------------------------------------------
        | Dynamic Categories
        |--------------------------------------------------------------------------
        */

        $categories = Order::query()

            ->select('field')

            ->whereNull('translator_id')

            ->where('status', 'open')

            ->whereNotNull('field')

            ->where('field', '!=', '')

            ->distinct()

            ->orderBy('field')

            ->pluck('field')

            ->filter()

            ->values();

        /*
        |--------------------------------------------------------------------------
        | Main Jobs Query
        |--------------------------------------------------------------------------
        */

        $jobs = Order::with([
                'user',
                'service'
            ])

            ->whereNull('translator_id')

            ->where('status', 'open')

            ->when(
                $request->search,
                function ($query) use ($request) {

                    $query->where(function ($q) use ($request) {

                        $q->where(
                            'title',
                            'like',
                            '%' . $request->search . '%'
                        )

                        ->orWhere(
                            'field',
                            'like',
                            '%' . $request->search . '%'
                        )

                        ->orWhere(
                            'source_language',
                            'like',
                            '%' . $request->search . '%'
                        )

                        ->orWhere(
                            'target_language',
                            'like',
                            '%' . $request->search . '%'
                        );

                    });

                }
            )

            ->when(
                $request->category,
                function ($query) use ($request) {

                    $query->where(
                        'field',
                        $request->category
                    );

                }
            )

            ->latest()

            ->paginate(12);

        /*
        |--------------------------------------------------------------------------
        | Statistics
        |--------------------------------------------------------------------------
        */

        $totalJobs = Order::query()

            ->whereNull('translator_id')

            ->where('status', 'open')

            ->count();

        $totalBudget = Order::query()

            ->whereNull('translator_id')

            ->where('status', 'open')

            ->sum('price');

        return view(
            'translator.jobs.index',
            compact(
                'jobs',
                'recommendedJobs',
                'categories',
                'totalJobs',
                'totalBudget',
                'profile'
            )
        );
    }

    public function show(Order $job)
    {
        if (
            $job->translator_id !== null ||
            $job->status !== 'open'
        ) {
            abort(404);
        }

        $job->load([
            'user',
            'service'
        ]);

        return view(
            'translator.jobs.show',
            compact('job')
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
            'translator_id' => Auth::id(),
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

    public function create()
    {
        abort(404);
    }

    public function store(Request $request)
    {
        abort(404);
    }

    public function edit(Order $job)
    {
        abort(404);
    }

    public function update(
        Request $request,
        Order $job
    ) {
        abort(404);
    }

    public function destroy(Order $job)
    {
        abort(404);
    }
}