<?php 

namespace Pingu\Block\Contracts;

use Illuminate\Http\Request;
use Pingu\Forms\Support\Form;

interface BlockWithOptionsContract extends BlockContract
{
    /**
     * Get the form to create options
     * 
     * @return Form
     */
    public function createOptionsForm(): Form;

    /**
     * Get the form to edit options
     * 
     * @return Form
     */
    public function editOptionsForm(Block $block): Form;

    /**
     * Validate the options
     * 
     * @param Request $request
     * 
     * @return array
     */
    public function validateOptionsRequest(Request $request): array;

}