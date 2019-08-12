<?php

namespace Pingu\Block\Providers;

use Illuminate\Support\ServiceProvider;
use Pingu\Block\Console\MakeBlockCommand;
use Pingu\Block\Console\ModuleMakeBlockCommand;

class ConsoleServiceProvider extends ServiceProvider
{
    protected $defer = true;

    protected $commands = [
        MakeBlockCommand::class,
        ModuleMakeBlockCommand::class
    ];

    /**
     * Register the commands.
     */
    public function register()
    {
        $this->commands($this->commands);
    }

    /**
     * @return array
     */
    public function provides()
    {
        return $this->commands;
    }
}
