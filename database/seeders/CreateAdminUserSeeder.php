<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'David',
            'email' => 'admin@demo.com',
            'password' => bcrypt('12345678'),
            'name_user' => 'basado'
        ]);

        $user1 = User::create([
            'name' => 'Alejandro',
            'email' => 'alejandro@demo.com',
            'password' => bcrypt('123'),
            'name_user' => 'almulin'
        ]);

        $user2 = User::create([
            'name' => 'Alan',
            'email' => 'alan@demo.com',
            'password' => bcrypt('123'),
            'name_user' => 'alansito'
        ]);


        $role = Role::create(['name' => 'admin']);
        $role2 = Role::create(['name' => 'user']);
        $permissions = [
            'post-list',
            'post-create',
            'post-edit',
            'post-delete',
            'post-list',
            'exercise-create',
            'exercise-edit',
            'exercise-all',
            'exercise-delete'
        ];
        $role2->syncPermissions($permissions);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
        $user1->assignRole([$role->id]);
    }
}
