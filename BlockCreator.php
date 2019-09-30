<?php

namespace Pingu\Block;

use Pingu\Block\Contracts\CreatableBlockContract;
use Pingu\Block\Exceptions\BlockCreatorException;
use Pingu\Core\Traits\HasCrudUris;

class BlockCreator
{
    use HasCrudUris;

    protected $models = [];

    /**
     * Registers a model that can create a block
     * 
     * @param  string      $model
     * @param  string|null $name
     */
    public function registerModelSlug(string $model)
    {
        $reflection = new \ReflectionClass($model);
        if(!$reflection->implementsInterface(CreatableBlockContract::class)){
            throw ClassException::missingInterface($model, CreatableBlockContract::class);
        }
    	if($this->isSlugRegistered($model::blockSlug())){
    		throw BlockCreatorException::slugDefined($model::blockSlug());
    	}
    	$this->models[$model::blockSlug()] = $model;
    }

    /**
     * Check if a model is registered
     * 
     * @param  string  $model
     * @return boolean
     */
    public function isSlugRegistered(string $slug)
    {
    	return isset($this->models[$slug]);
    }

    /**
     * gets the model that defines a slug
     * 
     * @param  string $slug
     * @return string
     */
    public function getModel(string $slug)
    {
        if(!$this->isSlugRegistered($slug)){
            throw BlockCreatorException::slugUndefined($slug);
        }
        return $this->models[$slug];
    }

    /**
     * Gets all registered models
     * 
     * @return array
     */
    public function getModels()
    {
    	return $this->models;
    }

    /**
     * Create uri
     * 
     * @return string
     */
    public static function createUri()
    {
        return 'blocks/create/{blockSlug}';
    }

    /**
     * store uri
     * 
     * @return string
     */
    public static function storeUri()
    {
        return 'blocks/create/{blockSlug}';
    }
}
