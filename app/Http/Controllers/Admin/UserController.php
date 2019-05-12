<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\Log;
use App\Http\Requests\AddUserRequest;
use App\Http\Requests\EditUserRequest;
use Auth;
use App\FreeFunction;

class UserController extends Controller
{
    public function __construct(User $mUser, Role $mRole, Log $mLog, FreeFunction $mFreeFunction){
        $this->mUser = $mUser;
        $this->mRole = $mRole;
        $this->mLog = $mLog;
        $this->mFreeFunction = $mFreeFunction;
        $this->mRoute = 'admin.users.index';
        $this->mView = 'admin.users.index';
	}
    public function index(){
        $objItems_User = $this->mUser->getItems();
        $quantity = $this->mUser->countGetItems();
        return view($this->mView, compact('objItems_User', 'quantity'));
    }

    public function getAdd(){
        $objItems_Role = $this->mRole->getAllItems();
        return view('admin.users.add', compact('objItems_Role'));
    }

    public function postAdd(AddUserRequest $request){
        $username = $request->username;
        $password = trim($request->password);
        $id_role = $request->id_role;
        $fullname = $request->fullname;
        $password = bcrypt($password);

        //BEGIN Tao maUser min de tiet kiem Id
        $objItems_UserId = $this->mUser->getAllIds();
        $id = $this->mFreeFunction->suggestId($objItems_UserId);
        //END Tao maSp min de tiet kiem Id
        $date_at = date("Y-m-d H:i:s");

        $arrItem = [
                'id'=>$id,
                'username'=>$username,
                'password'=>$password,
                'id_role'=>$id_role,
                'fullname'=>$fullname,
                'date_at'=>$date_at,
        ];

        $msg = '';
    	if($this->mUser->addItem($arrItem)) $msg = 'Thêm thành công!'; 
        else $msg = getenv('ERR');

        return redirect()->route($this->mRoute)->with('msg', $msg);
    }

    public function del($id, Request $request){
        $objItem_User = $this->mUser->getItem($id);
        $objItem_Role = $this->mRole->getItem($id_role);
        if($objItem_User == null || $objItem_Role == null) return redirect()->route($this->mRoute)->with('msg', getenv('ERR'));
        $id_role = $objItem_User->id_role;
        $name_role = $objItem_Role->name;

        if($name_role == 'admin'){
            $msg = 'Error: Tài khoản Admin được bảo vệ!';
            return redirect()->route('admin.users.index')->with('msg', $msg);
        }else{
            $msg = '';
            if($this->mUser->delItem($id)) {
                $msg = 'Xóa thành công!'; 
                 //add to Log
                 $action = "Xóa người dùng";
                 $username = Auth::user()->username;
                 $date_at = date("Y-m-d H:i:s");
                 $detail = (string) $objItem_User;
                 $arItem = [
                     'action'=>$action,
                     'username'=>$username,
                     'date_at'=>$date_at,
                     'detail'=>$detail,
                 ];
                 $this->mLog->addItem($arItem);
            }
            else $msg = getenv('ERR');
            return redirect()->route($this->mRoute)->with('msg', $msg);
        }
    }

    public function getEdit($id){
        $idUserAuth = Auth::user()->id;
        if($idUserAuth != $id){
            $msg = 'Error: Không có quyền sửa user khác';
            return redirect()->route($this->mRoute)->with('msg', $msg);
        }

        $objItem_User = $this->mUser->getItem($id);
        if($objItem_User == null) return redirect()->route($this->mRoute)->with('msg', getenv('ERR'));

        $objItems_Role = $this->mRole->getAllItems();
        return view('admin.users.edit', compact('objItem_User', 'objItems_Role'));
    }

    public function postEdit($id, EditUserRequest $request){
        $idUserAuth = Auth::user()->id;
        if($idUserAuth != $id){
            $msg = 'Error: Không có quyền sửa user khác';
            return redirect()->route($this->mRoute)->with('msg', $msg);
        }
        
        $password = trim($request->password);
        $id_role = $request->id_role;
        $fullname = $request->fullname;
        $username = $request->username;

        if($password != ''){
            $password = bcrypt($password);
            $arrItem = [
                'password'=>$password,
                'id_role'=>$id_role,
                'fullname'=>$fullname,
                'username'=>$username
            ];
        }else{
            $arrItem = [
                'id_role'=>$id_role,
                'fullname'=>$fullname,
                'username'=>$username
            ];
        }     
        $msg = '';
    	if($this->mUser->editItem($id, $arrItem)) $msg = 'Sửa thành công!'; 
        else $msg = getenv('ERR');
        return redirect()->route($this->mRoute)->with('msg', $msg);
    }

    public function search(Request $request){
        $key = trim($request->key);
        $search_by = $request->search_by;
        $objItems_User = $this->mUser->search($key, $search_by);
        $quantity = $this->mUser->countSearch($key, $search_by);
        $objItems_User->appends(['key'=>$key, 'search_by'=>$search_by]);
        return view('admin.users.search', compact('objItems_User', 'key', 'search_by', 'quantity'));
    }
}
