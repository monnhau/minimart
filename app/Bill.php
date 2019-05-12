<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Bill extends Model
{
    protected $table = "bill";
    protected $primaryKey = "id";
    public $timestamps = false;

   	public function getAllItems(){
    	return $this->all();
    }

    public function countGetAllItems(){
    	return $this->count();
    }

    public function getItems(){
        return Bill::orderBy('id', 'desc')->paginate(getenv('ADMIN_ROW_COUNT'));
    } 

    public function countGetItems(){
        return Bill::count();
    } 

    public function getAllIds(){
        return Bill::select('id')->orderBy('id', 'asc')->get();
    }

    public function addItem($arItem){
        return Bill::insert($arItem);
    }

    public function getItemLatest(){
        return Bill::orderBy('id', 'desc')->first();
    }

    public function editItem($id, $arItem){
        return Bill::where('id', $id)->update($arItem);
    }
}
