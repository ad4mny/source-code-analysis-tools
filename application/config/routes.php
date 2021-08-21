<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'IndexController';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login'] = 'LoginController/index/login';
$route['login/submit'] = 'LoginController/loginUser';
$route['logout'] = 'LoginController/logoutUser';
$route['register'] = 'LoginController/index/register';
$route['register/submit'] = 'LoginController/registerUser';

$route['analytic'] = 'AnalyticController';
$route['analytic/upload'] = 'AnalyticController/uploadFile';
$route['solution'] = 'SolutionController';
$route['about'] = 'AboutController';
$route['profile'] = 'ProfileController';
$route['history'] = 'HistoryController';


