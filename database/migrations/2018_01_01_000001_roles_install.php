<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesInstall extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Role::create(['name' => 'admin','display_name' => 'Super admin']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $role = Role::findByName('admin');
        $role->delete();
    }
}
