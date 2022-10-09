<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployerNotification extends Model
{
    use HasFactory;

    protected $table = 'employer_notification';

    protected $fillable = [
        'user_id',
        'rated_by',
        'rating',
        'rating_description',
    ];
}
