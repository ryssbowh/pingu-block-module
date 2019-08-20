<?php

namespace Pingu\Block\Http\Controllers;

use Pingu\Block\BlockProviders\DbBlockProvider;
use Pingu\Block\Entities\Block;
use Pingu\Core\Http\Controllers\BaseController;
use Pingu\Forms\Support\ModelForm;
use Pingu\Page\Entities\Page;

class AdminBlockController extends BaseController
{
	/**
	 * Creates a form to add a block
	 * 
	 * @param  string $blockSlug
	 * @return view
	 */
	public function create(string $blockSlug)
	{
		$blockModel = \BlockCreator::getModel($blockSlug);
		$form = new ModelForm(
			['url' => \BlockCreator::makeUri('store', $blockSlug, adminPrefix())],
			'POST',
			new $blockModel,
			false
		);
		$form->considerGet(['redirect']);
		$form->addSubmit();

		return view('pages.addModel')->with([
			'form' => $form,
			'model' => $blockModel
		]);
	}

	/**
	 * Stores a block
	 * 
	 * @param  string $blockSlug
	 * @return redirect
	 */
	public function store(string $blockSlug)
	{
		$post = $this->request->post();
		$modelStr = \BlockCreator::getModel($blockSlug);
		$model = new $modelStr;

		$validated = $model->validateRequest($this->request, $model->getAddFormFields());

		$model->formFill($validated)->save();

		$dbProvider = app(DbBlockProvider::class)->getModel();

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
