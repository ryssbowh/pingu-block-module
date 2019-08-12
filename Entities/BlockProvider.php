<?php

namespace Pingu\Block\Entities;

use Pingu\Core\Contracts\Models\HasRouteSlugContract;
use Pingu\Core\Entities\BaseModel;

class BlockProvider extends BaseModel implements HasRouteSlugContract
{
    protected $fillable = ['name', 'class'];
    
    protected $visible = ['id', 'name', 'class'];

    public static function routeSlug()
    {
    	return 'provider';
    }

    public static function routeSlugs()
    {
    	return 'provider';
    }

    public static function findByClass(string $class)
    {
        return static::where(['class' => $class])->first();
    }

    public function blocks()
    {
    	return $this->hasMany(Block::class, 'provider_id');
    }
}
