<?php

Route::group(['middleware' => ['auth'], 'namespace' => 'Site', 'prefix' => 'site'], function () {

    $this->get('certificates', 'CertificateController@certificatesPending')->name('site.certificates'); 
    $this->get('certificates-accepted', 'CertificateController@certificatesAccepted')->name('site.certificate.accepted'); 
    $this->get('certificates-rejected', 'CertificateController@certificatesRejected')->name('site.certificate.rejected'); 
    $this->post('certificate-store', 'CertificateController@certificateStore')->name('site.certificate.store');    
    $this->get('certificate-upload', 'CertificateController@upload')->name('site.certificate.upload'); 

    $this->get('/', 'SiteController@home')->name('site.home');    

}); 



Route::group(['middleware' => ['auth'], 'namespace' => 'Admin', 'prefix' => 'admin'], function () {


    $this->get('certificate/{id}/{value}', 'CertificateController@validateCertificate')->name('admin.certificate.validate'); 
    $this->get('certificates', 'CertificateController@certificatesPending')->name('admin.certificates'); 
    $this->get('certificates-accepted', 'CertificateController@certificatesAccepted')->name('admin.certificate.accepted'); 
    $this->get('certificates-rejected', 'CertificateController@certificatesRejected')->name('admin.certificate.rejected'); 
    $this->post('certificate-store', 'CertificateController@certificateStore')->name('admin.certificate.store');    
    $this->get('certificate-upload', 'CertificateController@upload')->name('admin.certificate.upload'); 

    $this->post('student-store', 'CourseController@studentStore')->name('admin.student.store');
    $this->get('students', 'StudentController@students')->name('admin.students');    
    $this->get('student', 'StudentController@student')->name('admin.student');    
    $this->get('student-new', 'StudentController@newStudent')->name('admin.student.new');

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
$this->get('/check-user', 'Site\SiteController@checkUser');

Auth::routes();
