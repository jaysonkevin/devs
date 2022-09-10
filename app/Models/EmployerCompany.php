<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployerCompany extends Model
{
    use HasFactory;
    protected $table = "employer_company";

    protected $fillable = [
        'user_id',
        'company_name',
        'company_display',
        'company_description'
    ];
}
