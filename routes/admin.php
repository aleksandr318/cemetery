<?php

Route::get('/home', 'Admin\HomeController@index')->name('home');

/**
 * ROLES
 */
 Route::get('/role/{role}/permissions','Admin\RoleController@permissions');
 Route::get('/rolePermissions','Admin\RoleController@rolePermissions')->name('myrolepermission');
 Route::get('/roles/all','Admin\RoleController@all');
 Route::post('/assignPermission','Admin\RoleController@attachPermission');
 Route::post('/detachPermission','Admin\RoleController@detachPermission');
 Route::resource('/roles','Admin\RoleController');

 /**
  * PERMISSIONs
  */
 Route::get('/permissions/all','Admin\PermissionController@all');
 Route::resource('/permissions','Admin\PermissionController');


 /**
 * ADMINs
 */
Route::get('/profile','Admin\AdminController@profileEdit');
Route::put('/profile/{admin}','Admin\AdminController@profileUpdate');
Route::put('/changepassword/{admin}','Admin\AdminController@changePassword');
Route::put('/administrator/status','Admin\AdminController@switchStatus');
Route::post('/administrator/removeBulk','Admin\AdminController@destroyBulk');
Route::put('/administrator/statusBulk','Admin\AdminController@switchStatusBulk');
Route::resource('/administrator','Admin\AdminController');

/**
 * USERS
 */
Route::put('/user/status','Admin\UserController@switchStatus');
Route::post('/user/removeBulk','Admin\UserController@destroyBulk');
Route::put('/user/statusBulk','Admin\UserController@switchStatusBulk');
Route::get('/user/{id}/cellar','Admin\UserController@showUserCellar');
Route::resource('/user','Admin\UserController');



Route::get('/logout', 'Admin\HomeController@logout');
Route::get('/ViewProfile', 'Admin\HomeController@ViewProfile');
Route::get('/EditProfileView', 'Admin\HomeController@EditProfileView');
Route::post('/EditProfilePost', 'Admin\HomeController@EditProfilePost');

Route::get('/WorkerManagementView', 'Admin\AccountController@WorkerManagementView');
Route::get('/AddWorkerView', 'Admin\AccountController@AddWorkerView');
Route::get('/WorkerDetailView/{id}', 'Admin\AccountController@WorkerDetailView');
Route::get('/EditWorkerView/{id}', 'Admin\AccountController@EditWorkerView');
Route::post('/AddWorkerPost', 'Admin\AccountController@AddWorkerPost');
Route::post('/EditWorkerPost', 'Admin\AccountController@EditWorkerPost');
Route::post('/RemoveWorkerPost', 'Admin\AccountController@RemoveWorkerPost');

Route::get('/UserManagementView', 'Admin\AccountController@UserManagementView');
Route::get('/AddUserView', 'Admin\AccountController@AddUserView');
Route::get('/UserDetailView/{id}', 'Admin\AccountController@UserDetailView');
Route::get('/EditUserView/{id}', 'Admin\AccountController@EditUserView');
Route::post('/AddUserPost', 'Admin\AccountController@AddUserPost');
Route::post('/EditUserPost', 'Admin\AccountController@EditUserPost');
Route::post('/RemoveUserPost', 'Admin\AccountController@RemoveUserPost');



/* Ajax post start */

Route::post('GetSectionPost', 'Admin\PlotController@GetSectionPost');
Route::post('GetLotPost', 'Admin\PlotController@GetLotPost');

/* end */


Route::get('/MountManagementView', 'Admin\PlotController@MountManagementView');
Route::get('/AddMountView', 'Admin\PlotController@AddMountView');
Route::post('/AddMountPost', 'Admin\PlotController@AddMountPost');
Route::get('/EditMountView/{id}', 'Admin\PlotController@EditMountView');
Route::post('/EditMountPost', 'Admin\PlotController@EditMountPost');
Route::post('/RemoveMountPost', 'Admin\PlotController@RemoveMountPost');
Route::get('/AddSectionView/{id}', 'Admin\PlotController@AddSectionView');
Route::post('/AddSectionPost', 'Admin\PlotController@AddSectionPost');
Route::get('/EditSectionView/{id}', 'Admin\PlotController@EditSectionView');
Route::post('/EditSectionPost', 'Admin\PlotController@EditSectionPost');
Route::post('/RemoveSectionPost', 'Admin\PlotController@RemoveSectionPost');
Route::get('/AddLotView/{id}', 'Admin\PlotController@AddLotView');
Route::post('/AddLotPost', 'Admin\PlotController@AddLotPost');
Route::get('/EditLotView/{id}', 'Admin\PlotController@EditLotView');
Route::post('/EditLotPost', 'Admin\PlotController@EditLotPost');
Route::post('/RemoveLotPost', 'Admin\PlotController@RemoveLotPost');
Route::get('/PlotsView', 'Admin\PlotController@PlotsView');
Route::get('/AddPlotView', 'Admin\PlotController@AddPlotView');
Route::post('/AddPlotPost', 'Admin\PlotController@AddPlotPost');
Route::post('/getSections', 'Admin\PlotController@getSections');
Route::post('/getLots', 'Admin\PlotController@getLots');
Route::post('/getPlotInfos', 'Admin\PlotController@getPlotInfos');
Route::post('/getPlots', 'Admin\PlotController@getPlots');
Route::get('/PlotDetail/{id}', 'Admin\PlotController@PlotDetail');
Route::post("/AddBurialInPlot", 'Admin\PlotController@AddBurialInPlot');
Route::get('/AllPlotMapView', 'Admin\PlotController@AllPlotMapView');
Route::post('/RemoveBurialInPost', 'Admin\PlotController@RemoveBurialInPost');


Route::get('/RequestedBurialsView', 'Admin\BurialController@RequestedBurialsView');
Route::get('/BurialManagementView', 'Admin\BurialController@BurialManagementView');
Route::get('/AddBurialView', 'Admin\BurialController@AddBurialView');
Route::get('/EditBurialView/{id}', 'Admin\BurialController@EditBurialView');
Route::post('/AddBurialPost', 'Admin\BurialController@AddBurialPost');
Route::post('/EditBurialPost', 'Admin\BurialController@EditBurialPost');
Route::post('/RemoveBurialPost', 'Admin\BurialController@RemoveBurialPost');
