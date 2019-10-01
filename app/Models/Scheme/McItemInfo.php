<?php

namespace App\Models\Scheme;

use Illuminate\Database\Eloquent\Model;

class McItemInfo extends Model
{
    protected $table = 'mciteminfo';
    public $timestamps = false;
    protected $guarded = [];

    
   
    public function insertMcItemInfo($req,$data,$mcrefno ,$new_McItemInfo)
    {
        // $mcrefno1 =$mcrefno;
        $dateadd = date('Ymd');
        // $husstatus=$req['husstatus'];
        // $mcrefno=$mcrefno;

        $createMcItemInfo= $this->create([
            'caserefno'=> isset($data['caserefno']) ? $data['caserefno'] : NULL,
            'mcitemid'=> $new_McItemInfo,
            'mcrefno'=> $mcrefno,
           // 'clinicrefno' => $child,
            'mcitemstartdate'=> isset($req['mcitemstartdate']) ? $req['mcitemstartdate'] : NULL,
            'mcitemenddate'=> isset($req['mcitemenddate']) ? $req['mcitemenddate'] : NULL,
            'totalmcitem'=> isset($req['totalmcitem']) ? $req['totalmcitem'] : NULL,
            'approvalsts'=> isset($req['approvalsts']) ? $req['approvalsts'] : NULL,
            'dateadd'=> $dateadd,
            'addby'=> $data['operid'],
            
        ]);

            return  $createMcItemInfo;
        
        
    }

    public function deleteMcItemInfo($req)
    {
        $delete_McItemInfo = $this::where('caserefno', '=', $req['caserefno'])->delete();
        return  $delete_McItemInfo;
    }  

    public function getMcItemInfo($req, $mcrefno)
    {
        // $get_McItemInfo = $this::where('caserefno', '=', $req['caserefno'])->get();
        // return $get_McItemInfo;

        $get_McItemInfo = $this::where('caserefno', '=', $req['caserefno']) -> where('mcrefno','=',$mcrefno) -> get();
        return $get_McItemInfo;
    }  

    public function newMcItemInfo($req)
    {
          $new_McItemInfo  = $this::where('caserefno', '=', $req['caserefno']) -> orderBy('mcitemid','desc') -> first(['mcitemid']);
        //   dd($new_McClinicInfo);
          $mcitemid = 0;
        
          if(!empty($new_McItemInfo))
          {
                $mcitemid= $new_McItemInfo->mcitemid;

          }
          $runningnum = $mcitemid + 1;
        //   $generate_McClinicInfo = $new_McItemInfo + 1;
        return $runningnum;
    }

}