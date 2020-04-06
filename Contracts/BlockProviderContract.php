<?php 

namespace Pingu\Block\Contracts;

use Pingu\Block\Contracts\BlockContract;
use Pingu\Block\Entities\Block;
use Pingu\Block\Support\BlockProvider;
use Pingu\Forms\Support\Form;

interface BlockProviderContract
{
    /**
     * Machine name for this provider
     * 
     * @return string
     */
    public static function machineName(): string;

    /**
     * Get all the blocks registered by this provider
     * 
     * @return array
     */
    public function getRegisteredBlocks(): array;

    /**
     * Load a block model into a BlockContract instance
     * 
     * @param Block $block
     * 
     * @return BlockContract
     */
    public function load(Block $block): BlockContract;

    public function getRenderer(): string;
}