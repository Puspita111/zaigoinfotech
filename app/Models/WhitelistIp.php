<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhitelistIp extends Model
{
    use HasFactory;

    public function ipaddress(){

        return $this->belongsTo(User::class,'user_id');
    }
}
