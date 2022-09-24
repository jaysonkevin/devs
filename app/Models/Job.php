<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    protected $table = 'job_ads';

    protected $fillable = [
        'created_by',
        'job_title',
        'job_description',
        'job_type',
        'salary',
        'is_purchased'
    ];
}
