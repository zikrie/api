<?php

namespace App\Models\Scheme;

use Illuminate\Database\Eloquent\Model;

class McInfo extends Model
{
    protected $table = 'mcinfo';
    public $timestamps = false;
    protected $guarded = [];
    // protected $fillable = ['caserefno','mcrefno','husstatus','clinicrefno', 'startdate', 'enddate','totalmc','dateadd','addby','baoapprdate','scorecommend'];

    public function insertMcInfo($req,$data)
    {
        $dateadd = date('Ymd');
        // $husstatus=$req['husstatus'];
        $createMcInfo= $this->create([
            'caserefno'=> isset($data['caserefno']) ? $data['caserefno'] : NULL,
            'mcrefno'=> isset($req['mcrefno']) ? $req['mcrefno'] : 1,
            'husstatus'=> isset($req['husstatus']) ? $req['husstatus'] : NULL,
            'clinicrefno'=> isset($req['clinicrefno']) ? $req['clinicrefno'] : 1,
            'startdate'=> isset($req['startdate']) ? $req['startdate'] : NULL,
            'enddate'=> isset($req['enddate']) ? $req['enddate'] : NULL,
            'totalmc'=> isset($req['totalmc']) ? $req['totalmc'] : NULL,
            'dateadd'=> $dateadd,
            'addby'=> isset($data['operid']) ? $data['operid'] : NULL,
            'baoapprdate'=> $dateadd,
            'scorecommend'=> isset($req['scorecommend']) ? $req['scorecommend'] : NULL,
        ]);

            return  $createMcInfo;
        
        
    }

}
