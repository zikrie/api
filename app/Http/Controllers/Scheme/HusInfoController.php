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
                        
                                if(!empty($req['mcinfo']) ){

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

                                          if(!empty($req['mcitem'][$key]) ){

                                                foreach($req['mcitem'][$key] as $child =>$value)
                                                {
                                                        // return json_encode($req['mcitem']);
                                                        $insertMcItemInfo = $this->mciteminfo->insertMcItemInfo($value,$req,$mcrefno, );
                                                        // return json_encode($insertMcItemInfo);
                                                }
                                        }
                                  }
                                  return 'success';
                                  // return json_encode($req['mcitem']);
                                }

                                return "no record";
                                  
                                 
                      });

                      if($create == "success")
                      {
                          $errorcode = 0;
                          $data = ['errorcode'=>$errorcode];
                          return json_encode ($data);
                      }
                      else if($create == "no record"){
                          $errorcode = 1;
                          $data = ['errorcode'=>$errorcode];
                          return json_encode ($data);
                      }
                      else{
                        $errorcode = -1;
                        $data = ['errorcode'=>$errorcode];
                        return json_encode ($data);
                    }
           }


           public function show(Request $req)
           {
                   $clinicinfo =array();
              //  return json_encode(['caserefno'=>$req['caserefno']]);
                   
              //  $get_McInfo = McInfo::all();
               $get_McInfo = $this->mcinfo->getMcInfo($req);

                // $get_McClinicInfo = McClinicInfo::all();
                // $get_McItemInfo = McItemInfo::all();
                $arrayparent = [];
                $arraychild = [];

                if(!empty($get_McInfo) )
                {
                        $cnt = 0;
                        foreach($get_McInfo as $key => $parent)
                        {
                                $clinicrefno = $parent['clinicrefno'];
                                $mcrefno = $parent['mcrefno'];

                                $get_McClinicInfo = $this->mcclinicinfo->getMcClinicInfo($parent,$req,$clinicrefno);

                                $get_ClinicInfo = $get_McClinicInfo['clinicinfo'];

                                $McItemInfo = $this->mciteminfo->getMcItemInfo($req, $mcrefno);

                                if(!empty($McItemInfo) )
                                {

                                                foreach($McItemInfo as $child)
                                                {
                                                        // return json_encode($child);
                                                
                                                        $arraychild[$key][] = ['mcitemstartdate'=>$child['mcitemstartdate'],'mcitemenddate'=>$child['mcitemenddate'],'totalmcitem'=>$child['totalmcitem'],'approvalsts'=>$child['approvalsts']];
                                                        
                                                }

                                                $arrayparent[] = ['husstatus'=>$parent['husstatus'],'clinicinfo'=>$get_ClinicInfo,'startdate'=>$parent['startdate'],'enddate'=>$parent['enddate'],'totalmc'=>$parent['totalmc'],'scorecommend'=>$parent['scorecommend']];
                                                

                                                // return json_encode($parent[]);

                                }

                                $cnt++;
                        }
                }

                $data = ['record'=>$cnt,'parent'=>$arrayparent,'child'=>$arraychild ];
                return json_encode($data);
             
           }


        
          
}