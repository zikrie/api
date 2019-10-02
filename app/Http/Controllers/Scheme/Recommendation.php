<?php

namespace App\Http\Controllers\Scheme;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Scheme\ElDecision;
use Illuminate\Support\Facades\DB;

class Recommendation extends Controller
{
    public function __construct(ElDecision $eldecision)
    {
            $this->eldecision = $eldecision;
    }

    public function post(Request $req)
    {
        
        $create = DB::transaction(function() use ($req)
        {

            $recommendrole = $this->eldecision->newElDecision($req);
            $insertElDecision= $this->eldecision->insertElDecision($req,$recommendrole);
          //  return $insertElDecision;
            return 'success';
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
      //  return json_encode($create);
    }


    public function show(Request $req)
    {
        $get_ElDecision = $this->eldecision->getElDecision($req);
        return json_encode($get_ElDecision);
    }

    public function displayRecommend(Request $req)
    {
        $get_recommend = $this->eldecision->getRecommend($req);
        return json_encode($get_recommend);
    }
}
