<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\TimeclockEntry;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TimeClock extends Controller
{
  /**
   * Return all timeclock entries as json.
   *
   * @param Request $request
   * 
   * @return Json
   */
  public function getEntries(Request $request)
  {
    $user = $request->user();
    return $user->timeclockLog->toJson();
  }

  /**
   * Clock-In user
   *
   * @param Request $request
   * 
   * @return Json
   */
  public function clockIn(Request $request)
  {
    $user = $request->user();

    if (!$user->clocked_in) {
      $user->clocked_in = true;

      $timeclockEntry = new TimeClockEntry;
      $timeclockEntry->time_in = Carbon::now();
      $timeclockEntry->user_id = $user->id;


      // Commit changes
      $user->save();
      $timeclockEntry->save();

      return $timeclockEntry->toJson();
    }else{
      return response()->json([
        'error' => 'User is already clocked in'
      ]);
    }
  }

  /**
   * Clock-Out user
   *
   * @param Request $request
   * 
   * @return Json
   */
  public function clockOut(Request $request)
  {
    $user = $request->user();
    
    if ($user->clocked_in) {
      $user->clocked_in = false;
      $timeclockEntry = TimeClockEntry::where('user_id', $user->id)->get()->last();
      $timeclockEntry->time_out = Carbon::now();
    
      // Commit changes
      $user->save();
      $timeclockEntry->save();

      return $timeclockEntry->toJson();
    }else{
      return response()->json([
        'error' => 'User is already clocked out'
      ]);
    }
  }
}
