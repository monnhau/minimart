<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contact;
class ContactController extends Controller
{
    public function __construct(Contact $mContact){
        $this->mContact = $mContact;
        $this->mRoute = 'admin.contact.index';
        $this->mView = 'admin.contact.index';
    }
    
    public function index(){
        $objItems_Contact = $this->mContact->getItems();
        $quantity = $this->mContact->countGetItems();
        return view($this->mView, compact('objItems_Contact', 'quantity'));
    }

    public function del($id, Request $request){
        $msg = '';
    	if($this->mContact->delItem($id)) $msg = 'Xóa thành công!'; 
        else $msg = getenv('ERR');
        return redirect()->route($this->mRoute)->with('msg', $msg);
    }

    public function search(Request $request){
        $key = $request->key;
        $search_by = $request->search_by;
        $objItems_Contact = $this->mContact->search($key, $search_by);
        $quantity = $this->mContact->countSearch($key, $search_by);
        $objItems_Contact->appends(['key'=>$key, 'search_by'=>$search_by]);
        return view('admin.contact.search', compact('objItems_Contact', 'key', 'search_by', 'quantity'));
    }
}
