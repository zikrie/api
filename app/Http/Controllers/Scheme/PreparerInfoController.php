<?php

namespace App\Http\Controllers\Scheme;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Scheme\PreparerInfo;
use Illuminate\Support\Facades\DB;

class PreparerInfoController extends Controller
{
   

    public function __construct(PreparerInfo $caseinfo)
    {
            $this->preparerinfo = $caseinfo;
    }

    public function show(Request $req)
    {
        // $get_PreparerInfo = $this->preparerinfo->getPreparerInfo($req);
        // foreach($get_PreparerInfo as $preparer)
        // {
        //     $addby = $preparer['addby'];
        //     $dateadd = $preparer['dateadd'];
        // }

        //  return json_encode(['addby'=>$addby, 'dateadd'=>$dateadd]);

        $get_PreparerInfo = $this->preparerinfo->getPreparerInfo($req);
         return json_encode($get_PreparerInfo);

    }







}
