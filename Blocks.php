<?php

namespace Pingu\Block;

use Illuminate\Foundation\Application;
use Illuminate\Support\Collection;
use Pingu\Block\Contracts\BlockContract;
use Pingu\Block\Entities\Block;
use Pingu\Block\Entities\BlockProvider;
use Pingu\Block\Exceptions\BlockException;
use Pingu\Block\Exceptions\BlockProviderException;

class Blocks
{
    protected $modelCacheKey = 'block.blocks.models';
    protected $registeredCacheKey = 'block.blocks.registered';
    protected $providers = [];

    public function registerProvider(string $class)
    {
        if (in_array($class::machineName(), $this->providers)) {
            throw BlockProviderException::alreadyRegistered($class);
        }
        $this->providers[] = $class::machineName();
        app()->singleton('block.providers.'.$class::machineName(), $class);
    }

    public function registeredProviders(): array
    {
        $out = [];
        foreach ($this->providers as $provider) {
            $out[] = $this->resolveProvider($provider);
        }
        return $out;
    }

    /**
     * Resolve a provider within the application container
     * 
     * @param  BlockProvider $provider
     * @return Pingu\Block\Support\BlockProvider
     */
    public function resolveProvider(string $suffix)
    {
        return app('block.providers.'.$suffix);
    }
    
    public function resolveBlock(string $name)
    {
        $block = $this->registeredBlocks()[$name] ?? null;
        if (is_null($block)) {
            throw BlockException::notRegistered($name);
        }
        return $block;
    }

    public function registeredBlocks(): array
    {
        if (!config('block.useCache')) {
            $this->forgetCache();
        }
        $_this = $this;
        return \ArrayCache::rememberForever($this->registeredCacheKey, function () use ($_this) {
            $out = [];
            foreach ($_this->registeredProviders() as $provider) {
                $out = array_merge($out, $provider->getRegisteredBlocks());
            }
            return $out;
        });
    }

    public function registeredBlocksBySection()
    {
        $blocks = $this->registeredBlocks();
        $out = [];
        foreach ($blocks as $block) {
            $out[$block->section()][] = $block;
        }
        return $out;
    }

    public function forgetCache()
    {
        \ArrayCache::forget('block.blocks');
    }

    /**
     * Loads and returns one block
     * 
     * @param  int|Block    $id
     * @return BlockContract
     */
    public function loadOne($block)
    {
        if (is_int($block)) {
            $block = Block::findOrFail($block);
        }
        return $this->resolveProvider($block->provider)->load($block);
    }

    /**
     * Loads and returns a collection of Blocks
     * 
     * @param  array  $ids
     * @return Collection
     */
    public function loadMany(array $ids)
    {
        return collect(array_map(function ($id) {
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
        if (is_array($ids)) {
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
        if (!config('block.useCache')) {
            $this->forgetCache();
        }
        return \ArrayCache::rememberForever($this->modelCacheKey, function () {
            return Block::get()->map(function ($block) {
                return $block->provider->load($block);
            });
        });
    }
}