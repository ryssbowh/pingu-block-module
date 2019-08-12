<?php 

namespace Pingu\Block\Contracts;

interface BlockContract
{
	public function render();

	public static function getBlockSection();

	public function getBlockName();
	
	public function block();

	public function blockIsEditable();

}