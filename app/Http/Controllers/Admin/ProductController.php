<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddProductRequest;
use App\Http\Requests\EditProductRequest;
use App\Http\Requests\AddBatchRequest;
use App\Product;
use App\Cat;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\EditPictureRequest;
use Illuminate\Support\Facades\File;
use App\Batch;
use App\FreeFunction;
use DateTime;

class ProductController extends Controller
{
    public function __construct(Product $mProduct, Cat $mCat, Batch $mBatch, FreeFunction $mFreeFunction){
        $this->mProduct = $mProduct;
        $this->mCat = $mCat;
        $this->mBatch = $mBatch;
        $this->mFreeFunction = $mFreeFunction;
        
        $this->mRoute = 'admin.product.index';
        $this->mRouteBatch = 'admin.product.indexBatch';

        $this->mView = 'admin.product.index';
        $this->mViewBatch = 'admin.product.indexBatch';
	}
    public function index(){
        $objItems_Product = $this->mProduct->getItems();
        $quantity = $this->mProduct->countGetItems();
        return view($this->mView, compact('objItems_Product', 'quantity'));
    }

    public function getAdd(){
        $objItems_Cat = $this->mCat->getAllItems();
        return view('admin.product.add', compact('objItems_Cat'));
    }

    public function postAdd(AddProductRequest $request){
        $unit_si_int = $request->unit_si_int;
        $price_si = $request->price_si;

        if( ($unit_si_int == '' || $unit_si_int == null) && $price_si != null){
            return redirect()->route('admin.product.add')->with('msg', 'Error: Vì bạn đã nhập giá sĩ, nên bạn cần nhập ĐVSNN kèm theo!')->withInput();
        }else if( $unit_si_int != null && ($price_si == '' || $price_si == null) ){
            return redirect()->route('admin.product.add')->with('msg', 'Error: Vì bạn đã nhập ĐVSNN, nên bạn cần nhập giá sĩ kèm theo!')->withInput();
        }else{

        }

        $name = trim($request->name);
        $id_cat = $request->id_cat;
        $desc_text = trim($request->desc_text);
        $detail_text = $request->detail_text;
        $km_text = trim($request->km_text);

        $unit_le_char = $request->unit_le_char;
        $price_le = $request->price_le;
    
        $picture = '';
        $product_img_default = getenv('DEFAULT_IMG');
        if($product_img_default != '') $picture = $product_img_default;

        //BEGIN Tao maSp min de tiet kiem Id
        $objItems_ProductId = $this->mProduct->getAllIds();
        $suggestId = $this->mFreeFunction->suggestId($objItems_ProductId);
        //END Tao maSp min de tiet kiem Id
        $date_at = date("Y-m-d H:i:s");

        $arItem = [
            'id'=>$suggestId,
            'name'=>$name,
            'id_cat'=>$id_cat,
            'desc_text'=>$desc_text,
            'detail_text'=>$detail_text,
            'km_text'=>$km_text,
            'picture'=>$picture,
            'unit_le_char'=>$unit_le_char,
            'price_le'=>$price_le,
            'unit_si_int'=>$unit_si_int,
            'price_si'=>$price_si,
            'date_at'=>$date_at,
        ];

        $msg = '';
    	if($this->mProduct->addItem($arItem)) $msg = 'Thêm thành công!'; 
        else $msg = getenv('ERR');
        return redirect()->route($this->mRoute)->with('msg', $msg);
        
    }

    public function del($id, Request $request){
        $objItem_Product = $this->mProduct->getItem($id);
        if($objItem_Product == null) return redirect()->route($this->mRoute)->with('msg', getenv('ERR'));

        $objItems_Batch_Count = $this->mBatch->countGetItemsByProductId($id);
        if($objItems_Batch_Count > 0) return redirect()->route($this->mRoute)->with('msg', 'Error: Hiện có '.$objItems_Batch_Count.' lô (mang tính phân loại) thuộc sản phẩm này! Sản phẩm này không thế xóa bây giờ!');
    
        $msg = '';
        $product_img_default = getenv('DEFAULT_IMG');

        $fileName = $objItem_Product->picture;
        if($fileName != $product_img_default){
            $old_file_path = storage_path('app/files/product/'.$fileName);
            if(file_exists($old_file_path)){
                unlink($old_file_path);
            }
        }
        
    	if($this->mProduct->delItem($id)) $msg = 'Xóa thành công!'; 
        else $msg = getenv('ERR');
        return redirect()->route($this->mRoute)->with('msg', $msg);
    }

    public function getEdit($id, Request $request){
        $objItems_Cat = $this->mCat->getAllItems();
        $objItem_Product = $this->mProduct->getItem($id);
        if($objItem_Product == null) return redirect()->route($this->mRoute)->with('msg', getenv('ERR'));

        return view('admin.product.edit', compact('objItems_Cat', 'objItem_Product'));
    }

    public function postEdit($id, EditProductRequest $request){
        $unit_si_int = $request->unit_si_int;
        $price_si = $request->price_si;

        if( ($unit_si_int == '' || $unit_si_int == null) && $price_si != null){
            return redirect()->route('admin.product.edit', ['id'=>$id])->with('msg', 'Error: Vì bạn đã nhập giá sĩ, nên bạn cần nhập ĐVSNN kèm theo!')->withInput();
        }else if( $unit_si_int != null && ($price_si == '' || $price_si == null) ){
            return redirect()->route('admin.product.edit', ['id'=>$id])->with('msg', 'Error: Vì bạn đã nhập ĐVSNN, nên bạn cần nhập giá sĩ kèm theo!')->withInput();
        }else{

        }

        $name = $request->name;
        $id_cat = $request->id_cat;
        $desc_text = $request->desc_text;
        $detail_text = $request->detail_text;
        $km_text = $request->km_text;

        $unit_le_char = $request->unit_le_char;
        $price_le = $request->price_le;

        $arItem = [
            'name'=>$name,
            'id_cat'=>$id_cat,
            'desc_text'=>$desc_text,
            'detail_text'=>$detail_text,
            'km_text'=>$km_text,
            'unit_le_char'=>$unit_le_char,
            'price_le'=>$price_le,
            'unit_si_int'=>$unit_si_int,
            'price_si'=>$price_si,
        ];

        $msg = '';
    	if($this->mProduct->editItem($id, $arItem)) $msg = 'Sửa thành công!'; 
        else $msg = getenv('ERR');
        return redirect()->route($this->mRoute)->with('msg', $msg);
    }

    public function getEditPicture($id, Request $request){
        $objItem_Product = $this->mProduct->getItem($id);
        if($objItem_Product == null) return redirect()->route($this->mRoute)->with('msg', getenv('ERR'));
        return view('admin.product.editPicture', compact('objItem_Product'));
    }

    public function postEditPicture($id, EditPictureRequest $request){
        $image = $request->image;
        $objItem_Product = $this->mProduct->getItem($id);
        list($type, $image) = explode(';', $image);
        list(, $image)      = explode(',', $image);
        $image = base64_decode($image);
        $image_name= time().'.png';
        $path = storage_path('app/files/product/'.$image_name);

        $msg='';
        if(file_put_contents($path, $image) !== false){
            if($this->mProduct->editPicture($id, $image_name)) {
                $msg = 'true';
                if($objItem_Product->picture != getenv('DEFAULT_IMG')){
                    $old_file_path = storage_path('app/files/product/'.$objItem_Product->picture);
                    if(file_exists($old_file_path)){
                        unlink($old_file_path);
                    }
                }
            }
            else $msg = 'false';
        }else{
            $msg = 'false';
        }
        echo $msg;
    }

    public function selectPictureAvailable($id, Request $request){
        $objItem_Product = $this->mProduct->getItem($id);
        if($objItem_Product == null) return redirect()->route($this->mRoute)->with('msg', getenv('ERR'));
        $path = storage_path('app/files/product');
        $files = File::allFiles($path);
        return view('admin.product.selectPictureAvailable', compact('objItem_Product', 'files'));
    }

    public function editPictureAvailable($id, $slug, Request $request){
        $fileName = $request->slug;
        $msg = '';
        if($this->mProduct->editPicture($id, $fileName) ) $msg = 'Thay đổi ảnh sản phẩm thành công!'; 
        else $msg = getenv('ERR');
        return redirect()->route($this->mRoute)->with('msg', $msg);
    }

    public function ajaxToggoActiveStatus(Request $request){
        $presentStatus = $request->presentStatus;
        $id = $request->id;

        if( !($presentStatus == 1 || $presentStatus == 0) ) return getenv('ERR');
        $objItem_Product  = $this->mProduct->getItem($id);
        if($objItem_Product == null) return getenv('ERR');
        if($objItem_Product->id_cat == 1) return 'DB fixed';

        if($this->mProduct->ajaxToggoActiveStatus($presentStatus, $id)) return view('admin.product.ajaxToggoActiveStatus', compact('presentStatus', 'id')); 
        else return getenv('ERR');
    }

    public function toggoActiveKmStatus($presentStatus, $id, Request $request){      
        if($this->mProduct->toggoActiveKmStatus($presentStatus, $id)) return redirect()->route($this->mRoute)->with('msg', 'Sửa thành công!');
        else return getenv('ERR');
    }

    public function ajaxShowKmText(Request $request){
        $presentStatus = $request->presentStatus;
        $id = $request->id;  
        //lay thong tin sp ung voi id => lấy ra km_Text
        $objItem_Product = $this->mProduct->getItem($id);
        $km_text = $objItem_Product->km_text;
        $name = $objItem_Product->name;
        return view('admin.product.ajaxShowKmText', compact('id', 'presentStatus', 'km_text', 'name'));
        
    }

    public function toggoActivePriceStatus($presentStatus, $id, Request $request){      
        if($this->mProduct->toggoActivePriceStatus($presentStatus, $id)) return redirect()->route($this->mRoute)->with('msg', 'Sửa thành công!');
        else return getenv('ERR');
    }

    public function ajaxShowPriceText(Request $request){
        $presentStatus = $request->presentStatus;
        $id = $request->id;  
        //lay thong tin sp ung voi id => lấy ra km_Text
        $objItem_Product = $this->mProduct->getItem($id);
        $price_si = $objItem_Product->price_si;
        $unit_le_char = $objItem_Product->unit_le_char;
        $unit_si_int = $objItem_Product->unit_si_int;
        $name = $objItem_Product->name;
        return view('admin.product.ajaxShowPriceText', compact('id', 'presentStatus', 'price_si', 'name', 'unit_le_char', 'unit_si_int'));
    }

    public function search(Request $request){
        $key = trim($request->key);
        $search_by = $request->search_by;
        $objItems_Product = $this->mProduct->search($key, $search_by);
        $quantity = $this->mProduct->countSearch($key, $search_by);
        $objItems_Product->appends(['key'=>$key, 'search_by'=>$search_by]);
        return view('admin.product.search', compact('objItems_Product', 'key', 'search_by', 'quantity'));
    }

    //---------for Batch------------------------------
    public function indexBatch($id, Request $request){
        $idProduct = $id;
        $objItem_Product = $this->mProduct->getItem($idProduct);
        if($objItem_Product == null) return redirect()->route($this->mRoute)->with('msg', getenv('ERR'));
        $objItems_Batch = $this->mBatch->getItemsByProductId($idProduct);
        $quantity = $this->mBatch->countGetItemsByProductId($idProduct);
        return view($this->mViewBatch, compact('objItem_Product', 'objItems_Batch', 'quantity'));
    }

    public function getAddBatch(Request $request){
        $idProduct = $request->id;
        $objItem_Product = $this->mProduct->getItem($idProduct);
        return view('admin.product.addBatch', compact('objItem_Product'));
    }

    public function postAddBatch($id, AddBatchRequest $request){
        $nsx_d = $request->nsx_d;
        $nsx_m = $request->nsx_m;
        $nsx_y = $request->nsx_y;
        $hsd_d = $request->hsd_d;
        $hsd_m = $request->hsd_m;
        $hsd_y = $request->hsd_y;

        $dateString1 = $nsx_y.'-'.$nsx_m.'-'.$nsx_d;
        $countGetItemsByProductIdAndNsx = $this->mBatch->countGetItemsByProductIdAndNsx($id, $dateString1);
        if($countGetItemsByProductIdAndNsx > 0){
            $request->session()->flash('msg', 'Error: Trùng ngày sản xuất với 1 lô có sẵn! Vui lòng xem lại');
            return redirect()->route('admin.product.addBatch', ['id'=>$id])->withInput();
        }

        $isDataValid1 = checkdate($nsx_m, $nsx_d, $nsx_y);
        $isDataValid2 = checkdate($hsd_m, $hsd_d, $hsd_y);

        if($isDataValid1==true && $isDataValid2 == true){
            $dateTime1 = new DateTime($nsx_y.'-'.$nsx_m.'-'.$nsx_d);
            $dateTime2 = new DateTime($hsd_y.'-'.$hsd_m.'-'.$hsd_d);

            if ($dateTime1 < $dateTime2) {
                $nsx = $nsx_y.'-'.$nsx_m.'-'.$nsx_d;
                $hsd = $hsd_y.'-'.$hsd_m.'-'.$hsd_d;
                $qty = $request->qty;

                //BEGIN Tao maLo min de tiet kiem Id
                $objItems_BatchId = $this->mBatch->getAllIds();
                $suggestId = $this->mFreeFunction->suggestId($objItems_BatchId);
                //END Tao maSp min de tiet kiem Id
                $date_at = date("Y-m-d H:i:s");

                $arItem = [
                    'id'=>$suggestId,
                    'id_product'=>$id,
                    'nsx'=>$nsx,
                    'hsd'=>$hsd,
                    'qty'=>$qty,
                    'date_at'=>$date_at,
                ];

                $msg = '';
                if($this->mBatch->addItem($arItem)) $msg = 'Thêm thành công!'; 
                else $msg = getenv('ERR');
                return redirect()->route($this->mRouteBatch, ['id'=>$id])->with('msg', $msg);
            }
            else{
                $request->session()->flash('msg', 'Error: Ngày sản xuất phải bé hơn hạn sử dụng!');
                return redirect()->route('admin.product.addBatch', ['id'=>$id])->withInput();
            }
                
        }else {
            $request->session()->flash('msg', 'Error: Ngày bạn chọn không tồn tại!');
            return redirect()->route('admin.product.addBatch', ['id'=>$id])->withInput();
        }

    }

    public function delBatch($id, $sid, Request $request){
        $msg = '';
    	if($this->mBatch->delItem($sid)) $msg = 'Xóa thành công!'; 
        else $msg = getenv('ERR');
        return redirect()->route($this->mRouteBatch, ['id'=>$id])->with('msg', $msg);
    }

    public function getEditBatch($id, $sid){
        $objItem_Product = $this->mProduct->getItem($id);
        $objItem_Batch = $this->mBatch->getItem($sid);
        if($objItem_Product == null || $objItem_Batch == null) return redirect()->route($this->mRoute)->with('msg', getenv('ERR'));

        return view('admin.product.editBatch',compact('objItem_Product', 'objItem_Batch'));
    }

    public function postEditBatch($id, $sid, AddBatchRequest $request){
        $nsx_d = $request->nsx_d;
        $nsx_m = $request->nsx_m;
        $nsx_y = $request->nsx_y;
        $hsd_d = $request->hsd_d;
        $hsd_m = $request->hsd_m;
        $hsd_y = $request->hsd_y;

        $isDataValid1 = checkdate($nsx_m, $nsx_d, $nsx_y);
        $isDataValid2 = checkdate($hsd_m, $hsd_d, $hsd_y);

        if($isDataValid1==true && $isDataValid2 == true){
            $dateTime1 = new DateTime($nsx_y.'-'.$nsx_m.'-'.$nsx_d);
            $dateTime2 = new DateTime($hsd_y.'-'.$hsd_m.'-'.$hsd_d);

            if ($dateTime1 < $dateTime2) {
                $nsx = $nsx_y.'-'.$nsx_m.'-'.$nsx_d;
                $hsd = $hsd_y.'-'.$hsd_m.'-'.$hsd_d;
                $qty = $request->qty;
                $arItem = [
                    'nsx'=>$nsx,
                    'hsd'=>$hsd,
                    'qty'=>$qty,
                ];
                $msg = '';
                if($this->mBatch->editItem($sid, $arItem)) $msg = 'Sửa thành công!'; 
                else $msg = getenv('ERR');
                return redirect()->route($this->mRouteBatch, ['id'=>$id])->with('msg', $msg);
            }
            else{
                $request->session()->flash('msg', 'Error: Ngày sản xuất phải bé hơn hạn sử dụng!');
                return redirect()->route('admin.product.editBatch', ['id'=>$id, 'sid'=>$sid])->withInput();
            }
                
        }else {
            $request->session()->flash('msg', 'Error: Ngày bạn chọn không tồn tại!');
            return redirect()->route('admin.product.editBatch', ['id'=>$id, 'sid'=>$sid])->withInput();
        }
    }

    public function toggoActiveStatusBatch($presentStatus, $id, $sid, Request $request){
        if( !($presentStatus == 1 || $presentStatus == 0) ) return getenv('ERR');
        $objItem_Batch  = $this->mBatch->getItem($id);
        if($objItem_Batch == null) return getenv('ERR');
    
        $msg = '';
        if($this->mBatch->toggoActiveStatus($presentStatus, $id)) $msg = 'Cập nhật thành công!';
        else $msg = getenv('ERR');

        return redirect()->route('admin.product.indexBatch', ['id'=>$sid])->with('msg', $msg);
    }
}
