<?php

Route::group(['middleware' => ['auth'], 'namespace' => 'Admin', 'prefix' => 'admin'], function () {

    $this->get('coordinators', 'CoordinatorController@coordinators')->name('admin.coordinators');    
    $this->get('coordinator', 'CoordinatorController@coordinator')->name('admin.coordinator');    
    // $this->get('coord-course', 'CoordinatorController@course')->name('admin.coordinator.course');    


    $this->get('area-course', 'CourseController@areaCurso')->name('admin.area.course');    
    $this->get('courses-area', 'AreaController@courses')->name('admin.courses.area');    
    
    $this->post('course-store', 'CourseController@courseStore')->name('admin.course.store');
    $this->get('course-new', 'CourseController@newCourse')->name('admin.courses');    
    $this->get('courses', 'CourseController@courses')->name('admin.courses');    

    $this->post('activity-store', 'ActivityController@activityStore')->name('admin.activity.store');    
    $this->get('activity-new', 'ActivityController@newActivity')->name('admin.activity.new');    
    $this->get('activities', 'ActivityController@activities')->name('admin.activities');    
    $this->get('activity', 'ActivityController@index')->name('admin.activity');    
    $this->get('/', 'AdminController@index')->name('admin.home');    

});


$this->get('/', 'Site\SiteController@index');

Auth::routes();
