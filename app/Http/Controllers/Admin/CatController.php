<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Cat;
use App\Log;
use App\Product;
use App\Http\Requests\AddCatRequest;
use App\Http\Requests\EditCatRequest;
use Auth;

class CatController extends Controller
{
    public function __construct(Cat $mCat, Log $mLog, Product $mProduct){
        $this->mCat = $mCat;
        $this->mLog = $mLog;
        $this->mProduct = $mProduct;

        $this->mView = 'admin.cat.index';
        
        $this->mRoute = 'admin.cat.index';
    } 
    public function index(){
        $objItems_Cat = $this->mCat->getItems();
        $quantity = $this->mCat->countGetItems();
        return view($this->mView, compact('objItems_Cat', 'quantity'));
    }

    public function getAdd(){
        return view('admin.cat.add');
    }

    public function postAdd(AddCatRequest $request){
        $name = $request->name;
        $arItem = [
            'name'=>$name,
        ];
        $msg = '';
    	if($this->mCat->addItem($arItem)) {
            $msg = 'Thêm thành công!'; 
            //add Log
            $objItem_Cat = $this->mCat->getItemLatest();
            if($objItem_Cat == null) return redirect()->route($this->mRoute)->with('msg', getenv('ERR'));

            $action = "Thêm danh mục";
            $username = Auth::user()->username;
            $date_at = date("Y-m-d H:i:s");
            $detail = (string) $objItem_Cat;
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

    public function del($id, Request $request){
        $objItem_Cat = $this->mCat->getItem($id);
        if($objItem_Cat == null) return redirect()->route($this->mRoute)->with('msg', getenv('ERR'));
        $id_Cat = $objItem_Cat->id;
        $objItems_Product_Count = $this->mProduct->countGetItemsByCatId($id_Cat);
        if($objItems_Product_Count > 0 )  return redirect()->route($this->mRoute)->with('msg', 'Error: Hiện có '.$objItems_Product_Count.' sản phẩm (mang tính phân loại) thuộc danh mục này! Nên danh mục này không thể xóa bây giò!');
        if($id == 1) redirect()->route($this->mRoute)->with('msg', 'Error: Không thể xóa danh mục này!');
        $msg = '';
       
        if($this->mCat->delItem($id)) {
            $msg = 'Xóa thành công!'; 
            //---add to Log
            $action = "Xóa danh mục";
            $username = Auth::user()->username;
            $date_at = date("Y-m-d H:i:s");
            $detail = (string) $objItem_Cat;
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

    public function getEdit($id, Request $request){
        $objItem_Cat = $this->mCat->getItem($id);
        if($objItem_Cat == null) return redirect()->route($this->mRoute)->with('msg', getenv('ERR'));
        
        return view('admin.cat.edit', compact('objItem_Cat'));   
    }

    public function postEdit($id, EditCatRequest $request){
        $objItem_Cat = $this->mCat->getItem($id);
        if($objItem_Cat == null) return redirect()->route($this->mRoute)->with('msg', getenv('ERR'));

        if( !($id == 1) ){
            $name = $request->name;
            $arItem = [
                'name'=>$name,
            ];
            $msg = '';
            if($this->mCat->editItem($id, $arItem)) {
                $msg = 'Sửa thành công!'; 
                //add to Log
                $action = "Sửa danh mục";
                $username = Auth::user()->username;
                $date_at = date("Y-m-d H:i:s");
                $detail = (string) $objItem_Cat;
                $arItem = [
                    'action'=>$action,
                    'username'=>$username,
                    'date_at'=>$date_at,
                    'detail'=>$detail,
                ];
                $this->mLog->addItem($arItem);
            }
            else $msg = getenv('ERR');
        }else{
            $msg = 'Error: Không sửa danh mục này!'; 
        }
        return redirect()->route($this->mRoute)->with('msg', $msg); 
    }

    public function ajaxToggoActiveStatus(Request $request){
        $presentStatus = $request->presentStatus;
        $id = $request->id;
        if($this->mCat->ajaxToggoActiveStatus($presentStatus, $id)) return view('admin.cat.ajaxToggoActiveStatus', compact('presentStatus', 'id')); 
        else return 'Error: Có lỗi xảy ra!';
    }
}
