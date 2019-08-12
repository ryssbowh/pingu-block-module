<?php

namespace Pingu\Block\BlockProviders;

use Pingu\Block\Contracts\BlockProviderContract;
use Pingu\Block\Entities\Block;
use Pingu\Block\Entities\BlockProvider;

class DbBlockProvider implements BlockProviderContract
{
	public static function load(Block $block)
	{
		$entity = $block->data['entity'];
		$id = $block->data['id'];
		$entity = $entity::findOrFail($id);
		$entity->setBlock($block);
		return $entity;
	}

	public function getProviderName()
	{
		return 'db';
	}

	/**
	 * Returns the db provider model instance
	 * 
	 * @return BlockProvider
	 */
	public static function getModel()
	{
		return BlockProvider::where(['class' => get_called_class()])->first();
	}
}