<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    public function user() {
        return $this->belongsTo('App\User');
    }
}