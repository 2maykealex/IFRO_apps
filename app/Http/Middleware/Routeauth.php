<?php

namespace App\Http\Middleware;

use Closure;
// use \App\Models\Student;
// use \App\User;
use \App\Models\Coordinator;
use Illuminate\Http\Request;

class Routeauth               //se o usuário logado acessar um link q não seja permitido, retorna à pagina anterior com msg;
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = auth()->user();  //recupera o usuário logado

        // dd($user->userProfile->profileAccess->name);  

        $profile = $user->userProfile->profileAccess->name;  //retorna o perfil dele

        if ($request->segments()[0] != $profile) {  //compara o perfil com a url - se não for o mesmo, volta a página anterior com msg
            return redirect()->back()->with('error', 'Esta página não está acessível para seu perfil!')  ;    
        }        
        return $next($request);   //caso não haja restrição, continua        
    }
}
