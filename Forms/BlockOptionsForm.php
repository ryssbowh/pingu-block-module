<?php
namespace Pingu\Block\Forms;

use Pingu\Block\Contracts\BlockContract;
use Pingu\Block\Entities\Block;
use Pingu\Forms\Support\Fields\Submit;
use Pingu\Forms\Support\Form;

class BlockOptionsForm extends Form
{
    protected $block;
    protected $model;
    protected $updating;

    /**
     * Bring variables in your form through the constructor :
     */
    public function __construct(BlockContract $block, bool $updating, ?Block $model = null)
    {
        $this->updating = $updating;
        $this->block = $block;
        $this->model = $model ? $model : (new Block);
        parent::__construct();
    }

    /**
     * Fields definitions for this form, classes used here
     * must extend Pingu\Forms\Support\Field
     * 
     * @return array
     */
    public function elements(): array
    {
        $fields = $this->model->fields()->toFormElements($this->model, $this->updating);
        $fields[] = new Submit();
        return $fields;
    }

    public function afterBuilt()
    {
        if ($this->model->exists) {
            $data = $this->model->data;
            foreach ($this->getElements() as $element) {
                if (isset($data[$element->getName()])) {
                    $element->setValue($data[$element->getName()]);
                }
            }
        }
    }

    /**
     * Method for this form, POST GET DELETE PATCH and PUT are valid
     * 
     * @return string
     */
    public function method(): string
    {
        return $this->model->exists ? 'PUT' : 'POST';
    }

    /**
     * Url for this form, valid values are
     * ['url' => '/foo.bar']
     * ['route' => 'login']
     * ['action' => 'MyController@action']
     * 
     * @return array
     * @see    https://github.com/LaravelCollective/docs/blob/5.6/html.md
     */
    public function action(): array
    {
        if ($this->model->exists) {
            return ['url' => Block::uris()->make('update', $this->model)];
        } else {
            return ['url' => Block::uris()->make('store', $this->block->fullMachineName())];
        }
    }

    /**
     * Name for this form, ideally it would be application unique, 
     * best to prefix it with the name of the module it's for.
     * only alphanumeric and hyphens
     * 
     * @return string
     */
    public function name(): string
    {
        return 'block-options-form';
    }

    /**
     * Various options that you can access in your templates/events
     
     * @return array
     */
    public function options(): array
    {
        return [
            'title' => 'Add a block '.$this->block->name()
        ];
    }
}