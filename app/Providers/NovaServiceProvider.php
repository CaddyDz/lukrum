<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\Facades\{Gate, Route};
use App\Http\Controllers\Nova\LoginController;
use Laravel\Nova\{Nova, NovaApplicationServiceProvider};

class NovaServiceProvider extends NovaApplicationServiceProvider
{
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot(): void
	{
		parent::boot();
		Nova::sortResourcesBy(fn ($resource) => $resource::$priority ?? 9999);
		Nova::serving(fn () => Nova::style('lukrum', resource_path('css/app.css')));
	}

	/**
	 * Register the Nova routes.
	 *
	 * @return void
	 */
	protected function routes(): void
	{
		$this->withAuthenticationRoutes();
		Nova::routes()
			->withPasswordResetRoutes()
			->register();
	}

	/**
	 * Register the Nova authentication routes.
	 *
	 * @param array $middleware
	 * @return $this
	 */
	public function withAuthenticationRoutes($middleware = ['web'])
	{
		Route::namespace('App\Http\Controllers')
			->domain(config('nova.domain', null))
			->middleware($middleware)
			->prefix(Nova::path())
			->group(function () {
				Route::get('/login', [LoginController::class, 'showLoginForm']);
				Route::post('/login', [LoginController::class, 'login'])->name('nova.login');
			});

		Route::namespace('Laravel\Nova\Http\Controllers')
			->domain(config('nova.domain', null))
			->middleware(config('nova.middleware', []))
			->prefix(Nova::path())
			->group(function () {
				Route::get('/logout', [LoginController::class, 'logout'])->name('nova.logout');
			});

		return $this;
	}

	/**
	 * Register the Nova gate.
	 *
	 * This gate determines who can access Nova in non-local environments.
	 *
	 * @return void
	 */
	protected function gate(): void
	{
		Gate::define('viewNova', fn (): bool => true);
	}

	/**
	 * Get the cards that should be displayed on the default Nova dashboard.
	 *
	 * @return array
	 */
	protected function cards(): array
	{
		return [];
	}

	/**
	 * Get the extra dashboards that should be displayed on the Nova dashboard.
	 *
	 * @return array
	 */
	protected function dashboards(): array
	{
		return [];
	}

	/**
	 * Get the tools that should be listed in the Nova sidebar.
	 *
	 * @return array
	 */
	public function tools(): array
	{
		return [];
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register(): void
	{
		//
	}
}
