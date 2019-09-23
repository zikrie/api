<?php

namespace App\Models\Scheme;

use Illuminate\Database\Eloquent\Model;

class McClinicInfo extends Model
{
    protected $table = 'mcclinicinfo';
    public $timestamps = false;
    protected $fillable = ['caserefno','clinicrefno','clinicinfo','addby', 'dateadd'];
}
