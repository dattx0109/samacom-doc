<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Middleware\AuthServiceMiddleware;

Route::get('/login',['as' => 'get-login','uses' => 'Auth\LoginController@getLogin']);
Route::post('/login',['as' => 'post-login','uses' => 'Auth\LoginController@postLogin']);

Route::group(['middleware' => 'authSamacomAdmin'],function (){
    //test
    Route::get('/company/add',['as' => 'add_new_company', 'uses' => 'Company\CompanyControllerTest@getCreateCompany']);
    Route::post('/company/add',['as' => 'add_new_company', 'uses' => 'Company\CompanyControllerTest@postCreateCompany']);

    Route::get('/user', ['as' => 'user', 'uses' => 'User\UserController@getAllUser']);
    Route::post('/user', ['as' => 'user', 'uses' => 'User\UserController@getAllUser']);

    Route::get('/user/add', ['as' => 'user-create', 'uses' => 'User\UserController@create']);
    Route::post('/user/store', ['as' => 'store user', 'uses' => 'User\UserController@store']);
    Route::get('/user/detail/{id}', ['as' => 'user-detail', 'uses' => 'User\UserController@show']);
    Route::post('/user/update/{id}', ['as' => 'update_data_user', 'uses' => 'User\UserController@update']);
    Route::get('/user/delete/{id}', ['as' => 'delete_user', 'uses' => 'User\UserController@destroy']);
    Route::post('/user/change-password/{id}', ['as' => 'change-password', 'uses' => 'User\UserController@changePassword']);
    Route::get('/role/{id}', ['as' => 'role', 'uses' => 'Role\RoleController@getDetailRole']);
    Route::post('/role/{id}', ['as' => 'role', 'uses' => 'Role\RoleController@savePermission']);

    Route::get('/role', ['as' => 'role', 'uses' => 'Role\RoleController@getListRole']);
    Route::get('/delete/{id}', ['as' => 'delete_role', 'uses' => 'Role\RoleController@deleteRoleByRoleId']);
    Route::get('/', ['as' => 'home', 'uses' => 'Home\HomeController@home']);
    Route::get('/notification', ['as' => 'notification', 'uses' => 'Notification\NotificationController@getAllNotification']);
    Route::post('/role', ['as' => 'add role', 'uses' => 'Role\RoleController@addNewRole']);
    Route::get('/role/update/{id}', ['as' => 'role-show-role', 'uses' => 'Role\RoleController@showRole']);
    Route::post('/role/update/{id}', ['as' => 'update role', 'uses' => 'Role\RoleController@updateRoleByRoleId']);
    Route::post('/role-check-permissions', ['as' => 'update role', 'uses' => 'Role\RoleController@checkUserPermissions']);
    Route::get('/company', ['as' => 'company-index', 'uses' => 'Company\CompanyController@index']);
    Route::get('/company/create', ['as' => 'company-create', 'uses' => 'Company\CompanyController@create']);
    Route::get('/company/create-test', ['as' => 'company-create-test', 'uses' => 'Company\TestController@create']);
    Route::post('/company/store', ['as' => 'company-store', 'uses' => 'Company\CompanyController@store']);
    Route::post('/company/store-test', ['as' => 'company-store-test', 'uses' => 'Company\TestController@store']);
    Route::get('/company/list', ['as' => 'list-company', 'uses' => 'Company\CompanyController@getDetail']);
    Route::get('/list/company/{id}', ['as' => 'detail-company', 'uses' => 'Company\CompanyController@getDetailCompany']);
    Route::post('company/update/{id}', ['as' => 'edit-company', 'uses' => 'Company\CompanyController@updateCompany']);
    Route::post('/company/check-name', ['as' => 'company-check-name', 'uses' => 'Company\CompanyController@checkNameCompany']);
    Route::get('/company/delete/{id}', ['as' => 'delete-company', 'uses' => 'Company\CompanyController@delete']);
    Route::get('/detail/company/{id}', ['as' => 'index-company', 'uses' => 'Company\CompanyController@detailCompany']);

    //job
    Route::namespace('Job')->prefix('job')->group(function () {
        Route::get('create', ['as' => 'job-create', 'uses' => 'JobController@create']);
        Route::post('store', ['as' => 'job-store', 'uses' => 'JobController@store']);
        Route::get('detail/{id}', ['as' => 'job-detail', 'uses' => 'JobController@detail']);
        Route::get('show/{id}', ['as' => 'job-show', 'uses' => 'JobController@show']);
        Route::post('update/{id}', ['as' => 'job-update', 'uses' => 'JobController@update']);
        Route::post('change-show/{id}', ['as' => 'job-update', 'uses' => 'JobController@changeShowJob']);
        Route::post('public/{id}', ['as' => 'job-update', 'uses' => 'JobController@publicJob']);
        Route::get('list-apply-job/{id}',['as' => 'list-apply-job', 'uses' => 'JobController@getCvApplyJobByJobId']);
    });
    Route::get('/danh-sach-cong-viec', ['as' => 'list-job', 'uses' => 'Job\JobController@index']);

    Route::get('/workplace/list-district-by-province', ['as' => 'list-district-by-province', 'uses' => 'WorkPlace\WorkPlaceController@getListDistrictByProvince']);

    // Referral
    Route::get('/report-referral', ['as' => 'report-referral', 'uses' => 'Report\ReferralReport@getAllUserReferral']);

    Route::get('/recruitment', ['as' => 'recruitment', 'uses' => 'RecruitmentEmployee\RecruitmentEmployeeController@index']);
    Route::post('/recruitment', ['as' => 'add-recruitment', 'uses' => 'RecruitmentEmployee\RecruitmentEmployeeController@creatRecruitmentEmployeeRepository']);

    Route::get('/list-employer-order', ['as' => 'list-employer-order', 'uses' => 'Employer\EmployerController@listEmployPackageWithStatusOrder']);
    Route::post('approve-request-buy-package/{id}', ['as' => 'approve-request-buy-package', 'uses' => 'Employer\EmployerController@approvedBuyPackage']);

    Route::get('/list-employer-approve', ['as' => 'list-employer-approve', 'uses' => 'Employer\EmployerController@listEmployPackageWithStatusPendingApprove']);
    Route::get('/list-employer-buy-package', ['as' => 'list-employer-buy-package', 'uses' => 'Employer\EmployerController@listEmployerBuyPackage']);
    Route::post('active-package-for-employer/{id}', ['as' => 'approve-request-buy-package', 'uses' => 'Employer\EmployerController@activeEmployPackage']);
    Route::post('buy-product-by-admin', ['as' => 'buy-product-by-admin', 'uses' => 'Employer\EmployerController@buyProductByAdmin']);
    Route::get('/registerEmployer',['as'=>'registerEmployer','uses'=>'Employer\RegisterEmployerController@getregister'])->name('getRegister');
    Route::post('/postRegisterEmployer','Employer\RegisterEmployerController@postRegister')->name('postRegister');

    Route::get('/listEmployer/mail-reset-pass',['as' => 'get-send-pass', 'uses' => 'Employer\ResendMailController@getSendMailResetPass']);
    Route::post('/listEmployer/resend-mail-reset-pass',['as' => 'post-send-pass', 'uses' => 'Employer\ResendMailController@postSendMailResetPass']);

    Route::get('/listEmployer',['as'=>'listEmployer','uses'=>'Employer\EmployerController@listEmployer']);
    Route::get('/package/{id}', ['as' => 'detail-package', 'uses' => 'Package\PackageController@detail']);
    //Account
    Route::namespace('Account')->group(function () {
        Route::post('/postAccount', ['as' => 'postAccount', 'uses' => 'AccountController@postAccount']);
        Route::get('/workplace/list-district-by-province', ['as' => 'list-district-by-province', 'uses' => 'AccountController@getListDistrictByProvince']);
        Route::get('account', ['as' => 'filter-account', 'uses' => 'AccountController@filterAccount']);
        Route::post('account/show-account-to-employer/{id}', ['as' => 'show-account-to-employer', 'uses' => 'AccountController@showAccount']);
        Route::post('account/hide-account-to-employer/{id}', ['as' => 'show-account-to-employer', 'uses' => 'AccountController@hideAccount']);
    });

    // list employer from landing-page
    Route::get('/list-employer-landing-page',['as'=>'list-employer-landing-page','uses'=>'Employer\EmployerFromLandingPageController@listEmployerFromLandingPage']);
    Route::post('advisory-request-buy-package-from-landing-page/{id}', ['as' => 'advisory-request-buy-package', 'uses' => 'Employer\EmployerFromLandingPageController@advisoryEmployPackage']);

});

// tam ly khach hang vaf CV 4D
Route::get('/4d',function (){
    return view('4d.index');
});

Route::post('/them-cv4',['as' => 'them-cv-4', 'uses' => 'Cv4d\Cv4dController@insertCv4']);
Route::get('/tam-ly',['as' => 'list1 job', 'uses' => 'CustomerPsychology\CustomerPsychologyController@index']);
Route::post('/them-tam-ly',['as' => 'them-tam-ly', 'uses' => 'CustomerPsychology\CustomerPsychologyController@insert']);
Route::get('/count-tam-ly-cv-4d',['as' => 'count-tam-ly-cv-4d', 'uses' => 'CustomerPsychologyCv4d\CustomerPsychologyCv4dController@countDataByType']);
Route::get('/list-tam-ly',['as' => 'list-tam-ly', 'uses' => 'CustomerPsychology\CustomerPsychologyController@listTamLy']);
Route::get('/list-cv4d',['as' => 'list-cv4d', 'uses' => 'Cv4d\Cv4dController@listCv4d']);

Route::get('/export/cv4d', 'Cv4d\Cv4dController@export')->name('exportCv4d');
Route::get('/export/tam-ly', 'CustomerPsychology\CustomerPsychologyController@export')->name('exportTamLyKh');

Route::get('pdf_form', 'PdfController@pdfForm');
Route::post('pdf_download', 'PdfController@pdfDownload');
