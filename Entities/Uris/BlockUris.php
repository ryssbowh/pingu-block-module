<?php

namespace Pingu\Block\Entities\Uris;

use Pingu\Core\Support\Uris\BaseModelUris;

class BlockUris extends BaseModelUris
{
    /**
     * @inheritDoc
     */
    protected function uris(): array
    {
        return [
            'create' => '@slugs@/create/{block_name}',
            'store' => '@slugs@/{block_name}'
        ];
    }
}