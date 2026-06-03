<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ServiceCommand extends Command
{
    protected $signature = 'make:service {name}';

    protected $description = 'Create a new service class';

    public function handle(): int
    {
        $name = str_replace('\\', '/', $this->argument('name'));

        $baseName = class_basename($name);

        if (! Str::endsWith($baseName, 'Service')) {
            $className = $baseName . 'Service';
        } else {
            $className = $baseName;
        }

        $directoryPath = Str::contains($name, '/')
            ? Str::beforeLast($name, '/')
            : '';

        $serviceDirectory = app_path('Services' . ($directoryPath ? '/' . $directoryPath : ''));

        $filePath = $serviceDirectory . '/' . $className . '.php';

        if (File::exists($filePath)) {
            $this->error('Service already exists!');
            return self::FAILURE;
        }

        File::ensureDirectoryExists($serviceDirectory);

        $namespace = 'App\\Services' . ($directoryPath ? '\\' . str_replace('/', '\\', $directoryPath) : '');

        $stub = <<<PHP
<?php

namespace {$namespace};

class {$className}
{
    public function handle(): mixed
    {
        //
    }
}

PHP;

        File::put($filePath, $stub);

        $this->info("Service {$className} created successfully at {$filePath}");

        return self::SUCCESS;
    }
}
