<?php

namespace Pingu\Block\Exceptions;

use Pingu\Block\Contracts\BlockContract;

class BlockException extends \Exception
{
    public static function noOptions(BlockContract $block)
    {
        return new static("Block ".get_class($block)." doesn't define options");
    } 

    public static function notRegistered(string $block)
    {
        return new static("Block $block is not registered");
    }
}