<?php

namespace Pingu\Block\Support;

use Pingu\Block\Entities\Block;

trait ModelBlock
{
    protected $block;

    public function setBlock(Block $block)
    {
        $this->block = $block;
    }

    public function block()
    {
        return $this->block;
    }

    protected function getViewName()
	{
		return 'blocks.'.$this->getProviderName().'.'.Str::studly(class_basename($this));
	}

    protected function getViewVariables()
	{
		return [];
	}

	public function render()
	{
		$with = array_merge($this->getViewVariables(), ['block' => $this]);
		return view($this->getViewName())->with($with);
	}

}
