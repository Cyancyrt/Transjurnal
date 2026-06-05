<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\TranslatorProfile;

class ScholarController extends Controller
{
    public function index()
    {
        $scholars = TranslatorProfile::with('user')
            ->approved()
            ->orderByDesc('publication_count')
            ->paginate(12);

        return view(
            'user.scholars.index',
            compact('scholars')
        );
    }
    public function show(TranslatorProfile $scholar)
    {
        $scholar->load('user');

        return view(
            'user.scholars.show',
            [
                'translatorProfile' => $scholar
            ]
        );
    }
}