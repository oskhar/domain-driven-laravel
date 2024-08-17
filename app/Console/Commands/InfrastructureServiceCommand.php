<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InfrastructureServiceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'infrastructure:service {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new service class in the Infrastructure layer';

    /**
     * The console command visibility.
     *
     * @var boolean
     */
    protected $hidden = false;

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $serviceName = $this->argument('name');
        $stubPath = resource_path('stubs/infrastructure/service.php.stub');
        $targetPath = app_path("Infrastructure/Services/{$serviceName}.php");

        if (File::exists($targetPath)) {
            $this->error("Service {$serviceName} already exists!");
            return 1;
        }

        $stubContent = File::get($stubPath);
        $serviceContent = str_replace('{{ class }}', $serviceName, $stubContent);
        File::ensureDirectoryExists(dirname($targetPath));
        File::put($targetPath, $serviceContent);
        $this->info("Service {$serviceName} created successfully.");

        return 0;
    }
}
