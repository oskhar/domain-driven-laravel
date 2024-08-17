<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class DDDServiceCommand extends Command
{
    /**
     * How to use
     * @var string
     */
    protected $signature = 'ddd:service {name} {--domain=}';

    /**
     * Define your command description
     * @var string
     */
    protected $description = 'Create a new service class within a domain';

    /**
     * Initialization attribute
     * @var Filesystem
     */
    protected $files;

    /**
     * The console command visibility.
     *
     * @var boolean
     */
    protected $hidden = false;

    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

    public function handle()
    {
        if (!$this->option('domain')) {
            $this->error("The --domain= option is required.\n\nEx: php artisan ddd:service {serviceName} --domain={domainName}");
            return 1;
        }

        $name = $this->argument('name');
        $domain = $this->option('domain');
        $domain_namespace = config('ddd.domain_namespace');

        $stub = $this->files->get(resource_path('stubs/ddd/service.php.stub'));

        $stub = str_replace(
            ['{{ namespace }}', '{{ class }}'],
            ["{$domain_namespace}\\{$domain}\\Services", $name],
            $stub
        );

        $directory = app_path("Domain/{$domain}/Services");

        if (!$this->files->isDirectory($directory)) {
            $this->files->makeDirectory($directory, 0755, true);
        }

        $file = "{$directory}/{$name}.php";

        if ($this->files->exists($file)) {
            $this->error("File {$file} already exists!");
            return 1;
        }

        $this->files->put($file, $stub);

        $this->info("Service class created successfully at {$file}");
        return 0;
    }
}
