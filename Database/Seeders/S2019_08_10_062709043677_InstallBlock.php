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
        Permission::create(['name' => 'manage blocks', 'section' => 'Block']);
    }

    /**
     * Reverts the database seeder.
     */
    public function down(): void
    {
        // Remove your data
    }
}
