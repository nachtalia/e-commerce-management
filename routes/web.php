   <?php

   use App\Http\Controllers\AuthenticatedController;
   use App\Http\Controllers\ProductsController;
   use App\Http\Controllers\ProfileController;
   use Illuminate\Foundation\Application;
   use Illuminate\Support\Facades\Route;
   use Inertia\Inertia;

   Route::get('/', function () {
      return Inertia::render('Auth/Login', [
         'canLogin' => Route::has('login'),
         'canRegister' => Route::has('register'),
         'laravelVersion' => Application::VERSION,
         'phpVersion' => PHP_VERSION,
      ]);
   });

   Route::get('/dashboard', function () {
      return Inertia::render('Dashboard');
   })->middleware(['auth', 'verified'])->name('dashboard');

   Route::middleware('auth')->group(function () {
      Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
      Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
      Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
   });

   // routes/web.php
   Route::get('/setting', [ProfileController::class, 'setting'])->name('setting');
   Route::get('/user', [ProfileController::class, 'user'])->name('user');

   Route::post('/post', [ProductsController::class, 'create'])->name('products.create');
   Route::delete('/products/{id}', [ProductsController::class, 'destroy'])->name('products.destroy');
   Route::put('/products/{id}', [ProductsController::class, 'update'])->name('products.update');

   Route::get('/inventory', [ProductsController::class, 'index'])->name('inventory');

   require __DIR__ . '/auth.php';
