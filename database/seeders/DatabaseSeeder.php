<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('administradores')->insert([
			'nombre' => 'Gaby',
			'email' => 'gaby86@gmail.com',
			'password' => bcrypt('mandi0ca'),

			'remember_token' => Str::random(100),

			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
		]);

		DB::table('administradores')->insert([
			'nombre' => 'Gastón',
			'email' => 'gastonsiseles@gmail.com',
			'password' => bcrypt('mandioca'),

			'remember_token' => Str::random(100),

			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
		]);
	}
}
