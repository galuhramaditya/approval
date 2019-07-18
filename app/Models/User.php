<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = "samuser";
    protected $hidden = ["Password"];

    public function company()
    {
        return $this->belongsTo(Company::class, "cocd", "cocd");
    }
}