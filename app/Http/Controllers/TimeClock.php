<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use App\TimeclockEntries;

class TimeClock extends Controller
{
    /**
     * Return all timeclock entries as json.
     *
     * @return Json
     */
    public function index()
    {
        return TimeclockEntries::all()->toJson();
    }
}
