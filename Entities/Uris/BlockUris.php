<?php

namespace Pingu\Block\Entities\Uris;

use Pingu\Entity\Support\BaseEntityUris;

class BlockUris extends BaseEntityUris
{
    /**
     * @inheritDoc
     */
    protected function uris(): array
    {
        return [
            'create' => '@entities/create/{block_name}',
            'store' => '@entities/{block_name}'
        ];
    }
}