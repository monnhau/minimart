<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Export extends Model
{
    protected $table = "export";
    protected $primaryKey = "id";
    public $timestamps = false;

   	public function getAllItems(){
    	return $this->all();
    }

    public function countGetAllItems(){
    	return $this->count();
    }

    public function getItems(){
        return DB::table('export as e')->join('batch as b', 'e.id_batch', '=', 'b.id')->join('product as p', 'p.id', '=', 'b.id_product')->select('e.*', 'b.nsx','b.hsd', 'p.name as pname')->orderBy('date_at', 'desc')->paginate(getenv('ADMIN_ROW_COUNT'));
    }

    public static function getItemsByIdBill($id_bill){
        return Export::where('id_bill','=', $id_bill)->get();
    }

    public function addItem($arItem){
    	return Export::insert($arItem);
    }
}
