<?php

namespace Sayakb\Captcha;

use Illuminate\Support\ServiceProvider;

class CaptchaServiceProvider extends ServiceProvider
{

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		// ✅ Replace old package() method with loadRoutesFrom
		if (file_exists(__DIR__ . '/../../routes.php')) {
			$this->loadRoutesFrom(__DIR__ . '/../../routes.php');
		}

		// ✅ Laravel 5.4+ method to load views (if package has views)
		if (is_dir(__DIR__ . '/../../views')) {
			$this->loadViewsFrom(__DIR__ . '/../../views', 'captcha');
		}

		// ✅ Laravel 5.4+ method to load translations (if package has translations)
		if (is_dir(__DIR__ . '/../../lang')) {
			$this->loadTranslationsFrom(__DIR__ . '/../../lang', 'captcha');
		}
	}


	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->singleton('captcha', function ($app) {

			return Captcha::instance();
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('captcha');
	}
}
