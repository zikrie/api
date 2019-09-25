<?php

namespace App\Models\Scheme;

use Illuminate\Database\Eloquent\Model;

class McClinicInfo extends Model
{
    protected $table = 'mcclinicinfo';
    public $timestamps = false;
    protected $guarded = [];

    public function insertMcClinicInfo($req,$data)
    {
        $dateadd = date('Ymd');
        // $husstatus=$req['husstatus'];
        $createMcClinicInfo= $this->create([
            'caserefno'=> isset($data['caserefno']) ? $data['caserefno'] : NULL,
            'clinicinfo'=> isset($req['clinicinfo']) ? $req['clinicinfo'] : NULL,
            'addby'=> $data['operid'],
            'dateadd'=> $dateadd,
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
}
