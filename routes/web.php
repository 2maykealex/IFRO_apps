<?php

Route::group(['middleware' => ['auth'], 'namespace' => 'Admin'], function () {
    $this->get('activity', 'ActivityController@index')->name('admin.activity');    
    $this->get('admin', 'AdminController@index')->name('admin.home');    

});


$this->get('/', 'Site\SiteController@index');

Auth::routes();
