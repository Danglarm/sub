<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'plan',
        'price',
        'title',
        'start_date',
        'end_date',
        'is_active',
    ];

    protected $casts = [

        'start_date'=> 'datetime',
        'end_date'=> 'datetime',
        'created_at'=> 'datetime',
        'updated_at'=> 'datetime',
     ];

    protected $dates = [
        'start_date',
        'end_date',
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
