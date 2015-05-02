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

$route['default_controller'] = "welcome";
$route['404_override'] = '';
$route['action'] = "welcome/action";
$route['validateLogin'] = "welcome/validateLogin";
$route['adduser'] = "welcome/adduser";
$route['addpanel'] = "welcome/addpanel";
$route['deleteuser'] = "welcome/deleteuser";
$route['edituser'] = "welcome/edituser";
$route['updateuser'] = "welcome/updateuser";
$route['editthisuser'] = "welcome/editthisuser";
$route['viewdelete'] = "welcome/viewdelete";
$route['activeuser'] = "welcome/activeuser";
$route['addeduser'] = "welcome/addeduser";
$route['addedpanel'] = "welcome/addedpanel";
$route['userslink'] = "welcome/userslink";
$route['roleslink'] = "welcome/roleslink";
$route['panelslink'] = "welcome/panelslink";
$route['logout'] = "welcome/logout";
$route['home'] = "welcome";
$route['addrole'] = "welcome/addrole";
$route['addedrole'] = "welcome/addedrole";
$route['deletepanel'] = "welcome/deletepanel";
$route['deletedpanel'] = "welcome/deletedpanel";
$route['editpanel'] = "welcome/editpanel";
$route['editthispanel'] = "welcome/editthispanel";
$route['updatepanel'] = "welcome/updatepanel";
$route['visiblepanels'] = "welcome/visiblepanels";
$route['hiddenpanels'] = "welcome/hiddenpanels";
$route['editrole'] = "welcome/editrole";
$route['editthisrole'] = "welcome/editthisrole";
$route['deleterole'] = "welcome/deleterole";
$route['deletedrole'] = "welcome/deletedrole";
$route['updaterole'] = "welcome/updaterole";
$route['instagram'] = "site/hash";
$route['displayimages/(:any)'] = "site/displayimages/$1";
$route['updateimages'] = "site/updateimages";
$route['updateimagesfromtag'] = "site/updateimagesfromtag";
$route['searchimages'] = "site/searchimages";
$route['getimages/(:any)'] = "site/getimages/$1";
$route['pagination'] = "site/pagination";
$route['imageinfo/(:any)'] = "site/imageinfo/$1";
$route['vidisha'] = "site/vidisha";
$route['getcatalog'] = "site/letscurl";
$route['updatethisimage'] = "site/updatethisimage";
$route['makemenu'] = "site/makemenu";

/* End of file routes.php */
/* Location: ./application/config/routes.php */