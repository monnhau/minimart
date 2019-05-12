<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Slide extends Model
{
    protected $table = "slide";
    protected $primaryKey = "id";
    public $timestamps = false;

    //for Admin
    public function getAllItems(){
    	return $this->all();
    }

    public function getItem($id){
    	return Slide::findOrFail($id);
    }

    public function getItems(){
    	return Slide::orderBy('id', 'desc')->paginate(getenv('ADMIN_ROW_COUNT'));
    }

    public function countGetItems(){
    	return Slide::orderBy('id', 'desc')->count();
    }

    public function addItem($arItem){
    	return Slide::insert($arItem);
    }

    public function ajaxToggoActiveStatus($presentStatus, $id){
        $objItem_Slide = Slide::findOrFail($id);
        if($presentStatus == 1) $objItem_Slide->active = 0;
        else $objItem_Slide->active = 1;

        return $objItem_Slide->update();
    }

    public function editItem($id, $arItem){
    	return Slide::where('id', '=', $id)->update($arItem);
    }

    public function delItem($id){
    	return Slide::where('id', '=', $id)->delete();
    }

    public function editPicture($id, $picture){
    	return Slide::where('id', '=', $id)->update([
            'picture'=>$picture,
        ]);
    }
}
