<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelNotification extends Model
{
    use HasFactory;

    protected $table = 'model_notification';

    protected $fillable = [
        'user_id',
        'rated_by',
        'rating',
        'rating_description',
    ];

}
