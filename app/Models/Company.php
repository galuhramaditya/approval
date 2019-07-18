<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = "samcomp";

    public function user()
    {
        return $this->hasMany(User::class, "cocd", "cocd");
    }
}