<?php 

namespace Pingu\Block\Contracts;

use Illuminate\Contracts\Support\Arrayable;
use Pingu\Block\Entities\Block;
use Pingu\Block\Support\BlockProvider;
use Pingu\Core\Contracts\RenderableContract;
use Pingu\Forms\Support\Form;

interface BlockContract extends Arrayable, RenderableContract
{
    /**
     * Get the form to create options
     * 
     * @return Form
     */
    public function createOptionsForm(): Form;

    /**
     * Get the form to edit options
     * 
     * @return Form
     */
    public function editOptionsForm(Block $block): Form;

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
     * Validation rules for the options
     * 
     * @return array
     */
    public function getOptionsValidationRules(): array;

    /**
     * Validation messages for the options
     * 
     * @return array
     */
    public function getOptionsValidationMessages(): array;

    /**
     * Data for the view
     * 
     * @return array
     */
    public function getViewData(): array;

    /**
     * Default data
     * 
     * @return array
     */
    public function getDefaultData(): array;
}