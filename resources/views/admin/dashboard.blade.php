@extends('layouts.admin')

@section('content')

    <!-- START: Dashboard Header Banner -->
    <div class="page-header">
      <div>
        <h1 class="page-title">Dashboard Admin</h1>
        <p class="page-subtitle">Selamat datang, <strong>{{ auth()->user()->name }}</strong>! Kelola POS Toko Kelontong dengan mudah.</p>
      </div>
      <button class="btn-date-picker" type="button" id="date-picker-trigger">
        <i class="bi bi-calendar4-event"></i>
        <span id="selected-date-range">{{ date('F d, Y') }}</span>
      </button>
    </div>
    <!-- END: Dashboard Header Banner -->

    <!-- START: Main Layout Grid -->
    <div class="row g-4">

      <!-- TOP AREA: Quick Info Stat Cards Row -->
      <div class="col-12">
        <div class="row g-4">
          <!-- Stat Card 1: Alert Banner -->
          <div class="col-md-4">
            <div class="card alert-green-card">
              <div class="position-relative z-index-2">
                <span class="alert-green-badge">Status</span>
                <div class="alert-green-date">{{ date('d M Y') }}</div>
                <div class="alert-green-text">Sistem POS Toko Kelontong Berjalan Aktif</div>
              </div>
              <a href="{{ route('products.index') }}" class="alert-green-link z-index-2" id="alert-link-statistics">
                <span>Kelola Produk</span>
                <i class="bi bi-arrow-right"></i>
              </a>

              <svg class="alert-green-bg-shape" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g transform="translate(50,50)">
                  <rect x="-6" y="-45" width="12" height="90" rx="6" ry="6" fill="#B4F105" />
                  <rect x="-6" y="-45" width="12" height="90" rx="6" ry="6" fill="#B4F105" transform="rotate(60)" />
                  <rect x="-6" y="-45" width="12" height="90" rx="6" ry="6" fill="#B4F105" transform="rotate(120)" />
                </g>
              </svg>
            </div>
          </div>

          <!-- Stat Card 2: Net Income -->
          <div class="col-md-4">
            <div class="card card-stat d-flex flex-column justify-content-between">
              <div>
                <div class="card-header">
                  <span class="stat-label">Total Pendapatan</span>
                </div>
                <div class="stat-value">Rp 12.450.000</div>
                <div class="trend-badge trend-up">
                  <i class="bi bi-arrow-up-right"></i>
                  <span>+15% dari bulan lalu</span>
                </div>
              </div>
              <div class="sparkline-container sparkline-card-footer">
                <div id="income-sparkline"></div>
              </div>
            </div>
          </div>

          <!-- Stat Card 3: Total Products -->
          <div class="col-md-4">
            <div class="card card-stat d-flex flex-column justify-content-between">
              <div>
                <div class="card-header">
                  <span class="stat-label">Total Produk</span>
                </div>
                <div class="stat-value">{{ \Illuminate\Support\Facades\Schema::hasTable('products') ? \App\Models\Product::count() : 0 }} Produk</div>
                <div class="trend-badge trend-up">
                  <i class="bi bi-box-seam"></i>
                  <span>Terdaftar dalam database</span>
                </div>
              </div>
              <div class="sparkline-container sparkline-card-footer">
                <div id="return-sparkline"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- END: TOP AREA -->

      <!-- LEFT AREA: Primary Dashboard Stats & Tables -->
      <div class="col-xl-9 col-lg-8">
        <div class="row g-4">
          <!-- Column: Revenue Chart -->
          <div class="col-12">
            <div class="card mb-0">
              <div class="card-header mb-2">
                <h2 class="card-title">Grafik Penjualan</h2>
                <div class="d-flex gap-3 align-items-center">
                  <div class="chart-legend-item">
                    <span class="legend-dot bg-forest-medium"></span>
                    <span class="chart-legend-label">Pendapatan</span>
                  </div>
                  <div class="chart-legend-item">
                    <span class="legend-dot bg-lime-accent"></span>
                    <span class="chart-legend-label">Pengeluaran</span>
                  </div>
                </div>
              </div>
              <div class="d-flex align-items-baseline gap-2 mb-3">
                <span class="stat-value-amount">Rp 12.450.000</span>
                <span class="trend-badge trend-up fs-xs">+15% bulan ini</span>
              </div>
              <div id="revenue-chart"></div>
            </div>
          </div>
        </div>
      </div>

      <!-- RIGHT AREA: Performance Details Sidebar Panel -->
      <div class="col-xl-3 col-lg-4">
        <div class="right-panel-wrapper d-flex flex-column gap-4 h-100">
          <div class="card flex-grow-1 d-flex flex-column justify-content-between mb-0">
            <div class="card-header mb-1">
              <h2 class="card-title">Statistik Ringkas</h2>
            </div>
            <div id="views-chart"></div>
          </div>
        </div>
      </div>

    </div>
@endsection
