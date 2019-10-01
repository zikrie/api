<?php

namespace App\Models\Scheme;

use Illuminate\Database\Eloquent\Model;

class McClinicInfo extends Model
{
    protected $table = 'mcclinicinfo';
   // protected $primaryKey = 'caserefno';
   // public $incrementing = false;
    public $timestamps = false;
    protected $guarded = [];

    public function insertMcClinicInfo($req,$data,$clinicrefno)
    {
        $dateadd = date('Ymd');
        // $husstatus=$req['husstatus'];
        $createMcClinicInfo= $this->create([
            'caserefno'=> isset($data['caserefno']) ? $data['caserefno'] : NULL,
            'clinicrefno' => $clinicrefno,
            'clinicinfo'=> isset($req['clinicinfo']) ? $req['clinicinfo'] : NULL,
            'addby'=> $data['operid'],
            'dateadd'=> $dateadd,
            // $table->timestamps();
        ]);

        $last = $this->orderBy('clinicrefno','DESC')->first();
            return  $last;  
    }

    public function searchMcClinicInfo($req,$data)
    {
 
        $searchmcclinicinfo = $this::where('caserefno','=',$data['caserefno']) -> where ('clinicinfo','=',$req['clinicinfo'])->first(['clinicrefno']);
        return $searchmcclinicinfo;


    }
    
    public function deleteMcClinicInfo($req)
    {
        $delete_McClinicInfo = $this::where('caserefno', '=', $req['caserefno'])->delete();
        return $delete_McClinicInfo;
    }  

    public function getMcClinicInfo($req)
    {
        $get_McClinicInfo = $this::where('caserefno', '=', $req['caserefno'])-> where('clinicrefno','=',$req['clinicrefno']) -> first(['clinicinfo']);
        return $get_McClinicInfo;
    }  

    
    public function newMcClinicInfo($req)
    {
          $new_McClinicInfo  = $this::where('caserefno', '=', $req['caserefno']) -> orderBy('clinicrefno','desc') -> first(['clinicrefno']);
        //   dd($new_McClinicInfo);
          $clinicrefno = 0;
        
          if(!empty($new_McClinicInfo))
          {
                $clinicrefno= $new_McClinicInfo->clinicrefno;

          }
          $runningnum = $clinicrefno + 1;
        //   $generate_McClinicInfo = $new_McClinicInfo + 1;
        return $runningnum;
    }
}
