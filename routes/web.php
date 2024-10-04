<?php

use App\Http\Controllers\CatatanController;
use App\Http\Controllers\userController;
use App\Models\catatan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
   
    $data = Catatan::where('user_id', Auth::id())->paginate(3);
    $doneTodo = catatan::where('user_id', Auth::id())->where('status', 'done')->count();
    $unDoneTodo = catatan::where('user_id', Auth::id())->where('status', 'unDone')->count();
    // $unDoneTodo
    return view('home', [
        'page' => 'home',
        'titel' => 'Dashboard',
        'text' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, perspiciatis.",
        'data' => $data,
        'CountdoneTodo' => $doneTodo,
        'CountunDoneTodo' => $unDoneTodo
    ]);
});

Route::get("/login", [userController::class, 'index'])->name('login');
Route::get("/register", [userController::class, 'register']);
Route::post("/logout", [userController::class,  'logout']);

Route::post('/createUser', [userController::class, 'StoreRegister']);
Route::post('/Tologin', [userController::class, 'Login']);


Route::resource('/todo', CatatanController::class)->middleware('auth');
Route::put('/updateStatus/{id}', [CatatanController::class ,'updateStatus']);

Route::get('/profil/{id}', [userController::class, 'edit']);
Route::put('/profil/{id}', [userController::class ,'update']);


?>