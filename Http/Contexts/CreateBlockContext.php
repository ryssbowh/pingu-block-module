<?php 

namespace Pingu\Block\Http\Contexts;

use Illuminate\Support\Collection;
use Pingu\Core\Http\Contexts\CreateContext;
use Pingu\Forms\Support\Form;

class CreateBlockContext extends CreateContext
{
    /**
     * @inheritDoc
     */
    protected function getForm(): Form
    {
        $block = $this->routeParameter('block_name');
        return $block->createForm();
    }
}