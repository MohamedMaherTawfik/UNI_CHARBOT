<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class subjects extends Model
{
    protected $table = 'subjects';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function college()
    {
        return $this->belongsTo(college::class);
    }

    public function reviews()
    {
        return $this->hasMany(reviews::class);
    }
}