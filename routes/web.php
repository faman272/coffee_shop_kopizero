<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardStokBarangController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\LogsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\DashboardMenuController;
use App\Http\Controllers\DashboardKategoriController;
use App\Http\Controllers\DashboardPesananController;
use App\Http\Controllers\LaporanTransaksiController;
use App\Http\Controllers\DashboardMetodeController;
use App\Http\Controllers\ManageAccountController;
use App\Http\Controllers\NotificationController;

use App\Http\Controllers\UserNotificationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Route::get('/', function () {
//         return view('home');
// });

// Route::get('/', [MenuController::class, 'index']);

Route::get("/", [HomeController::class, 'index'])->name('home');
// Example in your routes/web.php file
Route::get('/detail/{id}', [MenuController::class, 'show']);

// Cart Route
Route::post('/detail/{id}', [CartController::class, 'create']);

Route::get('/cart', [CartController::class, 'index'])
    ->middleware('auth')
    ->name('cart');

Route::post('/cart', [CartController::class, 'store'])
->middleware('auth')
->name('cart.store');

Route::get('/editcart/{id_keranjang}', [CartController::class, 'show'])
->middleware('auth')
->name('editcart');

Route::post('/cart/update/{id_keranjang}', [CartController::class, 'update'])
->middleware('auth')
->name('cart.update');

Route::delete('/cart/{id_keranjang}', [CartController::class, 'delete'])
->name('cart.delete');

//checkout

Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store')
->middleware('auth');


Route::get('/checkout', [CheckoutController::class, 'index'])
    ->middleware('auth')
    ->name('checkout');

Route::post('/checkout/{id}', [CheckoutController::class, 'transaksi'])
    ->middleware('auth')
    ->name('checkout.transaksi');

//pembayarn
Route::get('/pembayaran/{no_order}', [CheckoutController::class, 'pembayaran'])
    ->middleware('auth')
    ->name('pembayaran');

Route::post('/pembayaran/cancel/{no_order}', [CheckoutController::class, 'cancel'])
->middleware('auth')
->name('pembayaran.cancel');

Route::post('/pembayaran/{id}', [CheckoutController::class, 'bayar'])
    ->middleware('auth')
    ->name('pembayaran.bayar');

Route::get('/history', [HistoryController::class, 'index'])
    ->middleware('auth')
    ->name('history');

Route::get('/detailhistory/{id}', [HistoryController::class, 'detail'])
    ->middleware('auth')
    ->name('detailhistory');

Route::get('/notification', [UserNotificationController::class, 'index'])
    ->middleware('auth')
    ->name('notification');

Route::delete('/notification/{id}', [UserNotificationController::class, 'destroy'])
    ->middleware('auth')
    ->name('notification.delete');




//Admin
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified', 'role'])->name('dashboard');

//CRUD Menu
Route::resource('dashboard/menu', DashboardMenuController::class)->middleware(['auth', 'verified', 'role']);


//CRUD Kategori
Route::resource('dashboard/kategori', DashboardKategoriController::class)->middleware(['auth', 'verified', 'role']);


//CRUD Stok Barang
Route::resource('dashboard/stokbarang', DashboardStokBarangController::class)->middleware(['auth', 'verified', 'role']);
Route::post('/dashboard/stokbarang/ubah/{id}', [DashboardStokBarangController::class, 'update'])->middleware(['auth', 'verified', 'role'])->name('stokbarang.ubah');
Route::delete('/dashboard/stokbarang/hapus/{id}', [DashboardStokBarangController::class, 'destroy'])->middleware(['auth', 'verified', 'role'])->name('stokbarang.hapus');

//CRUD Pesanan
Route::resource('dashboard/pesanan', DashboardPesananController::class)->middleware(['auth', 'verified', 'role']);



//Laporan Transaksi
Route::get('/dashboard/laporantransaksi', [LaporanTransaksiController::class, 'index'])->middleware(['auth', 'verified', 'role'])->name('laporantransaksi.index');
Route::post('/dashboard/laporantransaksi', [LaporanTransaksiController::class, 'showReport'])->middleware(['auth', 'verified', 'role'])->name('laporantransaksi');

Route::get('/dashboard/cetaklaporan', [LaporanTransaksiController::class, 'printReport'])->name('laporantransaksi.print');

Route::get('/dashboard/menuharian', [LaporanTransaksiController::class, 'menuHarian'])->middleware(['auth', 'verified', 'role'])->name('menuharian');
Route::get('/dashboard/menumingguan', [LaporanTransaksiController::class, 'menuMingguan'])->middleware(['auth', 'verified', 'role'])->name('menumingguan');


//CRUD Metode Pembayaran
Route::resource('/dashboard/metode_pembayaran', DashboardMetodeController::class)->middleware(['auth', 'verified', 'role', 'superadmin']);




//Manage Account
Route::resource('/dashboard/manage_account', ManageAccountController::class)->middleware(['auth', 'verified', 'role', 'superadmin']);
Route::post('/dashboard/manage_account/{id}', [ManageAccountController::class, 'update'])->middleware(['auth', 'verified', 'role', 'superadmin'])->name('manage_account.ubah');


//Notification
Route::resource('/dashboard/notification', NotificationController::class)->middleware(['auth', 'verified', 'role']);

Route::get('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');

Route::post('/notifications/read', [NotificationController::class, 'markAll'])->name('notifications.all');



//Logs
Route::get('/dashboard/logs', [LogsController::class, 'index'])->middleware(['auth', 'verified', 'role', 'superadmin'])->name('logs.index');

//Log Cart
Route::get('/dashboard/logcart', [LogsController::class, 'logCart'])->middleware(['auth', 'verified', 'role', 'superadmin'])->name('logcart');

//Log Order
Route::get('/dashboard/logorder', [LogsController::class, 'logOrder'])->middleware(['auth', 'verified', 'role', 'superadmin'])->name('logorder');

//log Akun
Route::get('/dashboard/logakun', [LogsController::class, 'logAkun'])->middleware(['auth', 'verified', 'role', 'superadmin'])->name('logakun');





require __DIR__ . '/auth.php';
 