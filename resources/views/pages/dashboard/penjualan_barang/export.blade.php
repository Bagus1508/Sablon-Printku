<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Penjualan Barang</title>
    <style>
        @page {
            margin: 0.5cm;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            line-height: 1.4;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .company-name {
            font-size: 20px;
            font-weight: bold;
            color: #2c5282;
            margin-bottom: 5px;
        }

        .document-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 15px;
            text-transform: uppercase;
            border-bottom: 2px solid #2c5282;
            padding-bottom: 5px;
        }

        .info-section {
            margin-bottom: 20px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-bottom: 15px;
        }

        .info-item {
            margin-bottom: 5px;
        }

        .info-label {
            font-weight: bold;
            color: #2c5282;
            margin-right: 5px;
        }

        .table-container {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th {
            background-color: #2c5282;
            color: white;
            padding: 8px;
            text-align: center;
            font-weight: bold;
        }

        td {
            padding: 8px;
            border: 1px solid #ddd;
            vertical-align: top;
        }

        .notes {
            margin-top: 10px;
            border-top: 1px dashed #2c5282;
            padding-top: 10px;
        }

        .status-badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 13px;
            text-transform: uppercase;
        }

        .status-pending {
            background-color: #f6ad55;
            color: #7b341e;
        }

        .status-approved {
            background-color: #68d391;
            color: #234e52;
        }

        .status-rejected {
            background-color: #fc8181;
            color: #9b2c2c;
        }

        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 13px;
        }

        .signature-section {
            display: flex;
            justify-content: space-between;
            margin-top: 50px;
        }

        .signature-box {
            width: 200px;
            text-align: center;
        }

        .signature-line {
            border-top: 1px solid #333;
            margin-top: 50px;
            padding-top: 5px;
        }

        .serial-number {
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="company-name">SABLON PRINT SURABAYA</div>
        <div class="document-title">Invoice {{ $nama }}</div>
    </div>

    <div class="info-section">
        <table width="100%" style="border: none; border-collapse: collapse; color: #2c5282;">
            <tr style="border: none;">
                <td align="left" width="50%" style="border: none; padding: 0;">
                    <strong>No Transaksi:</strong> {{ @$data->no_transaksi }}<br>
                    <strong>Tanggal:</strong> {{ @$data->created_at }}
                </td>
                <td align="left" width="50%" style="border: none; padding: 0;">
                    <strong>Nama Pembeli:</strong> {{ @$data->nama }}<br>
                    <strong>Status:</strong> {{ getStatusList($data->status ?? 0) }}
                </td>
            </tr>
        </table>

        <div class="notes">
            <div class="info-label">Catatan:</div>
            <div class="info-value">{{ @$data->catatan }}</div>
        </div>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 30%;">Kode Barang</th>
                    <th style="width: 25%;">Nama Barang</th>
                    <th style="width: 10%;">Harga</th>
                    <th style="width: 10%;">Jumlah</th>
                    <th style="width: 20%;">Sub Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data->items as $item)
                    <tr>
                        <td class="serial-number">1</td>
                        <td>{{ $item->kode_barang ?? '' }}</td>
                        <td>{{ $item->nama_barang ?? '' }}</td>
                        <td>{{ formatCurrency($item->harga ?? 0) }}</td>
                        <td>{{ formatCurrency($item->jumlah ?? 0) }}</td>
                        <td>{{ formatCurrency($item->sub_total ?? 0) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="footer">
        <div style="margin-bottom: 20px; font-size: 20px;">Total Transaksi :
            {{ formatCurrency($data->total_transaksi, $withRp = true) }} </div>
        <div>Dokumen ini dicetak pada: {{ \Carbon\Carbon::now()->translatedFormat('j F Y H:i') }}</div>
    </div>


<table width="100%" style="border: none; border-collapse: collapse; color: #2c5282;">
    <tr style="border: none;">
        <td align="left" width="50%" style="border: none; padding: 0;">
            </td>
        <td align="right" width="50%" style="border: none; padding: 0;">
            <div style="
                width: 200px;
                text-align: center;
                margin-top: 50px;
                /* Ini adalah kuncinya: Dorong ke kanan */
                margin-left: auto;
            ">
                <div>Mengetahui,</div>
                <div style="border-bottom: 1px solid black; margin: 60px 0 5px 0;"></div>
                <div>{{ @$data->nama ?? 'Pelanggan' }}</div>
            </div>
        </td>
    </tr>
</table>
</body>

</html>
