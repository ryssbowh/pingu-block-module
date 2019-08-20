<?php

namespace Pingu\Block\Http\Controllers;

use Pingu\Block\Entities\Block;
use Pingu\Core\Http\Controllers\BaseController;
use Pingu\Forms\Support\ModelForm;

class AjaxBlockController extends BaseController
{
	public function getModel(): string
	{
		return Block::class;
	}

	public function edit(BaseModel $block):array
	{
		$form = new ModelForm(
			['url' => Block::makeUri('update', [$block], ajaxPrefix()), 'method' => 'put'], 
			['submit' => ['Save'], 'view' => 'forms.modal', 'title' => 'Edit a ' . $block->instance->name . ' block'], 
			$block->instance,
			true
		);
		$form->end();
		return ['form' => $form->renderAsString()];
	}

	public function update(BaseModel $block): array
	{	
		$validated = $this->validateUpdateRequest($block->instance);

		try{
			$block->instance->saveWithRelations($validated);
		}
		catch(ModelNotSaved $e){
			$this->onUpdateFailure($block, $e);
		}
		catch(ModelRelationsNotSaved $e){
			$this->onUpdateRelationshipsFailure($block, $e);
		}

		return $this->onSuccessfullUpdate($block);
	}

}
