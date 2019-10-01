<?php

namespace App\Models\Scheme;

use Illuminate\Database\Eloquent\Model;

class ElDecision extends Model
{
    protected $table = 'recommend';
     public $timestamps = false;
     protected $guarded = [];




    public function insertElDecision($req,$recommendrole)
    {
        $dateadd = date('Ymd');
        $createElDecision= $this->create([
            'rc_caserefno'=> isset($req['rc_caserefno']) ? $req['rc_caserefno'] : NULL,
            'rc_q1'=> isset($req['rc_q1']) ? $req['rc_q1'] : NULL,
            'rc_q2'=> isset($req['rc_q2']) ? $req['rc_q2'] : NULL,
            'rc_q3'=> isset($req['rc_q3']) ? $req['rc_q3'] : NULL,
            'rc_q4'=> isset($req['rc_q4']) ? $req['rc_q4'] : NULL,
            'rc_q5'=> isset($req['rc_q5']) ? $req['rc_q5'] : NULL,
            'rc_recommend'=> isset($req['rc_recommend']) ? $req['rc_recommend'] : NULL,
            'rc_recommenddate'=> isset($req['rc_recommenddate']) ? $req['rc_recommenddate'] : NULL,
            'rc_recommendby'=> isset($req['rc_recommendby']) ? $req['rc_recommendby'] : NULL,
            'rc_recommendrole'=> $recommendrole,
            'rc_addby'=> $req['operid'],
            'rc_dateadd'=> $dateadd,
        ]);

        // $last = $this->orderBy('rc_recommendrole','DESC')->first();
            return  $createElDecision;  
    }






    public function newElDecision($req)
    {
          $new_ElDecision  = $this::where('rc_caserefno', '=', $req['rc_caserefno']) -> orderBy('rc_recommendrole','desc') -> first(['rc_recommendrole']);
        //   dd($new_ElDecision);
          $rc_recommendrole = 0;
        
          if(!empty($new_ElDecision))
          {
                $rc_recommendrole= $new_ElDecision->rc_recommendrole;

          }
          $runningnum = $rc_recommendrole + 1;
        //   $generate_McClinicInfo = $new_ElDecision + 1;
        return $runningnum;
    }













}