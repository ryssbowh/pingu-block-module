<?php 

namespace Pingu\Block\Support;

use Illuminate\Support\Str;
use Pingu\Block\Contracts\BlockProviderContract;
use Pingu\Block\Entities\Block as BlockModel;
use Pingu\Block\Forms\BlockOptionsForm;
use Pingu\Core\Contracts\RendererContract;
use Pingu\Forms\Support\Form;

trait Block
{
    /**
     * @var BlockModel
     */
    protected $model;

    /**
     * Constructor
     * 
     * @param BlockModel|null $block
     */
    public function __construct(?BlockModel $block = null)
    {
        $this->model = $block;
    }

    /**
     * Get the block's data
     *
     * @param ?string $name
     * 
     * @return mixed
     */
    public function getData(?string $name = null)
    {
        return $this->model->getData($name);
    }

    /**
     * @inheritDoc
     */
    public function blockModel(): BlockModel
    {
        return $this->model;
    }

    /**
     * @inheritDoc
     */
    public function machineName(): string
    {
        return class_machine_name($this);
    }

    /**
     * @inheritDoc
     */
    public function fullMachineName(): string
    {
        return $this->provider().'.'.$this->machineName();
    }

    /**
     * @inheritDoc
     */
    public function viewIdentifier(): string
    {
        return \Str::kebab($this->fullMachineName());
    }

    /**
     * @inheritDoc
     */
    public function getViewKey(): string
    {
        return \Str::kebab($this->machineName());
    }

    /**
     * @inheritDoc
     */
    public function resolveProvider(): BlockProviderContract
    {
        return  \Blocks::resolveProvider($this->provider());
    }

    /**
     * @inheritDoc
     */
    public function createOptionsForm(): Form
    {
        return new BlockOptionsForm($this);
    }

    /**
     * @inheritDoc
     */
    public function editOptionsForm(BlockModel $block): Form
    {
        return new BlockOptionsForm($this, $block);
    }

    /**
     * @inheritDoc
     */
    public function getOptionsValidationMessages(): array
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    public function getOptionsValidationRules(): array
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return [
            'title' => $this->title(),
            'hasOptions' => $this->hasOptions()
        ];
    }

    /**
     * @inheritDoc
     */
    public function defaultViewData(): array
    {
        return [];
    }
}