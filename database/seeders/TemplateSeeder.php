<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Template;
use Illuminate\Database\Seeder;

class TemplateSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run(): void
	{
		for ($i=1; $i < 5; $i++) {
			Template::factory()->create([
				'name' => 'Template ' . (string) $i,
			]);
		}
	}
}
