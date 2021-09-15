<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Template;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class TemplateSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run(): void
	{
		$disk = Storage::disk('templates');
		$files = $disk->allFiles();
		foreach ($files as $file) {
			Template::factory()->create([
				'name' => str_replace('.html', '', $file),
				'content' => $disk->get($file),
			]);
		}
	}
}
