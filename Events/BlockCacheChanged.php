<?php

namespace Pingu\Block\Events;

use Illuminate\Queue\SerializesModels;
use Pingu\Block\Entities\Block;

class BlockCacheChanged
{
    use SerializesModels;

    /**
     * @var Block
     */
    public $block;

    public function __construct(Block $block)
    {
        $this->block = $block;
    }

}
