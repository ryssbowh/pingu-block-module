<?php

namespace Pingu\Block\BlockProviders;

use Pingu\Block\Contracts\BlockContract;
use Pingu\Block\Contracts\BlockProviderContract;
use Pingu\Block\Entities\Block;
use Pingu\Block\Exceptions\ClassBlockProviderException;
use Pingu\Forms\Support\Form;

class ClassBlockProvider implements BlockProviderContract
{
    /**
     * Blocks registered in this provider
     * @var array
     */
    protected $blocks = [];

    /**
     * @inheritDoc
     */
    public static function machineName(): string
    {
        return 'class';
    }

    /**
     * @inheritDoc
     */
    public function load(Block $block): BlockContract
    {
        return new $block->data['class']($block);
    }

    /**
     * Register a new block class
     * 
     * @param  string|object $class
     */
    public function registerBlock($class)
    {   
        $class = class_to_object($class);
        if ($this->isRegistered('class.'.$class->machineName())) {
            throw ClassBlockProviderException::registered($class);
        }
        $this->blocks['class.'.$class->machineName()] = $class;
        \Blocks::forgetCache();
    }

    /**
     * Check if a block name is registered
     * 
     * @param  string  $machineName
     * @return boolean
     */
    public function isRegistered(string $machineName)
    {
        return isset($this->blocks[$machineName]);
    }

    /**
     * @inheritDoc
     */
    public function getRegisteredBlocks(): array
    {
        return $this->blocks;
    }
}