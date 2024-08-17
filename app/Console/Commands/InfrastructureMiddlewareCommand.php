<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InfrastructureMiddlewareCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'infrastructure:middleware {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new middleware class in the Infrastructure layer';

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
        $middlewareName = $this->argument('name');
        $stubPath = resource_path('stubs/infrastructure/middleware.php.stub');
        $targetPath = app_path("Infrastructure/Middleware/{$middlewareName}.php");

        if (File::exists($targetPath)) {
            $this->error("Middleware {$middlewareName} already exists!");
            return 1;
        }

        $stubContent = File::get($stubPath);
        $middlewareContent = str_replace('{{ class }}', $middlewareName, $stubContent);
        File::ensureDirectoryExists(dirname($targetPath));
        File::put($targetPath, $middlewareContent);
        $this->info("Middleware {$middlewareName} created successfully.");

        return 0;
    }
}
