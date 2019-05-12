<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Slide;
use App\Http\Requests\AddSlideRequest;
use App\Http\Requests\EditPictureRequest;
use File;

class SlideController extends Controller
{
    public function __construct(Slide $mSlide){
        $this->mSlide = $mSlide;
        $this->mRoute = 'admin.slide.index';
        $this->mView = 'admin.slide.index';
    }
    
    public function index(){
        $objItems_Slide = $this->mSlide->getItems();
        $quantity = $this->mSlide->countGetItems();
        return view($this->mView, compact('objItems_Slide', 'quantity'));
    }

    public function getAdd(){
        return view('admin.slide.add');
    }

    public function postAdd(AddSlideRequest $request){
        $desc_text = $request->desc_text;
        $detail_text = $request->detail_text;
        $picture = getenv('DEFAULT_IMG');
        $arItem = [
            'desc_text'=>$desc_text,
            'detail_text'=>$detail_text,
            'picture'=>$picture,
        ];
        $msg = '';
    	if($this->mSlide->addItem($arItem)) $msg = 'Thêm thành công!'; 
        else $msg = getenv('ERR');
        return redirect()->route($this->mRoute)->with('msg', $msg);
    }

    public function ajaxToggoActiveStatus(Request $request){
        $presentStatus = $request->presentStatus;
        $id = $request->id;
        if($this->mSlide->ajaxToggoActiveStatus($presentStatus, $id)) return view('admin.slide.ajaxToggoActiveStatus', compact('presentStatus', 'id')); 
        else return getnv('ERR');
    }

    public function getEdit($id){
        $objItem_Slide = $this->mSlide->getItem($id);
        if($objItem_Slide == null) return redirect()->route($this->mRoute)->with('msg', getenv('ERR'));
        return view('admin.slide.edit', compact('objItem_Slide'));
    }

    public function postEdit($id, AddSlideRequest $request){
        $desc_text = $request->desc_text;
        $detail_text = $request->detail_text;
        $arItem = [
            'desc_text'=>$desc_text,
            'detail_text'=>$detail_text,
        ];
        $msg = '';
    	if($this->mSlide->editItem($id, $arItem)) $msg = 'Sửa thành công!'; 
        else $msg = getenv('ERR');
        return redirect()->route($this->mRoute)->with('msg', $msg);
    }

    public function del($id, Request $request){
        $msg = '';
        $objItem_Slide = $this->mSlide->getItem($id);
        if($objItem_Slide == null) return redirect()->route($this->mRoute)->with('msg', getenv('ERR'));

    	if($this->mSlide->delItem($id)) {
            $msg = 'Xóa thành công!'; 
            $old_file_path = storage_path('app/files/slide/'.$objItem_Slide->picture);
            if(file_exists($old_file_path)){
                unlink($old_file_path);
            }
        }
        else $msg = getenv('ERR');
        return redirect()->route($this->mRoute)->with('msg', $msg);
    }

    public function getEditPicture($id){
        $objItem_Slide = $this->mSlide->getItem($id);
        if($objItem_Slide == null) return redirect()->route($this->mRoute)->with('msg', getenv('ERR'));

        return view('admin.slide.editPicture', compact('objItem_Slide'));
    }

    public function postEditPicture($id, Request $request){
        $image = $request->image;
        list($type, $image) = explode(';', $image);
        list(, $image)      = explode(',', $image);
        $image = base64_decode($image);
        $image_name= time().'.png';
        $path = storage_path('app/files/slide/'.$image_name);

        $msg='';
        if(file_put_contents($path, $image) !== false){
            if($this->mSlide->editPicture($id, $image_name)) $msg = 'true';
            else $msg = 'false';
        }else{
            $msg = 'false';
        }
        echo $msg;
    }

    public function selectPictureAvailable($id){
        $objItem_Slide = $this->mSlide->getItem($id);
        if($objItem_Slide == null) return redirect()->route($this->mRoute)->with('msg', getenv('ERR'));

        $path = storage_path('app/files/slide');
        $files = File::allFiles($path);
        return view('admin.slide.selectPictureAvailable', compact('objItem_Slide', 'files'));
    }

    public function editPictureAvailable($id, $slug, Request $request){
        $msg = '';
    	if($this->mSlide->editPicture($id, $slug)) $msg = 'Sửa thành công!'; 
        else $msg = getenv('ERR');
        return redirect()->route($this->mRoute)->with('msg', $msg);
    }

    public function showStorageSlide(){
        $path = storage_path('app/files/slide');
        $files = File::allFiles($path);

        $arFileNameInStorage = [];
        foreach($files as $fileName){
            $fileName = basename($fileName);
            $arFileNameInStorage[] = $fileName;
        }

        $objItems_Slide = $this->mSlide->getAllItems();
        $arFileNameInDB = [];
        foreach($objItems_Slide as $objItem){
            $fileName = $objItem->picture;
            $arFileNameInDB[] = $fileName;
        }
        
        $arDiff = array_diff($arFileNameInStorage, $arFileNameInDB);

        return view('admin.slide.showStorageSlide', compact('arDiff') );
    }


    public function delPicture($slug, Request $request){
        $old_file_path = storage_path('app/files/slide/'.$slug);
        if(file_exists($old_file_path)){     
            $msg = '';
            if(unlink($old_file_path)) $msg = 'Xóa thành công!'; 
            else $msg = getenv('ERR');
            return redirect()->route('admin.slide.showStorageSlide')->with('msg', $msg);
        }
    }

}
