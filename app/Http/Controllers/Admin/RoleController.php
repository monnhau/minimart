<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use App\Http\Requests\AddRoleRequest;
use App\Http\Requests\EditRoleRequest;
class RoleController extends Controller
{
    
    public function __construct(Role $mRole, User $mUser){
        $this->mRole = $mRole;
        $this->mUser = $mUser;
        $this->mRoute = 'admin.role.index';
        $this->mView = 'admin.role.index';
    }
    //for Admin
    public function index(){
        $objItems_Role = $this->mRole->getItems();
        $quantity = $this->mRole->countGetItems();
        return view($this->mView, compact('objItems_Role', 'quantity'));
    }

    public function getAdd(){
        return view('admin.role.add');
    }

    public function postAdd(AddRoleRequest $request){
        $name = $request->name;
        $arrItem = [
            'name'=>$name,
        ];
        $msg = '';
    	if($this->mRole->addItem($arrItem)) $msg = 'Thêm thành công!'; 
        else $msg = getenv('ERR');
        return redirect()->route($this->mRoute)->with('msg', $msg);

    }

    public function del($id, Request $request){
        $objItem_Role = $this->mRole->getItem($id);
        if($objItem_Role == null) return redirect()->route($this->mRoute)->with('msg', getenv('ERR'));
        
        $name_role = $objItem_Role->name;
        if($name_role == 'admin' || $name_role == 'user'){
            $msg = 'Error: Bạn không thể xóa chức danh này!';
            return redirect()->route($this->mRoute)->with('msg', $msg);
        }else{
            $countItemsByRoleId = $this->mUser->countItemsByRoleId($id);
            if($countItemsByRoleId > 0){
                $msg = 'Error: Hiện có '.$countItemsByRoleId.' tài khoản sử dụng chức danh này!Do vậy bạn không thể xóa chức danh này';
                return redirect()->route($this->mRoute)->with('msg', $msg);
            }else{
                $msg = '';
                if($this->mRole->delItem($id)) $msg = 'Xóa thành công!'; 
                else $msg = getenv('ERR');
                return redirect()->route($this->mRoute)->with('msg', $msg);
            }  
        }
        
    
    }

    public function ajaxToggoActiveStatusPS(Request $request){
        $presentStatus = $request->presentStatus;
        $id = $request->id;
        $level = $request->level;

        $objItem_Role = $this->mRole->getItem($id);
        if($objItem_Role == null) return redirect()->route($this->mRoute)->with('msg', getenv('ERR'));
        $name_role = $objItem_Role->name;

        if( $name_role == 'admin' || $name_role == 'user' || $level == 'US') return getenv('FIXED');
        else{
            switch ($level) {
                case 'AM':
                    if($this->mRole->ajaxToggoActiveStatusPSAM($presentStatus, $id)) return view('admin.role.ajaxToggoActiveStatusPS', compact('presentStatus', 'id', 'level'));     
                case 'DM':
                    if($this->mRole->ajaxToggoActiveStatusPSDM($presentStatus, $id)) return view('admin.role.ajaxToggoActiveStatusPS', compact('presentStatus', 'id', 'level')); 
                case 'PD':
                    if($this->mRole->ajaxToggoActiveStatusPSPD($presentStatus, $id)) return view('admin.role.ajaxToggoActiveStatusPS', compact('presentStatus', 'id', 'level')); 
                case 'US':
                    if($this->mRole->ajaxToggoActiveStatusPSUS($presentStatus, $id)) return view('admin.role.ajaxToggoActiveStatusPS', compact('presentStatus', 'id', 'level')); 
                case 'GD':
                    if($this->mRole->ajaxToggoActiveStatusPSGD($presentStatus, $id)) return view('admin.role.ajaxToggoActiveStatusPS', compact('presentStatus', 'id', 'level')); 
                default:
                    return getenv('ERR');   
            }
        }
    }

}
