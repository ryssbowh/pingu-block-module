<?php

namespace Pingu\Block\Http\Controllers;

use Illuminate\Http\Request;
use Pingu\Block\Entities\Block;

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
        $form->addElements((new Block)->fields()->toFormElements());
        $form->moveElementUp('active', 1);
        return $this->afterCreateOptionsFormCreated($form);
    }

    /**
     * Delete request
     * 
     * @param Block  $block
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
     * @param Block  $block
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
        $data = $block->instance()->validateOptionsRequest($request);
        $block->data = $data;
        $block->save();
        $block->refresh();
        return $this->afterSuccessfullUpdate($block);
    }

    /**
     * Store request.
     * If the block doesn't define options, the data will de defaulted,
     * otherwise the request will be validated
     * 
     * @param Request $request
     * 
     * @return mixed
     */
    public function store(Request $request)
    {
        $block = $this->routeParameter('block_name');
        if (!$block->hasOptions()) {
            $attributes = [
                'active' => 0,
                'provider' => $block->provider(),
                'data' => $block->getDefaultData()
            ];
        } else {
            $data = $block->validateOptionsRequest($request);
            $attributes = [
                'data' => $data,
                'active' => $request->post('active', false),
                'provider' => $block->provider()
            ];
        }
        $blockModel = Block::create($attributes);
        return $this->afterSuccessfullStore($blockModel);
    }
}
