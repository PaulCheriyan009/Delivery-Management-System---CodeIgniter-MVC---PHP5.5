<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//$route['default_controller'] = 'user/index';
$route['default_controller'] = 'frontend/home';
$route['404_override'] = '';
/*user/settings*/
$route['admin'] = 'user/index';
$route['admin/forbidden'] = 'user/unauthorized_access';
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
$route['admin/deliveries/add_facility/(:num)/(:num)/(:any)/(:any)'] = 'admin_deliveries/add_facility/$1/$2/$3/$4';
$route['admin/deliveries/update_facility_status/(:num)'] = 'admin_deliveries/update_individual_facility_status/$1';
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
$route['admin/drivers/delete/(:num)'] = 'admin_drivers/delete/$1';
$route['admin/drivers/update/(:num)'] = 'admin_drivers/update/$1';
$route['admin/drivers/add'] = 'admin_drivers/add';
// pagination stuff
$route['admin/drivers/(:any)'] = 'admin_drivers/index/$1';

// vehicle search
$route['admin/vehicles'] = 'admin_vehicles/index';
$route['admin/vehicles/update/(:num)'] = 'admin_vehicles/update/$1';
$route['admin/vehicles/add'] = 'admin_vehicles/add';
$route['admin/vehicles/get_vehicle_by_registration'] = 'admin_vehicles/get_vehicle_by_registration/$1';
$route['admin/vehicles/get_vehicle_by_registration/(:any)'] = 'admin_vehicles/get_vehicle_by_registration/$1';
$route['admin/vehicles/delete/(:num)'] = 'admin_vehicles/delete/$1';
// pagination stuff
$route['admin/vehicles/(:any)'] = 'admin_vehicles/index/$1';

/* supplier routes */
$route['admin/suppliers'] = 'admin_suppliers/index';
$route['admin/suppliers/delete/(:num)'] = 'admin_suppliers/delete/$1';
$route['admin/suppliers/list-vehicles/(:num)'] = 'admin_suppliers/list_vehicles/$1';
$route['admin/suppliers/list-drivers/(:num)'] = 'admin_suppliers/list_drivers/$1';
$route['admin/suppliers/add'] = 'admin_suppliers/add';
$route['admin/suppliers/update/(:num)'] = 'admin_suppliers/update/$1';
// finally deal with supplier company pagination route
$route['admin/suppliers/(:any)'] = 'admin_suppliers/index/$1';

/* dashboard */
$route['admin/dashboard'] = 'admin_dashboard/index';
$route['admin/dashboard/get_delivery_count_by_date_range/(:any)/(:any)'] = 'admin_dashboard/get_delivery_count_by_date_range/$1/$2';
$route['admin/dashboard/authorize-delivery/(:num)/(:num)'] = 'admin_dashboard/update_status/$1/$2';


/* frontend booking system routes */

$route['booking'] = 'frontend/home';
$route['register'] = 'user/create_driver_member';
$route['home'] = 'frontend/home';
$route['login'] = 'user/validate_frontend_credentials';
$route['logout'] = 'user/logout_frontend';
$route['your-deliveries'] = 'frontend/book/delivery_listing';
$route['create-delivery'] = 'frontend/book/create_delivery';
$route['book-timeslot/(:num)'] = 'frontend/book/index/$1';
$route['get-facility-timeslots/(:num)/(:any)'] = 'frontend/book/get_timeslots/$1/$2';
$route['add-timeslot/(:num)/(:num)/(:any)/(:any)'] = 'frontend/book/add_timeslot/$1/$2/$3/$4';

// and finally lightweight unit testing suite
$route['unit-tests'] = 'tests/index';


/* End of file routes.php */
/* Location: ./application/config/routes.php */