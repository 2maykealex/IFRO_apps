<?php

namespace App\Models;

use App\Models\ProfileAccess;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    public function profileAccess(){
        return $this->belongsTo(ProfileAccess::class);
    }
}
