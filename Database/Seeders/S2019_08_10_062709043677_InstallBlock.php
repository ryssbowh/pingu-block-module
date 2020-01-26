<?php

use Pingu\Core\Seeding\DisableForeignKeysTrait;
use Pingu\Core\Seeding\MigratableSeeder;
use Pingu\Permissions\Entities\Permission;
use Pingu\User\Entities\Role;

class S2019_08_10_062709043677_InstallBlock extends MigratableSeeder
{
    use DisableForeignKeysTrait;

    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        Role::find(4)->givePermissionTo(
            [
            Permission::create(['name' => 'edit blocks', 'section' => 'Block']),
            Permission::create(['name' => 'delete blocks', 'section' => 'Block']),
            Permission::create(['name' => 'create blocks', 'section' => 'Block'])
            ]
        );
    }

    /**
     * Reverts the database seeder.
     */
    public function down(): void
    {
        // Remove your data
    }
}
