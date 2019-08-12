<?php

namespace Pingu\Block\BlockProviders;

use Pingu\Block\Contracts\BlockContract;
use Pingu\Block\Entities\Block;
use Pingu\Block\Support\BlockProvider;

class DbBlockProvider extends BlockProvider
{
	public function load(Block $block): BlockContract
	{
		$entity = $block->data['entity'];
		$id = $block->data['id'];
		$entity = $entity::findOrFail($id);
		$entity->setBlock($block);
		$entity->setProvider($this);
		return $entity;
	}

	public function getName()
	{
		return 'db';
	}
}