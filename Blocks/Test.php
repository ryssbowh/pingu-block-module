<?php 

namespace Pingu\Block\Blocks;

use Pingu\Block\Support\SystemBlock;
use Pingu\User\Entities\User;

class Test extends SystemBlock
{
    public function systemView(): string
    {
        return 'block@test';
    }

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

    public function getViewData(): array
    {
        return [
            'users' => User::count()
        ];
    }
}