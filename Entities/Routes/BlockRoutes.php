<?php

namespace Pingu\Block\Entities\Routes;

use Pingu\Block\Entities\Block;
use Pingu\Entity\Support\BaseEntityRoutes;

class BlockRoutes extends BaseEntityRoutes
{
    /**
     * @inheritDoc
     */
    protected function middlewares(): array
    {
        return [
            'create' => ['can:create,@class','blockHasOptions:block_name'],
            'edit' => ['can:edit,@class','blockHasOptions:'.Block::routeSlug()],
            'update' => ['can:edit,@class','blockHasOptions:'.Block::routeSlug()],
            'delete' => ['can:delete,@class', 'deletableModel:'.Block::routeSlug()]
        ];
    }
}