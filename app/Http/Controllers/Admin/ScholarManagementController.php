<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TranslatorProfile;
use Illuminate\Http\Request;

class ScholarManagementController extends Controller
{
    public function index(Request $request)
    {
        $query = TranslatorProfile::with('user');

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($query) use ($search) {

                $query->where(
                    'university',
                    'like',
                    "%{$search}%"
                )

                ->orWhere(
                    'expertise',
                    'like',
                    "%{$search}%"
                )

                ->orWhereHas(
                    'user',
                    function ($user) use ($search) {

                        $user->where(
                            'name',
                            'like',
                            "%{$search}%"
                        );
                    }
                );
            });
        }

        if (
            $request->filled('status')
            &&
            $request->status !== 'all'
        ) {
            $query->where(
                'verification_status',
                $request->status
            );
        }

        $scholars = $query
            ->latest()
            ->paginate(10);

        $stats = [

            'pending' => TranslatorProfile::where(
                'verification_status',
                'pending'
            )->count(),

            'approved' => TranslatorProfile::where(
                'verification_status',
                'approved'
            )->count(),

            'rejected' => TranslatorProfile::where(
                'verification_status',
                'rejected'
            )->count(),
        ];

        return view(
            'admin.scholars.index',
            compact(
                'scholars',
                'stats'
            )
        );
    }

    public function show(
        TranslatorProfile $scholar
    )
    {
        $scholar->load('user');

        return view(
            'admin.scholars.show',
            compact('scholar')
        );
    }

    public function approve(
        TranslatorProfile $scholar
    )
    {
        $scholar->update([

            'verification_status' =>
                'approved'

        ]);

        return redirect()
            ->route(
                'admin.scholars.show',
                $scholar
            )
            ->with(
                'success',
                'Scholar approved successfully.'
            );
    }

    public function reject(
        TranslatorProfile $scholar
    )
    {
        $scholar->update([

            'verification_status' =>
                'rejected'

        ]);

        return redirect()
            ->route(
                'admin.scholars.show',
                $scholar
            )
            ->with(
                'success',
                'Scholar rejected successfully.'
            );
    }
}