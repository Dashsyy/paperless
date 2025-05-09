<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Symfony\Component\Process\Process;


class BuildDockerImage extends Command
{
    protected $signature = 'docker:build {--tag=laravel-app:latest}';

    protected $description = 'Build the Docker image for the Laravel app';
    public function handle()
    {
        $appName = env('APP_NAME', 'laravel-app');
        $appNameSlug = Str::slug($appName);

        $tagOption = $this->option('tag');

        if ($tagOption) {
            $fullTag = "$appNameSlug:$tagOption";
        } else {
            $version = $this->ask('Enter image version (e.g. 1.0.0 or latest)', 'latest');
            $fullTag = "$appNameSlug:$version";
        }

        $this->info("🚧 Building Docker image: $fullTag");

        $process = Process::fromShellCommandline("docker build -t $fullTag .");
        $process->setTimeout(null);

        $process->run(function ($type, $buffer) {
            echo $buffer;
        });

        if ($process->isSuccessful()) {
            $this->info("✅ Docker image built successfully: $fullTag");
            return 0;
        }

        $this->error('❌ Docker build failed.');
        return 1;
    }
}
