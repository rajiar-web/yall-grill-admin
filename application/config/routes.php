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
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['home'] = 'home';
$route['index'] = 'home';










//admin section
//Admin 
//***************************************
$route['login'] = 'admin/Login';
$route['login-action'] = 'admin/Login/laction';
$route['dashboard'] = 'admin/Dashboard';
$route['logout'] = 'admin/Login/admin_logout';
$route['changepassword'] = 'admin/Login/change_password';
$route['passwordaction'] = 'admin/Login/password_action';









//social media
$route['social-media'] = 'admin/Main_contact_controller/socialmedia_info';
$route['social-media-action'] = 'admin/Main_contact_controller/social_media_action';


//main contact
$route['main_contact'] = 'admin/Main_contact_controller/main_contact';
$route['add-main/(:num)'] = 'admin/Main_contact_controller/add_main/$1';
$route['main-action']='admin/Main_contact_controller/main_action';
$route['view-main']='admin/Main_contact_controller/view_main';



//category
$route['category']= 'admin/Category_controller/category';
$route['add-category'] = 'admin/Category_controller/add_category';
$route['add-category/(:num)'] = 'admin/Category_controller/add_category/$1';
$route['category-action']= 'admin/Category_controller/category_action';
$route['delete-category']='admin/Category_controller/category_delete';

//product
$route['product']= 'admin/Product_controller/product';
$route['add-product'] = 'admin/Product_controller/add_product';
$route['add-product/(:num)'] = 'admin/Product_controller/add_product/$1';
$route['product-action']= 'admin/Product_controller/product_action';
$route['delete-product']='admin/Product_controller/product_delete';
$route['product-image']='admin/Product_controller/image';
$route['home-product-status']='admin/Product_controller/home_product_status';


//slider
$route['slider']= 'admin/Slider_controller/slider';
$route['add-slider'] = 'admin/Slider_controller/add_slider';
$route['add-slider/(:num)'] = 'admin/Slider_controller/add_slider/$1';
$route['slider-action']= 'admin/Slider_controller/slider_action';
$route['delete-slider']='admin/Slider_controller/slider_delete';
$route['slider-image']='admin/Slider_controller/image';




$route['insert-newsLetter']= 'Api_controller/insert_newsletter';




