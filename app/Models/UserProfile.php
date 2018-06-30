<?php

namespace App\Models;

use App\Models\ProfileAccess;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    public $timestamps = false;

    public function newUserProfile($data):Array{

        $userProfile = new UserProfile;
        
        $userProfile->user_id             = $data['user_id'];
        $userProfile->profile_access_id   = $data['profile_access_id'];

        $updated = $userProfile->save();

        if ($updated){
            return [
                $userProfile->id
            ];
        }
    }
    
    public function profileAccess(){
        return $this->belongsTo(ProfileAccess::class);
    }
}
