<?php

namespace Modules\Sms\Database\Seeders;

use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SmsDatabaseSeeder extends Seeder
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
         
        $permission_model = config('access.permission');
        $view_sms = new $permission_model();
        $view_sms->name = 'view-sms';
        $view_sms->display_name = 'View Sms';
        $view_sms->sort = 4;
        $view_sms->created_at = Carbon::now();
        $view_sms->updated_at = Carbon::now();
        $view_sms->save(); 
        
        $permission_model = config('access.permission');
        $create_sms = new $permission_model();
        $create_sms->name = 'create-sms';
        $create_sms->display_name = 'Create Sms';
        $create_sms->sort = 4;
        $create_sms->created_at = Carbon::now();
        $create_sms->updated_at = Carbon::now();
        $create_sms->save();

        $permission_model = config('access.permission');
        $delete_sms = new $permission_model();
        $delete_sms->name = 'delete-sms';
        $delete_sms->display_name = 'Delete Sms';
        $delete_sms->sort = 4;
        $delete_sms->created_at = Carbon::now();
        $delete_sms->updated_at = Carbon::now();
        $delete_sms->save();

        $permission_model = config('access.permission');
        $edit_sms = new $permission_model();
        $edit_sms->name = 'edit-sms';
        $edit_sms->display_name = 'Edit Sms';
        $edit_sms->sort = 4;
        $edit_sms->created_at = Carbon::now();
        $edit_sms->updated_at = Carbon::now();
        $edit_sms->save();
    }
}
