<?php

namespace Pingu\Block\BlockProviders;

use Pingu\Block\Contracts\BlockContract;
use Pingu\Block\Contracts\BlockProviderContract;
use Pingu\Block\Entities\Block;
use Pingu\Block\Exceptions\SystemBlockProviderException;
use Pingu\Block\Renderers\SystemBlockRenderer;
use Pingu\Block\Support\SystemBlock;
use Pingu\Forms\Support\Form;

class SystemBlockProvider implements BlockProviderContract
{
    /**
     * Blocks registered in this provider
     *
     * @var array
     */
    protected $blocks = [];

    /**
     * @inheritDoc
     */
    public static function machineName(): string
    {
        return 'system';
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
     * @param string|object $class
     */
    public function register($class)
    {   
        $class = class_to_object($class);
        if ($this->isRegistered('system.'.$class->machineName())) {
            throw SystemBlockProviderException::registered($class);
        }
        $this->blocks['system.'.$class->machineName()] = $class;
        \Blocks::forgetCache();
    }

    /**
     * Check if a block name is registered
     * 
     * @param  string $machineName
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

    /**
     * @inheritDoc
     */
    public function render(Block $block): string
    {
        return (new SystemBlockRenderer($block->instance()))->render();
    }
}