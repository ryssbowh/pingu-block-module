<?php 

namespace Pingu\Block\Http\Contexts;

use Illuminate\Support\Collection;
use Pingu\Core\Http\Contexts\EditContext;
use Pingu\Forms\Support\Form;

class EditBlockContext extends EditContext
{
    /**
     * @inheritDoc
     */
    protected function getForm(): Form
    {
        return $this->model->instance()->editForm();
    }
}