<?php

use Pingu\Block\BlockProviders\DbBlockProvider;
use Pingu\Block\Entities\Block;
use Pingu\Block\Entities\BlockCreator;
use Pingu\Block\Entities\BlockProvider;
use Pingu\Block\Entities\BlockText;
use Pingu\Block\TestBlock;
use Pingu\Core\Seeding\DisableForeignKeysTrait;
use Pingu\Core\Seeding\MigratableSeeder;

class S2019_08_10_062709043677_InstallBlock extends MigratableSeeder
{
    use DisableForeignKeysTrait;

    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        Permissions::create(['name' => 'create blocks']);

        $block = BlockText::create([
            'name' => 'text',
            'text' => 'My first block'
        ]);

        $p1 = BlockProvider::create([
            'name' => 'First text block',
            'class' => DbBlockProvider::class
        ]);

        $p2 = BlockProvider::create([
            'name' => 'text',
            'class' => TestBlock::class
        ]);

        $block = new Block([
            'system' => false,
            'data' => [
                'entity' => BlockText::class,
                'id' => $block->id
            ]
        ]);
        $block->provider()->associate($p1)->save();

        $block = new Block([
            'provider_id' => $p2->id,
            'system' => true,
            'data' => []
        ]);
        $block->provider()->associate($p2)->save();
    }

    /**
     * Reverts the database seeder.
     */
    public function down(): void
    {
        // Remove your data
    }
}
