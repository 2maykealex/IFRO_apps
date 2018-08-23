<?php

Route::group(['middleware' => ['auth', 'authroute'], 'namespace' => 'Site', 'prefix' => 'site'], function () {

    $this->get('certificates/{status}', 'CertificateController@listCertificates')->name('site.certificates'); 
    $this->get('certificates/{status}/{id}', 'CertificateController@listCertificates')->name('site.certificates'); 
    $this->post('certificate-store', 'CertificateController@certificateStore')->name('site.certificate.store');
    $this->get('certificate-upload', 'CertificateController@upload')->name('site.certificate.upload'); 
    
    $this->get('/', 'SiteController@home')->name('site.home');    

}); 

Route::group(['middleware' => ['auth', 'authroute'], 'namespace' => 'Coordinator', 'prefix' => 'coordinator'], function () {

    $this->get('report/complete', 'CertificateController@checkChComplete')->name('coordinator.report.complete');  
    $this->get('report/attestation/{id}', 'CertificateController@attestationReport')->name('coordinator.report.attestation');  

    $this->get('certificate/{id}/{value}', 'CertificateController@validateCertificate')->name('coordinator.certificate.validate');  
    $this->post('validate/reject', 'CertificateController@rejectCertificate')->name('coordinator.certificate.reject');  
     
    $this->get('certificates/{status}/{group}', 'CertificateController@listCertificates')->name('coordinator.certificates'); 
    $this->get('certificates/{status}/{group}/{id}', 'CertificateController@listCertificates')->name('coordinator.certificates');
    $this->get('certificates/{status}', 'CertificateController@listCertificates')->name('coordinator.certificates');        

    $this->post('certificate-store', 'CertificateController@certificateStore')->name('coordinator.certificate.store');     
    $this->get('certificate-upload', 'CertificateController@upload')->name('coordinator.certificate.upload');  

    $this->post('storeImport', 'StudentController@importExcelStore')->name('coordinator.student.import'); //ajustar essas rotas
    $this->get('import-students', 'StudentController@importExcel')->name('coordinator.import.students');

    $this->post('student-store', 'StudentController@studentStore')->name('coordinator.student.store'); 
    $this->get('student-new', 'StudentController@newStudent')->name('coordinator.student.new'); 
    $this->get('student-new/{student}', 'StudentController@newStudent')->name('coordinator.student.new'); 
    $this->get('student/edit/{student}', 'StudentController@newStudent')->name('coordinator.student.edit'); 
    
    $this->get('students/{group}', 'StudentController@students')->name('coordinator.students');     
    $this->get('students/', 'StudentController@students')->name('coordinator.students');   
    $this->get('students-invalided', 'StudentController@studentsInvalided')->name('coordinator.students.invalided');     
    $this->get('student', 'StudentController@student')->name('coordinator.student');         

    $this->post('sign-store', 'CoordinatorController@signStore')->name('coordinator.sign.store');    
       
    $this->get('courses', 'CourseController@courses')->name('coordinator.courses');     

    $this->get('activities', 'ActivityController@activities')->name('coordinator.activities');     
    $this->get('activity', 'ActivityController@index')->name('coordinator.activity');     
      
    $this->get('/', 'CoordinatorController@home')->name('coordinator.home');
});

Route::group(['middleware' => ['auth', 'authroute'], 'namespace' => 'Admin', 'prefix' => 'admin'], function () {   

    $this->post('coordinator-store', 'CoordinatorController@coordinatorStore')->name('admin.coordinator.store'); 
    $this->get('coordinator-new', 'CoordinatorController@coordinatorNew')->name('admin.coordinator.new');    
    $this->get('coordinators', 'CoordinatorController@coordinators')->name('admin.coordinators');     
    $this->get('coordinator', 'CoordinatorController@coordinator')->name('admin.coordinator');     
     
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


$this->post('password-store', 'Site\SiteController@passwordStore')->name('password.store');
$this->get('change-password', 'Site\SiteController@changePassword')->name('change.password');
$this->get('change-password/{reason}', 'Site\SiteController@changePassword')->name('change.password');

$this->get('/', 'Site\SiteController@index');
$this->get('/logout', 'Site\SiteController@logout');

$this->get('/check-user', 'Site\SiteController@checkUser')->name('check-user');   //é necessário pois os Menus são diferentes

Auth::routes();
