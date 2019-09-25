<?php

namespace App\Http\Controllers\Scheme;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Scheme\McInfo;
use App\Models\Scheme\McClinicInfo;
use App\Models\Scheme\McItemInfo;
use Illuminate\Support\Facades\DB;
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
            public function __construct(McInfo $mcinfo, McClinicInfo $mcclinicinfo, McItemInfo $mciteminfo)
            {
                    $this->mcinfo = $mcinfo;
                    $this->mcclinicinfo = $mcclinicinfo;
                    $this->mciteminfo = $mciteminfo;
            }

            public function post(Request $req)
            { 
              // return json_encode($mc['husstatus']);

                      $create = DB::transaction(function() use ($req)
                      {

                        $delete_McInfo = $this->mcinfo->deleteMcInfo($req);
                        $delete_McClinicInfo = $this->mcclinicinfo->deleteMcClinicInfo($req);
                        $delete_McItemInfo = $this->mciteminfo->deleteMcItemInfo($req);

                                  foreach($req['mcinfo'] as $key => $parent)
                                  {
                                          // return json_encode($mc['husstatus']);
                                          $searchMcClinicInfo = $this->mcclinicinfo->searchMcClinicInfo($parent,$req);
                                          // return json_encode($searchMcClinicInfo);

                                          if($searchMcClinicInfo !== NULL && $searchMcClinicInfo !== '')
                                          {
                                                      $clinicrefno = $searchMcClinicInfo['clinicrefno']; 
                                                      $postMcClinicInfo = $searchMcClinicInfo;
                                          }
                                          else
                                          {
                                                      $postMcClinicInfo = $this->mcclinicinfo->insertMcClinicInfo($parent,$req);
                                                      $clinicrefno = $postMcClinicInfo['clinicrefno'];
                                          }

                                          // return json_encode($clinicrefno);
                                          $postMcInfo = $this->mcinfo->insertMcInfo($parent,$req,$clinicrefno);
                                          // return json_encode($postMcInfo);
                                          $mcrefno = $postMcInfo['mcrefno'];
                                          //  return json_encode($mcrefno);

                                          foreach($req['mcitem'][$key] as $child =>$value)
                                          {
                                                      // return json_encode($req['mcitem']);
                                                      $insertMcItemInfo = $this->mciteminfo->insertMcItemInfo($value,$req,$mcrefno);
                                                      // return json_encode($insertMcItemInfo);
                                          }
                                  }
                                  
                                  return 'success';
                                  // return json_encode($req['mcitem']);
                      });

                      if($create == "success")
                      {
                          $errorcode = 0;
                          $data = ['errorcode'=>$errorcode];
                          return json_encode ($data);
                      }
                      else{
                          $errorcode = -1;
                          $data = ['errorcode'=>$errorcode];
                          return json_encode ($data);
                      }
           }


        
          
}