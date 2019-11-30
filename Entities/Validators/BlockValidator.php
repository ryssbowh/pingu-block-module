<?php

namespace Pingu\Block\Entities\Validators;

use Pingu\Field\Contracts\BundleFieldsValidator;
use Pingu\Field\Support\FieldValidator\BaseFieldsValidator;

class BlockValidator extends BaseFieldsValidator
{
    /**
     * @inheritDoc
     */
    protected function rules(): array
    {
        return [

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