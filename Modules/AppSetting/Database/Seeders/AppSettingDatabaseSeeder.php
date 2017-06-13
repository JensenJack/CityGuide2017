<?php

namespace Modules\AppSetting\Database\Seeders;
use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class AppSettingDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Model::unguard();

        // $this->call("OthersTableSeeder");
        $module = strtolower('AppSetting');
        $permission_model = config('access.permission');
        $view_permission = new $permission_model();
        $view_permission->name = 'view-'.$module;
        $view_permission->display_name = 'View AppSetting';
        $view_permission->sort = \Module::count()+1;
        $view_permission->created_at = Carbon::now();
        $view_permission->updated_at = Carbon::now();
        $view_permission->save();


        $permission_model = config('access.permission');
        $edit_permission = new $permission_model();
        $edit_permission->name = 'edit-'.$module;
        $edit_permission->display_name = 'Edit AppSetting';
        $edit_permission->sort = \Module::count()+1;
        $edit_permission->created_at = Carbon::now();
        $edit_permission->updated_at = Carbon::now();
        $edit_permission->save();

        
    }
}
