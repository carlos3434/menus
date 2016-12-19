<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Restaurant\User;

class UserTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->modulosSeeder();
        $this->permissionsUserSeeder();
        $this->permissionsRoleSeeder();
        $this->permissionsSeeder();
        //$this->permissionsAllSeeder();
        $this->rolesSeeder();
        $this->addPermissionRoleSeeder();
        $this->usersSeeder();
        $this->roleUserSeeder();
    }

    private function modulosSeeder(){
        DB::table('modulos')->insert(array(
            'name' => 'mantenimiento',
            'icon' => 'mant',
            'url' => 'mantenimiento',
            'modulo_id' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));
        DB::table('modulos')->insert(array(
            'name' => 'users',
            'icon' => '',
            'url' => 'users',
            'modulo_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));
        DB::table('modulos')->insert(array(
            'name' => 'roles',
            'icon' => '',
            'url' => 'roles',
            'modulo_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));
        DB::table('modulos')->insert(array(
            'name' => 'modulos',
            'icon' => '',
            'url' => 'modulos',
            'modulo_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));
        DB::table('modulos')->insert(array(
            'name' => 'permissions',
            'icon' => '',
            'url' => 'permissions',
            'modulo_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));
        DB::table('modulos')->insert(array(
            'name' => 'sedes',
            'icon' => '',
            'url' => 'sedes',
            'modulo_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));
        DB::table('modulos')->insert(array(
            'name' => 'grupos',
            'icon' => '',
            'url' => 'grupos',
            'modulo_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));
        DB::table('modulos')->insert(array(
            'name' => 'mesas',
            'icon' => '',
            'url' => 'mesas',
            'modulo_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));
        DB::table('modulos')->insert(array(
            'name' => 'tipo_plato',
            'icon' => '',
            'url' => 'tipo_plato',
            'modulo_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));
        DB::table('modulos')->insert(array(
            'name' => 'platos',
            'icon' => '',
            'url' => 'platos',
            'modulo_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));
        DB::table('modulos')->insert(array(
            'name' => 'calendarios',
            'icon' => '',
            'url' => 'calendarios',
            'modulo_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));
        DB::table('modulos')->insert(array(
            'name' => 'calendario_plato',
            'icon' => '',
            'url' => 'calendario_plato',
            'modulo_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));
        DB::table('modulos')->insert(array(
            'name' => 'estado_pedido',
            'icon' => '',
            'url' => 'estado_pedido',
            'modulo_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));
        DB::table('modulos')->insert(array(
            'name' => 'tipo_cliente',
            'icon' => '',
            'url' => 'tipo_cliente',
            'modulo_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));
        DB::table('modulos')->insert(array(
            'name' => 'grupo_user',
            'icon' => '',
            'url' => 'grupo_user',
            'modulo_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));
    }
    private function permissionsUserSeeder(){

        DB::table('permissions')->insert(array(
            'name' => 'create-users',
            'display_name' => 'Create Users',
            'description' => 'Create users',
            'modulo_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('permissions')->insert(array(
            'name' => 'read-users',
            'display_name' => 'Read Users',
            'description' => 'List Users',
            'modulo_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('permissions')->insert(array(
            'name' => 'update-users',
            'display_name' => 'Update Users',
            'description' => 'Update Users',
            'modulo_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('permissions')->insert(array(
            'name' => 'delete-users',
            'display_name' => 'Delete Users',
            'description' => 'Delete Users',
            'modulo_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));
    }

    private function permissionsRoleSeeder(){

        DB::table('permissions')->insert(array(
            'name' => 'create-roles',
            'display_name' => 'Create Roles',
            'description' => 'Create Roles',
            'modulo_id' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('permissions')->insert(array(
            'name' => 'read-roles',
            'display_name' => 'Read Roles',
            'description' => 'List Roles',
            'modulo_id' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('permissions')->insert(array(
            'name' => 'update-roles',
            'display_name' => 'Update Roles',
            'description' => 'Update Roles',
            'modulo_id' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('permissions')->insert(array(
            'name' => 'delete-roles',
            'display_name' => 'Delete Roles',
            'description' => 'Delete Roles',
            'modulo_id' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));
    }

    private function permissionsModulosSeeder(){

        DB::table('permissions')->insert(array(
            'name' => 'create-modulos',
            'display_name' => 'Create modulos',
            'description' => 'Create modulos',
            'modulo_id' => 4,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('permissions')->insert(array(
            'name' => 'read-modulos',
            'display_name' => 'Read modulos',
            'description' => 'List modulos',
            'modulo_id' => 4,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('permissions')->insert(array(
            'name' => 'update-modulos',
            'display_name' => 'Update modulos',
            'description' => 'Update modulos',
            'modulo_id' => 4,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('permissions')->insert(array(
            'name' => 'delete-modulos',
            'display_name' => 'Delete modulos',
            'description' => 'Delete modulos',
            'modulo_id' => 4,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));
    }

    private function permissionsSeeder(){

        DB::table('permissions')->insert(array(
            'name' => 'create-permissions',
            'display_name' => 'Create Permissions',
            'description' => 'Create Permissions',
            'modulo_id' => 5,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('permissions')->insert(array(
            'name' => 'read-permissions',
            'display_name' => 'Read Permissions',
            'description' => 'List Permissions',
            'modulo_id' => 5,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('permissions')->insert(array(
            'name' => 'update-permissions',
            'display_name' => 'Update Permissions',
            'description' => 'Update Permissions',
            'modulo_id' => 5,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('permissions')->insert(array(
            'name' => 'delete-permissions',
            'display_name' => 'Delete Permissions',
            'description' => 'Delete Permissions',
            'modulo_id' => 5,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));
    }

    private function permissionsAllSeeder(){

        $name = 'Tables_in_'.env('DB_DATABASE', 'forge');
        $data = DB::select('SHOW TABLES WHERE '.$name.' NOT REGEXP "[[.low-line.]]"');
        $i=6;
        foreach($data as $value) {

            if(($value->$name != 'users') && ($value->$name != 'migrations') &&
                ($value->$name != 'roles') && ($value->$name != 'permissions') &&
                ($value->$name != 'modulos')) {
                DB::table('permissions')->insert(array(
                    'name' => 'create-'.$value->$name,
                    'display_name' => 'Create '.ucwords($value->$name),
                    'description' => 'Create '.ucwords($value->$name),
                    'modulo_id' => $i,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ));

                DB::table('permissions')->insert(array(
                    'name' => 'read-'.$value->$name,
                    'display_name' => 'Read '.ucwords($value->$name),
                    'description' => 'List '.ucwords($value->$name),
                    'modulo_id' => $i,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ));

                DB::table('permissions')->insert(array(
                    'name' => 'update-'.$value->$name,
                    'display_name' => 'Update '.ucwords($value->$name),
                    'description' => 'Update '.ucwords($value->$name),
                    'modulo_id' => $i,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ));

                DB::table('permissions')->insert(array(
                    'name' => 'delete-'.$value->$name,
                    'display_name' => 'Delete '.ucwords($value->$name),
                    'description' => 'Delete '.ucwords($value->$name),
                    'modulo_id' => $i,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ));
                $i++;
            }
        }
    }

    private function rolesSeeder(){

        DB::table('roles')->insert(array(
            'name' => 'admin',
            'display_name' => 'Administrador',
            'description' => 'Administra los módulos de usuarios',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));
/*
        DB::table('roles')->insert(array(
            'name' => 'teacher',
            'display_name' => 'Teacher',
            'description' => 'Teacher',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));

        DB::table('roles')->insert(array(
            'name' => 'student',
            'display_name' => 'Student',
            'description' => 'Student',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));*/
    }

    private function addPermissionRoleSeeder(){

        for($i=1; $i < 13; $i++){
            DB::table('permission_role')->insert(array(
                'permission_id' => $i,
                'role_id' => 1
            ));
        }
    }

    private function usersSeeder(){

        DB::table('users')->insert(array(
            'name' => 'John',
            'nickname' => 'Doe',
            'address' => 'lima',
            'phone_number' => 964142677,
            'email' => 'carlos3434@hotmail.com',
            'password' => \Hash::make('carlos3434'),
            'created_at' => Carbon::now(),
            'remember_token' => str_random(10),
            'birthdate' => Carbon::now(),
            'gender' => 'M',
            'group_id' => 1
        ));
        factory(Restaurant\User::class, 4)->create();

    }

    private function roleUserSeeder(){

        DB::table('role_user')->insert(array(
            'user_id' => 1,
            'role_id' => 1
        ));
    }

}