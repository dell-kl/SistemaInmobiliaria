<?php

namespace Database\Seeders;

use App\Models\Authorization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        /**
         * ===========================
         * PERMISOS PARA ADMINISTRADOR
         * ===========================
         */
        $permission_1 = new Authorization();
        $permission_1->authorizations_profilesId = 1;
        $permission_1->authorizations_permissionId = 1;
        $permission_1->save();

        $permission_1 = new Authorization();
        $permission_1->authorizations_profilesId = 1;
        $permission_1->authorizations_permissionId = 2;
        $permission_1->save();

        $permission_1 = new Authorization();
        $permission_1->authorizations_profilesId = 1;
        $permission_1->authorizations_permissionId = 3;
        $permission_1->save();

        $permission_1 = new Authorization();
        $permission_1->authorizations_profilesId = 1;
        $permission_1->authorizations_permissionId = 4;
        $permission_1->save();

        /**
         * ===========================
         * PERMISOS PARA AGE.INMOBILI
         * ===========================
         */
        $permission_1 = new Authorization();
        $permission_1->authorizations_profilesId = 2;
        $permission_1->authorizations_permissionId = 1;
        $permission_1->save();

        $permission_1 = new Authorization();
        $permission_1->authorizations_profilesId = 2;
        $permission_1->authorizations_permissionId = 2;
        $permission_1->save();

        $permission_1 = new Authorization();
        $permission_1->authorizations_profilesId = 2;
        $permission_1->authorizations_permissionId = 3;
        $permission_1->save();

        $permission_1 = new Authorization();
        $permission_1->authorizations_profilesId = 2;
        $permission_1->authorizations_permissionId = 4;
        $permission_1->save();


        /**
         * ===========================
         * SOPORTE TENICO
         * ===========================
         */
        $permission_1 = new Authorization();
        $permission_1->authorizations_profilesId = 3;
        $permission_1->authorizations_permissionId = 4;
        $permission_1->save();

        $permission_1 = new Authorization();
        $permission_1->authorizations_profilesId = 3;
        $permission_1->authorizations_permissionId = 3;
        $permission_1->save();


        // /**
        //  * ===========================
        //  * CLIENTE
        //  * ===========================
        //  */
        // $permission_1 = new Authorization();
        // $permission_1->authorizations_profilesId = 4;
        // $permission_1->authorizations_permissionId = 4;
        // $permission_1->save();

    }
}
