<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Contact extends Model
{
    protected $table = "contact";
    protected $primaryKey = "id";
    public $timestamps = false;

    //for Admin
    public function getAllItems(){
    	return $this->all();
    }

    public function getItems(){
    	return Contact::orderBy('id', 'desc')->paginate(getenv('ADMIN_ROW_COUNT'));
    }

    public function countGetItems(){
    	return Contact::orderBy('id', 'desc')->count();
    }

    public function delItem($id){
    	return Contact::where('id','=', $id)->delete();
    }

    public function addItem($arItem){
    	return Contact::insert($arItem);
    }

    public function search($key, $search_by){
        if($search_by == 0) return Contact::where('fullname', 'like', '%'.$key.'%')->orWhere('username', 'like', '%'.$key.'%')->orWhere('content', 'like', '%'.$key.'%')->orWhere('date_at', 'like', '%'.$key.'%')->orderBy('id', 'desc')->paginate(getenv('ADMIN_ROW_COUNT'));
        else if($search_by == 1) return Contact::where('fullname', 'like', '%'.$key.'%')->orderBy('id', 'desc')->paginate(getenv('ADMIN_ROW_COUNT'));
        else if($search_by == 2) return Contact::where('username', 'like', '%'.$key.'%')->orderBy('id', 'desc')->paginate(getenv('ADMIN_ROW_COUNT'));
        else if($search_by == 3) return Contact::where('content', 'like', '%'.$key.'%')->orderBy('id', 'desc')->paginate(getenv('ADMIN_ROW_COUNT'));
        else return Contact::where('date_at', 'like', '%'.$key.'%')->orderBy('id', 'desc')->paginate(getenv('ADMIN_ROW_COUNT'));
    }

    public function countSearch($key, $search_by){
        if($search_by == 0) return Contact::where('fullname', 'like', '%'.$key.'%')->orWhere('username', 'like', '%'.$key.'%')->orWhere('content', 'like', '%'.$key.'%')->orWhere('date_at', 'like', '%'.$key.'%')->count();
        else if($search_by == 1) return Contact::where('fullname', 'like', '%'.$key.'%')->count();
        else if($search_by == 2) return Contact::where('username', 'like', '%'.$key.'%')->count();
        else if($search_by == 3) return Contact::where('content', 'like', '%'.$key.'%')->count();
        else return Contact::where('date_at', 'like', '%'.$key.'%')->count();
    }
}
