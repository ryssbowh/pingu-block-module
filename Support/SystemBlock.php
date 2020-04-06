<?php 

namespace Pingu\Block\Support;

use Pingu\Block\Contracts\BlockContract;
use Pingu\Block\Contracts\BlockProviderContract;

abstract class SystemBlock implements BlockContract
{
    use Block;

    abstract public function systemView(): string;

    /**
     * @inheritDoc
     */
    public function getViewData(): array
    {
        return [];
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

    /**
     * @inheritDoc
     */
    public function provider(): string
    {
        return 'system';
    }

}