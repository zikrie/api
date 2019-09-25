<?php

namespace App\Models\Scheme;

use Illuminate\Database\Eloquent\Model;

class McInfo extends Model
{
    protected $table = 'mcinfo';
    public $timestamps = false;
    protected $guarded = [];
    // protected $fillable = ['caserefno','mcrefno','husstatus','clinicrefno', 'startdate', 'enddate','totalmc','dateadd','addby','baoapprdate','scorecommend'];

    public function insertMcInfo($req,$data,$clinicrefno)
    {
        $dateadd = date('Ymd');

        $clinicrefno1 =$clinicrefno;
        
        // $husstatus=$req['husstatus'];
        $createMcInfo= $this->create([
            'caserefno'=> isset($data['caserefno']) ? $data['caserefno'] : NULL,
            // 'mcrefno'=> isset($req['mcrefno']) ? $req['mcrefno'] : 3,
            'husstatus'=> isset($req['husstatus']) ? $req['husstatus'] : NULL,
            'clinicrefno'=> $clinicrefno1,
            'startdate'=> isset($req['startdate']) ? $req['startdate'] : NULL,
            'enddate'=> isset($req['enddate']) ? $req['enddate'] : NULL,
            'totalmc'=> isset($req['totalmc']) ? $req['totalmc'] : NULL,
            'dateadd'=> $dateadd,
            'addby'=> isset($data['operid']) ? $data['operid'] : NULL,
            'baoapprdate'=> $dateadd,
            'scorecommend'=> isset($req['scorecommend']) ? $req['scorecommend'] : NULL,
        ]);

        $last = $this->orderBy('mcrefno','DESC')->first();

            return  $last;
        
        
    }

    public function deleteMcInfo($req)
    {
        $delete_McInfo = $this::where('caserefno', '=', $req['caserefno'])->delete();
        return $delete_McInfo;
    }  
}
