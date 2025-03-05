<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mst_documents extends Model
{
    use HasFactory;
    protected $table = 'tnelb_applicants_doc';
    protected $fillable = [
        'upload_photo', 
        'upload_sign', 
        'login_id',
        'application_id',
        'education_serial',
        'experience_serial',
        'education_doc',
        'experience_doc'
        
    ];
}
