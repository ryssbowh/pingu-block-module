<?php
namespace Pingu\Block\Facades;

use Illuminate\Support\Facades\Facade;

class ClassBlockProvider extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'block.providers.class';
    }
}