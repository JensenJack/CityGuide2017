<?php

namespace Modules\Booking\Database\Seeders;
use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class BookingDatabaseSeeder extends Seeder
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
        $module = strtolower('Booking');
        $permission_model = config('access.permission');
        $view_permission = new $permission_model();
        $view_permission->name = 'view-'.$module;
        $view_permission->display_name = 'View Booking';
        $view_permission->sort = \Module::count()+1;
        $view_permission->created_at = Carbon::now();
        $view_permission->updated_at = Carbon::now();
        $view_permission->save();

        $permission_model = config('access.permission');
        $create_permission = new $permission_model();
        $create_permission->name = 'create-'.$module;
        $create_permission->display_name = 'Create Booking';
        $create_permission->sort = \Module::count()+1;
        $create_permission->created_at = Carbon::now();
        $create_permission->updated_at = Carbon::now();
        $create_permission->save();

        $permission_model = config('access.permission');
        $edit_permission = new $permission_model();
        $edit_permission->name = 'edit-'.$module;
        $edit_permission->display_name = 'Edit Booking';
        $edit_permission->sort = \Module::count()+1;
        $edit_permission->created_at = Carbon::now();
        $edit_permission->updated_at = Carbon::now();
        $edit_permission->save();

        $permission_model = config('access.permission');
        $delete_permission = new $permission_model();
        $delete_permission->name = 'delete-'.$module;
        $delete_permission->display_name = 'Delete Booking';
        $delete_permission->sort = \Module::count()+1;
        $delete_permission->created_at = Carbon::now();
        $delete_permission->updated_at = Carbon::now();
        $delete_permission->save();

        $permission_model = config('access.permission');
        $deletedBooking_permission = new $permission_model();
        $deletedBooking_permission->name = 'view-deleteBooking';
        $deletedBooking_permission->display_name = 'View Deleted Booking';
        $deletedBooking_permission->sort = \Module::count()+1;
        $deletedBooking_permission->created_at = Carbon::now();
        $deletedBooking_permission->updated_at = Carbon::now();
        $deletedBooking_permission->save();

        $permission_model = config('access.permission');
        $restoreBooking_permission = new $permission_model();
        $restoreBooking_permission->name = 'restore-booking';
        $restoreBooking_permission->display_name = 'Restore Booking';
        $restoreBooking_permission->sort = \Module::count()+1;
        $restoreBooking_permission->created_at = Carbon::now();
        $restoreBooking_permission->updated_at = Carbon::now();
        $restoreBooking_permission->save();

        $permission_model = config('access.permission');
        $forceDeleteBooking_permission = new $permission_model();
        $forceDeleteBooking_permission->name = 'forceDelete-booking';
        $forceDeleteBooking_permission->display_name = 'Force Delete Booking';
        $forceDeleteBooking_permission->sort = \Module::count()+1;
        $forceDeleteBooking_permission->created_at = Carbon::now();
        $forceDeleteBooking_permission->updated_at = Carbon::now();
        $forceDeleteBooking_permission->save();
    }
}
