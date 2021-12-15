<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'IndexController';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login'] = 'LoginController/index';
$route['login/submit'] = 'LoginController/loginUser';
$route['logout'] = 'LoginController/logoutUser';
$route['register/submit'] = 'LoginController/registerUser';

$route['analysis'] = 'AnalysisController';
$route['analysis/upload'] = 'AnalysisController/uploadFile';
$route['analysis/update'] = 'AnalysisController/updateFile';
$route['result/(:num)'] = 'AnalysisController/getResult/$1';
$route['result/delete/(:num)'] = 'AnalysisController/deleteResult/$1';
$route['solution'] = 'SolutionController';
$route['about'] = 'AboutController';
$route['account'] = 'AccountController';
$route['history'] = 'HistoryController';


