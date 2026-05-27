<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Frame extends Model
{
    protected $fillable = [
        'name',
        'image_path',
        'price',
        'description'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
