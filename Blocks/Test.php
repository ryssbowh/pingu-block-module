<?php 

namespace Pingu\Block\Blocks;

use Pingu\Block\Contracts\BlockContract;
use Pingu\Block\Support\ClassBlock;
use Pingu\Forms\Support\Form;

class Test extends ClassBlock
{
    public function section(): string
    {
        return 'Test';
    }

    public function name(): string
    {
        return 'Test';
    }

    public function title(): string
    {
        return 'Test';
    }

    public function hasOptions(): bool
    {
        return false;
    }
}