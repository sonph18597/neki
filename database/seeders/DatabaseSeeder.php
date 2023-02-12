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
        $dataShoes = [
            [
                "id"=>1,
                "id_prod_sale"=>1,
                "name"=>"nike",
                "list_img"=>"q",
                "id_type"=>1,
                "description"=>"abc",
                "list_variant"=>"1",
                "min_price"=>200000,
                "max_price"=>400000
            ],
            [
                "id"=>2,
                "id_prod_sale"=>1,
                "name"=>"nike",
                "list_img"=>"q",
                "id_type"=>1,
                "description"=>"abc",
                "list_variant"=>"1",
                "min_price"=>200000,
                "max_price"=>400000
            ],
        ];
        $dataDiscountCode = [
            [
                "id"=>1,
                "discount_code"=>"free123",
                "exclude_prod"=>"1",
                "include_prod"=>"1",
                "condition_type"=>"1",
"type_discount"=>"1",
"discount_number"=>1,
"limits"=>10,
"time_start"=>27/1/2023,
"time_end"=>27/10/2023,
            ], [
                "id"=>1,
                "discount_code"=>"free123",
                "exclude_prod"=>"1",
                "include_prod"=>"1",
                "condition_type"=>"1",
"type_discount"=>"1",
"discount_number"=>1,
"limits"=>10,
"time_start"=>27/1/2023,
"time_end"=>27/10/2023,
            ]
        ];

        DB::table('shoes')->insert($dataShoes);
        DB::table('discount_code')->insert($dataDiscountCode);
    }
}
