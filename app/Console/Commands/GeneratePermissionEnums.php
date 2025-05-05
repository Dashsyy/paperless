<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class GeneratePermissionEnums extends Command
{
    protected $signature   = 'generate:crud-permissions {name}';
    protected $description = 'Generate permission enums grouped by module';

    public function handle()
    {
        $name   = $this->argument('name');
        $module = Str::studly($name);
        $key    = Str::kebab($name);

        $enumClass = "{$module}Permission";
        $filename  = app_path("Enums/Permissions/{$enumClass}.php");

        $actions = ['view', 'create', 'update', 'delete'];

        $cases = collect($actions)->map(function ($action) use ($module, $key) {
            $caseName  = $action . $module;  // e.g., 'viewUser'
            $caseValue = "{$key}.{$action}"; // e.g., 'user.view'
            return "    case {$caseName} = '{$caseValue}';";
        })->implode("\n");
        $stub = <<<PHP
<?php

namespace App\Enums\Permissions;

enum {$enumClass}: string
{
{$cases}
}
PHP;

        if (! is_dir(dirname($filename))) {
            mkdir(dirname($filename), 0755, true);
        }

        file_put_contents($filename, $stub);
        $this->info("Enum generated: App\\Enums\\Permissions\\{$enumClass}");
    }
}
