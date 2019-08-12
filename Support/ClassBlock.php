<?php 

namespace Pingu\Block\Support;

use Pingu\Block\Entities\Block;

trait ClassBlock
{
	protected $block;

	public function __construct(Block $block)
	{
		$this->block = $block;
	}
	
	public static function load(Block $block)
	{
		return new static($block);
	}

	public function block()
    {
        return $this->block;
    }

    public function getProviderName()
	{
		return 'class';
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