<?php 

namespace Pingu\Block\Contracts;

use Pingu\Block\Entities\Block;

interface BlockProviderContract
{
	public static function load(Block $block);

	public function getProviderName();
}