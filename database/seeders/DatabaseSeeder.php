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
			'nombre' => 'Admin Conciencia Astral',
			'email' => 'admin@concienciaastral.com.ar',
			'password' => bcrypt('password'),

			'remember_token' => Str::random(100),

			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
		]);
	}
}
