<?php

namespace Pingu\Block\Http\Controllers;

use Pingu\Block\Entities\Block;
use Pingu\Core\Http\Controllers\BaseController;
use Pingu\Forms\Support\Form;

class BlockAjaxController extends BaseController
{
    use BlockController;

    public function afterCreateOptionsFormCreated(Form $form)
    {
        $form->addViewSuggestion('forms.modal')
            ->isAjax();
        return ['html' => $form->__toString()];
    }

    public function afterSuccessfullDeletion(Block $block)
    {
        return ['success' => true];
    }

    public function afterSuccessfullStore(Block $block)
    {
        return $block;
    }

    public function afterSuccessfullUpdate(Block $block)
    {
        return $block;
    }

    public function afterEditOptionsFormCreated(Form $form, Block $block)
    {
        $form->addViewSuggestion('forms.modal')
            ->isAjax();
        return ['html' => $form->__toString()];
    }
}
