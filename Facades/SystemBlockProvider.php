<?php
namespace Pingu\Block\Facades;

use Illuminate\Support\Facades\Facade;

class SystemBlockProvider extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'block.providers.system';
    }
}