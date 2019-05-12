<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Log;
class LogController extends Controller
{

    public function __construct(Log $mLog){
        $this->mLog = $mLog;
        $this->mView = 'admin.log.index';
        $this->mRoute = 'admin.log.index';
    }
    
    public function index(){
        $objItems_Log = $this->mLog->getItems();
        $quantity = $this->mLog->countGetItems();
        return view($this->mView, compact('objItems_Log', 'quantity'));
    }

    public function del($id, Request $request){
        $msg = '';
    	if($this->mLog->delItem($id)) $msg = 'Xóa thành công!'; 
        else $msg = getenv('ERR');
        return redirect()->route($this->mRoute)->with('msg', $msg);

    }

    public function search(Request $request){
        $key = $request->key;
        $search_by = $request->search_by;
        $objItems_Log = $this->mLog->search($key, $search_by);
        $quantity = $this->mLog->countSearch($key, $search_by);
        $objItems_Log->appends(['key'=>$key, 'search_by'=>$search_by]);
        return view('admin.log.search', compact('objItems_Log', 'key', 'search_by', 'quantity'));

    }
}
