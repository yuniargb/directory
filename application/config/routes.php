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
$route['default_controller'] = 'DirectoryController/index';
$route['404_override'] = 'Dist/errors_404';
$route['403_override'] = 'Dist/errors_403';
$route['translate_uri_dashes'] = FALSE;


$route['proses_login'] = 'AuthController/login';
$route['dashboard'] = 'DashboardController/index';
$route['login'] = 'AuthController/login';
$route['logout'] = 'AuthController/logout';
$route['find_data'] = 'DirectoryController/findData';
$route['find_event'] = 'DirectoryController/findEvent';
$route['detail_juara/(:any)'] = 'DirectoryController/detailJuara/$1';
// menu
$route['menu'] = 'MenuController/index';
$route['menu/tambah'] = 'MenuController/store';
$route['menu/update/(:any)'] = 'MenuController/update/$1';
$route['menu/delete/(:any)'] = 'MenuController/delete/$1';
// access_menu
$route['access_menu'] = 'AccessMenuController/index';
$route['access_menu/tambah'] = 'AccessMenuController/store';
$route['access_menu/update/(:any)'] = 'AccessMenuController/update/$1';
$route['access_menu/delete/(:any)'] = 'AccessMenuController/delete/$1';
// header_menu
$route['header_menu'] = 'HeaderMenuController/index';
$route['header_menu/tambah'] = 'HeaderMenuController/store';
$route['header_menu/update/(:any)'] = 'HeaderMenuController/update/$1';
$route['header_menu/delete/(:any)'] = 'HeaderMenuController/delete/$1';
// kategori
$route['kategori'] = 'KategoriController/index';
$route['kategori/tambah'] = 'KategoriController/store';
$route['kategori/update/(:any)'] = 'KategoriController/update/$1';
$route['kategori/delete/(:any)'] = 'KategoriController/delete/$1';
// subkategori
$route['subkategori'] = 'SubkategoriController/index';
$route['subkategori/tambah'] = 'SubkategoriController/store';
$route['subkategori/update/(:any)'] = 'SubkategoriController/update/$1';
$route['subkategori/delete/(:any)'] = 'SubkategoriController/delete/$1';
// cabang
$route['cabang'] = 'CabangController/index';
$route['cabang/tambah'] = 'CabangController/store';
$route['cabang/update/(:any)'] = 'CabangController/update/$1';
$route['cabang/delete/(:any)'] = 'CabangController/delete/$1';
// event
$route['event'] = 'EventController/index';
$route['event/tambah'] = 'EventController/store';
$route['event/update/(:any)'] = 'EventController/update/$1';
$route['event/delete/(:any)'] = 'EventController/delete/$1';
// golongan
$route['golongan'] = 'GolonganController/index';
$route['golongan/tambah'] = 'GolonganController/store';
$route['golongan/update/(:any)'] = 'GolonganController/update/$1';
$route['golongan/delete/(:any)'] = 'GolonganController/delete/$1';
// juara
$route['juara'] = 'JuaraController/index';
$route['juara/tambah'] = 'JuaraController/store';
$route['juara/update/(:any)'] = 'JuaraController/update/$1';
$route['juara/delete/(:any)'] = 'JuaraController/delete/$1';
$route['juara/data_list'] = 'JuaraController/ajax';
// video
$route['video'] = 'VideoController/index';
$route['video/tambah'] = 'VideoController/store';
$route['video/update/(:any)'] = 'VideoController/update/$1';
$route['video/delete/(:any)'] = 'VideoController/delete/$1';
$route['video/data_list'] = 'VideoController/ajax';
// level_user
$route['level_user'] = 'UserLevelController/index';
$route['level_user/tambah'] = 'UserLevelController/store';
$route['level_user/update/(:any)'] = 'UserLevelController/update/$1';
$route['level_user/delete/(:any)'] = 'UserLevelController/delete/$1';
// setting
$route['password'] = 'SettingController/ganti_password';
$route['ganti_password'] = 'SettingController/proses_ganti_password';
$route['setting'] = 'SettingController/ganti_layout';
$route['proses_setting'] = 'SettingController/proses_ganti_layout';
// user
$route['user'] = 'UserController/index';
$route['user/tambah'] = 'UserController/store';
$route['user/update/(:any)'] = 'UserController/update/$1';
$route['user/delete/(:any)'] = 'UserController/delete/$1';
// file
$route['file'] = 'FileController/index';
$route['file/tambah'] = 'FileController/store';
$route['file/update/(:any)'] = 'FileController/update/$1';
$route['file/delete/(:any)'] = 'FileController/delete/$1';
$route['file/data_list'] = 'FileController/ajax';