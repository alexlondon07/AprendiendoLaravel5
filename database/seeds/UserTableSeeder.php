<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder {

	public function run() {
		DB::table('users')->delete();
		
		\DB::table('users')->insert(array (
			'profile' => 'sp_admin',
			'name' => 'Alexander Londono',
			'email' => 'admin@admin.com',
			'enable' => 'si',
			'password' => \Hash::make('admin')
			));
	}
}