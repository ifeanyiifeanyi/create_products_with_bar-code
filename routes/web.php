<?php
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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


Route::get('/', [ProductController::class, 'index'])->name("product.name");
Route::get('/create', [ProductController::class, 'create'])->name("product.create");
Route::get('/edit/{product}', [ProductController::class, 'edit'])->name("product.edit");
Route::get('/delete/{product}', [ProductController::class, 'destroy'])->name("product.destroy");
Route::post('/update/{product}', [ProductController::class, 'update'])->name("product.update");
Route::post('/store', [ProductController::class, 'store'])->name("product.store");
Route::delete('/selected-products', [ProductController::class, 'destroyAll'])->name("product.delete.all");
Route::get('/print-pdf', [ProductController::class, 'generatePdf'])->name("product.pdf");

Route::get('/run-fresh-migrations', function () {
    try {
        Artisan::call('migrate:fresh'); // Use Artisan facade directly
        $output = Artisan::output(); // Capture the output
        return response("Fresh migrations have been executed successfully.\n\n" . $output);
    } catch (\Exception $e) {
        return response("Error: " . $e->getMessage(), 500);
    }
});