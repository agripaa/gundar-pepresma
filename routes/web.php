<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\FacultyDataController;
use App\Http\Controllers\ProdiDataController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CapaianJuaraController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenPembimbingController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KepesertaanController;
use App\Http\Controllers\MasterDataController;
use App\Http\Controllers\PosisiDataController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\PrestasiLombaController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\HomeController;
use App\Models\Prestasi;

Route::get('/', [HomeController::class, 'index']);
Route::get('/get-prestasi', [HomeController::class, 'getPrestasiAjax'])->name('get-prestasi');


Route::get('/data/role', function () {
    return view('data.role');
});

Route::get('/prestasi-visitor', [PrestasiController::class, 'fetchPrestasiVisitor'])->name('prestasi.visitor');

Route::get('/roles', [RolesController::class, 'index']);
Route::get('/roles/{id}', [RolesController::class, 'show']);
Route::post('/roles', [RolesController::class, 'store']);
Route::put('/roles/{id}', [RolesController::class, 'update']);
Route::delete('/roles/{id}', [RolesController::class, 'destroy']);

Route::get('/registerSuperAdmin', function () {
    return view('data.registerSuperAdmin');
})->name('registerSuperAdmin');

Route::post('/registerSuperAdmin', [AuthController::class, 'registerSuperAdmin']);

Route::post('/kepesertaan', [KepesertaanController::class, 'store']);
Route::get('/kepesertaan/edit/{id}', [KepesertaanController::class, 'edit'])->name('kepesertaan.edit');
Route::post('/kepesertaan/update/{id}', [KepesertaanController::class, 'update'])->name('kepesertaan.update');
Route::delete('/kepesertaan/delete/{id}', [KepesertaanController::class, 'destroy'])->name('kepesertaan.delete');

Route::post('/kategori', [KategoriController::class, 'store']);
Route::get('/kategori/edit/{id}', [KategoriController::class, 'edit'])->name('kategori.edit');
Route::post('/kategori/update/{id}', [KategoriController::class, 'update'])->name('kategori.update');
Route::delete('/kategori/delete/{id}', [KategoriController::class, 'destroy'])->name('kategori.delete');

Route::post('/prestasi', [PrestasiLombaController::class, 'store']);
Route::get('/prestasi/edit/{id}', [PrestasiLombaController::class, 'edit'])->name('prestasi.edit');
Route::post('/prestasi/update/{id}', [PrestasiLombaController::class, 'update'])->name('prestasiData.update');
Route::delete('/prestasi/delete/{id}', [PrestasiLombaController::class, 'destroy'])->name('prestasi.delete');

Route::post('/juara', [CapaianJuaraController::class, 'store']);
Route::get('/juara/edit/{id}', [CapaianJuaraController::class, 'edit'])->name('juara.edit');
Route::post('/juara/update/{id}', [CapaianJuaraController::class, 'update'])->name('juara.update');
Route::delete('/juara/delete/{id}', [CapaianJuaraController::class, 'destroy'])->name('juara.delete');

Route::post('/posisi', [PosisiDataController::class, 'store']);
Route::get('/posisi/edit/{id}', [PosisiDataController::class, 'edit'])->name('posisi.edit');
Route::post('/posisi/update/{id}', [PosisiDataController::class, 'update'])->name('posisi.update');
Route::delete('/posisi/delete/{id}', [PosisiDataController::class, 'destroy'])->name('posisi.delete');

// Route Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route Register (Only for Super Admin)
Route::middleware(['auth', 'superadmin'])->group(function () {
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Route CRUD untuk Admin dan Super Admin
Route::middleware(['auth'])->group(function () {
    Route::get('/list-master-data', [MasterDataController::class, 'index'])->name('list-master-data');

    // Contact Routes
    Route::get('/contact/create', [VisitorController::class, 'createContact'])->name('contact.create');
    Route::post('/contact/store', [VisitorController::class, 'storeContact'])->name('contact.store');
    Route::get('/contact/{id}/edit', [VisitorController::class, 'editContact'])->name('contact.edit');
    Route::put('/contact/{id}', [VisitorController::class, 'updateContact'])->name('contact.update');
    Route::delete('/contact/{id}', [VisitorController::class, 'destroyContact'])->name('contact.destroy');

    // Footer Routes
    Route::get('/footer/create', [VisitorController::class, 'createFooter'])->name('footer.create');
    Route::post('/footer/store', [VisitorController::class, 'storeFooter'])->name('footer.store');
    Route::get('/footer/{id}/edit', [VisitorController::class, 'editFooter'])->name('footer.edit');
    Route::put('/footer/{id}', [VisitorController::class, 'updateFooter'])->name('footer.update');
    Route::delete('/footer/{id}', [VisitorController::class, 'destroyFooter'])->name('footer.destroy');

    // Manage Visitor Page
    Route::get('/manage-visitor', [VisitorController::class, 'index'])->name('manage-visitor');
    
    Route::get('/list-prestasi', [PrestasiController::class, 'index'])->name('prestasi.index');
    Route::get('/export-prestasi', [PrestasiController::class, 'export'])->name('export-prestasi');
    
    Route::get('tambah-prestasi', [PrestasiController::class, 'create'])->name('tambah-prestasi');
    Route::post('/tambah-prestasi', [PrestasiController::class, 'store'])->name('tambah-prestasi.store');    
    Route::get('/prestasi/{id}/edit', [PrestasiController::class, 'edit'])->name('prestasi.edit');
    Route::put('/prestasi/{id}', [PrestasiController::class, 'update'])->name('prestasi.update');
    Route::delete('/prestasi/{id}', [PrestasiController::class, 'destroy'])->name('prestasi.destroy');
    
    Route::get('/get-prodi-by-faculty/{facultyId}', [MahasiswaController::class, 'getProdiByFaculty']);
    
    Route::get('/search-mahasiswa', [PrestasiController::class, 'searchMahasiswa'])->name('search-mahasiswa');
    Route::get('/search-dospem', [PrestasiController::class, 'searchDospem'])->name('search-dospem');
    
    // Route untuk form dan menyimpan data mahasiswa
    Route::get('/get-mahasiswa/{id}', [MahasiswaController::class, 'getMahasiswaDetails']);
    Route::get('/tambah-mahasiswa', [MahasiswaController::class, 'create'])->name('tambah-mahasiswa');
    Route::post('/tambah-mahasiswa', [MahasiswaController::class, 'store']);
    Route::get('/mahasiswa/{id}/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
    Route::put('/mahasiswa/{id}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
    Route::delete('/mahasiswa/{id}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');
    
    // Route untuk list prestasi dengan filter dan search
    Route::get('/list-prestasi', [PrestasiController::class, 'index'])->name('list-prestasi');
    
    Route::get('/get-dospem/{id}', [DosenPembimbingController::class, 'getDosenDetails']);
    Route::get('/tambah-dospem', [DosenPembimbingController::class, 'create'])->name('tambah-dospem');
    Route::post('/tambah-dospem', [DosenPembimbingController::class, 'store']);
    Route::get('/dospem/{id}/edit', [DosenPembimbingController::class, 'edit'])->name('dospem.edit');
    Route::put('/dospem/{id}', [DosenPembimbingController::class, 'update'])->name('dospem.update');
    Route::delete('/dospem/{id}', [DosenPembimbingController::class, 'destroy'])->name('dospem.destroy');
    
    Route::get('/tambah-fakultas', [FacultyDataController::class, 'create'])->name('tambah-fakultas');
    Route::post('/tambah-fakultas', [FacultyDataController::class, 'store'])->name('tambah-fakultas');
    Route::get('/fakultas/{id}/edit', [FacultyDataController::class, 'edit'])->name('fakultas.edit');
    Route::put('/fakultas/{id}', [FacultyDataController::class, 'update'])->name('fakultas.update');
    Route::delete('/fakultas/{id}', [FacultyDataController::class, 'destroy'])->name('fakultas.destroy');
    
    Route::get('/get-prodi/{prodiId}', [ProdiDataController::class, 'fetchProdi']);
    Route::get('/tambah-prodi', [ProdiDataController::class, 'create'])->name('tambah-prodi');
    Route::post('/tambah-prodi', [ProdiDataController::class, 'store']);
    Route::get('/prodi/{id}/edit', [ProdiDataController::class, 'edit'])->name('prodi.edit');
    Route::put('/prodi/{id}', [ProdiDataController::class, 'update'])->name('prodi.update');
    Route::delete('/prodi/{id}', [ProdiDataController::class, 'destroy'])->name('prodi.destroy');
    
    // Route untuk ambil lampiran prestasi
    Route::get('/get-lampiran/{id}', [PrestasiController::class, 'getLampiran']);
    
    Route::get('/list-admin', [AdminController::class, 'index'])->name('list-admin');
    Route::get('/admin/search', [AdminController::class, 'search'])->name('admin.search');
    Route::get('/laporan', [AdminController::class, 'laporan'])->name('laporan');
    
    Route::get('/admin/create', [AdminController::class, 'create'])->name('create'); // This shows the create admin form
    Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store');  // This handles storing the new admin
    
    Route::get('/admin/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit');  // Show edit admin form
    Route::post('/admin/{id}/update', [AdminController::class, 'update'])->name('admin.update'); // Update admin
    Route::delete('/admin/{id}/delete', [AdminController::class, 'destroy'])->name('admin.delete'); // Delete admin
    
    Route::get('/tambah-master-data', function () {
        return view('tambah-master-data');
    })->name('tambah-master-data');
});

// Route untuk logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
