<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/
$route['default_controller'] = 'user/index';
$route['404_override'] = '';

/*user/settings*/
$route['admin'] = 'user/index';
$route['admin/signup'] = 'user/signup';
$route['admin/create_member'] = 'user/create_member';
$route['admin/login'] = 'user/index';
$route['admin/logout'] = 'user/logout';
$route['admin/changepermission/(:any)'] = 'user/change_user_permission/$1';
$route['admin/login/validate_credentials'] = 'user/validate_credentials';

/* deliveries */
$route['admin/deliveries'] = 'admin_deliveries/index';

$route['admin/deliveries/add'] = 'admin_deliveries/add';
$route['admin/deliveries/update'] = 'admin_deliveries/update';
$route['admin/deliveries/update/(:any)'] = 'admin_deliveries/update/$1';
$route['admin/deliveries/delete/(:any)'] = 'admin_deliveries/delete/$1';


// attach facilities to delivery
$route['admin/deliveries/add_facility'] = 'admin_deliveries/add_facility';
$route['admin/deliveries/add_facility/(:num)'] = 'admin_deliveries/add_facility/$1';
$route['admin/deliveries/add_facility/(:num)/(:num)'] = 'admin_deliveries/add_facility/$1/$2';
// delete facilities from delivery
$route['admin/deliveries/delete_facility/(:any)'] = 'admin_deliveries/delete_facility/$1';
// put index pg pagination routing last otherwise stuff will f up.
$route['admin/deliveries/(:any)'] = 'admin_deliveries/index/$1'; //$1 = page number

/* facilities */
$route['admin/facilities'] = 'admin_facilities/index';
$route['admin/facilities/add'] = 'admin_facilities/add';
$route['admin/facilities/update'] = 'admin_facilities/update';
$route['admin/facilities/update/(:any)'] = 'admin_facilities/update/$1';
$route['admin/facilities/delete/(:any)'] = 'admin_facilities/delete/$1';
$route['admin/facilities/(:any)'] = 'admin_facilities/index/$1'; //$1 = page number

// drivers
$route['admin/drivers'] = 'admin_drivers/index';
// vehicle search
$route['admin/vehicles/get_vehicle_by_registration'] = 'admin_vehicles/get_vehicle_by_registration/$1';
$route['admin/vehicles/get_vehicle_by_registration/(:any)'] = 'admin_vehicles/get_vehicle_by_registration/$1';
/* supplier routes */
$route['admin/suppliers'] = 'admin_suppliers/index';
/* dashboard */
$route['admin/dashboard'] = 'admin_dashboard/index';


/* End of file routes.php */
/* Location: ./application/config/routes.php */