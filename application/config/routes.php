<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'IndexController';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login'] = 'LoginController';
$route['logout'] = 'LoginController/logout';
$route['register'] = 'LoginController/register';

$route['analytic'] = 'AnalyticController';
$route['analytic/upload'] = 'AnalyticController/uploadFile';
$route['solution'] = 'SolutionController';
$route['about'] = 'AboutController';
$route['profile'] = 'ProfileController';
$route['history'] = 'HistoryController';


