<?php

namespace App\Models\Scheme;

use Illuminate\Database\Eloquent\Model;

class McItemInfo extends Model
{
    protected $table = 'mciteminfo';
    public $timestamps = false;
    protected $fillable = ['caserefno','mcitemid','mcrefno','mcitemstartdate','mcitemenddate', 'totalmcitem','approvalsts','dateadd','addby'];
}
