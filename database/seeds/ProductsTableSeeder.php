<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'First Product',
                'description' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>',
                'price' => 15.50,
                'tax' => 2.00,
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Second Product',
                'description' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>',
                'price' => 20.50,
                'tax' => 4.00,
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Third Product',
                'description' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>',
                'price' => 30.00,
                'tax' => 0.00,
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
