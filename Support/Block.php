<?php 

namespace Pingu\Block\Support;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Pingu\Block\Contracts\BlockProviderContract;
use Pingu\Block\Entities\Block as BlockModel;
use Pingu\Block\Forms\CreateBlockOptionsForm;
use Pingu\Block\Forms\EditBlockOptionsForm;
use Pingu\Block\Support\BlockValidator;
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
     * Form fields for the options
     * 
     * @return array
     */
    abstract protected function getOptionsFormFields(): array;

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
    public function createForm(): Form
    {
        return BlockModel::forms()->create([$this, new BlockModel, $this->getOptionsFormFields(), $this->createAction()]);
    }

    /**
     * @inheritDoc
     */
    public function editForm(): Form
    {
        return BlockModel::forms()->edit([$this, $this->blockModel(), $this->getOptionsFormFields(), $this->editAction()]);
    }

    /**
     * @inheritDoc
     */
    public function validateRequest(Request $request, BlockModel $block): array
    {
        $validated = (new BlockValidator($this, $block))->validateRequest($request);
        $validated['provider'] = $this->provider();
        return $validated;
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

    /**
     * Url to edit this block
     * 
     * @return array
     */
    protected function editAction(): array
    {
        return ['url' => BlockModel::uris()->make('update', $this->model)];
    }

    /**
     * Url to create this block
     * 
     * @return array
     */
    protected function createAction(): array
    {
        return ['url' => BlockModel::uris()->make('store', $this->fullMachineName())];
    }
}