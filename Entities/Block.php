<?php

namespace Pingu\Block\Entities;

use Pingu\Core\Entities\BaseModel;
use Pingu\Forms\Contracts\Models\FormableContract;
use Pingu\Forms\Traits\Models\Formable;
use Pingu\Page\Entities\Page;
use Pingu\Page\Entities\PageRegion;

class Block extends BaseModel implements FormableContract
{
    use Formable;

    protected $fillable = ['provider', 'data', 'system'];

    protected $with = ['provider'];

    protected $visible = ['id', 'system', 'provider'];

    protected $casts = [
        'data' => 'json'
    ];

    protected $attributes = [
        'system' => 0
    ];

    public function formAddFields()
    {
        return [];
    }

    public function formEditFields()
    {
        return [];
    }

    public function fieldDefinitions()
    {
        return [];
    }

    public function validationRules()
    {
        return [];
    }

    public function validationMessages()
    {
        return [];
    }

    public function instance()
    {
        return $this->provider->class::load($this);
    }

    public function regions()
    {
    	return $this->hasMany(PageRegion::class);
    }

    public function provider()
    {
    	return $this->belongsTo(BlockProvider::class);
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
