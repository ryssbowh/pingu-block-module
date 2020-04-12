<?php 

namespace Pingu\Block\Support;

use Illuminate\Support\Collection;
use Pingu\Block\Contracts\BlockContract;
use Pingu\Core\Support\Renderers\ObjectRenderer;
use Pingu\Forms\Support\ClassBag;

abstract class BlockRenderer extends ObjectRenderer
{
    public function __construct(BlockContract $block)
    {
        parent::__construct($block);
    }

    /**
     * Type of block renderer
     * 
     * @return string
     */
    abstract public function rendererType(): string;

    /**
     * @inheritDoc
     */
    public function viewIdentifier(): string
    {
        return 'block-'.$this->rendererType();
    }

    /**
     * @inheritDoc
     */
    public function viewFolder(): string
    {
        return 'blocks';
    }

    /**
     * @inheritDoc
     */
    public function getHookName(): string
    {
        return 'block';
    }

    /**
     * Classes for the block
     * 
     * @return array
     */
    protected function getDefaultClasses(): array
    {
        return [
            'block',
            'block-'.$this->rendererType(),
            'block-'.$this->rendererType().'-'.$this->viewIdentifier()
        ];
    }

    /**
     * @inheritDoc
     */
    public function getDefaultData(): Collection
    {
        return collect(array_merge([
            'block' => $this->object,
            'classes' => new ClassBag($this->getDefaultClasses()),
        ], $this->object->getViewData()));
    }
}