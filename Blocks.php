<?php

namespace Pingu\Block;

use Illuminate\Support\Collection;
use Pingu\Block\Contracts\BlockContract;
use Pingu\Block\Entities\Block;

class Blocks{

	/**
	 * Loads and returns one block by its id
	 * 
	 * @param  int    $id
	 * @return BlockContract
	 */
	public function loadOne(int $id)
	{
		$block = Block::findOrFail($id);
		return $block->provider->class::load($block);
	}

	/**
	 * Loads and returns a collection of Blocks
	 * 
	 * @param  array  $ids
	 * @return Collection
	 */
	public function loadMany(array $ids)
	{
		return collect(array_map(function($id){
			return $this->loadOne($id);
		}, $ids));
	}

	/**
	 * Loads one or several blocks
	 * 
	 * @param  array|int $ids
	 * @return mixed
	 */
	public function load($ids)
	{
		if(is_array($ids)){
			return $this->loadMany($ids);
		}
		return $this->loadOne($ids);
	}

	/**
	 * Loads all blocks
	 * 
	 * @return Illuminate\Database\Eloquent\Collection
	 */
	public function all()
	{
		return Block::all()->map(function($block){
			return $block->provider->class::load($block);
		});
	}

	/**
	 * Loads all blocks and organise them by section
	 * 
	 * @return array
	 */
	public function bySection()
	{
		$out = [];
		foreach(Block::all() as $block){
			$instance = $block->provider->class::load($block);
			$out[$instance::getBlockSection()][] = $instance;
		}
		return $out;
	}

}