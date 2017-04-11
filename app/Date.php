<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Date extends Model
{
        protected $fillable = [
        'from_date','to_date','employee_id'
    ];
}
