<?php

namespace Pingu\Block\Http\Controllers;

use Illuminate\Http\Request;
use Pingu\Block\Contracts\BlockContract;
use Pingu\Block\Entities\Block;
use Pingu\Core\Entities\BaseModel;
use Pingu\Core\Support\Arr;
use Pingu\Core\Support\ModelCrudContextController;

class BlockController extends ModelCrudContextController
{
    /**
     * @inheritDoc
     */
    protected function getModel(): BaseModel
    {
        return new Block;
    }
}
