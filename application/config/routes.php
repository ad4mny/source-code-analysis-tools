<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'IndexController';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login'] = 'LoginController/index';
$route['login/submit'] = 'LoginController/loginUser';
$route['logout'] = 'LoginController/logoutUser';
$route['register/submit'] = 'LoginController/registerUser';

$route['analytic'] = 'AnalyticController';
$route['analytic/upload'] = 'AnalyticController/uploadFile';
$route['result/(:num)'] = 'AnalyticController/getResult/$1';
$route['result/delete/(:num)'] = 'AnalyticController/deleteResult/$1';
$route['solution'] = 'SolutionController';
$route['about'] = 'AboutController';
$route['profile'] = 'ProfileController';
$route['history'] = 'HistoryController';


