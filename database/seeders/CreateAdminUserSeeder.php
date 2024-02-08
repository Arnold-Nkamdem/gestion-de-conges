<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Seeder;
use App\Models\User;
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
        // Create an admin user
        $user = User::create([
            'first_name' => 'Arnold', 
            'last_name' => 'NKAMDEM',
            'email' => 'arnold.nkamdem@andigital.cm',
            'phone_number' => '656413108',
            'guard_name'=>'web',
            'password' => bcrypt('Admin@2024'),
            'position_id' => 2, 
        ]);
    
        $role = Role::create(['name' => 'admin']);
        // $permissions = Permission::pluck('id', 'id')->all();
        // $role->givePermissionTo($permissions);
        $role->givePermissionTo([
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
            'holiday-delete'
        ]);
        $user->assignRole([$role->id]);

        // Create a moderator user
        $user = User::create([
            'first_name' => 'Modeste',
            'last_name' => 'TALOM', 
            'email' => 'modeste.talom@andigital.cm',
            'phone_number' => '691721964',
            'guard_name'=>'web',
            'password' => bcrypt('Moderator@2024'),
            'position_id' => 1, 
        ]);
    
        $role = Role::create(['name' => 'moderator']);
        $role->givePermissionTo([
           'holiday-list',
           'holiday-create',
           'holiday-edit',
           'holiday-delete',
           'holiday-approuve',
           'holiday-reject'
        ]);
        $user->assignRole([$role->id]);

        // Create a user
        $user = User::create([ 
            'first_name' => 'Rosine',
            'last_name' => 'SOBDEUNGBE',
            'email' => 'rosine.sobdeungbe@andigital.cm',
            'phone_number' => '698712565',
            'guard_name'=>'web',
            'password' => bcrypt('User@2024'),
            'position_id' => 3, 
        ]);
    
        $role = Role::create(['name' => 'user']);
        $role->givePermissionTo([
           'holiday-list',
           'holiday-create',
           'holiday-edit',
           'holiday-delete'
        ]);
        $user->assignRole([$role->id]);
    }
}