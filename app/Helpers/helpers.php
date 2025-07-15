<?php

use App\Models\DataProduk;
use App\Models\PenerimaanBarang;
use App\Models\PengirimanBarang;
use App\Models\PermintaanBarang;
use App\Models\Produk;
use App\Models\VerifikasiPermintaanBarang;

if (!function_exists('setTitle')) {
    function setTitle($title)
    {
        session(['page_title' => $title]);
    }
}

if (!function_exists('getStatusList')) {
    function getStatusList($key = null)
    {
        $columns = [
            0 => 'Draft',
            1 => 'Perlu Persetujuan',
            2 => 'Disetujui',
            3 => 'Selesai',
            4 => 'Tidak Disetujui',
        ];

        return is_null($key) ? $columns : ($columns[$key] ?? null);
    }
}

if (!function_exists('getDeliveryStatusList')) {
    function getDeliveryStatusList($key = null)
    {
        $columns = [
            0 => 'Perlu Dikirim',
            1 => 'Proses Kirim',
            2 => 'Barang Diterima',
        ];

        return is_null($key) ? $columns : ($columns[$key] ?? null);
    }
}

if (!function_exists('getReceiptItemStatusList')) {
    function getReceiptItemStatusList($key = null)
    {
        $columns = [
            0 => 'Belum Diterima',
            1 => 'Barang Diterima',
            2 => 'Barang Ditolak',
        ];

        return is_null($key) ? $columns : ($columns[$key] ?? null);
    }
}

if (!function_exists('getListProduct')) {
    function getListProduct($key = null)
    {
        $columns = DataProduk::pluck('nama_barang', 'kode_produk');

        return is_null($key) ? $columns : ($columns[$key] ?? null);
    }
}

if (!function_exists('getPriceProduct')) {
    function getPriceProduct($key = null)
    {
        $columns = DataProduk::pluck('harga_jual', 'kode_produk');

        return is_null($key) ? $columns : ($columns[$key] ?? null);
    }
}

if (!function_exists('getUnitList')) {
    function getUnitList()
    {
        $columns = [
            'PCS' => 'PCS',
            'BOX' => 'BOX',
        ];

        return $columns;
    }
}

if (!function_exists('formatCurrency')) {
    function formatCurrency($amount, $withRp = false)
    {
        $formatted = number_format($amount, 2, ',', '.');

        if ($withRp) {
            return 'Rp ' . $formatted;
        }

        return $formatted;
    }
}

if (!function_exists('getTransactionNoItemReq')) {
    function getTransactionNoItemReq()
    {
        // Ambil record terakhir berdasarkan ID atau tanggal
        $last = \App\Models\PermintaanBarang::orderBy('id', 'desc')->first();

        // Format nomor: PR-YYMMDD-0001
        $prefix = 'PR';
        $datePart = now()->format('ymd'); // contoh: 250703

        if ($last) {
            // Ambil bagian nomor dari transaksi terakhir
            $lastNumber = (int) substr($last->no_transaksi, -4);
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }

        return $prefix . '-' . $datePart . '-' . $newNumber;
    }
}

if (!function_exists('getTransactionNoSales')) {
    function getTransactionNoSales()
    {
        // Ambil record terakhir berdasarkan ID atau tanggal
        $last = \App\Models\PenjualanBarang::orderBy('id', 'desc')->first();

        // Format nomor: PR-YYMMDD-0001
        $prefix = 'SO';
        $datePart = now()->format('ymd'); // contoh: 250703

        if ($last) {
            // Ambil bagian nomor dari transaksi terakhir
            $lastNumber = (int) substr($last->no_transaksi, -4);
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }

        return $prefix . '-' . $datePart . '-' . $newNumber;
    }
}

if (!function_exists('getTransactionNoVerificationPr')) {
    function getTransactionNoVerificationPr()
    {
        // Ambil record terakhir berdasarkan ID atau tanggal
        $last = VerifikasiPermintaanBarang::orderBy('id', 'desc')->first();

        // Format nomor: PR-YYMMDD-0001
        $prefix = 'VPR';
        $datePart = now()->format('ymd'); // contoh: 250703

        if ($last) {
            // Ambil bagian nomor dari transaksi terakhir
            $lastNumber = (int) substr($last->no_transaksi, -4);
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }

        return $prefix . '-' . $datePart . '-' . $newNumber;
    }
}

if (!function_exists('getTransactionNoDelivery')) {
    function getTransactionNoDelivery()
    {
        // Ambil record terakhir berdasarkan ID atau tanggal
        $last = PengirimanBarang::orderBy('id', 'desc')->first();

        // Format nomor: PR-YYMMDD-0001
        $prefix = 'DO';
        $datePart = now()->format('ymd'); // contoh: 250703

        if ($last) {
            // Ambil bagian nomor dari transaksi terakhir
            $lastNumber = (int) substr($last->no_transaksi, -4);
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }

        return $prefix . '-' . $datePart . '-' . $newNumber;
    }
}

if (!function_exists('getTransactionNoReceiptItem')) {
    function getTransactionNoReceiptItem()
    {
        // Ambil record terakhir berdasarkan ID atau tanggal
        $last = PenerimaanBarang::orderBy('id', 'desc')->first();

        // Format nomor: PR-YYMMDD-0001
        $prefix = 'GRN';
        $datePart = now()->format('ymd'); // contoh: 250703

        if ($last) {
            // Ambil bagian nomor dari transaksi terakhir
            $lastNumber = (int) substr($last->no_transaksi, -4);
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }

        return $prefix . '-' . $datePart . '-' . $newNumber;
    }
}

if (!function_exists('getTransactionNoReceiptCustomer')) {
    function getTransactionNoReceiptCustomer()
    {
        // Ambil record terakhir berdasarkan ID atau tanggal
        $last = PenerimaanBarang::orderBy('id', 'desc')->first();

        // Format nomor: PR-YYMMDD-0001
        $prefix = 'STDO';
        $datePart = now()->format('ymd'); // contoh: 250703

        if ($last) {
            // Ambil bagian nomor dari transaksi terakhir
            $lastNumber = (int) substr($last->no_transaksi, -4);
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }

        return $prefix . '-' . $datePart . '-' . $newNumber;
    }
}

