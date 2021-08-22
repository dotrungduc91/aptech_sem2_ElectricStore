<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('roles')->insert([
				'name' => 'Admin',
				'created_at' => date('Y-m-d H:i:s')
			]);
		DB::table('roles')->insert([
				'name' => 'Mod',
				'created_at' => date('Y-m-d H:i:s')
			]);
		DB::table('roles')->insert([
				'name' => 'User',
				'created_at' => date('Y-m-d H:i:s')
			]);
    }
}
