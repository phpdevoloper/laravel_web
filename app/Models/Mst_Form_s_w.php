<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mst_Form_s_w extends Model
{
    use HasFactory;

    protected $table = 'tnelb_application_tbl';
    protected $fillable = [
        'applicant_name', 
        'fathers_name', 
        'applicants_address', 
        'd_o_b', 
        'age', 
        'previously_number', 
        'previously_date', 
        'login_id',
        'application_id',
        'status',
        'wireman_details',
        'form_name',
        'license_name'
    ];
}
