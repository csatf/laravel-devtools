<?php

declare(strict_types=1);

namespace Csatf\LaravelDevtools;

use Csatf\LaravelDevtools\Console\InstallCommand;
use Illuminate\Support\ServiceProvider;

class DevtoolsServiceProvider extends ServiceProvider
{
    /**
     * This provider only does anything under `composer install` with dev
     * dependencies, in a console context. It is never discovered in a
     * production build installed with `--no-dev`.
     */
    public function boot(): void
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->commands([
            InstallCommand::class,
        ]);

        $this->publishes([
            __DIR__.'/../pint.json' => base_path('pint.json'),
            __DIR__.'/../stubs/phpstan.neon.stub' => base_path('phpstan.neon'),
        ], 'csatf-devtools');
    }
}
