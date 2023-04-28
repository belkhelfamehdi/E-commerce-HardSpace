<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierApplication extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'company_name',
        'company_email',
        'company_number',
        'company_country',
        'company_street',
        'company_city',
        'company_state',
        'company_zip',
        'message',
        'status',
    ];
}
