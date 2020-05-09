<?php

namespace Pingu\Block\Entities\Fields;

use Pingu\Field\BaseFields\Boolean;
use Pingu\Field\BaseFields\Model;
use Pingu\Field\BaseFields\Text;
use Pingu\Field\Support\FieldRepository\BaseFieldRepository;
use Pingu\Permissions\Entities\Permission;

class BlockFields extends BaseFieldRepository
{
    /**
     * @inheritDoc
     */
    protected function fields(): array
    {
        return [
            new Model(
                'permission',
                [
                    'model' => Permission::class,
                    'label' => 'Viewing permission',
                    'items' => \Permissions::all()->sortBy('section'),
                    'textField' => ['section', 'name'],
                    'separator' => ' : ',
                    'noValueLabel' => 'None'
                ]
            ),
            new Boolean(
                'active'
            ),
            new Text(
                'provider'
            )
        ];
    }

    /**
     * @inheritDoc
     */
    protected function rules(): array
    {
        return [
            'active' => 'boolean',
            'permission' => 'nullable|exists:permissions,id'
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