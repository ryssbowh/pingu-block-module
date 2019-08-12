<?php

use Pingu\Block\BlockProviders\ClassBlockProvider;
use Pingu\Block\BlockProviders\DbBlockProvider;
use Pingu\Block\Entities\Block;
use Pingu\Block\Entities\BlockCreator;
use Pingu\Block\Entities\BlockProvider;
use Pingu\Block\Entities\BlockText;
use Pingu\Core\Seeding\DisableForeignKeysTrait;
use Pingu\Core\Seeding\MigratableSeeder;
use Pingu\Permissions\Entities\Permission;

class S2019_08_10_062709043677_InstallBlock extends MigratableSeeder
{
    use DisableForeignKeysTrait;

    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        Permission::create(['name' => 'create blocks', 'section' => 'Block']);

        $block = BlockText::create([
            'name' => 'text',
            'text' => 'My first block'
        ]);

        $p1 = BlockProvider::create([
            'name' => 'Database',
            'class' => DbBlockProvider::class
        ]);

        $p2 = BlockProvider::create([
            'name' => 'Class',
            'class' => ClassBlockProvider::class
        ]);

        $block = new Block([
            'data' => [
                'entity' => BlockText::class,
                'id' => $block->id
            ]
        ]);
        $block->provider()->associate($p1)->save();
    }

    /**
     * Reverts the database seeder.
     */
    public function down(): void
    {
        // Remove your data
    }
}
