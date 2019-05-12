<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\User;
class Role extends Model
{
    protected $table = "role";
    protected $primaryKey = "id";
    public $timestamps = false;

    //for Admin
    public function getAllItems(){
    	return $this->all();
    }

    public function getItems(){
    	return Role::orderBy('id', 'asc')->paginate(getenv('ADMIN_ROW_COUNT'));
    }

    public function countGetItems(){
    	return Role::orderBy('id', 'asc')->count();
    }

    public function getItem($id){
    	return Role::findOrFail($id);
    }

    public function getItemByName($name){
    	return Role::where('name', '=', $name)->first();
    }

    public static function getItemStatic($id){
    	return Role::findOrFail($id);
    }

    public function addItem($arrItem){
        return Role::insert($arrItem);
    }

    public function delItem($id){
        return Role::where('id', $id)->delete();
    }

    public function ajaxToggoActiveStatusPSAM($presentStatus, $id){
        $objItem_Role = Role::findOrFail($id);
        if($presentStatus == 1) $objItem_Role->phanSuAdmin = 0;
        else $objItem_Role->phanSuAdmin = 1;
        return $objItem_Role->update();
    }

    public function ajaxToggoActiveStatusPSDM($presentStatus, $id){
        $objItem_Role = Role::findOrFail($id);
        if($presentStatus == 1) $objItem_Role->phanSuDanhMuc = 0;
        else $objItem_Role->phanSuDanhMuc = 1;
        return $objItem_Role->update();
    }

    public function ajaxToggoActiveStatusPSUS($presentStatus, $id){
        $objItem_Role = Role::findOrFail($id);
        if($presentStatus == 1) $objItem_Role->phanSuUser = 0;
        else $objItem_Role->phanSuUser = 1;
        return $objItem_Role->update();
    }

    public function ajaxToggoActiveStatusPSGD($presentStatus, $id){
        $objItem_Role = Role::findOrFail($id);
        if($presentStatus == 1) $objItem_Role->phanSuGiaoDien = 0;
        else $objItem_Role->phanSuGiaoDien = 1;
        return $objItem_Role->update();
    }

    public function ajaxToggoActiveStatusPSPD($presentStatus, $id){
        $objItem_Role = Role::findOrFail($id);
        if($presentStatus == 1) $objItem_Role->phanSuProduct = 0;
        else $objItem_Role->phanSuProduct = 1;
        return $objItem_Role->update();
    }

    public static function getItemByUserId($id){
        $objItem_User = User::getItemStatic($id);
        return Role::findOrFail($objItem_User->id_role);
    } 

}
