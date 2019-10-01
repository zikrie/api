<?php

namespace App\Models\Scheme;

use Illuminate\Database\Eloquent\Model;

class PreparerInfo extends Model
{
    protected $table = 'caseinfo';
    public $timestamps = false;
    protected $guarded = [];


    public function getPreparerInfo($req)
    {
       $get_PreparerInfo = $this::where('caserefno', '=', $req['caserefno'])->get();
         return $get_PreparerInfo;
        //  dd($get_PreparerInfo);
    }  
}
