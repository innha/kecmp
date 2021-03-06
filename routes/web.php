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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin/districts/get/{province_id}', 'GetParamsController@getDistricts');
Route::get('/admin/sectors/get/{district_id}', 'GetParamsController@getSectors');
Route::get('/admin/cells/get/{sector_id}', 'GetParamsController@getCells');
Route::get('/admin/villages/get/{cell_id}', 'GetParamsController@getVillages');

Route::get('/admin/parishes/get/{diocese_id}', 'GetParamsController@getParishes');
Route::get('/admin/chapelles/get/{parish_id}', 'GetParamsController@getChapelles');
Route::get('/admin/zones/get/{chapelle_id}', 'GetParamsController@getZones');

Route::post('/admin/registrations/search', 'AdminRegistrationsController@search');
Route::get('/admin/registrations/search/ajax', array('as' => 'admin.registrations.search.ajax', 'uses' => 'AdminRegistrationsController@searchAjax'));
Route::get('/admin/cells/search/ajax', array('as' => 'admin.cells.search.ajax', 'uses' => 'AdminCellsController@searchAjax'));
Route::get('/admin/parishes/search/ajax', array('as' => 'admin.parishes.search.ajax', 'uses' => 'AdminParishesController@searchAjax'));
Route::post('/admin/users/search', 'AdminUsersController@search');

//post params
Route::post('/admin/villages/store', 'AdminVillagesController@store');
Route::post('/admin/cells/store', 'AdminCellsController@store');
Route::post('/admin/sectors/store', 'AdminSectorsController@store');
Route::post('/admin/districts/store', 'AdminDistrictsController@store');
Route::post('/admin/provinces/store', 'AdminProvincesController@store');

Route::post('/admin/zones/store', 'AdminZonesController@store');
Route::post('/admin/chapelles/store', 'AdminChapellesController@store');
Route::post('/admin/parishes/store', 'AdminParishesController@store');
Route::post('/admin/dioceses/store', 'AdminDiocesesController@store');

Route::post('/admin/categories/store', 'AdminCategoriesController@store');
Route::post('/admin/choirs/store', 'AdminChoirsController@store');
Route::post('/admin/commissions/store', 'AdminCommissionsController@store');
Route::post('/admin/degrees/store', 'AdminDegreesController@store');
Route::post('/admin/duties/store', 'AdminDutiesController@store');
Route::post('/admin/privileges/store', 'AdminPrivilegesController@store');
Route::post('/admin/roles/store', 'AdminRolesController@store');
Route::post('/admin/services/store', 'AdminServicesController@store');
Route::post('/admin/statuses/store', 'AdminStatusesController@store');
Route::post('/admin/types/store', 'AdminTypesController@store');
Route::post('/admin/tasks/store', 'AdminTasksController@store');

//return cells, sectors, districts, provinces as array to populate dropdown lists
Route::get('/admin/param/villages', 'AdminVillagesController@list');
Route::get('/admin/param/cells', 'AdminCellsController@list');
Route::get('/admin/param/sectors', 'AdminSectorsController@list');
Route::get('/admin/param/districts', 'AdminDistrictsController@list');
Route::get('/admin/param/provinces', 'AdminProvincesController@list');

Route::get('/admin/param/zones', 'AdminZonesController@list');
Route::get('/admin/param/chapelles', 'AdminChapellesController@list');
Route::get('/admin/param/parishes', 'AdminParishesController@list');
Route::get('/admin/param/dioceses', 'AdminDiocesesController@list');


Route::resource('/admin/baptisms', 'AdminBaptismsController', ['as' => 'admin'], 
	['name' => [

		'admin/baptisms' => 'admin.baptisms.index',
		'create' => 'admin.baptisms.create',
		'store' => 'admin.baptisms.store',
		'show' => 'admin.baptisms.show',
		'edit' => 'admin.baptisms.edit',
		'update' => 'admin.baptisms.update',
		'destroy' => 'admin.baptisms.destroy'
	]]
);

Route::resource('/admin/bridals', 'AdminBridalsController', ['as' => 'admin'], 
	['name' => [

		'admin/bridals' => 'admin.bridals.index',
		'create' => 'admin.bridals.create',
		'store' => 'admin.bridals.store',
		'show' => 'admin.bridals.show',
		'edit' => 'admin.bridals.edit',
		'update' => 'admin.bridals.update',
		'destroy' => 'admin.bridals.destroy'
	]]
);

Route::resource('/admin/burials', 'AdminBurialsController', ['as' => 'admin'], 
	['name' => [

		'admin/burials' => 'admin.burials.index',
		'create' => 'admin.burials.create',
		'store' => 'admin.burials.store',
		'show' => 'admin.burials.show',
		'edit' => 'admin.burials.edit',
		'update' => 'admin.burials.update',
		'destroy' => 'admin.burials.destroy'
	]]
);

Route::resource('/admin/categories', 'AdminCategoriesController', ['as' => 'admin'], 
	['name' => [

		'admin/categories' => 'admin.categories.index',
		'create' => 'admin.categories.create',
		'store' => 'admin.categories.store',
		'show' => 'admin.categories.show',
		'edit' => 'admin.categories.edit',
		'update' => 'admin.categories.update',
		'destroy' => 'admin.categories.destroy'
	]]
);

Route::resource('/admin/cells', 'AdminCellsController', ['as' => 'admin'], 
	['name' => [

		'admin/cells' => 'admin.cells.index',
		'create' => 'admin.cells.create',
		'store' => 'admin.cells.store',
		'show' => 'admin.cells.show',
		'edit' => 'admin.cells.edit',
		'update' => 'admin.cells.update',
		'destroy' => 'admin.cells.destroy'
	]]
);

Route::resource('/admin/chapelles', 'AdminChapellesController', ['as' => 'admin'], 
	['name' => [

		'admin/chapelles' => 'admin.chapelles.index',
		'create' => 'admin.chapelles.create',
		'store' => 'admin.chapelles.store',
		'show' => 'admin.chapelles.show',
		'edit' => 'admin.chapelles.edit',
		'update' => 'admin.chapelles.update',
		'destroy' => 'admin.chapelles.destroy'
	]]
);

Route::resource('/admin/choirs', 'AdminChoirsController', ['as' => 'admin'], 
	['name' => [

		'admin/choirs' => 'admin.choirs.index',
		'create' => 'admin.choirs.create',
		'store' => 'admin.choirs.store',
		'show' => 'admin.choirs.show',
		'edit' => 'admin.choirs.edit',
		'update' => 'admin.choirs.update',
		'destroy' => 'admin.choirs.destroy'
	]]
);

Route::resource('/admin/commissions', 'AdminCommissionsController', ['as' => 'admin'], 
	['name' => [

		'admin/commissions' => 'admin.commissions.index',
		'create' => 'admin.commissions.create',
		'store' => 'admin.commissions.store',
		'show' => 'admin.commissions.show',
		'edit' => 'admin.commissions.edit',
		'update' => 'admin.commissions.update',
		'destroy' => 'admin.commissions.destroy'
	]]
);

Route::resource('/admin/commission_reports', 'AdminCommissionReportsController', ['as' => 'admin'], 
	['name' => [

		'admin/commission_reports' => 'admin.commission_reports.index',
		'create' => 'admin.commission_reports.create',
		'store' => 'admin.commission_reports.store',
		'show' => 'admin.commission_reports.show',
		'edit' => 'admin.commission_reports.edit',
		'update' => 'admin.commission_reports.update',
		'destroy' => 'admin.commission_reports.destroy'
	]]
);

Route::resource('/admin/degrees', 'AdminDegreesController', ['as' => 'admin'], 
	['name' => [

		'admin/degrees' => 'admin.degrees.index',
		'create' => 'admin.degrees.create',
		'store' => 'admin.degrees.store',
		'show' => 'admin.degrees.show',
		'edit' => 'admin.degrees.edit',
		'update' => 'admin.degrees.update',
		'destroy' => 'admin.degrees.destroy'
	]]
);

Route::resource('/admin/dioceses', 'AdminDiocesesController', ['as' => 'admin'], 
	['name' => [

		'admin/dioceses' => 'admin.dioceses.index',
		'create' => 'admin.dioceses.create',
		'store' => 'admin.dioceses.store',
		'show' => 'admin.dioceses.show',
		'edit' => 'admin.dioceses.edit',
		'update' => 'admin.dioceses.update',
		'destroy' => 'admin.dioceses.destroy'
	]]
);

Route::resource('/admin/districts', 'AdminDistrictsController', ['as' => 'admin'], 
	['name' => [

		'admin/districts' => 'admin.districts.index',
		'create' => 'admin.districts.create',
		'store' => 'admin.districts.store',
		'show' => 'admin.districts.show',
		'edit' => 'admin.districts.edit',
		'update' => 'admin.districts.update',
		'destroy' => 'admin.districts.destroy'
	]]
);

Route::resource('/admin/duties', 'AdminDutiesController', ['as' => 'admin'], 
	['name' => [

		'admin/duties' => 'admin.duties.index',
		'create' => 'admin.duties.create',
		'store' => 'admin.duties.store',
		'show' => 'admin.duties.show',
		'edit' => 'admin.duties.edit',
		'update' => 'admin.duties.update',
		'destroy' => 'admin.duties.destroy'
	]]
);

Route::resource('/admin/kids', 'AdminKidsController', ['as' => 'admin'], 
	['name' => [

		'admin/kids' => 'admin.kids.index',
		'create' => 'admin.kids.create',
		'store' => 'admin.kids.store',
		'show' => 'admin.kids.show',
		'edit' => 'admin.kids.edit',
		'update' => 'admin.kids.update',
		'destroy' => 'admin.kids.destroy'
	]]
);

Route::resource('/admin/literacies', 'AdminLiteraciesController', ['as' => 'admin'], 
	['name' => [

		'admin/literacies' => 'admin.literacies.index',
		'create' => 'admin.literacies.create',
		'store' => 'admin.literacies.store',
		'show' => 'admin.literacies.show',
		'edit' => 'admin.literacies.edit',
		'update' => 'admin.literacies.update',
		'destroy' => 'admin.literacies.destroy'
	]]
);

Route::resource('/admin/marriages', 'AdminMarriagesController', ['as' => 'admin'], 
	['name' => [

		'admin/marriages' => 'admin.marriages.index',
		'create' => 'admin.marriages.create',
		'store' => 'admin.marriages.store',
		'show' => 'admin.marriages.show',
		'edit' => 'admin.marriages.edit',
		'update' => 'admin.marriages.update',
		'destroy' => 'admin.marriages.destroy'
	]]
);

Route::resource('/admin/parishes', 'AdminParishesController', ['as' => 'admin'], 
	['name' => [

		'admin/parishes' => 'admin.parishes.index',
		'create' => 'admin.parishes.create',
		'store' => 'admin.parishes.store',
		'show' => 'admin.parishes.show',
		'edit' => 'admin.parishes.edit',
		'update' => 'admin.parishes.update',
		'destroy' => 'admin.parishes.destroy'
	]]
);

Route::resource('/admin/preachings', 'AdminPreachingsController', ['as' => 'admin'], 
	['name' => [

		'admin/preachings' => 'admin.preachings.index',
		'create' => 'admin.preachings.create',
		'store' => 'admin.preachings.store',
		'show' => 'admin.preachings.show',
		'edit' => 'admin.preachings.edit',
		'update' => 'admin.preachings.update',
		'destroy' => 'admin.preachings.destroy'
	]]
);

Route::resource('/admin/privileges', 'AdminPrivilegesController', ['as' => 'admin'], 
	['name' => [

		'admin/privileges' => 'admin.privileges.index',
		'create' => 'admin.privileges.create',
		'store' => 'admin.privileges.store',
		'show' => 'admin.privileges.show',
		'edit' => 'admin.privileges.edit',
		'update' => 'admin.privileges.update',
		'destroy' => 'admin.privileges.destroy'
	]]
);

Route::resource('/admin/provinces', 'AdminProvincesController', ['as' => 'admin'], 
	['name' => [

		'admin/provinces' => 'admin.provinces.index',
		'create' => 'admin.provinces.create',
		'store' => 'admin.provinces.store',
		'show' => 'admin.provinces.show',
		'edit' => 'admin.provinces.edit',
		'update' => 'admin.provinces.update',
		'destroy' => 'admin.provinces.destroy'
	]]
);

Route::resource('/admin/receptions', 'AdminReceptionsController', ['as' => 'admin'], 
	['name' => [

		'admin/receptions' => 'admin.receptions.index',
		'create' => 'admin.receptions.create',
		'store' => 'admin.receptions.store',
		'show' => 'admin.receptions.show',
		'edit' => 'admin.receptions.edit',
		'update' => 'admin.receptions.update',
		'destroy' => 'admin.receptions.destroy'
	]]
);

Route::resource('/admin/recommendations', 'AdminRecommendationsController', ['as' => 'admin'], 
	['name' => [

		'admin/recommendations' => 'admin.recommendations.index',
		'create' => 'admin.recommendations.create',
		'store' => 'admin.recommendations.store',
		'show' => 'admin.recommendations.show',
		'edit' => 'admin.recommendations.edit',
		'update' => 'admin.recommendations.update',
		'destroy' => 'admin.recommendations.destroy'
	]]
);

Route::resource('/admin/registrations', 'AdminRegistrationsController', ['as' => 'admin'], 
	['name' => [

		'admin/registrations' => 'admin.registrations.index',
		'create' => 'admin.registrations.create',
		'store' => 'admin.registrations.store',
		'show' => 'admin.registrations.show',
		'edit' => 'admin.registrations.edit',
		'update' => 'admin.registrations.update',
		'destroy' => 'admin.registrations.destroy'		
	]]
);

Route::resource('/admin/repentings', 'AdminRepentingsController', ['as' => 'admin'], 
	['name' => [

		'admin/repentings' => 'admin.repentings.index',
		'create' => 'admin.repentings.create',
		'store' => 'admin.repentings.store',
		'show' => 'admin.repentings.show',
		'edit' => 'admin.repentings.edit',
		'update' => 'admin.repentings.update',
		'destroy' => 'admin.repentings.destroy'
	]]
);

Route::resource('/admin/roles', 'AdminRolesController', ['as' => 'admin'], 
	['name' => [

		'admin/roles' => 'admin.roles.index',
		'create' => 'admin.roles.create',
		'store' => 'admin.roles.store',
		'show' => 'admin.roles.show',
		'edit' => 'admin.roles.edit',
		'update' => 'admin.roles.update',
		'destroy' => 'admin.roles.destroy'
	]]
);

Route::resource('/admin/sectors', 'AdminSectorsController', ['as' => 'admin'], 
	['name' => [

		'admin/sectors' => 'admin.sectors.index',
		'create' => 'admin.sectors.create',
		'store' => 'admin.sectors.store',
		'show' => 'admin.sectors.show',
		'edit' => 'admin.sectors.edit',
		'update' => 'admin.sectors.update',
		'destroy' => 'admin.sectors.destroy'
	]]
);

Route::resource('/admin/services', 'AdminServicesController', ['as' => 'admin'], 
	['name' => [

		'admin/services' => 'admin.services.index',
		'create' => 'admin.services.create',
		'store' => 'admin.services.store',
		'show' => 'admin.services.show',
		'edit' => 'admin.services.edit',
		'update' => 'admin.services.update',
		'destroy' => 'admin.services.destroy'
	]]
);

Route::resource('/admin/statuses', 'AdminStatusesController', ['as' => 'admin'], 
	['name' => [

		'admin/statuses' => 'admin.statuses.index',
		'create' => 'admin.statuses.create',
		'store' => 'admin.statuses.store',
		'show' => 'admin.statuses.show',
		'edit' => 'admin.statuses.edit',
		'update' => 'admin.statuses.update',
		'destroy' => 'admin.statuses.destroy'
	]]
);

Route::resource('/admin/suspensions', 'AdminSuspensionsController', ['as' => 'admin'], 
	['name' => [

		'admin/suspensions' => 'admin.suspensions.index',
		'create' => 'admin.suspensions.create',
		'store' => 'admin.suspensions.store',
		'show' => 'admin.suspensions.show',
		'edit' => 'admin.suspensions.edit',
		'update' => 'admin.suspensions.update',
		'destroy' => 'admin.suspensions.destroy'
	]]
);

Route::resource('/admin/teachings', 'AdminTeachingsController', ['as' => 'admin'], 
	['name' => [

		'admin/teachings' => 'admin.teachings.index',
		'create' => 'admin.teachings.create',
		'store' => 'admin.teachings.store',
		'show' => 'admin.teachings.show',
		'edit' => 'admin.teachings.edit',
		'update' => 'admin.teachings.update',
		'destroy' => 'admin.teachings.destroy'
	]]
);

Route::resource('/admin/types', 'AdminTypesController', ['as' => 'admin'], 
	['name' => [

		'admin/types' => 'admin.types.index',
		'create' => 'admin.types.create',
		'store' => 'admin.types.store',
		'show' => 'admin.types.show',
		'edit' => 'admin.types.edit',
		'update' => 'admin.types.update',
		'destroy' => 'admin.types.destroy'
	]]
);

Route::resource('/admin/tasks', 'AdminTasksController', ['as' => 'admin'], 
	['name' => [

		'admin/tasks' => 'admin.tasks.index',
		'create' => 'admin.tasks.create',
		'store' => 'admin.tasks.store',
		'show' => 'admin.tasks.show',
		'edit' => 'admin.tasks.edit',
		'update' => 'admin.tasks.update',
		'destroy' => 'admin.tasks.destroy'
	]]
);

Route::resource('/admin/users', 'AdminUsersController', ['as' => 'admin'], 
	['name' => [

		'admin/users' => 'admin.users.index',
		'create' => 'admin.users.create',
		'store' => 'admin.users.store',
		'show' => 'admin.users.show',
		'edit' => 'admin.users.edit',
		'update' => 'admin.users.update',
		'destroy' => 'admin.users.destroy'
	]]
);

Route::resource('/admin/villages', 'AdminVillagesController', ['as' => 'admin'], 
	['name' => [

		'admin/villages' => 'admin.villages.index',
		'create' => 'admin.villages.create',
		'store' => 'admin.villages.store',
		'show' => 'admin.villages.show',
		'edit' => 'admin.villages.edit',
		'update' => 'admin.villages.update',
		'destroy' => 'admin.villages.destroy'
	]]
);

Route::resource('/admin/zones', 'AdminZonesController', ['as' => 'admin'], 
	['name' => [

		'admin/zones' => 'admin.zones.index',
		'create' => 'admin.zones.create',
		'store' => 'admin.zones.store',
		'show' => 'admin.zones.show',
		'edit' => 'admin.zones.edit',
		'update' => 'admin.zones.update',
		'destroy' => 'admin.zones.destroy'
	]]
);


Route::resource('/admin/users', 'AdminUsersController', ['as' => 'admin'], 
	['name' => [

		'admin/users' => 'admin.users.index',
		'create' => 'admin.users.create',
		'store' => 'admin.users.store',
		'show' => 'admin.users.show',
		'edit' => 'admin.users.edit',
		'update' => 'admin.users.update',
		'destroy' => 'admin.users.destroy'
	]]
);

Route::resource('/admin/singers', 'AdminSingersController', ['as' => 'admin'], 
	['name' => [

		'admin/singers' => 'admin.singers.index',
		'create' => 'admin.singers.create',
		'store' => 'admin.singers.store',
		'show' => 'admin.singers.show',
		'edit' => 'admin.singers.edit',
		'update' => 'admin.singers.update',
		'destroy' => 'admin.singers.destroy'
	]]
);