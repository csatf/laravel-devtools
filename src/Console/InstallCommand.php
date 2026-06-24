<?php

declare(strict_types=1);

namespace Csatf\LaravelDevtools\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class InstallCommand extends Command
{
    protected $signature = 'csatf:devtools:install {--force : Overwrite existing config files}';

    protected $description = 'Install the shared CSATF Pint and PHPStan configuration into this application.';

    public function handle(Filesystem $files): int
    {
        $targets = [
            __DIR__.'/../../pint.json' => base_path('pint.json'),
            __DIR__.'/../../stubs/phpstan.neon.stub' => base_path('phpstan.neon'),
        ];

        foreach ($targets as $source => $destination) {
            $name = basename($destination);

            if ($files->exists($destination) && ! $this->option('force')) {
                $this->components->warn("{$name} already exists — skipping (use --force to overwrite).");

                continue;
            }

            $files->copy($source, $destination);
            $this->components->info("Wrote {$name}.");
        }

        $this->newLine();
        $this->components->info('CSATF devtools installed. You can now remove the individual tool entries (pint, pest, larastan, pail, collision, mockery, faker) from your composer.json "require-dev".');

        return self::SUCCESS;
    }
}
