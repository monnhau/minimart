<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ValueOption;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Http\Requests\EditPictureRequest;
use App\Http\Requests\EditCropSizeRequest;

class ValueOptionController extends Controller
{

    public function __construct(ValueOption $mValueOtion){
        $this->mValueOption = $mValueOtion;

        $this->mRouteLogo = 'admin.valueOption.indexLogo';
        $this->mRouteMauNen = 'admin.valueOption.updateMauNen';
        $this->mRouteMauNenContent = 'admin.valueOption.updateMauNenContent';
        $this->mRouteCropSize = 'admin.valueOption.updateCropSize';
        $this->mRouteCropSizeLogo = 'admin.valueOption.updateCropSizeLogo';
        $this->mRouteCropSizeSlide = 'admin.valueOption.updateCropSizeSlide';
        $this->mRouteCropSizeProduct = 'admin.valueOption.updateCropSizeProduct';

        $this->mViewLogo = 'admin.valueOption.indexLogo';
        $this->mViewMauNen = 'admin.valueOption.updateMauNen';
        $this->mViewMauNenContent = 'admin.valueOption.updateMauNenContent';
        $this->mViewCropSize = 'admin.valueOption.updateCropSize';
        $this->mViewCropSizeLogo = 'admin.valueOption.updateCropSizeLogo';
        $this->mViewCropSizeSlide = 'admin.valueOption.updateCropSizeSlide';
        $this->mViewCropSizeProduct = 'admin.valueOption.updateCropSizeProduct';

    }

    //BEGIN Quan_ly_logo
    public function indexLogo(){
        return view($this->mViewLogo);
    }

    public function showStorageLogo(){
        $path = storage_path('app/files/logo');
        $files = File::allFiles($path);
        $objItem_Logo = $this->mValueOption->getItemByName('logo');
        if($objItem_Logo == null) return redirect()->route($this->mRouteLogo)->with('msg', getenv('ERR'));
        return view('admin.valueOption.showStorageLogo', compact('files', 'objItem_Logo'));
    }

    public function delLogo($slug, Request $request){
        $old_file_path = storage_path('app/files/logo/'.$slug);
        if(file_exists($old_file_path)){     
            $msg = '';
            if(unlink($old_file_path)) $msg = 'Xóa thành công!'; 
            else $msg = getenv('ERR');
            return redirect()->route('admin.valueOption.showStorageLogo')->with('msg', $msg);
        }
    }
    //BEGIN Update_Logo
        public function getUpdateLogo(){
            $objItem_Logo = $this->mValueOption->getItemByName('logo');
            if($objItem_Logo == null) return redirect()->route($this->mRouteLogo)->with('msg', getenv('ERR'));
            return view('admin.valueOption.updateLogo', compact('objItem_Logo'));
        }

        public function postUpdateLogo(EditPictureRequest $request){
            $image = $request->image;
            list($type, $image) = explode(';', $image);
            list(, $image)      = explode(',', $image);
            $image = base64_decode($image);
            $image_name= time().'.png';
            $path = storage_path('app/files/logo/'.$image_name);

            $msg='';
            if(file_put_contents($path, $image) !== false){
                if($this->mValueOption->updateLogoDemo($image_name)) $msg = 'true';
                else $msg = 'false';
            }else{
                $msg = 'false';
            }
            echo $msg;
        }

        public function updateLogoCancel(Request $request){
            $logoDemo = $this->mValueOption->getItemByName("logo_demo");
            if($logoDemo == null) return redirect()->route($this->mRouteLogo)->with('msg', getenv('ERR'));
          
            $filePath = storage_path('app/files/logo/'.$logoDemo->value_char);
            if(file_exists($filePath)){
                unlink($filePath);
            }
            return redirect()->route($this->mRouteLogo);
            
        }


        public function updateLogoReal(Request $request){
            $logoDemo = $this->mValueOption->getItemByName("logo_demo");
            if($logoDemo == null) return redirect()->route($this->mRouteLogo)->with('msg', getenv('ERR'));
            
            $msg = '';
            if($this->mValueOption->updateLogoReal($logoDemo->value_char) ) $msg = 'Thay đổi logo thành công!'; 
            else $msg = getenv('ERR');
    
            return redirect()->route('admin.valueOption.updateLogo')->with('msg', $msg);
            
        }

        public function selectLogoAvailable(){
            $path = storage_path('app/files/logo');
            $files = File::allFiles($path);
            $objItem_Logo = $this->mValueOption->getItemByName('logo');
            if($objItem_Logo == null) return redirect()->route($this->mRouteLogo)->with('msg', getenv('ERR'));
            return view('admin.valueOption.selectLogoAvailable', compact('files', 'objItem_Logo'));
        }

        public function updateLogoAvailable(Request $request){
            $fileName = $request->slug;
            $msg = '';
            if($this->mValueOption->updateLogoReal($fileName) ) $msg = 'Thay đổi logo thành công!'; 
            else $msg = getenv('ERR');

            return redirect()->route($this->mRouteLogo)->with('msg', $msg);
        }
        //END Update_Logo
    //END Quan_ly_logo

    //BEGIN Doi_mau_nen
    public function getUpdateMauDemo(){
        return view($this->mViewMauNen);
    }

    public function postUpdateMauDemo(Request $request){
        $mauNenDemo = $request->mau_nen_demo;
        if($mauNenDemo == null) return redirect()->route($this->mRouteMauNen)->with('msg', getenv('ERR'));
       
        $msg = '';
        if( $this->mValueOption->updateMauNenDemo($mauNenDemo) ) {
            return redirect()->route('admin.index.indexDemo');
        }
        else {
            $msg = getenv('ERR');
            return redirect()->route($this->mRouteMauNen)->with('msg', $msg);
        }          
            
    }

    public function updateMauNenReal(Request $request){
        $mauNenDemo = $this->mValueOption->getItemByName("mau_nen_demo");
        if($mauNenDemo == null) return redirect()->route($this->mRouteMauNen)->with('msg', getenv('ERR'));
        $mauNenDemo = $mauNenDemo->value_char;
        
        $msg = '';
        if( $this->mValueOption->updateMauNenReal($mauNenDemo) ) {
            $msg = 'Đổi màu nền thành công!'; 
        }
        else {
            $msg = getenv('ERR');
        }   
        return redirect()->route($this->mRouteMauNen)->with('msg', $msg);      
              
    }

    //END Doi_mau_nen

    //BEGIN DOi_mau_nen_content
    public function getUpdateMauContentDemo(){
        return view($this->mViewMauNenContent);
    }

    public function postUpdateMauContentDemo(Request $request){
        $mauNenDemo = $request->mau_nen_demo;
        if($mauNenDemo == null) return redirect()->route($this->mRouteMauNenContent)->with('msg', getenv('ERR'));

        $msg = '';
        if( $this->mValueOption->updateMauNenContentDemo($mauNenDemo) ) {
            return redirect()->route('admin.index.indexDemoContent');
        }
        else {
            $msg = getenv('ERR');
            return redirect()->route($this->mRouteMauNenContent)->with('msg', $msg);
        }          
               
    }

    public function updateMauNenContentReal(Request $request){
        $mauNenDemo = $this->mValueOption->getItemByName("mau_nen_content_demo");
        if($mauNenDemo == null) return redirect()->route($this->mRouteMauNenContent)->with('msg', getenv('ERR'));
        $mauNenDemo = $mauNenDemo->value_char;
        
        $msg = '';
        if( $this->mValueOption->updateMauNenContentReal($mauNenDemo) ) $msg = 'Đổi màu nền thành công!'; 
        else $msg = getenv('ERR');
        return redirect()->route($this->mRouteMauNenContent)->with('msg', $msg);      
              
    }
    //END DOi_mau_nen_content

    //BEGIN Update_Crop_size
    public function updateCropSize(){
        return view($this->mViewCropSize);
    }

    public function getUpdateCropSizeSlide(){
        return view($this->mViewCropSizeSlide);
    }

    public function postUpdateCropSizeSlide(EditCropSizeRequest $request){
        $width = $request->width;
        $height = $request->height;
        if($width >= 650 || $height >= 400){
            $msg = 'Error: Chiều rộng cần bé hơn 650, chiều cao cần bé hơn 400!';
            return redirect()->route($this->mRouteCropSizeSlide)->with('msg', $msg)->withInput();    
        }else{
            $msg = '';
            if( $this->mValueOption->updateWidthSlide($width) && $this->mValueOption->updateHeightSlide($height) ) {
                $msg = 'Sửa thành công!'; 
                return redirect()->route($this->mRouteCropSize)->with('msg', $msg);
            }else{
                $msg = getenv('ERR'); 
                return redirect()->route($this->mRouteCropSize)->with('msg', $msg);
            }
            
        }
    }

    public function getUpdateCropSizeProduct(){
        return view($this->mViewCropSizeProduct);
    }

    public function postUpdateCropSizeProduct(EditCropSizeRequest $request){
        $width = $request->width;
        $height = $request->height;
        if($width >= 650 || $height >= 400){
            $msg = 'Error: Chiều rộng cần bé hơn 650, chiều cao cần bé hơn 400!';
            return redirect()->route($this->mRouteCropSizeProduct)->with('msg', $msg)->withInput();    
        }else{
            $msg = '';
            if( $this->mValueOption->updateWidthProduct($width) && $this->mValueOption->updateHeightProduct($height) ) {
                $msg = 'Sửa thành công!'; 
                return redirect()->route($this->mRouteCropSize)->with('msg', $msg);
            }else{
                $msg = getenv('ERR'); 
                return redirect()->route($this->mRouteCropSize)->with('msg', $msg);
            }
            
        }
    }

    public function getUpdateCropSizeLogo(){
        return view($this->mViewCropSizeLogo);
    }

    public function postUpdateCropSizeLogo(EditCropSizeRequest $request){
        $width = $request->width;
        $height = $request->height;
        if($width >= 650 || $height >= 400){
            $msg = 'Error: Chiều rộng cần bé hơn 650, chiều cao cần bé hơn 400!';
            return redirect()->route($this->mRouteCropSizeLogo)->with('msg', $msg)->withInput();    
        }else{
            $msg = '';
            if( $this->mValueOption->updateWidthLogo($width) && $this->mValueOption->updateHeightLogo($height) ) {
                $msg = 'Sửa thành công!'; 
                return redirect()->route($this->mRouteCropSize)->with('msg', $msg);
            }else{
                $msg = getenv('ERR'); 
                return redirect()->route($this->mRouteCropSizeLogo)->with('msg', $msg)->withInput();
            }
            
        }
    }
    //END Update_Crop_size
    

}
