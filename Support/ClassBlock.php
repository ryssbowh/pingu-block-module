<?php 

namespace Pingu\Block\Support;

use Pingu\Block\Entities\Block as BlockModel;

trait ClassBlock
{
	use Block;

	public function __construct(BlockModel $block, BlockProvider $provider)
	{
		$this->block = $block;
		$this->provider = $provider;
	}
}