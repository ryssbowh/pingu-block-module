<?php

namespace Pingu\Block\Entities;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Pingu\Block\Contracts\BlockContract;
use Pingu\Block\Contracts\BlockProviderContract;
use Pingu\Block\Entities\Policies\BlockPolicy;
use Pingu\Block\Events\BlockCacheChanged;
use Pingu\Core\Contracts\RenderableContract;
use Pingu\Core\Contracts\RendererContract;
use Pingu\Core\Entities\BaseModel;
use Pingu\Entity\Support\Entity;
use Pingu\Page\Entities\Page;
use Pingu\Page\Entities\PageRegion;
use Pingu\Permissions\Entities\Permission;

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

        static::saved(
            function ($block) {
                event(new BlockCacheChanged($block));
            }
        );
    }

    public function getPermissionAttribute()
    {
        $set = isset($this->attributes['permission_id']) and $this->attributes['permission_id'];
        return $set ? \Permissions::getById($this->attributes['permission_id']) : null;
    }

    /**
     * Permission relationship
     * 
     * @return BelongsTo
     */
    public function permission()
    {
        return $this->belongsTo(Permission::class);
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
    public function getProviderAttribute($provider): BlockProviderContract
    {
        return \Blocks::resolveProvider($provider);
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
            $this->instance = $this->provider->load($this);
        }
        return $this->instance;
    }

    /**
     * Data getter
     * 
     * @param ?string $name
     * 
     * @return mixed
     */
    public function getData(?string $name = null)
    {
        if (is_null($name)) {
            return $this->data;
        }
        return $this->data[$name] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        $array = parent::toArray();
        $array['provider'] = $this->attributes['provider'];
        $array['instance'] = $this->instance()->toArray();
        return $array;
    }

    /**
     * Renders this block
     * 
     * @return string
     */
    public function render($viewMode = null): string
    {
        return $this->provider->render($this);
    }
}
