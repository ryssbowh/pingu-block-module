<?php

namespace Pingu\Block\Entities\Fields;

use Pingu\Field\BaseFields\Boolean;
use Pingu\Field\Support\FieldRepository\BaseFieldRepository;

class BlockFields extends BaseFieldRepository
{
    /**
     * @inheritDoc
     */
    protected function fields(): array
    {
        return [
            new Boolean(
                'active'
            )
        ];
    }
}