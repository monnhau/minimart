<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ValueOption extends Model
{
    protected $table = "value_option";
    protected $primaryKey = "id";
    public $timestamps = false;

    //for Admin
    public static function getItemByName($name){
        return ValueOption::where('name','=', $name)->first();
    }

    public function updateMauNenDemo($value){
        return ValueOption::where('name','=', 'mau_nen_demo')->update([ 'value_char'=>$value ]  );
    }

    public function updateMauNenContentDemo($value){
        return ValueOption::where('name','=', 'mau_nen_content_demo')->update([ 'value_char'=>$value ]  );
    }

    public function updateMauNenReal($value){
        return ValueOption::where('name','=', 'mau_nen')->update([ 'value_char'=>$value ]  );
    }

    public function updateMauNenContentReal($value){
        return ValueOption::where('name','=', 'mau_nen_content')->update([ 'value_char'=>$value ]  );
    }

    public function updateLogoDemo($value){
        return ValueOption::where('name','=', 'logo_demo')->update([ 'value_char'=>$value ]  );
    }

    public function updateLogoReal($value){
        return ValueOption::where('name','=', 'logo')->update([ 'value_char'=>$value ]  );
    }

    public function updateWidthSlide($value){
        return ValueOption::where('name','=', 'width_slide')->update([ 'value_int'=>$value ]  );
    }

    public function updateHeightSlide($value){
        return ValueOption::where('name','=', 'height_slide')->update([ 'value_int'=>$value ]  );
    }

    public function updateWidthProduct($value){
        return ValueOption::where('name','=', 'width_product')->update([ 'value_int'=>$value ]  );
    }

    public function updateHeightProduct($value){
        return ValueOption::where('name','=', 'height_product')->update([ 'value_int'=>$value ]  );
    }

    public function updateWidthLogo($value){
        return ValueOption::where('name','=', 'width_logo')->update([ 'value_int'=>$value ]  );
    }

    public function updateHeightLogo($value){
        return ValueOption::where('name','=', 'height_logo')->update([ 'value_int'=>$value ]  );
    }

}
