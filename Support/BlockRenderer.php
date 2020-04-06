<?php 

namespace Pingu\Block\Support;

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
    public function getDefaultData(): array
    {
        return array_merge([
            'block' => $this->object,
            'classes' => new ClassBag($this->getDefaultClasses()),
        ], $this->object->getViewData());
    }
}