<?php 

namespace Pingu\Block\Contracts;

use Pingu\Block\Entities\Block;
use Pingu\Block\Support\BlockProvider;

interface BlockContract
{
	/**
	 * Renders this block
	 * 
	 * @return view
	 */
	public function render();

	/**
	 * Get this block section
	 * 
	 * @return string
	 */
	public static function getBlockSection();

	/**
	 * get this block name
	 * 
	 * @return string
	 */
	public function getBlockName();
		
	/**
	 * Get this block model
	 * 
	 * @return Block
	 */
	public function getBlock();

	/**
	 * is this block editable
	 * 
	 * @return bool
	 */
	public function blockIsEditable();

	/**
	 * Get this block's provider
	 * @return BlockProvider
	 */
	public function getProvider();

}