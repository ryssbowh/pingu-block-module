<?php

namespace Pingu\Block\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class MakeBlockCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:block';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a block class.';

    /**
     * Laravel filesystem
     * @var Filesystem
     */
    protected $files;

    protected $stub = __DIR__ . '/../stubs/block.stub'; 

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $directory = $this->getDirectory();
        $this->makeDirectory($directory);
        $namespace = $this->getNamespace();
        $path = $directory.'/'.$this->getFileName();
        $stub = $this->laravel['files']->get(realpath($this->stub));
        $stub = str_replace(
            ['$NAMESPACE$', '$CLASS$'],
            [$namespace, $this->getClassName()],
            $stub
        );
        $this->laravel['files']->put($path, $stub);
        $this->info('Block '.$path.' created !');
    }

    public function getNamespace()
    {
        return config('app.namespace').'\Blocks';
    }

    public function getFileName()
    {
        return $this->getClassName().'.php';
    }

    public function getClassName()
    {
        return Str::studly($this->argument('name'));
    }

    public function getDirectory()
    {
        return app_path('Blocks');
    }

    public function makeDirectory($directory)
    {
        if(!file_exists($directory)){
            $this->laravel['files']->makeDirectory($directory);
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'Block class name.'],
        ];
    }
}
