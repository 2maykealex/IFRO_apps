<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReasonRejected extends Model
{
    public function newReason($data):Array{

        $reason = new reason;
        
        $reason->person_id     = $data['person_id'];
        $reason->registration  = $data['registration'];
        $reason->group         = $data['group'];
        $reason->status        = $data['status'];

        $updated = $reason->save();

        // dd($user->id);

        if ($updated){
            return [
                $reason->id
            ];
        }
    }
}
