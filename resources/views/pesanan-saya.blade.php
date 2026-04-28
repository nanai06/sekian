<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya - AYU-NE</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background: #fff; color: #3b1a1a; }

        /* CONTENT */
        .content { padding: 36px 40px; }

        h1 { font-size: 22px; font-weight: 800; color: #3b1a1a; margin-bottom: 24px; }

        /* STATUS TABS */
        .status-tabs {
            display: flex; gap: 0;
            border-bottom: 1px solid #f5e0e0;
            margin-bottom: 28px;
        }

        .status-tab {
            font-size: 14px; font-weight: 500; color: #9a6a6a;
            padding: 10px 0; margin-right: 28px; cursor: pointer;
            border-bottom: 2px solid transparent; transition: all 0.2s;
            white-space: nowrap;
        }
        .status-tab.active { color: #e07080; font-weight: 700; border-bottom: 2px solid #e07080; }
        .status-tab:hover:not(.active) { color: #7a4a4a; }

        /* ORDER CARD */
        .order-card {
            display: flex; align-items: flex-start; gap: 20px;
            padding: 24px; border: 1px solid #f5e0e0; border-radius: 16px;
            margin-bottom: 14px; transition: box-shadow 0.2s;
        }
        .order-card:hover { box-shadow: 0 4px 16px rgba(224,112,128,0.08); }

        .order-thumb {
            width: 80px; height: 80px; border-radius: 12px;
            background: #fdf0f2; display: flex; align-items: center;
            justify-content: center; font-size: 10px; color: #c4a0a0;
            text-align: center; flex-shrink: 0; line-height: 1.4;
        }

        .order-info { flex: 1; }
        .order-name { font-size: 15px; font-weight: 700; color: #3b1a1a; margin-bottom: 4px; }
        .order-date { font-size: 12px; color: #b4a0a0; margin-bottom: 10px; }
        .order-price { font-size: 16px; font-weight: 800; color: #3b1a1a; margin-bottom: 14px; }

        .order-actions { display: flex; gap: 10px; }

        .btn-lacak {
            padding: 9px 20px; border: 1.5px solid #f0d5d5;
            border-radius: 50px; background: white; font-size: 13px;
            font-weight: 600; color: #3b1a1a; cursor: pointer;
            font-family: 'Poppins', sans-serif; transition: all 0.2s;
        }
        .btn-lacak:hover { background: #fce4ec; border-color: #f4a0aa; }

        .btn-detail {
            padding: 9px 20px; background: #f4a0aa; color: white;
            border: none; border-radius: 50px; font-size: 13px;
            font-weight: 600; cursor: pointer; font-family: 'Poppins', sans-serif;
            transition: background 0.2s;
        }
        .btn-detail:hover { background: #e8858f; }

        .order-status { flex-shrink: 0; }

        .status-badge {
            padding: 5px 14px; border-radius: 50px;
            font-size: 12px; font-weight: 600;
        }
        .status-dikirim { background: #e3f2fd; color: #1976d2; }
        .status-diproses { background: #fff3e0; color: #f57c00; }
        .status-selesai { background: #e8f5e9; color: #388e3c; }
        .status-dibayar { background: #fce4ec; color: #e07080; }
        .status-batal { background: #f5f5f5; color: #9e9e9e; }
    </style>
</head>
<body>

@include('layouts.navigation')

<div class="content">
    <h1>Pesanan Saya</h1>

    <!-- STATUS TABS -->
    <div class="status-tabs">
        <div class="status-tab active" onclick="switchStatus('semua', this)">Semua</div>
        <div class="status-tab" onclick="switchStatus('belum', this)">Belum Dibayar</div>
        <div class="status-tab" onclick="switchStatus('diproses', this)">Sedang Diproses</div>
        <div class="status-tab" onclick="switchStatus('dikirim', this)">Dikirim</div>
        <div class="status-tab" onclick="switchStatus('selesai', this)">Selesai</div>
        <div class="status-tab" onclick="switchStatus('dibatalkan', this)">Dibatalkan</div>
    </div>

    <!-- SEMUA -->
    <div id="tSemua">

        <div class="order-card" data-status="dikirim">
            <div class="order-thumb">Product<br>Thumb</div>
            <div class="order-info">
                <div class="order-name">5X Ceramide Barrier Repair</div>
                <div class="order-date">5 Mar 2026</div>
                <div class="order-price">Rp 110.000</div>
                <div class="order-actions">
                    <a href="{{ route('lacak-pesanan') }}" class="btn-lacak" style="text-decoration:none;">Lacak Pesanan</a>
                    <a href="{{ route('detail-pesanan') }}" class="btn-detail" style="text-decoration:none;">Lihat Detail</a>
                </div>
            </div>
            <div class="order-status"><span class="status-badge status-dikirim">Dikirim</span></div>
        </div>

        <div class="order-card" data-status="diproses">
            <div class="order-thumb">Product<br>Thumb</div>
            <div class="order-info">
                <div class="order-name">Holyshield Sunscreen</div>
                <div class="order-date">3 Mar 2026</div>
                <div class="order-price">Rp 90.000</div>
                <div class="order-actions">
                    <button class="btn-lacak">Lacak Pesanan</button>
                    <button class="btn-detail">Lihat Detail</button>
                </div>
            </div>
            <div class="order-status"><span class="status-badge status-diproses">Diproses</span></div>
        </div>

        <div class="order-card" data-status="selesai">
            <div class="order-thumb">Product<br>Thumb</div>
            <div class="order-info">
                <div class="order-name">Brightening Face Toner</div>
                <div class="order-date">1 Mar 2026</div>
                <div class="order-price">Rp 60.000</div>
                <div class="order-actions">
                    <button class="btn-lacak">Lacak Pesanan</button>
                    <button class="btn-detail">Lihat Detail</button>
                </div>
            </div>
            <div class="order-status"><span class="status-badge status-selesai">Selesai</span></div>
        </div>

        <div class="order-card" data-status="belum">
            <div class="order-thumb">Product<br>Thumb</div>
            <div class="order-info">
                <div class="order-name">Moisturizer SPF 30</div>
                <div class="order-date">28 Feb 2026</div>
                <div class="order-price">Rp 75.000</div>
                <div class="order-actions">
                    <button class="btn-lacak">Lacak Pesanan</button>
                    <button class="btn-detail">Lihat Detail</button>
                </div>
            </div>
            <div class="order-status"><span class="status-badge status-dibayar">Belum Dibayar</span></div>
        </div>

    </div>
</div>

<script>
    const statusMap = {
        semua: null,
        belum: 'belum',
        diproses: 'diproses',
        dikirim: 'dikirim',
        selesai: 'selesai',
        dibatalkan: 'dibatalkan'
    };

    function switchStatus(key, el) {
        document.querySelectorAll('.status-tab').forEach(t => t.classList.remove('active'));
        el.classList.add('active');

        const cards = document.querySelectorAll('.order-card');
        cards.forEach(card => {
            if (!statusMap[key] || card.dataset.status === statusMap[key]) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });
    }
</script>

</body>
</html>