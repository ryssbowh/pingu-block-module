<?php

namespace Pingu\Block\Exceptions;

class ClassBlockProviderException extends \Exception
{
    public static function registered(string $class)
    {
        return new static("Can't register block $class : machine name {$class::machineName()} is already registered");
    }

    public static function notRegistered(string $name)
    {
        return new static("Machine name $name is not a registered class block");
    }
}