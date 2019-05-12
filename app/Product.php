<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Product extends Model
{
    
    protected $table = "product";
    protected $primaryKey = "id";
    public $timestamps = false;

    //for Admin
    public function getAllItems(){
    	return $this->all();
    }

    public function countGetAllItems(){
    	return $this->count();
    }
    
    public function getItem($id){
        return Product::findOrFail($id);
    }
    public function getItems(){
    	return DB::table('product as p')->join('cat as c', 'p.id_cat', '=', 'c.id')->select('p.*', 'c.id as id_cat','c.name as name_cat', 'c.active as active_cat')->orderBy('date_at', 'desc')->paginate(getenv('ADMIN_ROW_COUNT'));
    }

    public function getItem2($id){
    	return DB::table('product as p')->join('cat as c', 'p.id_cat', '=', 'c.id')->where('p.id', $id)->select('p.*', 'c.id as id_cat','c.name as name_cat', 'c.active as active_cat')->first();
    }

    public function countGetItems(){
    	return DB::table('product as p')->join('cat as c', 'p.id_cat', '=', 'c.id')->select('p.*', 'c.id as id_cat','c.name as name_cat', 'c.active as active_cat')->orderBy('date_at', 'desc')->count();
    }

    public function addItem($arItem){
        return Product::insert($arItem);
    }

    public function delItem($id){
        $objItem_Product = Product::findOrFail($id);
        return $objItem_Product->delete();
    }

    public function editItem($id, $arItem){
        return Product::where('id', $id)->update($arItem);
    }

    public function editPicture($id, $fileName){
        $objItem_Product = Product::findOrFail($id);
        $objItem_Product->picture = $fileName;
        return $objItem_Product->update();
    }

    public function getAllIds(){
        return Product::select('id')->orderBy('id', 'asc')->get();
    }

    public function countGetItemsByCatId($id){
        return Product::where('id_cat', '=' , $id)->count();
    }

    public function ajaxToggoActiveStatus($presentStatus, $id){
        $objItem_Product = Product::findOrFail($id);
        if($presentStatus == 1) $objItem_Product->active = 0;
        else $objItem_Product->active = 1;

        return $objItem_Product->update();
    }

    public function toggoActiveKmStatus($presentStatus, $id){
        $objItem_Product = Product::findOrFail($id);
        if($presentStatus == 1) $objItem_Product->active_km = 0;
        else $objItem_Product->active_km = 1;

        return $objItem_Product->update();
    }

    public function toggoActivePriceStatus($presentStatus, $id){
        $objItem_Product = Product::findOrFail($id);
        if($presentStatus == 1) $objItem_Product->active_ban_si = 0;
        else $objItem_Product->active_ban_si = 1;

        return $objItem_Product->update();
    }

    public function search($key, $search_by){
        if($search_by == 0) return DB::table('product as p')->join('cat as c', 'p.id_cat', '=', 'c.id')->select('p.*', 'c.id as id_cat','c.name as name_cat', 'c.active as active_cat')->where('p.name', 'like', '%'.$key.'%')->orWhere('c.name', 'like', '%'.$key.'%')->orWhere('p.id', 'like', '%'.$key.'%')->orderBy('date_at', 'desc')->paginate(getenv('ADMIN_ROW_COUNT'));
        else if($search_by == 1) return DB::table('product as p')->join('cat as c', 'p.id_cat', '=', 'c.id')->select('p.*', 'c.id as id_cat','c.name as name_cat', 'c.active as active_cat')->where('p.name', 'like', '%'.$key.'%')->orderBy('date_at', 'desc')->paginate(getenv('ADMIN_ROW_COUNT'));
        else if($search_by == 2) return DB::table('product as p')->join('cat as c', 'p.id_cat', '=', 'c.id')->select('p.*', 'c.id as id_cat','c.name as name_cat', 'c.active as active_cat')->where('c.name', 'like', '%'.$key.'%')->orderBy('date_at', 'desc')->paginate(getenv('ADMIN_ROW_COUNT'));
        else if($search_by == 3) return DB::table('product as p')->join('cat as c', 'p.id_cat', '=', 'c.id')->select('p.*', 'c.id as id_cat','c.name as name_cat', 'c.active as active_cat')->where('p.active', 'like', '%'.$key.'%')->orderBy('date_at', 'desc')->paginate(getenv('ADMIN_ROW_COUNT'));
        else if($search_by == 4) return DB::table('product as p')->join('cat as c', 'p.id_cat', '=', 'c.id')->select('p.*', 'c.id as id_cat','c.name as name_cat', 'c.active as active_cat')->where('p.active_km', 'like', '%'.$key.'%')->orderBy('date_at', 'desc')->paginate(getenv('ADMIN_ROW_COUNT'));
        else return DB::table('product as p')->join('cat as c', 'p.id_cat', '=', 'c.id')->select('p.*', 'c.id as id_cat','c.name as name_cat', 'c.active as active_cat')->where('p.id', 'like', '%'.$key.'%')->orderBy('date_at', 'desc')->paginate(getenv('ADMIN_ROW_COUNT'));
    }

    public function countSearch($key, $search_by){
        if($search_by == 0) return DB::table('product as p')->join('cat as c', 'p.id_cat', '=', 'c.id')->select('p.*', 'c.id as id_cat','c.name as name_cat', 'c.active as active_cat')->where('p.name', 'like', '%'.$key.'%')->orWhere('c.name', 'like', '%'.$key.'%')->orWhere('p.id', 'like', '%'.$key.'%')->count();
        else if($search_by == 1) return DB::table('product as p')->join('cat as c', 'p.id_cat', '=', 'c.id')->select('p.*', 'c.id as id_cat','c.name as name_cat', 'c.active as active_cat')->where('p.name', 'like', '%'.$key.'%')->count();
        else if($search_by == 2) return DB::table('product as p')->join('cat as c', 'p.id_cat', '=', 'c.id')->select('p.*', 'c.id as id_cat','c.name as name_cat', 'c.active as active_cat')->where('c.name', 'like', '%'.$key.'%')->count();
        else if($search_by == 3) return DB::table('product as p')->join('cat as c', 'p.id_cat', '=', 'c.id')->select('p.*', 'c.id as id_cat','c.name as name_cat', 'c.active as active_cat')->where('p.active', 'like', '%'.$key.'%')->count();
        else if($search_by == 4) return DB::table('product as p')->join('cat as c', 'p.id_cat', '=', 'c.id')->select('p.*', 'c.id as id_cat','c.name as name_cat', 'c.active as active_cat')->where('p.active_km', 'like', '%'.$key.'%')->count();
        else return DB::table('product as p')->join('cat as c', 'p.id_cat', '=', 'c.id')->select('p.*', 'c.id as id_cat','c.name as name_cat', 'c.active as active_cat')->where('p.id', 'like', '%'.$key.'%')->count();
    }

}
