<?php 

namespace Pingu\Block\Renderers;

use Pingu\Block\Support\BlockRenderer;
use Pingu\Block\Support\SystemBlock;
use Pingu\Core\Support\Renderer;

class SystemBlockRenderer extends BlockRenderer
{
    public function __construct(SystemBlock $block)
    {
        parent::__construct($block);
    }

    /**
     * @inheritDoc
     */
    public function rendererType(): string
    {
        return 'system';
    }
}