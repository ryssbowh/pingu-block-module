<?php 

namespace Pingu\Block\Http\Contexts;

use Pingu\Core\Http\Contexts\UpdateContext;

class UpdateBlockContext extends UpdateContext
{
    /**
     * @inheritDoc
     */
    protected function validateRequest(): array
    {
        return $this->model->instance()->validateRequest($this->request, $this->model);
    }

    /**
     * @inheritDoc
     */
    protected function performUpdate(array $validated)
    {
        $fieldNames = $this->model->fieldRepository()->names();
        $modelValidated = array_intersect_key($validated, array_flip($fieldNames));
        $dataValidated = array_diff_key($validated, array_flip($fieldNames));
        $this->model->data = $dataValidated;
        $this->model->saveFields($modelValidated);
    }
}