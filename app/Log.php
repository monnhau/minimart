<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Log extends Model
{
    protected $table = "log";
    protected $primaryKey = "id";
    public $timestamps = false;

    //for Admin
    public function getAllItems(){
    	return $this->all();
    }

    public function getItems(){
        return Log::orderBy('id', 'desc')->paginate(getenv('ADMIN_ROW_COUNT'));
    }

    public function countGetItems(){
        return Log::orderBy('id', 'desc')->count();
    }

    public function addItem($arItem){
        return Log::insert($arItem);
    }

    public function delItem($id){
        return Log::where('id','=', $id)->delete();
    }

    public function search($key, $search_by){
        if($search_by == 0) return Log::where('action', 'like', '%'.$key.'%')->orWhere('action', 'like', '%'.$key.'%')->orWhere('username', 'like', '%'.$key.'%')->orWhere('date_at', 'like', '%'.$key.'%')->orderBy('id', 'desc')->paginate(getenv('ADMIN_ROW_COUNT'));
        else if($search_by == 1) return Log::where('action', 'like', '%'.$key.'%')->orderBy('id', 'desc')->paginate(getenv('ADMIN_ROW_COUNT'));
        else if($search_by == 2) return Log::where('username', 'like', '%'.$key.'%')->orderBy('id', 'desc')->paginate(getenv('ADMIN_ROW_COUNT'));
        else return Log::where('date_at', 'like', '%'.$key.'%')->orderBy('id', 'desc')->paginate(getenv('ADMIN_ROW_COUNT'));
    }

    public function countSearch($key, $search_by){
        if($search_by == 0) return Log::where('action', 'like', '%'.$key.'%')->orWhere('action', 'like', '%'.$key.'%')->orWhere('username', 'like', '%'.$key.'%')->orWhere('date_at', 'like', '%'.$key.'%')->orderBy('id', 'desc')->count();
        else if($search_by == 1) return Log::where('action', 'like', '%'.$key.'%')->count();
        else if($search_by == 2) return Log::where('username', 'like', '%'.$key.'%')->count();
        else return Log::where('date_at', 'like', '%'.$key.'%')->count();
    }
}
