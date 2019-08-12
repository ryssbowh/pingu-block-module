<?php

namespace Pingu\Block;

use Pingu\Block\Contracts\BlockContract;
use Pingu\Block\Contracts\BlockProviderContract;
use Pingu\Block\Support\ClassBlock;

class TestBlock implements BlockContract, BlockProviderContract
{
	use ClassBlock;

	public static function getBlockSection()
	{
		return 'Test';
	}

	public function getBlockName()
	{
		return 'Test';
	}

	public function blockIsEditable()
	{
		return false;
	}
}