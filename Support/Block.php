<?php 

namespace Pingu\Block\Support;

use Illuminate\Support\Str;
use Pingu\Block\Contracts\BlockProviderContract;
use Pingu\Block\Entities\Block as BlockModel;

trait Block
{
    protected $model;

    /**
     * Constructor
     * 
     * @param BlockModel|null $block
     */
    public function __construct(?BlockModel $block = null)
    {
        $this->model = $block;
    }

    /**
     * @inheritDoc
     */
    public function blockModel(): BlockModel
    {
        return $this->block;
    }

    /**
     * @inheritDoc
     */
    public function machineName(): string
    {
        return class_machine_name($this);
    }

    /**
     * @inheritDoc
     */
    public function fullMachineName(): string
    {
        return $this->provider().'.'.$this->machineName();
    }

    /**
     * @inheritDoc
     */
    public function resolveProvider(): BlockProviderContract
    {
        return  \Blocks::resolveProvider($this->provider());
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return [
            'title' => $this->title(),
            'hasOptions' => $this->hasOptions()
        ];
    }
}