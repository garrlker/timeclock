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


Route::group(['prefix' => '/user'], function () {

  /**
   * Get user
   *
   * @uses Route::get()
   * @example /api/user
   * @param Request $request
   */
  Route::get('/', function (Request $request) {
    return $request->user();
  });

  /**
   * Update user's timezone
   *
   * @uses Route::post()
   * @example /api/user/updateTimezone
   * @param Request $request
   */
  Route::post('/updateTimezone', function (Request $request) {
    $user = $request->user();
    $newTimezone = $request->input('timezone');

    if ($newTimezone == null) {
      return response()->json([
        'error' => 'Bad Request: No Timezone in request'
      ]);
    }

    // Update user timezone and return user data
    $user->timezone = $newTimezone;
    $user->save();
    return $request->user();
  });
});

Route::group(['prefix' => '/timeclock'], function () {
  Route::get('/', 'TimeClock@getEntries');
  Route::post('/clockin', 'TimeClock@clockIn');
  Route::post('/clockout', 'TimeClock@clockOut');
});
