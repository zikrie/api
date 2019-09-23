<?php

namespace App\Models\Scheme;

use Illuminate\Database\Eloquent\Model;

class McInfo extends Model
{
    protected $table = 'mcinfo';
    public $timestamps = false;
    protected $fillable = ['caserefno','mcrefno','husstatus','clinicrefno', 'startdate', 'enddate','totalmc','dateadd','addby','baoapprdate','scorecommend'];
}
