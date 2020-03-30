<?php

namespace Pingu\Block\Entities\Fields;

use Pingu\Field\BaseFields\Boolean;
use Pingu\Field\BaseFields\Model;
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
            new Boolean(
                'active'
            ),
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
            )
        ];
    }
}