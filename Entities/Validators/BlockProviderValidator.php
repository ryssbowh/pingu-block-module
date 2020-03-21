<?php

namespace Pingu\Block\Entities\Validators;

use Pingu\Field\Contracts\BundleFieldsValidator;
use Pingu\Field\Support\FieldValidator\BaseFieldsValidator;

class BlockProviderValidator extends BaseFieldsValidator
{
    /**
     * @inheritDoc
     */
    protected function rules(bool $updating): array
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