<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Batch extends Model
{
    protected $table = "batch";
    protected $primaryKey = "id";
    public $timestamps = false;

    //for Admin
    public function getAllItems(){
    	return $this->all();
    }

    public function getItem($id){
        return Batch::where('id',$id)->first();
    }

    public function getItemsByProductId($id){
        return Batch::where('id_product', '=', $id)->orderBy('date_at', 'desc' )->paginate(getenv('ADMIN_ROUNT_COUNT'));
    }

    public function countGetItemsByProductId($id){
        return Batch::where('id_product', '=', $id)->count();
    }

    public function addItem($arItem){
        return Batch::insert($arItem);
    }

    public function delItem($id){
        $objItem_Batch = Batch::findOrFail($id);
        return $objItem_Batch->delete();
    }

    public function editItem($id, $arItem){
        return Batch::where('id', $id)->update($arItem);
    }

    public function getAllIds(){
        return Batch::select('id')->orderBy('id', 'asc')->get();
    }

    public function toggoActiveStatus($presentStatus, $id){
        $objItem_Batch = Batch::findOrFail($id);
        if($presentStatus == 1) $objItem_Batch->active = 0;
        else $objItem_Batch->active = 1;

        return $objItem_Batch->update();
    }

    public function countGetItemsByProductIdAndNsx($id, $dateString){
        return Batch::where('id_product', $id)->where('nsx', '=', $dateString)->count();
    }
}
