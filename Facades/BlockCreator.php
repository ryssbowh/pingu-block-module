<?php
namespace Pingu\Block\Facades;

use Illuminate\Support\Facades\Facade;

class BlockCreator extends Facade {

	protected static function getFacadeAccessor() {

		return 'block.creator';

	}

}