<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Role;

class PhanSuGiaoDien
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
            $phanSuGiaoDien = $objItem_Role->phanSuGiaoDien;
            if($phanSuGiaoDien != 1){
                $request->session()->flash('msg', 'Error: Bạn không đủ quyền!');
                return redirect()->route('admin.index.index');
            }else{
                return $next($request);
            } 
        }

        $request->session()->flash('msg', 'Error: Bạn không đủ quyền!');
        return redirect()->route('admin.index.index');
        
    }
}
