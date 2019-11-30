<?php

namespace Pingu\Block\Exceptions;

class BlockProviderException extends \Exception
{
    public static function alreadyDefined(string $class)
    {
        $name = $class::machineName();
        return new static("Block Provider : '$name' is already registered");
    }
}