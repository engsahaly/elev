<?php

use App\Models\Branch;
use Illuminate\Support\Facades\Auth;

/**
 * Check Permissions of Admin Guard User
 */
function permission($permission)
{
    return (Auth::guard('admin')->user()?->type == 'super_admin' || Auth::guard('admin')->user()?->hasAnyPermission($permission))  ? true : false;
}

/**
 * Check Permissions of Admin Guard User
 */
function super_admin_permission()
{
    return (Auth::guard('admin')->user()?->type == 'super_admin')  ? true : false;
}

/**
 * permission description indicator
 */
function permission_description($permission)
{
    if ($permission != null) {
        echo "<span class='text-danger font-size-12'>(";
        echo __("lang.$permission->name".'_desc') ;
        echo ")</span>";
    }
}