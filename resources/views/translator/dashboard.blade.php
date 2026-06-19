@extends('layouts.app')

@section('content')
<div class="space-y-10">

    {{-- ── HERO ── --}}
    <div class="t-hero anim-0">
        <div class="t-hero-grid"></div>
        <div class="t-hero-left">
            <div class="t-hero-badge">
                <i class="bi bi-patch-check-fill"></i>
                Scholar Translator
            </div>
            <div class="t-hero-name">
                {{ auth()->user()->academic_title ?? '' }}
                {{ auth()->user()->name }}
            </div>
            <div class="t-hero-title-sub">
                {{ auth()->user()->university ?? 'Academic Institution' }}
                &nbsp;·&nbsp;
                {{ auth()->user()->expertise ?? '' }}
            </div>
        </div>
        <div class="t-hero-right">
            <div class="t-stat-chip">
                <div class="t-stat-num">{{ $activeOrders->count() }}</div>
                <div class="t-stat-label">Active</div>
            </div>
            <div class="t-stat-chip accent">
                <div class="t-stat-num">{{ $completedOrders->count() }}</div>
                <div class="t-stat-label">Completed</div>
            </div>
            <div class="t-stat-chip">
                <div class="t-stat-num">{{ number_format($averageRating ?? 0, 1) }}</div>
                <div class="t-stat-label">Avg Rating</div>
            </div>
            <div class="t-stat-chip">
                <div class="t-stat-num">Rp {{ number_format(($totalEarnings ?? 0) / 1000, 0) }}k</div>
                <div class="t-stat-label">Earnings</div>
            </div>
        </div>
    </div>

    {{-- ── METRICS ── --}}
    <section class="anim-1">
        <div class="section-label">
            <div class="section-label-line"></div>
            <h2>Overview</h2>
        </div>
        <div class="metrics-row">
            <div class="metric-card blue">
                <div class="metric-card-icon blue"><i class="bi bi-file-earmark-text"></i></div>
                <div class="metric-value">{{ $activeOrders->count() }}</div>
                <div class="metric-label">Active Orders</div>
            </div>
            <div class="metric-card green">
                <div class="metric-card-icon green"><i class="bi bi-check2-all"></i></div>
                <div class="metric-value">{{ $completedOrders->count() }}</div>
                <div class="metric-label">Completed Translations</div>
            </div>
            <div class="metric-card yellow">
                <div class="metric-card-icon yellow"><i class="bi bi-star-fill"></i></div>
                <div class="metric-value">{{ number_format($averageRating ?? 0, 1) }}</div>
                <div class="metric-label">Average Rating</div>
            </div>
            <div class="metric-card violet">
                <div class="metric-card-icon violet"><i class="bi bi-cash-stack"></i></div>
                <div class="metric-value">Rp {{ number_format($totalEarnings ?? 0, 0, ',', '.') }}</div>
                <div class="metric-label">Total Earnings</div>
            </div>
        </div>
    </section>

    {{-- ── TWO-COL: Active Orders + Profile ── --}}
    <div class="dashboard-grid">

        {{-- Active Orders Table --}}
        <div class="orders-card">
            <div class="orders-wrapper">
                <div class="orders-card-header">
                    <h2>Active Orders</h2>
                    @if($activeOrders->count() > 0)
                        <span style="background:var(--primary-lt);color:var(--primary);font-size:12px;font-weight:700;padding:4px 10px;border-radius:100px;">
                            {{ $activeOrders->count() }} ongoing
                        </span>
                    @endif
                </div>
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th>Journal</th>
                            <th>Client</th>
                            <th>Deadline</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($activeOrders as $order)
                            @php
                                $daysLeft  = now()->diffInDays($order->deadline, false);
                                $totalDays = $order->created_at->diffInDays($order->deadline);
                                $progress  = $totalDays > 0 ? max(0, min(100, 100 - ($daysLeft / $totalDays * 100))) : 100;
                                $barClass  = $daysLeft < 1 ? 'danger' : ($daysLeft < 3 ? 'warn' : '');
                                $statusClass = match($order->status) {
                                    'pending'    => 'status-pending',
                                    'in_progress','processing' => 'status-progress',
                                    'revision'   => 'status-revision',
                                    'completed'  => 'status-completed',
                                    default      => 'status-default',
                                };
                            @endphp
                            <tr>
                                <td>
                                    <div style="font-weight:600;font-size:14px;">{{ Str::limit($order->title, 35) }}</div>
                                    <div style="font-size:12px;color:var(--ink-muted);margin-top:2px;">{{ $order->service?->name }}</div>
                                </td>
                                <td style="font-size:13px;color:var(--ink-muted);">{{ $order->user?->name }}</td>
                                <td>
                                    <div class="deadline-wrap">
                                        @if($order->deadline)
                                            <div class="deadline-label">
                                                {{ $daysLeft >= 0 ? $daysLeft.' days left' : 'Overdue' }}
                                            </div>
                                            <div class="deadline-bar">
                                                <div class="deadline-fill {{ $barClass }}" style="width:{{ $progress }}%"></div>
                                            </div>
                                        @else
                                            <span style="color:var(--ink-muted);font-size:12px;">No deadline</span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <span class="status-badge {{ $statusClass }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td>
                                    <div style="display:flex;gap:8px;flex-wrap:wrap;">
                                        <a href="{{ route('translator.orders.show', $order) }}" class="action-btn primary">
                                            <i class="bi bi-pencil-square"></i> Work
                                        </a>
                                        <a href="{{ route('translator.orders.show', $order) }}" class="action-btn ghost">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="empty-state">
                                    <i class="bi bi-inbox"></i>
                                    No active orders at the moment.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Profile Sidebar --}}
        <div class="profile-card anim-2">
            <div class="profile-avatar-lg">
                <i class="bi bi-person-fill"></i>
            </div>
            <div class="profile-name">{{ auth()->user()->name }}</div>
            <div class="profile-title">
                {{ auth()->user()->academic_title ?? '' }}
            </div>
            <div style="margin-top:6px;">
                <span class="verification-chip">
                    <i class="bi bi-patch-check-fill"></i>
                    {{ ucfirst(auth()->user()->verification_status ?? 'Verified') }}
                </span>
            </div>
            <hr class="profile-divider">
            <div class="profile-stat-row">
                <span class="lbl">Expertise</span>
                <span class="val">{{ auth()->user()->expertise ?? '-' }}</span>
            </div>
            <div class="profile-stat-row">
                <span class="lbl">Publications</span>
                <span class="val">{{ auth()->user()->publication_count ?? 0 }}</span>
            </div>
            <div class="profile-stat-row">
                <span class="lbl">Hourly Rate</span>
                <span class="val" style="color:var(--accent);">
                    Rp {{ number_format(auth()->user()->hourly_rate ?? 0, 0, ',', '.') }}
                </span>
            </div>
            <hr class="profile-divider">
            <a href="{{ route('translator.profile.edit', $user->id) }}" class="action-btn primary" style="width:100%;justify-content:center;margin-top:4px;">
                <i class="bi bi-pencil"></i> Edit Profile
            </a>
        </div>

    </div>

    {{-- ── PENDING REQUESTS + UPLOAD RESULT ── --}}
    <div class="request-grid">

        {{-- Pending Requests --}}
        <div class="orders-card">
            <div class="orders-card-header">
                <h2>New Requests</h2>
                @if($pendingRequests->count() > 0)
                    <span style="background:var(--warn-lt);color:var(--warn);font-size:12px;font-weight:700;padding:4px 10px;border-radius:100px;">
                        {{ $pendingRequests->count() }} pending
                    </span>
                @endif
            </div>
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>Journal</th>
                        <th>Service</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pendingRequests as $order)
                        <tr>
                            <td>
                                <div style="font-weight:600;font-size:14px;">{{ Str::limit($order->title, 30) }}</div>
                                <div style="font-size:12px;color:var(--ink-muted);margin-top:2px;">{{ $order->user?->name }}</div>
                            </td>
                            <td style="font-size:13px;color:var(--ink-muted);">{{ $order->service?->name }}</td>
                            <td>
                                <div style="display:flex;gap:6px;">
                                    <form action="{{ route('translator.orders.accept', $order) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="action-btn primary">
                                            <i class="bi bi-check-lg"></i> Accept
                                        </button>
                                    </form>
                                    <form action="{{ route('translator.orders.reject', $order) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="action-btn danger">
                                            <i class="bi bi-x-lg"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="empty-state">
                                <i class="bi bi-inbox"></i>
                                No pending requests.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Upload Translation Result --}}
        <div class="upload-panel">
            <div class="section-label" style="margin-bottom:16px;">
                <div class="section-label-line" style="background:var(--accent);"></div>
                <h2 style="font-size:1.05rem;">Upload Translation Result</h2>
            </div>
            @if($activeOrders->count() > 0)
                <form
                    action="{{ route('translator.orders.upload', $activeOrders->first()) }}"
                    method="POST"
                    enctype="multipart/form-data"
                >
                    @csrf
                    <div style="margin-bottom:14px;">
                        <label style="font-size:13px;font-weight:600;color:var(--ink-soft);display:block;margin-bottom:6px;">
                            Select Order
                        </label>
                        <select name="order_id" style="width:100%;padding:10px 14px;border:1px solid var(--border);border-radius:var(--radius-sm);font-family:inherit;font-size:14px;color:var(--ink);background:var(--card);outline:none;">
                            @foreach($activeOrders as $order)
                                <option value="{{ $order->id }}">{{ Str::limit($order->title, 45) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div
                        class="upload-area"
                        onclick="document.getElementById('file-input').click()"
                        id="upload-drop"
                    >
                        <i class="bi bi-cloud-arrow-up"></i>
                        <p>
                            Drop file here or
                            <strong>click to browse</strong>
                        </p>
                        <p style="font-size:12px;margin-top:4px;">PDF, DOCX up to 20MB</p>
                        <p id="file-name" style="margin-top:8px;font-size:13px;font-weight:600;color:var(--primary);display:none;"></p>
                    </div>
                    <input
                        type="file"
                        id="file-input"
                        name="translated_file"
                        accept=".pdf,.doc,.docx"
                        style="display:none;"
                        onchange="showFileName(this)"
                    >
                    <button
                        type="submit"
                        style="width:100%;margin-top:16px;padding:12px;background:var(--accent);color:#fff;font-weight:600;font-size:14px;border:none;border-radius:var(--radius-sm);cursor:pointer;transition:opacity .2s;"
                        onmouseover="this.style.opacity='.85'" onmouseout="this.style.opacity='1'"
                    >
                        <i class="bi bi-upload me-2"></i> Submit Translation
                    </button>
                </form>
            @else
                <div class="upload-area" style="cursor:default;">
                    <i class="bi bi-file-earmark-check" style="color:var(--ink-muted);"></i>
                    <p>No active orders to upload results for.</p>
                </div>
            @endif
        </div>

    </div>

    {{-- ── EARNINGS CHART ── --}}
    <section class="anim-4">
        <div class="section-label">
            <div class="section-label-line" style="background:var(--violet);"></div>
            <h2>Monthly Earnings</h2>
        </div>
        <div class="earnings-card">
            <div class="earnings-summary">
                <div class="earnings-summary-item">
                    <div class="earnings-summary-label">This Month</div>
                    <div class="earnings-summary-val green">
                        Rp {{ number_format($thisMonthEarnings ?? 0, 0, ',', '.') }}
                    </div>
                </div>
                <div class="earnings-summary-item">
                    <div class="earnings-summary-label">Last Month</div>
                    <div class="earnings-summary-val">
                        Rp {{ number_format($lastMonthEarnings ?? 0, 0, ',', '.') }}
                    </div>
                </div>
                <div class="earnings-summary-item">
                    <div class="earnings-summary-label">All Time</div>
                    <div class="earnings-summary-val">
                        Rp {{ number_format($totalEarnings ?? 0, 0, ',', '.') }}
                    </div>
                </div>
            </div>

            {{-- Simple bar chart from monthly data --}}
            <div class="chart-bars">
                @php
                    $months = $monthlyEarnings ?? collect();
                    $maxVal = $months->max('total') ?: 1;
                @endphp
                @forelse($months as $m)
                    @php $barH = max(6, (int)(($m->total / $maxVal) * 90)); @endphp
                    <div class="chart-col">
                        <div
                            class="chart-bar {{ $m->month == now()->month ? 'current' : '' }}"
                            style="height:{{ $barH }}px;"
                            title="Rp {{ number_format($m->total,0,',','.') }}"
                        ></div>
                        <span class="chart-label">{{ \Carbon\Carbon::create()->month($m->month)->format('M') }}</span>
                    </div>
                @empty
                    {{-- Placeholder bars when no data --}}
                    @foreach(['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'] as $i => $label)
                        <div class="chart-col">
                            <div class="chart-bar" style="height:{{ rand(20,90) }}px;opacity:.3;"></div>
                            <span class="chart-label">{{ substr($label,0,1) }}</span>
                        </div>
                    @endforeach
                @endforelse
            </div>
        </div>
    </section>

    {{-- ── RECENT REVIEWS ── --}}
    <section class="anim-5">
        <div class="section-label">
            <div class="section-label-line" style="background:var(--warn);"></div>
            <h2>Recent Reviews</h2>
            <a href="{{ route('translator.reviews.index') }}">See All →</a>
        </div>
        <div class="reviews-grid">
            @forelse($recentReviews as $review)
                <div class="review-card">
                    <div class="review-stars">
                        @for($s=1;$s<=5;$s++)
                            {{ $s <= $review->rating ? '★' : '☆' }}
                        @endfor
                    </div>
                    <p class="review-text">"{{ $review->comment }}"</p>
                    <div class="review-author">
                        <div class="review-avatar"><i class="bi bi-person"></i></div>
                        <div>
                            <div class="review-author-name">{{ $review->user?->name ?? 'Anonymous' }}</div>
                            <div class="review-date">{{ $review->created_at->format('d M Y') }}</div>
                        </div>
                    </div>
                </div>
            @empty
                <div style="grid-column:1/-1;padding:40px;text-align:center;color:var(--ink-muted);background:var(--card);border-radius:var(--radius-lg);border:1px solid var(--border);">
                    <i class="bi bi-star" style="font-size:2rem;display:block;margin-bottom:10px;"></i>
                    No reviews yet. Complete some translations to receive feedback!
                </div>
            @endforelse
        </div>
    </section>

    {{-- ── COMPLETED ORDERS TABLE ── --}}
    <section class="anim-5">
        <div class="section-label">
            <div class="section-label-line" style="background:var(--accent);"></div>
            <h2>Completed Translations</h2>
            <a href="{{ route('translator.orders.index') }}">View All →</a>
        </div>
        <div class="orders-card">
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>Journal</th>
                        <th>Client</th>
                        <th>Completed</th>
                        <th>Earnings</th>
                        <th>Rating</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($completedOrders->take(5) as $order)
                        <tr>
                            <td>
                                <div style="font-weight:600;">{{ Str::limit($order->title, 40) }}</div>
                                <div style="font-size:12px;color:var(--ink-muted);">{{ $order->service?->name }}</div>
                            </td>
                            <td style="color:var(--ink-muted);font-size:13px;">{{ $order->user?->name }}</td>
                            <td style="color:var(--ink-muted);font-size:13px;">{{ $order->updated_at->format('d M Y') }}</td>
                            <td style="font-weight:600;color:var(--accent);">
                                Rp {{ number_format($order->total_price ?? 0, 0, ',', '.') }}
                            </td>
                            <td>
                                @if($order->review)
                                    <span style="color:var(--warn);font-size:13px;font-weight:600;">
                                        ★ {{ $order->review->rating }}
                                    </span>
                                @else
                                    <span style="color:var(--ink-muted);font-size:12px;">Not rated</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="empty-state">
                                <i class="bi bi-check2-circle"></i>
                                No completed translations yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

</div>

<script>
function showFileName(input) {
    const label = document.getElementById('file-name');
    if (input.files.length > 0) {
        label.textContent = '📄 ' + input.files[0].name;
        label.style.display = 'block';
    }
}
</script>

@endsection