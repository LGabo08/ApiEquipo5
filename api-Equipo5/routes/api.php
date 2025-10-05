use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController; // si ya lo tienes

// públicas
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);

// protegidas
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // CRUD protegido (ajusta a tu caso):
    Route::apiResource('products', ProductController::class);
    // Si quieres dejar index/show públicas, muévelas fuera del group
});
