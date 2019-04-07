<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (User::where('email', '=', 'admin@admin.com')->first() === null) {
              User::create([
                'name'     => 'Admin MG',
                'email'    => 'admin@admin.com',
                'password' => bcrypt('asdasdasd'),
            ]);
        }
    }
}
