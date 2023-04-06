<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // $array=[];
        // for($i=0;$i<2;$i++){
        //     array_push($array,[  
        //         "ten"=>"Nguyen Xuan Hau",
        //         "email"=>"nguyenxuanhau".($i+1)."@fpt.edu.vn",
        //         "password"=>Hash::make('12345678')
        //     ],
        //     );
        // }
        // DB::table("users")->insert(
        //     $array
        // );
        $array1=[];
        for($i=0;$i<11;$i++){
            array_push($array1,[
                "trang_thai" => 1,
                "tong_so_luong" => (20 + $i),
                "tong_tien" => 1000000,
                "user_id" => $i +1,
                "ho_ten" => "hau " . $i,
                "id_dia_chi" => 1,
                "xac_nhan" => 2,
                "so_dien_thoai" => "000001112"
            ]);
        }
        DB::table("don_hang")->insert(
                 $array1
        );
        // $array2 = [];
        // for ($i = 0; $i < 11; $i++) {
        //     array_push($array2, [
        //         'id_don_hang' => $i + 1,
        //         'id_san_pham' => $i + 1,
        //         'so_luong' => 100
        //     ]);
        // }
        // DB::table("san_pham_don_hang")->insert(
        //     $array2
        // );
        // $array3 = [];
        // for ($i = 0; $i < 11; $i++) {
        //         array_push($array3, [
        //             'id_sale_off' => $i + 1,
        //             'id_san_pham' => $i + 1,
        //             'gia_sale' => 100000,
        //             'so_luong' => 40,
        //         ]);
        //     }
        //     DB::table("san_pham_sale")->insert(
        //         $array3
        //     );
    }
}
