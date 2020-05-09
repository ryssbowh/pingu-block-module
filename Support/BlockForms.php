<?php 

namespace Pingu\Block\Support;

use Pingu\Block\Forms\CreateBlockForm;
use Pingu\Block\Forms\EditBlockForm;
use Pingu\Forms\Support\BaseForms;
use Pingu\Forms\Support\Form;

class BlockForms extends BaseForms
{
    /**
     * @inheritDoc
     */
    public function create(array $args): Form
    {
        return new CreateBlockForm(...$args);
    }

    /**
     * @inheritDoc
     */
    public function edit(array $args): Form
    {
        return new EditBlockForm(...$args);
    }
}