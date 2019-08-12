<?php

namespace Pingu\Block\Exceptions;

class BlockCreatorException extends \Exception{

	public static function slugDefined(string $slug)
	{
		return new static("Block Creator : slug $slug is already registered");
	}

	public static function slugUndefined(string $slug)
	{
		return new static("Block Creator : slug $slug is not defined");
	}

}