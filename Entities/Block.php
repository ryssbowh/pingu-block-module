<?php

namespace Pingu\Block\Entities;

use Pingu\Block\Entities\BlockProvider;
use Pingu\Block\Entities\Policies\BlockPolicy;
use Pingu\Block\Events\BlockCacheChanged;
use Pingu\Core\Entities\BaseModel;
use Pingu\Entity\Entities\Entity;
use Pingu\Page\Entities\Page;
use Pingu\Page\Entities\PageRegion;

class Block extends Entity
{
    protected $fillable = ['provider', 'data', 'active'];

    protected $visible = ['id', 'provider', 'active'];

    protected $casts = [
        'data' => 'json',
        'active' => 'bool'
    ];

    /**
     * @var BlockContract
     */
    protected $instance;

    /**
     * @inheritDoc
     */
    public static function boot()
    {
        parent::boot();

        static::saved(function () {
            event(new BlockCacheChanged());
        });
    }

    /**
     * @inheritDoc
     */
    public function getPolicy(): string
    {
        return BlockPolicy::class;
    }

    /**
     * Resolve the provider of this block
     * 
     * @return BlockProvider
     */
    public function resolveProvider(): BlockProvider
    {
        return \Blocks::resolveProvider($this->provider);
    }

    /**
     * @inheritDoc
     */
    public function refresh()
    {
        parent::refresh();
        $this->instance = null;
    }

    /**
     * Get the BlockContract instance for this block
     * 
     * @return BlockContract
     */
    public function instance(): BlockContract
    {
        if (is_null($this->instance)) {
            $this->instance = $this->resolveProvider()->load($this);
        }
        return $this->instance;
    }

    /**
     * Data getter
     * 
     * @param string  $name
     * 
     * @return mixed
     */
    public function getData(string $name)
    {
        return $this->data[$name] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        $array = parent::toArray();
        if ($this->provider) {
            $array['provider'] = $this->provider;
            $array['instance'] = $this->instance()->toArray();
        }
        return $array;
    }
}
