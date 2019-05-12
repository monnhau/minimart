<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Export;
use App\Bill;
use App\Batch;
use App\Product;
class ExportController extends Controller
{ 
    public function __construct(Export $mExport, Bill $mBill,Batch $mBatch ,Product $mProduct){
        $this->mExport = $mExport;
        $this->mBill = $mBill;
        $this->mBatch = $mBatch;
        $this->mProduct = $mProduct;
        $this->mRoute = 'admin.export.index';
        $this->mView = 'admin.export.index';
    }
    public function index(){
        $objItems_Bill = $this->mBill->getItems();
        $quantity = $this->mBill->countGetItems();
        return view($this->mView, compact('objItems_Bill', 'quantity'));
    }

    public function getExport(){
        return view('admin.export.export');
    }

    public function postExport(Request $request){
        $soDong = $request->soDong;
        
    //kiem tra tat ca malo phai hop le
        $arIdsBatch = [];
        for($i = 1; $i <= $soDong; $i++){
            $id_batchInputName = 'id_batch'.$i;
            $id_batch = $request->$id_batchInputName;

            //check maLo hop le
            $objItem_Batch = $this->mBatch->getItem($id_batch);
            if($objItem_Batch == null) return redirect()->route($this->mRoute)->with('msg', 'Error: Nhập mã lô nào đó chưa đúng!' );

            //check so luong phai nho hon trong Kho
            $qtyInputName = 'qty'.$i;  
            $qty = $request->$qtyInputName;
            if($qty > $objItem_Batch->qty) return redirect()->route($this->mRoute)->with('msg', 'Error: Số lượng sản phẩm trong lô mã '.$id_batch.' hiện không đủ để xuất!'  );

            //chen id_batch vao mang arIds_Batch;
            $arIdsBatch[] = $id_batch;
        }

        if( count(array_unique($arIdsBatch)) != count($arIdsBatch) ) return redirect()->route($this->mRoute)->with('msg', 'Error: Mã lô nhập trùng nhau' );

    //tao 1 hoa don moi
        $date_at = date("Y-m-d H:i:s");
        $arItem = [
            'date_at'=>$date_at,
        ];
        $msg = '';
    	if(!$this->mBill->addItem($arItem)) {
            $msg = getenv('ERR');
            return redirect()->route($this->mRoute)->with('msg', $msg);
        }

    //lay id bill của Bill vua them ở trên
        $objItem_Bill = $this->mBill->getItemLatest();
        if($objItem_Bill == null) return redirect()->route($this->mRoute)->with('msg', getenv('ERR'));
        $id_bill = $objItem_Bill->id;

    //Xuat tung loai sp ra
        $total_money = 0;
        for($i = 1; $i <= $soDong; $i++){
            $id_batchInputName = 'id_batch'.$i;
            $qtyInputName = 'qty'.$i;  

            $id_batch = $request->$id_batchInputName;
            $qty = $request->$qtyInputName;
            
            $objItem_Batch = $this->mBatch->getItem($id_batch);
            $objItem_Product = $this->mProduct->getItem($objItem_Batch->id_product);

            $sub_money = $qty*($objItem_Product->price_le);
            
            $arItem = [
                'id_batch'=>$id_batch,
                'id_bill'=>$id_bill,
                'qty'=>$qty,
                'date_at'=>$date_at,
                'nsx'=>$objItem_Batch->nsx,
                'hsd'=>$objItem_Batch->hsd,
                'unit_le_char'=>$objItem_Product->unit_le_char,
                'unit_si_int'=>$objItem_Product->unit_si_int,
                'price_le'=>$objItem_Product->price_le,
                'price_si'=>$objItem_Product->price_si,
                'name_product'=>$objItem_Product->name,
                'sub_money'=>$sub_money,
            ];

            if(!$this->mExport->addItem($arItem)) {
                return redirect()->route($this->mRoute)->with('msg', getenv('ERR'));
            }

            //cap nhat lai so luong cho Batch, sau khi export
            $qty_batch_new = $objItem_Batch->qty - $qty;
            $arItem2 = [
                'qty'=>$qty_batch_new,
            ];

            if(!$this->mBatch->editItem($id_batch, $arItem2)) {
                return redirect()->route($this->mRoute)->with('msg', getenv('ERR'));
            }

            $total_money += $sub_money;
        }

        //cập nhật totel_money cho Bill
        $arItem3 = [
            'total_money'=>$total_money,
        ];
        $msg = '';
    	if($this->mBill->editItem($id_bill, $arItem3) ) $msg = 'Xuất thành công!'; 
        else $msg = getenv('ERR');
        return redirect()->route($this->mRoute)->with('msg', $msg);
    }

    public function ajaxThemDong(Request $request){
        $soDong = $request->soDong;
        return view('admin.export.ajaxThemDong', compact('soDong') );
    }

    public function ajaxXoaDong(Request $request){
        $soDong = $request->soDong;
        return view('admin.export.ajaxXoaDong', compact('soDong') );
    }

    public function ajaxSearchProductByIdBatch(Request $request){
        $idBatch = $request->idBatch;
        $stt = $request->stt;

        $err = '';
        $objItem_Product = null;
        $objItem_Batch = $this->mBatch->getItem($idBatch);
        if($objItem_Batch == null) $err = "false1";  //"Mã sản phẩm không tìm thấy!"
        else{
            $id_product = $objItem_Batch->id_product;
            $objItem_Product = $this->mProduct->getItem2($id_product);
            if($objItem_Product == null) $err = "false2"; //"Sản phẩm không tìm thấy!"
        }
        return view('admin.export.ajaxSearchProductByIdBatch', compact('objItem_Product', 'stt', 'err'));
    }

    public function ajaxCheckQtyByIdBatch(Request $request){
        $idBatch = $request->idBatch;
        $qty = $request->qty;
        $stt = $request->stt;

        $err = '';
        $objItem_Batch = $this->mBatch->getItem($idBatch);
        $qtyBatch = 0;
        if($objItem_Batch == null) $err =  "false1";   // ma lo k tim thay
        else{
            $qtyBatch = $objItem_Batch->qty;
            if($qtyBatch <= 0) $err = "false2";   // hang trong lô đã hết
            else{
                if($qty > $qtyBatch ){
                    $err = "false3";               // hàng trong lô còn, nhưng k đủ để xuất với số lương qty yêu cấu
                }else{
                    $err = 'true';// moi thứ ổn  ==> có thể xuất
                }
            }
        }

        //return $err.' vs '.$stt.' vs '.$idBatch.' vs '.$qtyBatch.' vs '.$qty;

        return view('admin.export.ajaxCheckQtyByIdBatch', compact('qtyBatch', 'stt', 'err'));
       
    }
}
