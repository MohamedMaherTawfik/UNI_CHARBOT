<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class college extends Model
{
    protected $table = 'colleges';
    protected $guarded = [];
    public function subjects()
    {
        return $this->hasMany(subjects::class);
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }
}