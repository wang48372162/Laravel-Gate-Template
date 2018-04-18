<?php

use Illuminate\Database\Seeder;

use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $author = Role::create([
            'name' => '作家',
            'slug' => 'author',
            'permissions' => [
                'create-post' => true,
            ]
        ]);

        $editor = Role::create([
            'name' => '編輯',
            'slug' => 'editor',
            'permissions' => [
                'update-post' => true,
                'publish-post' => true,
                'delete-post' => true,
            ]
        ]);
    }
}
