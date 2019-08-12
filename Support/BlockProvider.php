<?php

namespace Pingu\Block\Support;

use Pingu\Block\Contracts\BlockContract;
use Pingu\Block\Entities\Block;
use Pingu\Block\Entities\BlockProvider as BlockProviderModel;

abstract class BlockProvider
{
	/**
	 * Loads a model block
	 * 
	 * @param  Block  $block
	 * @return BlockContract
	 */
    public abstract function load(Block $block): BlockContract;

    /**
     * Get this provider name
     * 
     * @return string
     */
	public abstract function getName();

	/**
	 * Gets the mode lassociated with that provider
	 * 
	 * @return BlockProviderModel
	 */
	public function getModel()
	{
		return BlockProviderModel::findByClass(get_class($this));
	}

}
