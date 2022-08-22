<?php

use App\Upcoming;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\UpcomingResource;

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

/**  For testing api http://postman.com **/

// Default Route of laravel
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//**Upcoming Task

// Get all the upcoming tasks
Route::get('/upcoming', function(){
    $upcoming = Upcoming::all();
    return UpcomingResource::collection($upcoming);
});

// Add a new task
Route::post('/upcoming', function(Request $request){
    return Upcoming::create([
        'title' => $request->title,
        'taskId' => $request->taskId,
        'waiting' => $request->waiting,
    ]);
});

// Delete upcoming task
Route::post('/upcoming/{taskId}', function($taskId){
    DB::table('upcomings')->where('taskId', $taskId)->delete();
    //Quando viene eliminata una taskId visualizza 204
    return 204;
});

//** Today Task
route::post('/dailytask', function(Request $request){
    return Today::create([
        'id'=>$request->id,
        'title'=>$request->title,
        'taskId'=>$request->taskId,
    ]);
});

// Delete Today Task
Route::delete('/dailytask/{taskId}', function($taskId){
    DB::table('todays')->where('taskId', $taskId)->delete();
    return 204;
});

