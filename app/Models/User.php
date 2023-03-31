<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Laravel\Passport\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table="users";
    protected $fillable = [
        'id',
        'ten',
        'so_dien_thoai',
        'email',
        'id_dia_chi',
        'role_id',
        'gioi_tinh',
        'anh',
        'ngay_sinh',
        'trang_thai',
    ];
    public function loadListWithPager($param = []) {
        $query = DB::table($this->table)
            ->select($this->fillable)
            ->where('delete_at', '!=', null);

        if(isset($param['so_dien_thoai']) ) {
            $query->where("so_dien_thoai" , "LIKE" , "%".$param['so_dien_thoai']."%" );
        }
        if(isset($param['ten'])) {
            $query->where('ten',"=", $param['ten'] );
        }
        if(isset($param['email'])) {
            $query->where('email',"=",$param['email'] );
        }
        $lists = $query->paginate(10);
        return $lists;
    }
    public function saveNew($params){
        $data = array_merge($params['cols'], [
                'password'=>Hash::make($params['cols']['password']),
            ]
        );
        $res = DB::table($this->table)->insertGetId($data);
        return $res;
    }

    public function loadOne($id,$params = []) {
        $query = DB::table($this->table)
            ->where('id','=',$id)
            ->where('delete_at', '!=', null);
        $obj = $query->first();
        return $obj;
    }


    public function saveUpdate($params) {
        if (empty($params['cols']['id'])) {
            Session::push('errors','không xác định bản ghi cập nhập');
        }
        $dataUpdate = [];
        foreach ($params['cols'] as $colName =>$val) {
            if ($colName == 'id') continue;
            $dataUpdate[$colName] = (strlen($val) == 0) ? null:$val;
        }
        $res = DB::table($this->table)
            ->where('id',$params['cols']['id'])
            ->update($dataUpdate);
        return $res;
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
