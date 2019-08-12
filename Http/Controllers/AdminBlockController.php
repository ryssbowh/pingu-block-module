<?php

namespace Pingu\Block\Http\Controllers;

use Pingu\Block\Entities\Block;
use Pingu\Core\Http\Controllers\BaseController;
use Pingu\Forms\Support\ModelForm;

class AdminBlockController extends BaseController
{

	public function create($blockSlug)
	{
		$blockModel = \BlockCreator::getModel($blockSlug);
		$form = new ModelForm(
			['url' => \BlockCreator::transformUri('store', $blockSlug, config('core.adminPrefix'))],
			'POST',
			new $blockModel
		);
		$form->considerGet(['redirect']);
		$form->addSubmit();

		return view('pages.addModel')->with([
			'form' => $form,
			'model' => $blockModel
		]);
	}

	public function store($blockSlug)
	{
		$post = $this->request->post();
		$modelStr = \BlockCreator::getModel($blockSlug);
		$model = new $modelStr;

		$validated = $model->validateForm($post, $model->getAddFormFields(), false);

		$model->formFill($validated)->save();

		$dbProvider = app('block.providers.db')::getModel();

		$block = new Block([
			'data' => [
				'id' => $model->id,
				'entity' => $modelStr
			]
		]);
		$block->provider()->associate($dbProvider);
		$block->save();

		\Notify::success($model::friendlyName()." has been created");

		return $post['redirect'] ? redirect($post['redirect']) : back();
	}

}
