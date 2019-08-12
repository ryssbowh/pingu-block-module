<?php

namespace Pingu\Block\Support;

use Illuminate\Support\Str;
use Pingu\Block\Entities\Block as BlockModel;

trait Block
{
    protected $block;

    protected $provider;

    /**
     * Sets the model block
     * 
     * @param BlockModel $block
     */
    public function setBlock(BlockModel $block)
    {
        $this->block = $block;
    }

    /**
     * Sets the provider
     * 
     * @param BlockProvider $provider
     */
    public function setProvider(BlockProvider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * get block
     * 
     * @return BlockModel
     */
    public function getBlock()
    {
        return $this->block;
    }

    /**
     * get provider
     * 
     * @return BlockProvider
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * Get the view name for this block
     * 
     * @return string
     */
    protected function getViewName()
    {
        return 'blocks.'.$this->getProvider()->getName().'.'.Str::kebab(class_basename($this));
    }

    /**
     * Define extra variables for the view here
     * 
     * @return array
     */
    protected function getViewVariables()
    {
        return [];
    }

    /**
     * Renders this block
     * 
     * @return view
     */
    public function render()
    {
        $with = array_merge($this->getViewVariables(), ['block' => $this]);
        return view($this->getViewName())->with($with);
    }

}
