<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Role;

class PhanSuAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function __construct(Role $mRole){
        $this->mRole = $mRole;
    }
    public function handle($request, Closure $next)
    { 
        if(Auth::check()){
            $id_role = Auth::user()->id_role;   //id chuc vu

            $objItem_Role = $this->mRole->getItem($id_role); //xac dinh phanSuAdmin cua id nay
            $phanSuAdmin = $objItem_Role->phanSuAdmin;
            if($phanSuAdmin != 1){
                $request->session()->flash('msg', 'Error: Tài khoản của bạn không đủ quyền!');
                return redirect()->route('auth.auth.login');
            }else{
                return $next($request);
            } 
        }

        $request->session()->flash('msg', 'Error: Tài khoản của bạn không đủ quyền!!');
        return redirect()->route('auth.auth.login');
        
    }
}
