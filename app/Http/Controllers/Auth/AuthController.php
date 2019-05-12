<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\AddUserRequest;
use App\Http\Requests\ForgotPasswordRequest;
use Illuminate\Support\Str;
use Auth;
use Mail;
use App\Role;
use App\User;
use App\Log;
use App\FreeFunction;

class AuthController extends Controller
{
    public function __construct(Role $mRole, User $mUser, Log $mLog, FreeFunction $mFreeFunction){
        $this->mRole = $mRole;
        $this->mUser = $mUser;
        $this->mLog = $mLog;
        $this->mFreeFunction = $mFreeFunction;
        $this->mView = 'auth.auth.login';
        $this->mRoute = 'auth.auth.login';
	}

    public function getLogin(){
        Auth::logout();
        return view($this->mView);
    }

    public function postLogin(LoginRequest $request){
        $typeUsername = $request->typeUsername;
        if($typeUsername == 'email'){
                $username =trim($request->username);
                $password = trim($request->password);

                $objItem_User = $this->mUser->getItemByUsername($username);
                if($objItem_User == null) return redirect()->route($this->mRoute)->with('msg', 'Sai tài khoản hoặc mật khẩu!')->withInput();

                if(Auth::attempt(['username'=>$username, 'password'=>$password])){
                    if($objItem_User->is_activated_email != 1){
                        return redirect()->route($this->mRoute)->with('msg', 'Email tài khoản chưa được xác thực! Vui lòng kiểm tra lại email!<br>Nếu bạn chưa nhận được email xác thực, nhấn: <a href="'.route('auth.auth.activateEmailAgain', ['username'=>$username]).'">Gửi lại</a>')->withInput();
                    }else{
                        return redirect()->route('minimart.index.index');
                    }
                }else{
                    return redirect()->route($this->mRoute)->with('msg', 'Sai tài khoản hoặc mật khẩu')->withInput();
                }
        }else if($typeUsername == 'phone'){
                $username =trim($request->username);
                $password = trim($request->password);
                
                if(Auth::attempt(['username'=>$username, 'password'=>$password])){
                    return redirect()->route('minimart.index.index');
                }
                return redirect()->route($this->mRoute)->with('msg', 'Sai tài khoản hoặc mật khẩu')->withInput();
        }else{
                $msg = getenv('ERR');
                return redirect()->route($this->mRoute)->with('msg', $msg);
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('minimart.index.index');
    }

    public function getRegister(){
        Auth::logout();
        return view('auth.auth.register');
    }

    public function postRegister(AddUserRequest $request){
        $typeUsername = $request->typeUsername;
        if($typeUsername == 'email'){
                $username = $request->username;
                $password = trim($request->password);
                $password = bcrypt($password);
                $fullname = $request->fullname;
               
                $objItem_Role = $this->mRole->getItemByName('user');
                if($objItem_Role == null) return redirect()->route($this->mRoute)->with('msg', getenv('ERR'));
                $id_role = $objItem_Role->id;

                //BEGIN Tao maUser min de tiet kiem Id
                $objItems_UserId = $this->mUser->getAllIds();
                $suggestId = $this->mFreeFunction->suggestId($objItems_UserId);
                //END Tao maSp min de tiet kiem Id
                $date_at = date("Y-m-d H:i:s");
                
                $arrItem = [
                        'id'=>$suggestId,
                        'username'=>$username,
                        'password'=>$password,
                        'id_role'=>$id_role,
                        'fullname'=>$fullname,
                        'date_at'=>$date_at,
                ];

                $msg = '';
                if($this->mUser->addItem($arrItem)) {
                    //---BEGIN Xu li xac thuc email Tai day
                    $objItem_User = $this->mUser->getItemByUsername($username);
                    if($objItem_User == null) return redirect()->route($this->mRoute)->with('msg', getenv('ERR'));
                    $id = $objItem_User->id;
                    $data=['id'=>$id, 'username'=>$username,'fullname'=>$fullname];
                    Mail::send('auth.auth.verifyMailBody', $data, function($msg) use ($request) {
                        $msg->from(getenv('MAIL_USERNAME'), getenv('MAIL_NAME'));
                        $msg->to($request->username, $request->fullname)->subject('Xác thực email');
                    });
                    //---END Xu li xac thuc email Tai day

                    $msg = 'Tạo tài khoản thành công!Vui lòng xác thực email trước khi đăng nhập'; 
                    return redirect()->route($this->mRoute)->with('msg', $msg);
                }else{
                    $msg = getenv('ERR');
                    return redirect()->route($this->mRoute)->with('msg', $msg);
                }
                
        }else if($typeUsername == 'phone'){
            /*-----------HỆ THỐNG CHƯA CÓ QUY TRÌNH XÁC THỰC SỐ ĐIỆN THOẠI CHÍNH CHỦ--------------- */
                $username = $request->username;
                $password = trim($request->password);
                $fullname = $request->fullname;
                $password = bcrypt($password);

                $objItem_Role = $this->mRole->getItemByName('user');
                if($objItem_Role == null) return redirect()->route($this->mRoute)->with('msg', getenv('ERR'));
                $id_role = $objItem_Role->id;

                //BEGIN Tao maUser min de tiet kiem Id
                $objItems_UserId = $this->mUser->getAllIds();
                $suggestId = $this->mFreeFunction->suggestId($objItems_UserId);
                //END Tao maSp min de tiet kiem Id
                $date_at = date("Y-m-d H:i:s");

                $arrItem = [
                        'id'=>$suggestId,
                        'username'=>$username,
                        'password'=>$password,
                        'id_role'=>$id_role,
                        'fullname'=>$fullname,
                        'date_at'=>$date_at,
                ];

                $msg = '';
                if($this->mUser->addItem($arrItem)) {
                    $msg = 'Tạo tài khoản thành công! Bạn có thể đăng nhập ngay!'; 
                    return redirect()->route($this->mRoute)->with('msg', $msg);
                }else{
                    $msg = getenv('ERR');
                    return redirect()->route($this->mRoute)->with('msg', $msg);
                }
        }else{
                $msg = getenv('ERR');
                return redirect()->route('auth.auth.register')->with('msg', $msg);
        }

    }

    public function activateEmail($id, $username, Request $request){
        $objItem_User = $this->mUser->getItem($id);
        if($objItem_User == null) return redirect()->route($this->mRoute)->with('msg', getenv('ERR'));

        if($objItem_User->is_activated_email == 1){
            $msg = 'Email này đã được xác thực! Bạn không cần xác thực nữa!';
            return redirect()->route($this->mRoute)->with('msg', $msg);
        }

        if($objItem_User->username != $username){
            //echo 'Co ve sai';
            $msg = getenv('ERR');
            return redirect()->route($this->mRoute)->with('msg', $msg);
        }else{
             //echo 'Co ve khop nguoi dung';
            //update trang thai is_activate_email
            $arItem = [
                'is_activated_email'=>1,
            ];

            $msg = '';
            if($this->mUser->editItem($id, $arItem)) $msg = 'Xác thực thành công! Bạn có thể đăng nhập bây giờ!'; 
            else $msg = getenv('ERR');
            return redirect()->route($this->mRoute)->with('msg', $msg);
        }
    }

    public function activateEmailAgain($username, Request $request){
        //---BEGIN Xu li xac thuc email Tai day
        $objItem_User = $this->mUser->getItemByUsername($username);
        if($objItem_User == null) return redirect()->route($this->mRoute)->with('msg', getenv('ERR'));
        $id = $objItem_User->id;
        $fullname = $objItem_User->fullname;
        $data=['id'=>$id, 'username'=>$username,'fullname'=>$fullname];
        Mail::send('auth.auth.verifyMailBody', $data, function($msg) use ($request) {
            $msg->from(getenv('MAIL_USERNAME'), getenv('MAIL_NAME'));
            $msg->to($request->username, $request->fullname)->subject('Xác thực email');
        });
        //---END Xu li xac thuc email Tai day
        $msg = 'Email xác thực đã gửi đến bạn, vui lòng xác thực email!'; 
        return redirect()->route($this->mRoute)->with('msg', $msg);
    }

    public function getForgotPassword(){
        return view('auth.auth.forgotPassword');
    }

    public function postForgotPassword(ForgotPasswordRequest $request){
        $typeUsername = $request->typeUsername;
        if($typeUsername == 'email'){
            $username = $request->username;
            
            $objItem_User = $this->mUser->getItemByUsername($username);
            if($objItem_User == null) return redirect()->route($this->mRoute)->with('msg', getenv('ERR'));

            $id = $objItem_User->id;
            $fullname = $objItem_User->fullname;
            //---BEGIN tao 1 random code va luu vao database ung voi username nay
            $code = Str::random(getenv('CODE_LENGTH'));
            $arItem = [
                'code'=>$code,
            ];
            $msg = '';
            if($this->mUser->editItem($id, $arItem)) $msg = 'Liên kết reset mật khẩu đã được gửi tới email của bạn! Vui lòng kiểm tra email!'; 
            else $msg = getenv('ERR');
            //---END tao 1 random code va luu vao database ung voi username nay

            //---BEGIN Xu li xac thuc email Tai day
            $data=['id'=>$id, 'username'=>$username,'fullname'=>$fullname, 'code'=>$code];
            Mail::send('auth.auth.forgotPasswordMailBody', $data, function($msg) use ($request) {
                $msg->from(getenv('MAIL_USERNAME'), getenv('MAIL_NAME'));
                $msg->to($request->username, $request->fullname)->subject('Thiết lập lại mật khẩu của bạn!');
            });
            //---END Xu li xac thuc email Tai day
            return redirect()->route($this->mRoute)->with('msg', $msg);
        }else if($typeUsername == 'phone'){
            return redirect()->route($this->mRoute)->with('msg', 'Xin lỗi! Tạm thời chưa có chức năng reset mật khẩu cho tài khoản đăng kí với số điện thoại');
        }else{
            return redirect()->route($this->mRoute)->with('msg', getenv('ERR'));
        }
    }

    public function getResetPassword($username, $code, Request $request){
        $objItem_User = $this->mUser->getItemByUsername($username);
        if($objItem_User == null) return redirect()->route($this->mRoute)->with('msg', getenv('ERR'));
        $id = $objItem_User->id;
        
        if($objItem_User->code != $code){
            //echo 'Khong dung code=> chuyen sang trang khac ngay';
            return redirect()->route($this->mRoute)->with('msg', getenv('ERR'));
        }else{
            //echo 'dung code! o lai trang nay de reset';
            //---BEGIN tao 1 random code va luu vao database ung voi username nay
            $code = Str::random(getenv('CODE_LENGTH'));
            $arItem = [
                'code'=>$code,
            ];
            $msg = '';
            if($this->mUser->editItem($id, $arItem)) {
                return view('auth.auth.resetPassword', compact('username', 'code'));
            }
            else {
                $msg = getenv('ERR');
                return redirect()->route($this->mRoute)->with('msg', getenv('ERR'));
            }
            //---END tao 1 random code va luu vao database ung voi username nay            
        }
    }

    public function postResetPassword($username, $code, Request $request){
            $password = trim($request->password);
            $password = bcrypt($password);

            $objItem_User = $this->mUser->getItemByUsername($username);
            if($objItem_User == null) return redirect()->route($this->mRoute)->with('msg', getenv('ERR'));

            if($objItem_User->code != $code){
                //echo 'Khong dung code=> chuyen sang trang khac ngay';
                return redirect()->route($this->mRoute)->with('msg', getenv('ERR'));
            }else{
                $id = $objItem_User->id;
                $arItem = [
                    'password'=>$password,
                ];

                $msg = '';
                if($this->mUser->editItem($id, $arItem)) {
                    $msg = 'Cập nhật mật khẩu thành công!'; 
                    $code = Str::random(getenv('CODE_LENGTH'));
                    $arItem = [
                        'code'=>$code,
                    ];
                    $this->mUser->editItem($id, $arItem);
                }else $msg = getenv('ERR');

                return redirect()->route($this->mRoute)->with('msg', $msg);
            }
            
    }

 
    //---BEGIN TEST Function , Không sử dụng đến
    public function postRegisterTestMail(AddUserRequest $request){
        //---BEGIN Xu li xac thuc email Tai day
        $data=['username'=>$username,'fullname'=>$fullname];

        Mail::send('auth.auth.mail', $data, function($msg) use ($request) {
            $msg->from('bayna4k13@gmail.com', 'Sieu thi Hang Quyen');
            $msg->to($request->username, $request->fullname)->subject('Thông báo từ Siêu thị Hằng Quyền: Xác thực email ');
        });
        //---END Xu li xac thuc email Tai day

    }

    public function getRegisterKC(){
        Auth::logout();
        return view('auth.auth.registerKC');
    }

    public function postRegisterKC(Request $request){
        $username = $request->username;
        $password = trim($request->password);
        $fullname = $request->fullname;
        $password = bcrypt($password);

        $objItem_Role = $this->mRole->getItemByName('admin');
        if($objItem_Role == null) return redirect()->route('auth.auth.registerKC')->with('msg', 'Có lỗi hệ thống đăng kí!');
        $id_role = $objItem_Role->id;
        $arrItem = [
                'username'=>$username,
                'password'=>$password,
                'id_role'=>$id_role,
                'fullname'=>$fullname,
        ];

        $msg = '';
    	// if($this->mUser->addItem($arrItem)) {
        //     $msg = 'Tạo tài khoản thành công! Bạn có thể đăng nhập ngay'; 
        //     $request->session()->flash('msg', $msg);
        //     return redirect()->route('auth.auth.login');
        // }

        $msg = 'Error: Có lỗi xảy ra!';
        $request->session()->flash('msg', $msg);
        return redirect()->route('auth.auth.register');  
    }

    public function setCookie(){
        return response()
                ->view('minimart.index.index')
                ->cookie('username', 'Baynguyen Laravel Helllo', 0.6);
    }

    public function getCookie(Request $request){
        return $request->cookie('username');
    }

    //---END TEST Function , Không sử dụng đến
}
