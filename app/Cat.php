<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cat extends Model
{
    protected $table="cat";
    protected $primaryKey="id";
    public $timestamps=false;
    //for Admin
    public function getAllItems(){
        return Cat::all();
    }
    public function getItems(){
        return Cat::orderBy('id', 'desc')->paginate(getenv('ADMIN_ROW_COUNT'));
    }

    public function countGetItems(){
        return Cat::orderBy('id', 'desc')->count();
    }

    public function addItem($arItem){
        return Cat::insert($arItem);
    }

    public function delItem($id){
        $objItem =  Cat::findOrFail($id);
        return $objItem->delete();
    }

    public function getItem($id){
        return Cat::findOrFail($id);
    }

    public function getItemLatest(){
        return Cat::orderBy('id','desc')->first();
    }

    public static function getItemStatic($id){
        return DB::table('cat')->where('id','=', $id)->first();
    }

    public function editItem($id, $arItem){
        return Cat::where('id', $id)->update($arItem);
    }

    public function ajaxToggoActiveStatus($presentStatus, $id){
        $objItem_Cat = Cat::findOrFail($id);
        if($presentStatus == 1) $objItem_Cat->active = 0;
        else $objItem_Cat->active = 1;

        return $objItem_Cat->update();
    }

}
