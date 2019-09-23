<?php

namespace App\Http\Controllers\Scheme;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Scheme\McInfo;
use App\Models\Scheme\McClinicInfo;
use App\Models\Scheme\McItemInfo;

class HusInfoController extends Controller
{
      //send data to database
      public function create(Request $request)
      {
        $body = json_decode($request->getContent(), true);
  
        app('App\Models\Scheme\McInfo')->create($body);
        app('App\Models\Scheme\McClinicInfo')->create($body);
        app('App\Models\Scheme\McItemInfo')->create($body);

        return $body;
      }
  
      //retrieve data from database
      public function show()
      {
        $mcinfo = McInfo::all();
        $mcclinicinfo = McClinicInfo::all();
        $mciteminfo = McItemInfo::all();
        return response()->json(['mcinfo'=>$mcinfo,'mcclinicinfo'=>$mcclinicinfo,'mciteminfo'=>$mciteminfo]);
      }
}
