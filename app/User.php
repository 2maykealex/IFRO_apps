<?php

namespace App;

use App\Models\UserProfile;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function userProfile(){
        return $this->hasOne(UserProfile::class)->with('profileAccess');
    }

    public function changePassword($data):Array{

        $this->password    = $data['password'];

        $updated = $this->save();

        if ($updated){
            return [
                $updated
            ];
        }
    }

    public function newUser($data):Array{

        $user = User::where('email', $data['email'])->get()->first(); //verifica se existe o email de novo usuário no banco 

        if (!$user){             //caso não, cadastre 
            $this->name        = $data['name'];
            $this->email       = $data['email'];
            $this->password    = $data['password'];
            $this->image       = $data['image'];

            $updated = $this->save();

            if ($updated){
                return [
                    $this->id
                ];
            }

        } else{
            return [0];
        }
    }
}
