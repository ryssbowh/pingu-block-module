<?php

namespace Pingu\Block\Console;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Nwidart\Modules\Traits\ModuleCommandTrait;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class ModuleMakeBlockCommand extends MakeBlockCommand
{
    use ModuleCommandTrait;
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:make-block';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a block class for a module.';

    protected $module;

    public function handle()
    {
        $this->module = $this->laravel['modules']->findOrFail($this->getModuleName());
        parent::handle();
    }

    public function getNamespace()
    {

        $namespace = $this->laravel['modules']->config('namespace');

        $namespace .= '\\' . $this->module->getStudlyName();

        $namespace .= '\\Blocks';

        $namespace = str_replace('/', '\\', $namespace);

        return trim($namespace, '\\');
    }

    public function getDirectory()
    {
        return $this->module->getPath().'/Blocks';
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
            ['module', InputArgument::REQUIRED, 'Module name.'],
        ];
    }
}
