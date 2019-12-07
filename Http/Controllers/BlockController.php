<?php

namespace Pingu\Block\Http\Controllers;

use Illuminate\Http\Request;
use Pingu\Block\Contracts\BlockContract;
use Pingu\Block\Entities\Block;
use Pingu\Core\Support\Arr;

trait BlockController
{
   
    /**
     * Create request
     * 
     * @return mixed
     */
    public function create()
    {
        $block = $this->routeParameter('block_name');
        $form = $block->createOptionsForm();
        return $this->afterCreateOptionsFormCreated($form);
    }

    /**
     * Delete request
     * 
     * @param Block $block
     * 
     * @return mixed
     */
    public function delete(Block $block)
    {
        $block->delete();
        return $this->afterSuccessfullDeletion($block);
    }

    /**
     * Edit request
     * 
     * @param Block $block
     * 
     * @return mixed
     */
    public function edit(Block $block)
    {
        $form = $block->instance()->editOptionsForm($block);
        return $this->afterEditOptionsFormCreated($form, $block);
    }

    /**
     * Update request
     * 
     * @param Request $request
     * @param Block   $block 
     * 
     * @return mixed
     */
    public function update(Request $request, Block $block)
    {
        list($attributes, $data) = $this->validateOptionsRequest($request, $block->instance());
        $attributes['data'] = $data;
        $block->saveWithRelations($attributes);
        $block->refresh();
        return $this->afterSuccessfullUpdate($block);
    }

    public function validateOptionsRequest(Request $request, BlockContract $block): array
    {
        $modelValidated = (new Block)->validator()->validateRequest($request);

        $rules = $block->getOptionsValidationRules();
        $messages = $block->getOptionsValidationMessages();
        $validator = \Validator::make($request->post(), $rules, $messages);
        $validator->validate();
        $blockValidated = $validator->validated();
        return [$modelValidated, array_merge($block->getDefaultData(), $blockValidated)];
    }

    /**
     * Store request.
     * 
     * @param Request $request
     * 
     * @return mixed
     */
    public function store(Request $request)
    {
        $block = $this->routeParameter('block_name');
        list($attributes, $data) = $this->validateOptionsRequest($request, $block);
        $blockModel = new Block;
        $blockModel->provider = $block->provider();
        $blockModel->data = $data;
        $blockModel->saveWithRelations($attributes);
        return $this->afterSuccessfullStore($blockModel);
    }
}
