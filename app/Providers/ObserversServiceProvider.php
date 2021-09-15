<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\{Email, Template};
use Illuminate\Support\ServiceProvider;
use App\Observers\{EmailObserver, TemplateObserver};

class ObserversServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap services.
	 *
	 * @return void
	 */
	public function boot(): void
	{
		Template::observe(TemplateObserver::class);
		Email::observe(EmailObserver::class);
	}
}
