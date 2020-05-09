<?php 

namespace Pingu\Block\Support;

use Pingu\Block\Contracts\BlockContract;
use Pingu\Block\Entities\Block;
use Pingu\Field\Support\FieldValidator;

class BlockValidator extends FieldValidator
{
    public function __construct(BlockContract $block, Block $model)
    {
        $this->block = $block;
        parent::__construct($model);
    }

    /**
     * @inheritDoc
     */
    public function getMessages(): array
    {
        return parent::getMessages() + $this->block->getOptionsValidationMessages();
    }

    /**
     * @inheritDoc
     */
    public function getRules(): array
    {
        return parent::getRules() + $this->block->getOptionsValidationRules();
    }

    /**
     * @inheritDoc
     */
    public function validateData(array $data): array
    {
        return parent::validateData($data) + $this->block->getDefaultData();
    }

    /**
     * @inheritDoc
     */
    public function afterValidated(array $validated): array
    {
        return $validated;
    }
}