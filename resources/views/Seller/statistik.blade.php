<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
    <title>Statistik Toko - AYU-NE</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --pk: #639922; --pk2: #4a7a1e; --pk-light: #eaf3de;
            --border: #c5e0a0; --text: #2d5016; --text2: #5a7a40;
            --grn: #4CAF7D; --grn-bg: #EAF3DE;
            --org: #E65100; --org-bg: #FFF3E0;
            --blu: #1565C0; --blu-bg: #E3F2FD;
            --yel: #f59e0b; --yel-bg: #FFF8E1;
        }
        * { margin:0; padding:0; box-sizing:border-box; font-family:'Poppins',sans-serif; }
        body { background:linear-gradient(180deg,#e8f5e0 0%,#f5fff5 50%,#e8f5e0 100%); color:var(--text); }

        .page { max-width:1100px; margin:0 auto; padding:30px 40px 60px; }

        /* HEADER */
        .page-header { display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:24px; }
        .breadcrumb { font-size:12px; color:var(--text2); margin-bottom:4px; }
        .breadcrumb a { color:var(--pk); text-decoration:none; }
        .page-title { font-size:24px; font-weight:800; color:var(--text); }
        .page-title span { color:var(--pk); }
        .btn-back {
            display:inline-flex; align-items:center; gap:6px;
            padding:9px 18px; border:1.5px solid var(--border);
            border-radius:10px; font-size:13px; font-weight:600;
            color:var(--text2); background:white; text-decoration:none; transition:all 0.2s;
        }
        .btn-back:hover { border-color:var(--pk); color:var(--pk); }

        /* STAT CARDS */
        .stat-grid { display:grid; grid-template-columns:repeat(4,1fr); gap:14px; margin-bottom:24px; }
        .stat-card {
            background:white; border:1px solid var(--border); border-radius:16px;
            padding:20px; box-shadow:0 2px 8px rgba(99,153,34,0.06);
            transition:all 0.2s;
        }
        .stat-card:hover { transform:translateY(-3px); box-shadow:0 6px 20px rgba(99,153,34,0.12); }
        .stat-top { display:flex; justify-content:space-between; align-items:center; margin-bottom:12px; }
        .stat-ico {
            width:38px; height:38px; border-radius:10px;
            display:flex; align-items:center; justify-content:center;
        }
        .stat-ico.grn { background:var(--grn-bg); color:var(--grn); }
        .stat-ico.pk  { background:var(--pk-light); color:var(--pk); }
        .stat-ico.yel { background:var(--yel-bg); color:var(--yel); }
        .stat-ico.blu { background:var(--blu-bg); color:var(--blu); }
        .stat-num { font-size:22px; font-weight:800; line-height:1; margin-bottom:4px; }
        .stat-lbl { font-size:11px; color:var(--text2); font-weight:500; }

        /* TAB */
        .tab-row {
            display:flex; gap:8px; margin-bottom:20px;
            border-bottom:2px solid var(--border); padding-bottom:0;
        }
        .tab-btn {
            padding:10px 20px; font-size:13px; font-weight:600;
            color:var(--text2); background:none; border:none;
            cursor:pointer; font-family:'Poppins',sans-serif;
            border-bottom:2px solid transparent; margin-bottom:-2px;
            transition:all 0.2s; display:flex; align-items:center; gap:6px;
        }
        .tab-btn.active { color:var(--pk); border-bottom-color:var(--pk); }
        .tab-btn:hover { color:var(--pk); }
        .tab-content { display:none; }
        .tab-content.active { display:block; }

        /* CHART CARD */
        .chart-card {
            background:white; border:1px solid var(--border); border-radius:16px;
            padding:24px; box-shadow:0 2px 12px rgba(99,153,34,0.06); margin-bottom:20px;
        }
        .chart-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; }
        .chart-title { font-size:14px; font-weight:700; color:var(--text); display:flex; align-items:center; gap:7px; }
        .chart-title iconify-icon { color:var(--pk); }
        .chart-period {
            font-size:10px; color:var(--text2); background:var(--pk-light);
            padding:3px 10px; border-radius:10px; font-weight:500;
        }
        .chart-wrap { position:relative; height:280px; }

        /* MINI STATS UNDER CHART */
        .chart-stats { display:grid; grid-template-columns:repeat(3,1fr); gap:14px; margin-top:16px; }
        .chart-stat {
            background:var(--pk-light); border-radius:12px; padding:14px 16px; text-align:center;
        }
        .chart-stat-num { font-size:18px; font-weight:800; color:var(--pk); }
        .chart-stat-lbl { font-size:10px; color:var(--text2); margin-top:2px; }

        /* KONVERSI */
        .konversi-card {
            background:white; border:1px solid var(--border); border-radius:16px;
            padding:24px; box-shadow:0 2px 12px rgba(99,153,34,0.06); margin-bottom:20px;
        }
        .konversi-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; }
        .konversi-title { font-size:14px; font-weight:700; color:var(--text); display:flex; align-items:center; gap:7px; }
        .konversi-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:14px; }
        .konversi-item {
            text-align:center; padding:16px; border:1px solid var(--border);
            border-radius:12px; background:#f5fbf0;
        }
        .konversi-num { font-size:24px; font-weight:800; margin-bottom:4px; }
        .konversi-lbl { font-size:11px; color:var(--text2); font-weight:500; }
        .konversi-bar-wrap { margin-top:14px; }
        .konversi-bar-lbl { display:flex; justify-content:space-between; font-size:11px; color:var(--text2); margin-bottom:6px; }
        .konversi-bar { height:10px; background:#e8f3de; border-radius:99px; overflow:hidden; }
        .konversi-fill { height:100%; border-radius:99px; background:linear-gradient(90deg, #4CAF7D, #639922); transition:width 1s ease; }

        /* PRODUK STATS */
        .produk-stat-card {
            background:white; border:1px solid var(--border); border-radius:16px;
            padding:24px; box-shadow:0 2px 12px rgba(99,153,34,0.06);
        }
        .produk-stat-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:16px; }
        .produk-stat-title { font-size:14px; font-weight:700; color:var(--text); display:flex; align-items:center; gap:7px; }
        .produk-row {
            display:flex; align-items:center; gap:12px;
            padding:10px 0; border-bottom:0.5px solid #e8f3de;
        }
        .produk-row:last-child { border-bottom:none; }
        .produk-rank {
            width:24px; height:24px; border-radius:6px;
            background:var(--pk-light); color:var(--pk);
            font-size:11px; font-weight:700;
            display:flex; align-items:center; justify-content:center; flex-shrink:0;
        }
        .produk-img-sm {
            width:36px; height:36px; border-radius:8px;
            background:var(--pk-light); overflow:hidden; flex-shrink:0;
            border:1px solid var(--border);
            display:flex; align-items:center; justify-content:center;
        }
        .produk-img-sm img { width:100%; height:100%; object-fit:cover; }
        .produk-info-sm { flex:1; min-width:0; }
        .produk-nama-sm { font-size:12px; font-weight:600; color:var(--text); white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
        .produk-cat-sm { font-size:10px; color:var(--text2); margin-top:1px; }
        .produk-harga-sm { font-size:12px; font-weight:700; color:var(--pk); white-space:nowrap; }

        /* INSIGHT CARDS */
        .insight-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:14px; margin-top:20px; }
        .insight-card {
            background:white; border:1px solid var(--border); border-radius:14px;
            padding:20px; box-shadow:0 2px 8px rgba(99,153,34,0.06);
        }
        .insight-ico {
            width:36px; height:36px; border-radius:10px;
            display:flex; align-items:center; justify-content:center;
            margin-bottom:10px;
        }
        .insight-ico.grn { background:var(--grn-bg); color:var(--grn); }
        .insight-ico.yel { background:var(--yel-bg); color:var(--yel); }
        .insight-ico.blu { background:var(--blu-bg); color:var(--blu); }
        .insight-title { font-size:12px; font-weight:700; color:var(--text); margin-bottom:4px; }
        .insight-desc { font-size:11px; color:var(--text2); line-height:1.6; }

        /* EMPTY */
        .empty-state { text-align:center; padding:40px 20px; }
        .empty-txt { font-size:13px; color:var(--text2); font-weight:500; margin-top:10px; }
        .empty-sub { font-size:11px; color:#9ab87a; margin-top:4px; }
    </style>
</head>
<body>

    @include('layouts.navigation')

    <div class="page">

        {{-- HEADER --}}
        <div class="page-header">
            <div>
                <div class="breadcrumb">
                    <a href="{{ route('profil') }}">Profil</a> /
                    <a href="{{ route('seller.dashboard') }}">Dashboard Penjual</a> /
                    Statistik
                </div>
                <div class="page-title">Statistik <span>Toko</span></div>
            </div>
            <a href="{{ route('seller.dashboard') }}" class="btn-back">
                <iconify-icon icon="solar:arrow-left-linear" width="15"></iconify-icon>
                Kembali
            </a>
        </div>

        {{-- STAT CARDS --}}
        @php
            $konversi = $totalPesanan > 0 ? round(($pesananSelesai / $totalPesanan) * 100) : 0;
        @endphp
        <div class="stat-grid">
            <div class="stat-card">
                <div class="stat-top">
                    <div class="stat-ico pk">
                        <iconify-icon icon="solar:wallet-money-bold" width="18"></iconify-icon>
                    </div>
                </div>
                <div class="stat-num" style="color:var(--pk);">
                    Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                </div>
                <div class="stat-lbl">Total Pendapatan</div>
            </div>
            <div class="stat-card">
                <div class="stat-top">
                    <div class="stat-ico grn">
                        <iconify-icon icon="solar:clipboard-list-bold" width="18"></iconify-icon>
                    </div>
                </div>
                <div class="stat-num" style="color:var(--grn);">{{ $totalPesanan }}</div>
                <div class="stat-lbl">Total Pesanan</div>
            </div>
            <div class="stat-card">
                <div class="stat-top">
                    <div class="stat-ico yel">
                        <iconify-icon icon="solar:star-bold" width="18"></iconify-icon>
                    </div>
                </div>
                <div class="stat-num" style="color:var(--yel);">{{ number_format($ratingToko, 1) }} ★</div>
                <div class="stat-lbl">Rating Toko</div>
            </div>
            <div class="stat-card">
                <div class="stat-top">
                    <div class="stat-ico blu">
                        <iconify-icon icon="solar:box-bold" width="18"></iconify-icon>
                    </div>
                </div>
                <div class="stat-num" style="color:var(--blu);">{{ $produkAktif }}</div>
                <div class="stat-lbl">Produk Aktif</div>
            </div>
        </div>

        {{-- TABS --}}
        <div class="tab-row">
            <button class="tab-btn active" onclick="switchTab('penjualan', this)">
                <iconify-icon icon="solar:chart-2-bold" width="14"></iconify-icon>
                Penjualan
            </button>
            <button class="tab-btn" onclick="switchTab('konversi', this)">
                <iconify-icon icon="solar:transfer-horizontal-bold" width="14"></iconify-icon>
                Konversi
            </button>
            <button class="tab-btn" onclick="switchTab('produk', this)">
                <iconify-icon icon="solar:box-bold" width="14"></iconify-icon>
                Produk
            </button>
        </div>

        {{-- TAB: PENJUALAN --}}
        <div class="tab-content active" id="tab-penjualan">

            {{-- Chart Pendapatan --}}
            <div class="chart-card">
                <div class="chart-header">
                    <div class="chart-title">
                        <iconify-icon icon="solar:chart-2-bold" width="16"></iconify-icon>
                        Grafik Pendapatan
                    </div>
                    <span class="chart-period">30 hari terakhir</span>
                </div>
                <div class="chart-wrap">
                    <canvas id="revenueChart"></canvas>
                </div>
                <div class="chart-stats">
                    <div class="chart-stat">
                        <div class="chart-stat-num">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
                        <div class="chart-stat-lbl">Total Pendapatan</div>
                    </div>
                    <div class="chart-stat">
                        <div class="chart-stat-num">{{ $pesananSelesai }}</div>
                        <div class="chart-stat-lbl">Pesanan Selesai</div>
                    </div>
                    <div class="chart-stat">
                        <div class="chart-stat-num">
                            Rp {{ $pesananSelesai > 0 ? number_format($totalPendapatan / $pesananSelesai, 0, ',', '.') : 0 }}
                        </div>
                        <div class="chart-stat-lbl">Rata-rata per Pesanan</div>
                    </div>
                </div>
            </div>

            {{-- Chart Jumlah Pesanan --}}
            <div class="chart-card">
                <div class="chart-header">
                    <div class="chart-title">
                        <iconify-icon icon="solar:clipboard-list-bold" width="16"></iconify-icon>
                        Grafik Jumlah Pesanan
                    </div>
                    <span class="chart-period">30 hari terakhir</span>
                </div>
                <div class="chart-wrap">
                    <canvas id="orderChart"></canvas>
                </div>
            </div>

        </div>

        {{-- TAB: KONVERSI --}}
        <div class="tab-content" id="tab-konversi">
            <div class="konversi-card">
                <div class="konversi-header">
                    <div class="konversi-title">
                        <iconify-icon icon="solar:transfer-horizontal-bold" width="16"></iconify-icon>
                        Tingkat Konversi Pesanan
                    </div>
                </div>
                <div class="konversi-grid">
                    <div class="konversi-item">
                        <div class="konversi-num" style="color:var(--text);">{{ $totalPesanan }}</div>
                        <div class="konversi-lbl">Total Pesanan Masuk</div>
                    </div>
                    <div class="konversi-item">
                        <div class="konversi-num" style="color:var(--grn);">{{ $pesananSelesai }}</div>
                        <div class="konversi-lbl">Pesanan Selesai</div>
                    </div>
                    <div class="konversi-item">
                        <div class="konversi-num" style="color:var(--pk);">{{ $konversi }}%</div>
                        <div class="konversi-lbl">Tingkat Konversi</div>
                    </div>
                </div>
                <div class="konversi-bar-wrap" style="margin-top:20px;">
                    <div class="konversi-bar-lbl">
                        <span>Konversi pesanan selesai</span>
                        <span style="font-weight:700; color:var(--pk);">{{ $konversi }}%</span>
                    </div>
                    <div class="konversi-bar">
                        <div class="konversi-fill" style="width:{{ $konversi }}%;"></div>
                    </div>
                </div>
            </div>

            {{-- Insight Cards --}}
            <div class="insight-grid">
                <div class="insight-card">
                    <div class="insight-ico grn">
                        <iconify-icon icon="solar:check-circle-bold" width="18"></iconify-icon>
                    </div>
                    <div class="insight-title">Pesanan Berhasil</div>
                    <div class="insight-desc">{{ $pesananSelesai }} dari {{ $totalPesanan }} pesanan berhasil diselesaikan dengan baik.</div>
                </div>
                <div class="insight-card">
                    <div class="insight-ico yel">
                        <iconify-icon icon="solar:star-bold" width="18"></iconify-icon>
                    </div>
                    <div class="insight-title">Rating Toko</div>
                    <div class="insight-desc">Rating toko kamu saat ini {{ number_format($ratingToko, 1) }} dari 5.0. {{ $ratingToko >= 4 ? 'Pertahankan!' : 'Tingkatkan pelayanan untuk rating lebih baik.' }}</div>
                </div>
                <div class="insight-card">
                    <div class="insight-ico blu">
                        <iconify-icon icon="solar:lightbulb-bold" width="18"></iconify-icon>
                    </div>
                    <div class="insight-title">Tips Meningkatkan Konversi</div>
                    <div class="insight-desc">Balas pesan pembeli dengan cepat dan upload foto produk yang jelas untuk meningkatkan kepercayaan.</div>
                </div>
            </div>
        </div>

        {{-- TAB: PRODUK --}}
        <div class="tab-content" id="tab-produk">
            <div class="produk-stat-card">
                <div class="produk-stat-header">
                    <div class="produk-stat-title">
                        <iconify-icon icon="solar:box-bold" width="16"></iconify-icon>
                        Produk Aktif ({{ $produkAktif }})
                    </div>
                </div>

                @if($produkList->isEmpty())
                    <div class="empty-state">
                        <iconify-icon icon="solar:box-bold" width="40" style="color:var(--border);"></iconify-icon>
                        <div class="empty-txt">Belum ada produk aktif</div>
                        <div class="empty-sub">Upload produk pertamamu sekarang!</div>
                    </div>
                @else
                    @foreach($produkList as $index => $produk)
                        @php $foto = is_array($produk->foto) ? ($produk->foto[0] ?? null) : $produk->foto; @endphp
                        <div class="produk-row">
                            <div class="produk-rank">{{ $index + 1 }}</div>
                            <div class="produk-img-sm">
                                @if($foto)
                                    <img src="{{ asset('storage/'.$foto) }}" alt="{{ $produk->nama_produk }}">
                                @else
                                    <iconify-icon icon="solar:cosmetic-bold" width="18" style="color:var(--border);"></iconify-icon>
                                @endif
                            </div>
                            <div class="produk-info-sm">
                                <div class="produk-nama-sm">{{ $produk->nama_produk }}</div>
                                <div class="produk-cat-sm">{{ $produk->category->nama ?? '-' }}</div>
                            </div>
                            <div class="produk-harga-sm">Rp {{ number_format($produk->harga, 0, ',', '.') }}</div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

    </div>

    <script>
        // ── TAB SWITCHER ──
        function switchTab(name, btn) {
            document.querySelectorAll('.tab-content').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
            document.getElementById('tab-' + name).classList.add('active');
            btn.classList.add('active');
        }

        // ── CHART DATA ──
        const chartRaw = {!! json_encode($chartPenjualan) !!};
        const labels   = chartRaw.map(d => d.tanggal);
        const revenue  = chartRaw.map(d => d.total);
        const orders   = chartRaw.map(d => d.jumlah);

        const chartDefaults = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { font: { size: 9, family: 'Poppins' }, color: '#5a7a40' }
                },
                y: {
                    grid: { color: 'rgba(197,224,160,0.4)', drawBorder: false },
                    ticks: { font: { size: 9, family: 'Poppins' }, color: '#5a7a40' }
                }
            }
        };

        // Chart Pendapatan
        new Chart(document.getElementById('revenueChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Pendapatan',
                    data: revenue,
                    backgroundColor: 'rgba(99,153,34,0.15)',
                    borderColor: '#639922',
                    borderWidth: 2,
                    borderRadius: 6,
                    borderSkipped: false,
                }]
            },
            options: {
                ...chartDefaults,
                plugins: {
                    ...chartDefaults.plugins,
                    tooltip: {
                        callbacks: {
                            label: ctx => 'Rp ' + ctx.raw.toLocaleString('id-ID')
                        }
                    }
                },
                scales: {
                    ...chartDefaults.scales,
                    y: {
                        ...chartDefaults.scales.y,
                        ticks: {
                            ...chartDefaults.scales.y.ticks,
                            callback: val => 'Rp ' + (val/1000) + 'rb'
                        }
                    }
                }
            }
        });

        // Chart Pesanan
        new Chart(document.getElementById('orderChart').getContext('2d'), {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Pesanan',
                    data: orders,
                    backgroundColor: 'rgba(76,175,125,0.1)',
                    borderColor: '#4CAF7D',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#4CAF7D',
                    pointRadius: 4,
                }]
            },
            options: {
                ...chartDefaults,
                plugins: {
                    ...chartDefaults.plugins,
                    tooltip: {
                        callbacks: {
                            label: ctx => ctx.raw + ' pesanan'
                        }
                    }
                }
            }
        });
    </script>

</body>
</html>