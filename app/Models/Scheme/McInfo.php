<?php

namespace App\Models\Scheme;

use Illuminate\Database\Eloquent\Model;

class McInfo extends Model
{
    protected $table = 'mcinfo';
    public $timestamps = false;
    protected $guarded = [];
    // protected $fillable = ['caserefno','mcrefno','husstatus','clinicrefno', 'startdate', 'enddate','totalmc','dateadd','addby','baoapprdate','scorecommend'];

    public function insertMcInfo($req,$data,$clinicrefno,$new_McRefNo )
    {
        $dateadd = date('Ymd');

        $clinicrefno1 =$clinicrefno;
        
        // $husstatus=$req['husstatus'];
        $createMcInfo= $this->create([
            'caserefno'=> isset($data['caserefno']) ? $data['caserefno'] : NULL,
            'mcrefno' => $new_McRefNo,
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

    public function getMcInfo($req)
    {
       $get_McInfo = $this::where('caserefno', '=', $req['caserefno'])->get();
       // $get_McInfo = McInfo::all();
        return $get_McInfo;
    }  

    public function newMcInfo($req)
    {
          $new_McInfo  = $this::where('caserefno', '=', $req['caserefno']) -> orderBy('mcrefno','desc') -> first(['mcrefno']);
         //dd($new_McInfo);
          $mcrefno = 0;
        
          if(!empty($new_McInfo))
          {
                $mcrefno= $new_McInfo->mcrefno;

          }
          $runningnum = $mcrefno + 1;
        //   $generate_McClinicInfo = $new_McInfo + 1;
        return $runningnum;
    }
}
