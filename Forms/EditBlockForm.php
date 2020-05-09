<?php

namespace Pingu\Block\Forms;

use Pingu\Block\Contracts\BlockContract;
use Pingu\Block\Entities\Block;

class EditBlockForm extends CreateBlockForm
{
    /**
     * @inheritDoc
     */
    public function method(): string
    {
        return 'PUT';
    }

    /**
     * @inheritDoc
     */
    public function afterBuilt()
    {
        $data = $this->model->data;
        foreach ($this->getElements() as $element) {
            if (isset($data[$element->getName()])) {
                $element->setValue($data[$element->getName()]);
            }
        }
    }

    /**
     * @inheritDoc
     */
    public function name(): string
    {
        return 'edit-block-options-form';
    }

    /**
     * @inheritDoc
     */
    public function options(): array
    {
        return [
            'title' => 'Edit block '.$this->block->name()
        ];
    }
}