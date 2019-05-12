<?php

namespace App\Http\Controllers\Minimart;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddContactRequest;
use App\Contact;

class ContactController extends Controller
{
    public function __construct(Contact $mContact){
		$this->mContact = $mContact;
	}

    public function getIndex(){
        return view('minimart.contact.index');
    }

    public function postIndex(AddContactRequest $request){
        $fullname = $request->fullname;
        $username = $request->username;
        $content = $request->content;
        $date_at = date("Y-m-d H:i:s");

        $arItem = [
            'fullname'=>$fullname,
            'username'=>$username,
            'content'=>$content,
            'date_at'=>$date_at,
        ];

        $msg = '';
    	if( $this->mContact->addItem($arItem) ) $msg = 'Gửi thành công! Chúng tôi sẽ phản hồi cho bạn sớm nhất có thể! Xin cảm ơn!'; 
        else $msg = 'Có lỗi xảy ra!';
        return redirect()->route('minimart.contact.index')->with('msg', $msg);
    }
}
