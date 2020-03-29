<?php

namespace Pingu\Block\Entities\Validators;

use Pingu\Field\Support\FieldValidator\BaseFieldsValidator;

class BlockValidator extends BaseFieldsValidator
{
    /**
     * @inheritDoc
     */
    protected function rules(bool $updating): array
    {
        return [
            'active' => 'boolean',
            'permission' => 'sometimes|integer|exists:permissions,id'
        ];
    }
    
    /**
     * @inheritDoc
     */
    protected function messages(): array
    {
        return [

        ];
    }
}