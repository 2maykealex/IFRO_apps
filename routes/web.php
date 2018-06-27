<?php




Route::group(['middleware' => ['auth', 'authroute'], 'namespace' => 'Site', 'prefix' => 'site'], function () {

    $this->get('certificates/{status}', 'CertificateController@listCertificates')->name('site.certificates'); 
    $this->get('certificates/{status}/{id}', 'CertificateController@listCertificates')->name('site.certificates'); 
    $this->post('certificate-store', 'CertificateController@certificateStore')->name('site.certificate.store');
    $this->get('certificate-upload', 'CertificateController@upload')->name('site.certificate.upload'); 

    $this->get('/', 'SiteController@home')->name('site.home');    

}); 

// ->middleware('authroute')

Route::group(['middleware' => ['auth', 'authroute'], 'namespace' => 'Admin', 'prefix' => 'admin'], function () {

    $this->get('certificates-report/{id}', 'CertificateController@certificatesReport')->name('admin.certificates.report');  
    $this->get('certificate/{id}/{value}', 'CertificateController@validateCertificate')->name('admin.certificate.validate');  
    $this->get('certificates/{status}', 'CertificateController@listCertificates')->name('admin.certificates');  
    $this->get('certificates/{status}/{id}', 'CertificateController@listCertificates')->name('admin.certificates');  

    $this->post('certificate-store', 'CertificateController@certificateStore')->name('admin.certificate.store');     
    $this->get('certificate-upload', 'CertificateController@upload')->name('admin.certificate.upload');  

    $this->post('storeImport', 'StudentController@importExcelStore')->name('admin.student.import'); //ajustar essas rotas
    $this->get('import-students', 'StudentController@importExcel')->name('admin.import.students');
    
    $this->post('student-store', 'StudentController@studentStore')->name('admin.student.store'); 
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
$this->get('/check-user', 'Site\SiteController@checkUser');   //é necessário pois os Menus são diferentes

Auth::routes();
