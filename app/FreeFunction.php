<?php

namespace App;
use DateTime;

use Illuminate\Database\Eloquent\Model;

class FreeFunction extends Model
{
    public static function highLight($key, $para){
        $kq =  str_replace($key, '<span style="color:orange">'.$key.'</span>', $para);
        return $kq;
    }

    public function suggestId($objItems_Id){
        $idTemp = 0;
        foreach ($objItems_Id as $objItem_Id) {
            if($objItem_Id->id > $idTemp + 1) break;
            $idTemp = $objItem_Id->id;
        }

        return $idTemp+1;
    }

    public static function getTime(){
        return date("Y-m-d H:i:s");
    }

    public static function isWhiteTextByBgColor($bgHexColor){
        list($r, $g, $b) = sscanf($bgHexColor, "#%02x%02x%02x");
        $lum = ($r+$r+$b+$b+$g+$g)/6;
        if ($lum > 170) {
            return 0;
        } else {
            return 1;
        }
    }
}
