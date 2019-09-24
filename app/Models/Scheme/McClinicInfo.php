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
            'clinicrefno'=> isset($req['clinicrefno']) ? $req['clinicrefno'] : 1,
            'clinicinfo'=> isset($req['clinicinfo']) ? $req['clinicinfo'] : NULL,
            'addby'=> isset($data['operid']) ? $data['operid'] : NULL,
            'dateadd'=> $dateadd,
        ]);

            return  $createMcClinicInfo;
        
        
    }
}
