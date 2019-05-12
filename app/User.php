<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $table = "users";
    protected $primaryKey = "id";
    public $timestamps = false;

    //for Admin
    public function getAllItems(){
    	return User::paginate(getenv('ADMIN_ROW_COUNT'));
    }

    public function getItem($id){
        return User::findOrFail($id);
    }

    public static function getItemStatic($id){
        return User::findOrFail($id);
    }

    public function getItems(){
        return DB::table('users as u')->join('role as r', 'u.id_role', '=', 'r.id')->select('u.*', 'r.id as id_role2', 'r.name as name2')->orderBy('date_at', 'desc')->paginate(getenv('ADMIN_ROW_COUNT'));
    }

    public function countGetItems(){
        return DB::table('users as u')->join('role as r', 'u.id_role', '=', 'r.id')->select('u.*', 'r.id as id_role2', 'r.name as name2')->count();
    }

    public function addItem($arItem){
        return User::insert($arItem);
    }

    public function delItem($id){
        return User::where('id', $id)->delete();
    }

    public function editItem($id, $arItem){
        return User::where('id', $id)->update($arItem);
    }

    public function countItemsByRoleId($id){
        return User::where('id_role', '=', $id)->count();
    }

    public function search($key, $search_by){
        if($search_by == 0) return DB::table('users as u')->join('role as r', 'u.id_role', '=', 'r.id')->select('u.*', 'r.id as id_role2', 'r.name as name2')->where('username', 'like', '%'.$key.'%')->orWhere('fullname', 'like', '%'.$key.'%')->orWhere('r.name', 'like', '%'.$key.'%')->orWhere('u.id', 'like', '%'.$key.'%')->paginate(getenv('ADMIN_ROW_COUNT'));
        else if($search_by == 1) return DB::table('users as u')->join('role as r', 'u.id_role', '=', 'r.id')->select('u.*', 'r.id as id_role2', 'r.name as name2')->where('username', 'like', '%'.$key.'%')->paginate(getenv('ADMIN_ROW_COUNT'));
        else if($search_by == 2) return DB::table('users as u')->join('role as r', 'u.id_role', '=', 'r.id')->select('u.*', 'r.id as id_role2', 'r.name as name2')->where('fullname', 'like', '%'.$key.'%')->paginate(getenv('ADMIN_ROW_COUNT'));
        else if($search_by == 3) return DB::table('users as u')->join('role as r', 'u.id_role', '=', 'r.id')->select('u.*', 'r.id as id_role2', 'r.name as name2')->where('r.name', 'like', '%'.$key.'%')->paginate(getenv('ADMIN_ROW_COUNT'));
        else return DB::table('users as u')->join('role as r', 'u.id_role', '=', 'r.id')->select('u.*', 'r.id as id_role2', 'r.name as name2')->where('u.id', 'like', '%'.$key.'%')->paginate(getenv('ADMIN_ROW_COUNT'));
    }

    public function countSearch($key, $search_by){
        if($search_by == 0) return DB::table('users as u')->join('role as r', 'u.id_role', '=', 'r.id')->select('u.*', 'r.id as id_role2', 'r.name as name2')->where('username', 'like', '%'.$key.'%')->orWhere('fullname', 'like', '%'.$key.'%')->orWhere('r.name', 'like', '%'.$key.'%')->orWhere('u.id', 'like', '%'.$key.'%')->count();
        else if($search_by == 1) return DB::table('users as u')->join('role as r', 'u.id_role', '=', 'r.id')->select('u.*', 'r.id as id_role2', 'r.name as name2')->where('username', 'like', '%'.$key.'%')->count();
        else if($search_by == 2) return DB::table('users as u')->join('role as r', 'u.id_role', '=', 'r.id')->select('u.*', 'r.id as id_role2', 'r.name as name2')->where('fullname', 'like', '%'.$key.'%')->count();
        else if($search_by == 3) return DB::table('users as u')->join('role as r', 'u.id_role', '=', 'r.id')->select('u.*', 'r.id as id_role2', 'r.name as name2')->where('r.name', 'like', '%'.$key.'%')->count();
        else return DB::table('users as u')->join('role as r', 'u.id_role', '=', 'r.id')->select('u.*', 'r.id as id_role2', 'r.name as name2')->where('u.id', 'like', '%'.$key.'%')->count();
    }

    public function getAllIds(){
        return User::select('id')->orderBy('id', 'asc')->get();
    }

    public function getItemByUsername($username){
        return User::where('username', '=', $username)->first();
    }
   
}
