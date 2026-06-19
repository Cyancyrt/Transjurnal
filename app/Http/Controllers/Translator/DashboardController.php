<?php

namespace App\Http\Controllers\Translator;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $activeOrders = Order::with([
                'user',
                'service'
            ])
            ->where('translator_id', $user->id)
            ->whereIn('status', [
                'accepted',
                'in_progress',
                'revision'
            ])
            ->latest()
            ->get();

        $completedOrders = Order::with([
                'user',
                'service'
            ])
            ->where('translator_id', $user->id)
            ->where('status', 'completed')
            ->latest()
            ->get();

        $pendingRequests = Order::with([
                'user',
                'service'
            ])
            ->whereNull('translator_id')
            ->where('status', 'pending')
            ->latest()
            ->get();

        $averageRating = Review::whereHas('order', function ($q) use ($user) {
                $q->where('translator_id', $user->id);
            })
            ->avg('rating') ?? 0;

        $recentReviews = Review::with('user')
            ->whereHas('order', function ($q) use ($user) {
                $q->where('translator_id', $user->id);
            })
            ->latest()
            ->take(5)
            ->get();

        $totalEarnings = Order::where(
                'translator_id',
                $user->id
            )
            ->where('status', 'completed')
            ->sum('price');

        $thisMonthEarnings = Order::where(
                'translator_id',
                $user->id
            )
            ->where('status', 'completed')
            ->whereMonth('updated_at', now()->month)
            ->whereYear('updated_at', now()->year)
            ->sum('price');

        $lastMonthEarnings = Order::where(
                'translator_id',
                $user->id
            )
            ->where('status', 'completed')
            ->whereMonth(
                'updated_at',
                now()->copy()->subMonth()->month
            )
            ->whereYear(
                'updated_at',
                now()->copy()->subMonth()->year
            )
            ->sum('price');

        $monthlyEarnings = Order::selectRaw(
                'MONTH(updated_at) as month,
                 SUM(price) as total'
            )
            ->where('translator_id', $user->id)
            ->where('status', 'completed')
            ->whereYear('updated_at', now()->year)
            ->groupBy(
                DB::raw('MONTH(updated_at)')
            )
            ->orderBy('month')
            ->get();
        // dd($user, $activeOrders, $completedOrders, $pendingRequests, $averageRating, $recentReviews, $totalEarnings, $thisMonthEarnings, $lastMonthEarnings, $monthlyEarnings);
        return view(
            'translator.dashboard',
            compact(
                'user',
                'activeOrders',
                'completedOrders',
                'pendingRequests',
                'averageRating',
                'recentReviews',
                'totalEarnings',
                'thisMonthEarnings',
                'lastMonthEarnings',
                'monthlyEarnings'
            )
        );
    }
}