<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\TranslatorProfile;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::latest()->get();

        return view(
            'user.services.index',
            compact('services')
        );
    }

    public function show(Service $service)
    {
        $recommendedScholars = TranslatorProfile::with('user')
            ->approved()
            ->orderByDesc('publication_count')
            ->take(4)
            ->get();

        return view(
            'user.services.show',
            compact(
                'service',
                'recommendedScholars'
            )
        );
    }
}