<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class RepositoryCommand extends Command
{
    protected $signature = 'make:repository {name}';

    protected $description = 'Command to make a repository';

    public function handle(): int
    {
        $name = str_replace('\\', '/', $this->argument('name'));

        $baseName = class_basename($name);

        if (! Str::endsWith($baseName, 'Repository')) {
            $className = $baseName . 'Repository';
        } else {
            $className = $baseName;
            $baseName = Str::beforeLast($baseName, 'Repository');
        }

        $directoryPath = Str::contains($name, '/')
            ? Str::beforeLast($name, '/')
            : '';

        $repositoryDirectory = app_path('Contracts/Repositories' . ($directoryPath ? '/' . $directoryPath : ''));
        $filePath = $repositoryDirectory . '/' . $className . '.php';

        if (File::exists($filePath)) {
            $this->error('Repository already exists!');
            return self::FAILURE;
        }

        File::ensureDirectoryExists($repositoryDirectory);

        $namespace = 'App\\Contracts\\Repositories' . ($directoryPath ? '\\' . str_replace('/', '\\', $directoryPath) : '');

        $interfaceNamespace = 'App\\Contracts\\Interfaces' . ($directoryPath ? '\\' . str_replace('/', '\\', $directoryPath) : '');
        $interfaceName = $baseName . 'Interface';

        $modelName = $baseName;
        $varName = Str::camel($modelName);

        $stub = <<<PHP
<?php

namespace {$namespace};

use {$interfaceNamespace}\\{$interfaceName};
use App\Models\\{$modelName};

class {$className} extends BaseRepository.php implements {$interfaceName}
{
    public function __construct({$modelName} \${$varName})
    {
        \$this->model = \${$varName};
    }

    public function get(): mixed
    {
        return \$this->model->query()->get();
    }

    public function store(array \$data): mixed
    {
        return \$this->model->query()->create(\$data);
    }

    public function show(mixed \$id): mixed
    {
        return \$this->model->query()->findOrFail(\$id);
    }

    public function update(mixed \$id, array \$data): mixed
    {
        \$model = \$this->show(\$id);

        \$model->update(\$data);

        return \$model;
    }

    public function delete(mixed \$id): mixed
    {
        return \$this->show(\$id)->delete();
    }
}

PHP;

        File::put($filePath, $stub);

        $this->info("Repository {$className} created successfully at {$filePath}");

        return self::SUCCESS;
    }
}
