<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BahanBakuController;
use App\Http\Controllers\BahanBakuGlobalController;
use App\Http\Controllers\BahanBakuSatuanController;
use App\Http\Controllers\BarangKontrakRinciController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataPerusahaanController;
use App\Http\Controllers\EkspedisiController;
use App\Http\Controllers\MonitoringKontrakGlobalController;
use App\Http\Controllers\MonitoringKontrakRinciController;
use App\Http\Controllers\PakaianCelanaGlobalController;
use App\Http\Controllers\PakaianCelanaSatuanController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\StokBahanBakuController;
use App\Http\Controllers\StokPakaianCelanaController;
use App\Http\Controllers\UnitController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Symfony\Component\HttpKernel\Profiler\Profile;

/* Route::get('login', [AuthController::class, 'indexLogin'])->name('auth.login'); */

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/', function () {
        return redirect('/dashboard');
    });    
    
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('profil', [ProfileController::class, 'index'])->name('profile.index');
    
    Route::get('setting-akun', [AccountController::class, 'edit'])->name('akun.edit');

    Route::middleware(['checkrole:1'])->group(function () {
        Route::resource('monitoring-kontrak-global', MonitoringKontrakGlobalController::class);
        Route::get('export-monitoring-kontrak-global-preview', [MonitoringKontrakGlobalController::class, 'preview_export'])->name('preview-export-monitoring-kontrak-global');
        Route::get('export-monitoring-kontrak-global', [MonitoringKontrakGlobalController::class, 'exportMonitoringKontrakGlobal'])->name('export-monitoring-kontrak-global');
        Route::resource('monitoring-kontrak-rinci', MonitoringKontrakRinciController::class);
        Route::post('monitoring-kontrak-rinci/update/{id}', [MonitoringKontrakRinciController::class, 'update'])->name('monitoring-kontrak-rinci.update');
        Route::delete('monitoring-kontrak-rinci/hapus/{id}', [MonitoringKontrakRinciController::class, 'destroy'])->name('monitoring-kontrak-rinci.destroy');
        Route::post('monitoring-kontrak-rinci/proses-cutting/{id}', [MonitoringKontrakRinciController::class, 'updateProsesCutting'])->name('monitoring-kontrak-rinci.updateProsesCutting');
        Route::post('monitoring-kontrak-rinci/proses-jahit/{id}', [MonitoringKontrakRinciController::class, 'updateProsesJahit'])->name('monitoring-kontrak-rinci.updateProsesJahit');
        Route::post('monitoring-kontrak-rinci/proses-packing/{id}', [MonitoringKontrakRinciController::class, 'updateProsesPacking'])->name('monitoring-kontrak-rinci.updateProsesPacking');
        Route::resource('barang-kontrak-rinci', BarangKontrakRinciController::class);
        Route::post('monitoring-kontrak-rinci/barang-kontrak/{id}', [BarangKontrakRinciController::class, 'updateBarang'])->name('monitoring-kontrak-rinci.updateBarang');
        Route::delete('monitoring-kontrak-rinci/barang-kontrak/hapus/{id}', [BarangKontrakRinciController::class, 'destroy'])->name('barang-kontrak-rinci.destroy');
    });
    
    Route::middleware(['checkrole:1,2'])->group(function () {
        Route::resource('data-akun', AccountController::class);
        Route::resource('data-satuan', UnitController::class);
        Route::resource('data-ukuran', SizeController::class);
        Route::resource('data-warna', ColorController::class);
        Route::resource('data-kategori', CategoryController::class);
        Route::resource('data-ekspedisi', EkspedisiController::class);
        Route::resource('data-perusahaan', DataPerusahaanController::class);
    });
    
    Route::middleware(['checkrole:1,2,3'])->group(function () {
        //Monitoring Persediaan
        /* Bahan Baku */
        Route::resource('persediaan-bahan-baku-global', BahanBakuGlobalController::class);
        Route::get('export-stok-bahan-baku-global-preview', [BahanBakuGlobalController::class, 'preview_export'])->name('preview-export-stok-global');
        Route::get('export-stok-bahan-baku-global', [BahanBakuGlobalController::class, 'exportBahanBakuGlobal'])->name('export-bahan-baku-stok-global');
        Route::resource('persediaan-bahan-baku-satuan', BahanBakuSatuanController::class);
        Route::get('export-stok-bahan-satuan-global-preview', [BahanBakuSatuanController::class, 'preview_export'])->name('preview-export-stok-satuan');
        Route::get('export-stok-bahan-satuan-global', [BahanBakuSatuanController::class, 'exportBahanBakuSatuan'])->name('export-bahan-baku-stok-satuan');
        Route::resource('stok-bahan-baku-satuan', StokBahanBakuController::class);
    
        /* Pakaian dan Celana */
        Route::resource('persediaan-pakaian-celana-global', PakaianCelanaGlobalController::class);
        Route::get('export-stok-pakaian-celana-global-preview', [PakaianCelanaGlobalController::class, 'preview_export'])->name('preview-pakaian-celana-export-stok-global');
        Route::get('export-stok-pakaian-celana-global', [PakaianCelanaGlobalController::class, 'exportPakaianCelanaGlobal'])->name('export-pakaian-celana-stok-global');
        Route::resource('persediaan-pakaian-celana-satuan', PakaianCelanaSatuanController::class);
        Route::get('export-stok-pakaian-satuan-global-preview', [PakaianCelanaSatuanController::class, 'preview_export'])->name('preview-pakaian-celana-export-stok-satuan');
        Route::get('export-stok-pakaian-satuan-global', [PakaianCelanaSatuanController::class, 'exportPakaianCelanaSatuan'])->name('export-pakaian-celana-stok-satuan');
        Route::resource('stok-pakaian-celana-satuan', StokPakaianCelanaController::class);
    });

    Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');
});
