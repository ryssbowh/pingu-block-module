<?php

namespace Pingu\Block\Entities;

use Pingu\Core\Entities\BaseModel;
use Pingu\Core\Traits\Models\HasBasicCrudUris;
use Pingu\Forms\Contracts\Models\FormableContract;
use Pingu\Forms\Traits\Models\Formable;
use Pingu\Page\Entities\Page;
use Pingu\Page\Entities\PageRegion;

class Block extends BaseModel
{
    use HasBasicCrudUris;

    protected $fillable = ['provider', 'data'];

    protected $with = ['provider'];

    protected $visible = ['id', 'provider'];

    protected $casts = [
        'data' => 'json'
    ];

    public function instance()
    {
        return \Blocks::load($this);
    }

    public function regions()
    {
    	return $this->hasMany(PageRegion::class);
    }

    public function provider()
    {
    	return $this->belongsTo(BlockProvider::class);
    }

    public static function createUri()
    {
        return static::routeSlugs().'/create/{slug}';
    }

    public function toArray()
    {
        $array = parent::toArray();
        $instance = $this->instance();
        $array['name'] = $instance->getBlockName();
        $array['section'] = $instance->getBlockSection();
        return $array;
    }
}
