<?php 

namespace Pingu\Block\Support;

use Pingu\Block\Contracts\BlockContract;
use Pingu\Block\Contracts\BlockProviderContract;
use Pingu\Core\Traits\RendersWithSuggestions;

abstract class ClassBlock implements BlockContract
{
    use Block, RendersWithSuggestions;

    public function __construct()
    {
        $this->addViewSuggestions(
            [
            'blocks.'.$this->machineName(),
            'blocks.block',
            'block::block'
            ]
        );
    }

    protected function getViewData(): array
    {
        return [
            'block' => $this
        ];
    }

    /**
     * @inheritDoc
     */
    public function provider(): string
    {
        return 'class';
    }

    /**
     * @inheritDoc
     */
    public function getDefaultData(): array
    {
        return [
            'class' => get_class($this)
        ];
    }
}