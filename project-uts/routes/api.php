use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PegawaiController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Rute untuk resource `Pegawai`
Route::get('/employees', [PegawaiController::class, 'index']); 
Route::post('/employees', [PegawaiController::class, 'store']); 
Route::get('/employees/{id}', [PegawaiController::class, 'show']); 
Route::put('/employees/{id}', [PegawaiController::class, 'update']); 
Route::delete('/employees/{id}', [PegawaiController::class, 'destroy']); 
Route::get('/employees/search/{name}', [PegawaiController::class, 'search']); 
Route::get('/employees/status/active', [PegawaiController::class, 'active']); 
Route::get('/employees/status/inactive', [PegawaiController::class, 'inactive']); 
