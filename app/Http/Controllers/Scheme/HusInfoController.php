<?php

namespace App\Http\Controllers\Scheme;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Scheme\McInfo;
use App\Models\Scheme\McClinicInfo;
use App\Models\Scheme\McItemInfo;
// use App\Models\Scheme\McClinicInfo;
// use App\Models\Scheme\McItemInfo;

// class HusInfoController extends Controller
// {
//       //send data to database
//       public function create(Request $request)
//       {
//         $body = json_decode($request->getContent(), true);
  
//         app('App\Models\Scheme\McInfo')->create($body);
//         app('App\Models\Scheme\McClinicInfo')->create($body);
//         app('App\Models\Scheme\McItemInfo')->create($body);

//         return $body;
//       }
  
//       //retrieve data from database
//       public function show()
//       {
//         $mcinfo = McInfo::all();
//         $mcclinicinfo = McClinicInfo::all();
//         $mciteminfo = McItemInfo::all();
//         return response()->json(['mcinfo'=>$mcinfo,'mcclinicinfo'=>$mcclinicinfo,'mciteminfo'=>$mciteminfo]);
//       }
// }


class HusInfoController extends Controller
{

  public function __construct(McInfo $mcinfo, McClinicInfo $mcclinicinfo, McItemInfo $mciteminfo){
         $this->mcinfo = $mcinfo;
         $this->mcclinicinfo = $mcclinicinfo;
        $this->mciteminfo = $mciteminfo;
    }

   public function post(Request $req)
   {
    $create = DB::transaction(function() use ($validateUser, $validateStaff, $validateUserRole)
    {
        
          foreach($req['mcinfo'] as $mc)
          {
            // return json_encode($mc['husstatus']);

            $postMcInfo = $this->mcinfo->insertMcInfo($mc,$req);
            $postMcClinicInfo = $this->mcclinicinfo->insertMcClinicInfo($mc,$req);


            
          }

  });

    return json_encode(['postMcInfo'=> $postMcInfo, 'postMcClinicInfo'=>$postMcClinicInfo]);
    return json_encode($req['mcitem']);



   }
}