<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
           'role-list',
           'role-create',
           'role-edit',
           'role-delete',
           'user-list',
           'user-create',
           'user-edit',
           'user-delete',
           'holiday-list',
           'holiday-create',
           'holiday-edit',
           'holiday-delete',
           'holiday-approuve',
           'holiday-reject'
        ];
     
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission,'guard_name'=>'web']);
        }
    }
}
