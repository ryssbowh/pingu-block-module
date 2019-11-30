<?php 

namespace Pingu\Block\Contracts;

use Illuminate\Contracts\Support\Arrayable;
use Pingu\Block\Entities\Block;
use Pingu\Block\Support\BlockProvider;
use Pingu\Forms\Support\Form;

interface BlockContract extends Arrayable
{
    /**
     * Renders this block
     * 
     * @return view
     */
    public function render();

    /**
     * Does this block define options
     * 
     * @return boolean
     */
    public function hasOptions(): bool;

    /**
     * Full machine name, eg {providerName}.{blockName}
     * 
     * @return string
     */
    public function fullMachineName(): string;

    /**
     * Machine name for this block
     * 
     * @return string
     */
    public function machineName(): string;

    /**
     * Title describing this block
     * 
     * @return string
     */
    public function title(): string;

    /**
     * Simple name for this block
     * 
     * @return string
     */
    public function name(): string;

    /**
     * Get this block section
     * 
     * @return string
     */
    public function section(): string;
        
    /**
     * Get this block model
     * 
     * @return Block
     */
    public function blockModel(): Block;

    /**
     * Get this block's provider
     * 
     * @return BlockProviderContract
     */
    public function resolveProvider(): BlockProviderContract;

    /**
     * Get this block provider name
     * 
     * @return string
     */
    public function provider(): string;

    /**
     * Default data to be saved for this model
     * 
     * @return array
     */
    public function getDefaultData(): array;

}