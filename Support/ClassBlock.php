<?php 

namespace Pingu\Block\Support;

use Pingu\Block\Contracts\BlockProviderContract;

trait ClassBlock
{
    use Block;

    /**
     * @inheritDoc
     */
    public function render()
    {
        return view('blocks.'.$this::machineName())->with([
            'block' => $this
        ]);
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