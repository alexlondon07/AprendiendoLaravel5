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

		$faker = Faker\Factory::create();
        $count = 50;
        foreach (range(1, $count) as $index) {
		\DB::table('users')->insert(array (
			'profile' => 'usuario',
			'name' => $faker->lastName,
			'email' => $faker->email,
			'enable' => 'si',
			'password' => \Hash::make('12345')
			));
		}
	}
}