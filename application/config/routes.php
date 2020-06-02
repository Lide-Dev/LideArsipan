<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'landing';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['admin/dashboard']="admin_dashboard/index";

$route['admin/admdatauser']="admin_datauser/index";
$route['admin/admdatauser/form/request']='admin_datauser/submitrequest';
$route['admin/admdatauser/put/user']="admin_datauser/addaccount";
$route['admin/sampah']='admin_boxsampah/index';
//$route['admin/admdatauser/put/banuser']="admin_datauser/banaccount";
$route["ajaxadmin/user/table/(:any)"]="admin_datauser/gettable/$1";
$route["ajaxadmin/user/count"]="admin_datauser/getcountajax";
$route["ajaxadmin/user/mode"]="admin_datauser/tablemode";
$route["ajaxadmin/get/edituser"]="admin_datauser/geteditdatauser";
$route["ajaxadmin/get/modal"]="admin_datauser/getviewmodal";
$route["ajaxadmin/set/clickbutton"]="admin_datauser/setclickbutton";

$route['go/logout']="login/logout";

$route["dashboard"]="home";
$route["registrasi_surat"]= "form_surat";
$route["ksurat/kategori"]= "form_surat/get_autocomplete/kategori";
$route["ksurat/kodeutama"]= "form_surat/get_autocomplete/kodeutama";
$route["ksurat/subkode1"]= "form_surat/get_autocomplete/subkode1";
$route["ksurat/subkode2"]= "form_surat/get_autocomplete/subkode2";
$route["ksurat/kode"]= "form_surat/set_kode";
$route["ksurat/getkode"]= "form_surat/get_kode";
$route["ksurat/cekkode/(:any)"]= "form_surat/cek_kode/$1";
$route["ksurat/desckode"]="form_surat/get_desckode";
$route["surat/go/add/newsurat"]="form_surat/form_submit";

$route["arsip/suratmasuk"]= "arsip/showtable/sm";
$route["arsip/suratkeluar"]= "arsip/showtable/sk";
$route["arsip/disposisi"]= "arsip/showtable/dp";
$route["arsip/dokumen/get/(:any)"] = "arsip/getdokumendownload/$1";
$route["arsip/request/(:any)"] = "arsip/requestmodal/$1";
$route["arsip/modal/get/(:any)"] = "arsip/getviewmodal/$1";


$route["ajaxarsip/table"]="arsip/gettable";
$route["ajaxarsip/count"]="arsip/getcountajax";
$route["ajaxlogin/emailcek"]="login/LP_CheckEmail";

$route["error"]="error_page/index";
$route['go/loginvalid/token']="login/validateLogin";
$route['gantipass/(:any)']="login/viewCP/$1";
$route['gantipass/accept/go']="login/changePassword";