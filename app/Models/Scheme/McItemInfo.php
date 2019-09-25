<?php

namespace App\Models\Scheme;

use Illuminate\Database\Eloquent\Model;

class McItemInfo extends Model
{
    protected $table = 'mciteminfo';
    public $timestamps = false;
    protected $guarded = [];

    
   
    public function insertMcItemInfo($req,$data,$mcrefno)
    {
        // $mcrefno1 =$mcrefno;
        $dateadd = date('Ymd');
        // $husstatus=$req['husstatus'];
        // $mcrefno=$mcrefno;

        $createMcItemInfo= $this->create([
            'caserefno'=> isset($data['caserefno']) ? $data['caserefno'] : NULL,
            'mcrefno'=> $mcrefno,
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
}
