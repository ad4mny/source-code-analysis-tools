<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
$route['result/(:any)'] = 'AnalysisController/getResult/$1';
$route['result/delete/(:any)'] = 'AnalysisController/deleteResult/$1';

$route['account'] = 'AccountController';
$route['history'] = 'HistoryController';

$route['about'] = 'StaticController/index/about';
$route['solution'] = 'StaticController/index/solution';
$route['pricing'] = 'StaticController/index/pricing';

// Cordova API Ajax Request
$route['api/login'] = 'LoginController/loginUserAjax';
$route['api/register'] = 'LoginController/registerUserAjax';
$route['api/getFileList'] = 'HistoryController/getUploadedFileAjax';
$route['api/uploadFile'] = 'AnalysisController/uploadFileAjax';
$route['api/getResult'] = 'AnalysisController/getResultAjax';
$route['api/deleteFile'] = 'AnalysisController/deleteResultAjax';
$route['api/updateFile'] = 'AnalysisController/updateFileAjax';
