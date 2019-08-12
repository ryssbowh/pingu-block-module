<?php

namespace Pingu\Block\Entities;

use Pingu\Block\Contracts\CreatableBlockContract;
use Pingu\Block\Support\ModelBlock;
use Pingu\Core\Entities\BaseModel;
use Pingu\Core\Traits\Models\HasAdminRoutes;
use Pingu\Core\Traits\Models\HasAjaxRoutes;
use Pingu\Core\Traits\Models\HasRouteSlug;
use Pingu\Forms\Fields\Model\Text;
use Pingu\Forms\Support\Fields\TextInput;
use Pingu\Forms\Support\Fields\Textarea;
use Pingu\Forms\Traits\Models\Formable;

class BlockText extends BaseModel implements CreatableBlockContract
{
    use Formable, ModelBlock;
    
    protected $fillable = ['name', 'text'];

    protected $visible = ['id', 'text', 'name'];

    /**
     * @inheritDoc
     */
    public function formAddFields()
    {
        return ['name', 'text'];
    }

    /**
     * @inheritDoc
     */
    public function formEditFields()
    {
        return ['name', 'text'];
    }

    /**
     * @inheritDoc
     */
    public function fieldDefinitions()
    {
        return [
            'text' => [
                'field' => Textarea::class,
                'attributes' => ['required' => true],
            ],
            'name' => [
                'field' => TextInput::class,
                'attributes' => ['required' => true],
            ]
        ];
    }

    /**
     * @inheritDoc
     */
    public function validationRules()
    {
        return [
            'text' => 'required|string',
            'name' => 'required|string'
        ];
    }

    /**
     * @inheritDoc
     */
    public function validationMessages()
    {
        return [
            'text.required' => 'Text is required',
            'name.required' => 'Name is required'
        ];
    }

    public static function getBlockSection()
    {
        return 'Text';
    }

    public function getBlockName()
    {
        return $this->name;
    }

    public function blockIsEditable()
    {
        return true;
    }

    public static function blockSlug()
    {
        return 'text';
    }
}
