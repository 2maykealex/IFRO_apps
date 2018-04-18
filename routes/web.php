<?php

Route::group(['middleware' => ['auth'], 'namespace' => 'Admin', 'prefix' => 'admin'], function () {
    $this->get('activities', 'ActivityController@index')->name('admin.activities');    
    $this->get('activity', 'ActivityController@index')->name('admin.activity');    
    $this->get('/', 'AdminController@index')->name('admin.home');    

});


$this->get('/', 'Site\SiteController@index');

Auth::routes();
