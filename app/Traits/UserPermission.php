<?php


namespace App\Traits;
use Auth;

trait UserPermission {


    public function checkRequestPermission()
    {
        if(
            // user
            empty(Auth::user()->roleInfo->permissionInfo['permission']['user']['list']) && \Route::is('user.index') ||
            empty(Auth::user()->roleInfo->permissionInfo['permission']['user']['add']) && \Route::is('user.add') ||
            empty(Auth::user()->roleInfo->permissionInfo['permission']['user']['edit']) && \Route::is('user.edit') ||
            empty(Auth::user()->roleInfo->permissionInfo['permission']['user']['view']) && \Route::is('user.view') ||
            empty(Auth::user()->roleInfo->permissionInfo['permission']['user']['delete']) && \Route::is('user.delete') ||
            // user
            //permission 
            empty(Auth::user()->roleInfo->permissionInfo['permission']['permission']['list']) && \Route::is('permission.index') ||
            empty(Auth::user()->roleInfo->permissionInfo['permission']['permission']['add']) && \Route::is('permission.add') ||
            empty(Auth::user()->roleInfo->permissionInfo['permission']['permission']['edit']) && \Route::is('permission.edit') ||
            empty(Auth::user()->roleInfo->permissionInfo['permission']['permission']['delete']) && \Route::is('permission.delete') ||
            //permission 
            //role 
            empty(Auth::user()->roleInfo->permissionInfo['permission']['role']['list']) && \Route::is('role.index') ||
            empty(Auth::user()->roleInfo->permissionInfo['permission']['role']['add']) && \Route::is('role.add') ||
            empty(Auth::user()->roleInfo->permissionInfo['permission']['role']['edit']) && \Route::is('role.edit') ||
            empty(Auth::user()->roleInfo->permissionInfo['permission']['role']['delete']) && \Route::is('role.delete') 
            //role 
        ){
            return response()->view('welcome');
        }
    }

}