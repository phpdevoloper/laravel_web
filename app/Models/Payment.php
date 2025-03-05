<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'login_id', 
        'application_id', 
        'transaction_id', 
        'payment_status', 
        'form_name', 
        'license_name', 
       
    ];
}
