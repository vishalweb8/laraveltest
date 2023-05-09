<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware(['checkTenant'])->get('/users', function (Request $request) {
    $tenant = $request->input('tenant');
    $users = \App\Models\User::with('tenant')->whereHas('tenant',function($q) use ($tenant){
        $q->where('tenant_hash',$tenant->tenant_hash);
    })->get();
    return response()->json(['tenant' => $tenant, 'users' => $users]);
});
