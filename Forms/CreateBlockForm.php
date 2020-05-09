<?php

namespace Pingu\Block\Forms;

use Illuminate\Support\Collection;
use Pingu\Block\Contracts\BlockContract;
use Pingu\Block\Entities\Block;
use Pingu\Forms\Support\Forms\CreateModelForm;

class CreateBlockForm extends CreateModelForm
{
    protected $block;
    protected $optionFields;
    protected $action;

    public function __construct(BlockContract $block, Block $model, array $optionFields, array $action)
    {
        $this->block = $block;
        $this->optionFields = $optionFields;
        $this->action = $action;
        parent::__construct($model, $action);
    }

    /**
     * @inheritDoc
     */
    protected function getModelFields(): Collection
    {
        return $this->model->fieldRepository()->except(['provider']);
    }

    /**
     * @inheritDoc
     */
    protected function createElementsFromModel(): array
    {
        return parent::createElementsFromModel() + $this->optionFields;
    }

    /**
     * @inheritDoc
     */
    public function name(): string
    {
        return 'create-block-options-form';
    }

    /**
     * @inheritDoc
     */
    public function options(): array
    {
        return [
            'title' => 'Add a block '.$this->block->name()
        ];
    }
}