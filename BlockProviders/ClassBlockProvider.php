<?php

namespace Pingu\Block\BlockProviders;

use Pingu\Block\Contracts\BlockContract;
use Pingu\Block\Entities\Block;
use Pingu\Block\Support\BlockProvider;

class ClassBlockProvider extends BlockProvider
{
	public function load(Block $block): BlockContract
	{
		return new $block->data['class']($block, $this);
	}

	public function getName()
	{
		return 'class';
	}
}