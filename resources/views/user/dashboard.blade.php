@extends('layouts.app')

@section('content')


<div class="space-y-10">

    {{-- ── HERO BANNER ── --}}
    <div class="hero-banner anim-0">
        <div class="hero-grid-overlay"></div>
        <div class="hero-content">
            <div class="hero-badge">
                <span></span>
                SCHOLARTRANS PLATFORM
            </div>
            <h1 class="hero-title">
                Welcome back,<br>{{ auth()->user()->name }}
            </h1>
            <p class="hero-sub">
                Connect with verified scholars · Translate with precision
            </p>
            <a href="{{ route('user.orders.create') }}" class="hero-cta">
                <i class="bi bi-plus-lg"></i>
                New Translation Request
            </a>
        </div>
        <div class="hero-stats">
            <div class="hero-stat-card">
                <div class="hero-stat-num">{{ $recentOrders->count() }}</div>
                <div class="hero-stat-label">Active Orders</div>
            </div>
            <div class="hero-stat-card">
                <div class="hero-stat-num">{{ $completedTranslations->count() }}</div>
                <div class="hero-stat-label">Completed</div>
            </div>
            <div class="hero-stat-card">
                <div class="hero-stat-num">{{ $featuredScholars->count() }}</div>
                <div class="hero-stat-label">Scholars</div>
            </div>
        </div>
    </div>

    {{-- ── FEATURED SCHOLARS ── --}}
    <section class="anim-1">
        <div class="section-label">
            <div class="section-label-line"></div>
            <h2>Featured Scholars</h2>
            <a href="{{ route('user.scholars.index') }}">View All →</a>
        </div>

        <div class="scholar-slider-wrap">
            <button class="scroll-btn left" onclick="scrollScholars(-320)">
                <i class="bi bi-chevron-left"></i>
            </button>
            <button class="scroll-btn right" onclick="scrollScholars(320)">
                <i class="bi bi-chevron-right"></i>
            </button>

            <div id="scholar-slider">
                @forelse($featuredScholars as $scholar)
                    <div class="scholar-card">
                        <div class="scholar-card-cover">
                            <div class="scholar-card-cover-pattern"></div>
                        </div>
                        <div class="scholar-avatar-wrap">
                            <div class="scholar-avatar">
                                <i class="bi bi-person-fill"></i>
                            </div>
                        </div>
                        <div class="scholar-body">
                            <div class="scholar-name">
                                {{ $scholar->academic_title }} {{ $scholar->user->name }}
                            </div>
                            <div class="scholar-uni">{{ $scholar->university }}</div>
                            <div class="scholar-tag">{{ $scholar->expertise }}</div>
                            <hr class="scholar-divider">
                            <div class="scholar-stat-row">
                                <span class="label">Publications</span>
                                <span class="val blue">{{ $scholar->publication_count }}</span>
                            </div>
                            <div class="scholar-stat-row">
                                <span class="label">Hourly Rate</span>
                                <span class="val green">Rp {{ number_format($scholar->hourly_rate,0,',','.') }}</span>
                            </div>
                            <div class="scholar-stat-row">
                                <span class="label">Status</span>
                                <span class="val green">{{ ucfirst($scholar->verification_status) }}</span>
                            </div>
                            <a href="{{ route('user.scholars.show', $scholar) }}" class="scholar-btn">
                                View Profile
                            </a>
                        </div>
                    </div>
                @empty
                    <div style="width:100%;padding:40px;text-align:center;color:var(--ink-muted);background:var(--card);border-radius:var(--radius-lg);border:1px solid var(--border);">
                        <i class="bi bi-mortarboard" style="font-size:2.5rem;display:block;margin-bottom:12px;"></i>
                        No verified scholars available.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- ── TRANSLATION SERVICES ── --}}
    <section class="anim-2">
        <div class="section-label">
            <div class="section-label-line"></div>
            <h2>Translation Services</h2>
        </div>
        <div class="service-grid">
            @forelse($services as $service)
                <div class="service-card">
                    <div class="service-icon"><i class="bi bi-translate"></i></div>
                    <div class="service-name">{{ $service->name }}</div>
                    <div class="service-desc">{{ $service->description }}</div>
                    <div class="service-price">
                        Rp {{ number_format($service->base_price,0,',','.') }}
                        <span>/ project</span>
                    </div>
                    <button class="service-btn">
                        <i class="bi bi-arrow-right-circle me-1"></i> Order Service
                    </button>
                </div>
            @empty
                <div style="grid-column:1/-1;padding:40px;text-align:center;color:var(--ink-muted);background:var(--card);border-radius:var(--radius-lg);border:1px solid var(--border);">
                    No services available.
                </div>
            @endforelse
        </div>
    </section>

    {{-- ── RECENT ORDERS ── --}}
    <section class="anim-3">
        <div class="section-label">
            <div class="section-label-line"></div>
            <h2>My Recent Orders</h2>
        </div>
        <div class="orders-card">
            <div class="orders-card-header">
                <h2>Orders</h2>
                <span class="orders-count">{{ $recentOrders->count() }} orders</span>
            </div>
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>Journal Title</th>
                        <th>Service</th>
                        <th>Translator</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentOrders as $order)
                        <tr>
                            <td style="font-weight:500;">{{ $order->title }}</td>
                            <td style="color:var(--ink-muted);">{{ $order->service?->name }}</td>
                            <td style="color:var(--ink-muted);">{{ $order->translator?->name ?? 'Not Assigned' }}</td>
                            <td>
                                @php
                                    $statusClass = match($order->status) {
                                        'pending'    => 'status-pending',
                                        'in_progress','processing' => 'status-progress',
                                        'completed'  => 'status-completed',
                                        default      => 'status-default',
                                    };
                                @endphp
                                <span class="status-badge {{ $statusClass }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="text-align:center;padding:48px;color:var(--ink-muted);">
                                <i class="bi bi-inbox" style="font-size:2rem;display:block;margin-bottom:10px;"></i>
                                You don't have any orders yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    {{-- ── COMPLETED TRANSLATIONS ── --}}
    <section class="anim-4">
        <div class="section-label">
            <div class="section-label-line"></div>
            <h2>Completed Translations</h2>
        </div>
        <div class="completed-grid">
            @forelse($completedTranslations as $order)
                <div class="completed-card">
                    <div class="completed-title">{{ $order->title }}</div>
                    <div class="completed-meta">Translator: {{ $order->translator?->name }}</div>
                    <div class="completed-date">
                        <i class="bi bi-check2-circle me-1" style="color:var(--accent);"></i>
                        Completed {{ $order->updated_at->format('d M Y') }}
                    </div>
                    @if($order->translated_file)
                        <a href="{{ asset('storage/' . $order->translated_file) }}" class="download-btn">
                            <i class="bi bi-download"></i> Download Result
                        </a>
                    @endif
                </div>
            @empty
                <div style="grid-column:1/-1;padding:40px;text-align:center;color:var(--ink-muted);background:var(--card);border-radius:var(--radius-lg);border:1px solid var(--border);">
                    No completed translations yet.
                </div>
            @endforelse
        </div>
    </section>

</div>

<script>
function scrollScholars(distance) {
    document.getElementById('scholar-slider').scrollBy({ left: distance, behavior: 'smooth' });
}
</script>

@endsection