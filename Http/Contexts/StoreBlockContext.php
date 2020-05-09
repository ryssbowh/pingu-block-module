<?php 

namespace Pingu\Block\Http\Contexts;

use Pingu\Block\Entities\Block;
use Pingu\Core\Http\Contexts\StoreContext;
use Pingu\Field\Support\FieldValidator;
use Pingu\Forms\Support\Form;

class StoreBlockContext extends StoreContext
{
    /**
     * @inheritDoc
     */
    protected function validateRequest(): array
    {
        $block = $this->routeParameter('block_name');
        return $block->validateRequest($this->request, $this->model);
    }

    /**
     * @inheritDoc
     */
    protected function performStore(array $validated)
    {
        $fieldNames = $this->model->fieldRepository()->names();
        $modelValidated = array_intersect_key($validated, array_flip($fieldNames));
        $dataValidated = array_diff_key($validated, array_flip($fieldNames));
        $this->model->data = $dataValidated;
        $this->model->saveFields($modelValidated);
    }
}