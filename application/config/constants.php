<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
  |--------------------------------------------------------------------------
  | Display Debug backtrace
  |--------------------------------------------------------------------------
  |
  | If set to TRUE, a backtrace will be displayed along with php errors. If
  | error_reporting is disabled, the backtrace will not display, regardless
  | of this setting
  |
 */
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
  |--------------------------------------------------------------------------
  | File and Directory Modes
  |--------------------------------------------------------------------------
  |
  | These prefs are used when checking and setting modes when working
  | with the file system.  The defaults are fine on servers with proper
  | security, but you may wish (or even need) to change the values in
  | certain environments (Apache running a separate process for each
  | user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
  | always be used to set the mode correctly.
  |
 */
defined('FILE_READ_MODE') OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE') OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE') OR define('DIR_WRITE_MODE', 0755);

/*
  |--------------------------------------------------------------------------
  | File Stream Modes
  |--------------------------------------------------------------------------
  |
  | These modes are used when working with fopen()/popen()
  |
 */
defined('FOPEN_READ') OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE') OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE') OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE') OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE') OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE') OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT') OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT') OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
  |--------------------------------------------------------------------------
  | Exit Status Codes
  |--------------------------------------------------------------------------
  |
  | Used to indicate the conditions under which the script is exit()ing.
  | While there is no universal standard for error codes, there are some
  | broad conventions.  Three such conventions are mentioned below, for
  | those who wish to make use of them.  The CodeIgniter defaults were
  | chosen for the least overlap with these conventions, while still
  | leaving room for others to be defined in future versions and user
  | applications.
  |
  | The three main conventions used for determining exit status codes
  | are as follows:
  |
  |    Standard C/C++ Library (stdlibc):
  |       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
  |       (This link also contains other GNU-specific conventions)
  |    BSD sysexits.h:
  |       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
  |    Bash scripting:
  |       http://tldp.org/LDP/abs/html/exitcodes.html
  |
 */
defined('EXIT_SUCCESS') OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR') OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG') OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE') OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS') OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT') OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE') OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN') OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX') OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

defined('STATUS_CODE_OK') OR define('STATUS_CODE_OK', 200);
defined('STATUS_CODE_BAD_REQUEST') OR define('STATUS_CODE_BAD_REQUEST', 400);
defined('STATUS_CODE_UNAUTHORIZED') OR define('STATUS_CODE_UNAUTHORIZED', 401);
defined('STATUS_CODE_FORBIDDEN') OR define('STATUS_CODE_FORBIDDEN', 403);
defined('STATUS_CODE_SERVER_ERROR') OR define('STATUS_CODE_SERVER_ERROR', 500);


defined('BANK_FACIL_DIRECT_LOAN') OR define('BANK_FACIL_DIRECT_LOAN', 1);
defined('BANK_FACIL_INDIRECT_LOAN') OR define('BANK_FACIL_INDIRECT_LOAN', 2);
defined('BANK_FACIL_CASH') OR define('BANK_FACIL_CASH', 3);
defined('BANK_FACIL_TRANS_BANK') OR define('BANK_FACIL_TRANS_BANK', 4);

defined('USER_ROLE_SUPER_USER') OR define('USER_ROLE_SUPER_USER', 1);
defined('USER_ROLE_ADMIN_DIVISI') OR define('USER_ROLE_ADMIN_DIVISI', 2);
defined('USER_ROLE_ADMIN_PARAMETER') OR define('USER_ROLE_ADMIN_PARAMETER', 3);
defined('USER_ROLE_BOARD') OR define('USER_ROLE_BOARD', 6);
defined('USER_ROLE_RM') OR define('USER_ROLE_RM', 10);
defined('USER_ROLE_AVP') OR define('USER_ROLE_AVP', 7);
defined('USER_ROLE_VP') OR define('USER_ROLE_VP', 8);
defined('USER_ROLE_EVP') OR define('USER_ROLE_EVP', 9);
defined('USER_ROLE_RM_MENENGAH') OR define('USER_ROLE_RM_MENENGAH', 12);
defined('USER_ROLE_GH_MENENGAH') OR define('USER_ROLE_GH_MENENGAH', 13);
defined('USER_ROLE_WP') OR define('USER_ROLE_WP', 14);
defined('USER_ROLE_ERO') OR define('USER_ROLE_ERO', 15);
defined('USER_ROLE_KADIV') OR define('USER_ROLE_KADIV', 16);
defined('USER_ROLE_ADK') OR define('USER_ROLE_ADK', 17);
defined('USER_ROLE_ARK') OR define('USER_ROLE_ARK', 18);
defined('USER_ROLE_ADMIN_WILAYAH') OR define('USER_ROLE_ADMIN_WILAYAH', 21);
defined('USER_ROLE_SUPER_USER_MENENGAH') OR define('USER_ROLE_SUPER_USER_MENENGAH', 22);

defined('DSC_ENVIRONMENT') OR define('DSC_ENVIRONMENT', 'intranet');
defined('VALUE_PER') OR define('VALUE_PER', 1000000);
defined('VALUE_UNIT') OR define('VALUE_UNIT', 'Million');
defined('Form_Notes1') OR define('Form_Notes1', '#Income dalam angka penuh.');
defined('Form_Notes2') OR define('Form_Notes2', '#Nilai Valas dikonversi ke rupiah.');
defined('View_Notes1') OR define('View_Notes1', '#All values in million.');
defined('MIN_SUBMITED_PIPELINE') OR define('MIN_SUBMITED_PIPELINE', 3);
defined('MIN_PLAFOND') OR define('MIN_PLAFOND', 25000000000);
defined('MAX_PLAFOND') OR define('MAX_PLAFOND', 200000000000);
defined('MAX_NUMERIC') OR define('MAX_NUMERIC', 999999999999999999999);
defined('MIN_NUMERIC') OR define('MIN_NUMERIC', -999999999999999999999);
defined('MAX_NUMERIC_TOTAL') OR define('MAX_NUMERIC_TOTAL', 9999999999999999999999);
defined('MIN_NUMERIC_TOTAL') OR define('MIN_NUMERIC_TOTAL', -9999999999999999999999);
defined('MEMBER_MODULE_ID') OR define('MEMBER_MODULE_ID', 37);

// Constants for Fraud Detection
defined('V5_FRAUD_CONSTANT') OR define('V5_FRAUD_CONSTANT', -6.065);
defined('V5_DSRI_FRAUD_CONSTANT') OR define('V5_DSRI_FRAUD_CONSTANT', 0.823);
defined('V5_GMI_FRAUD_CONSTANT') OR define('V5_GMI_FRAUD_CONSTANT', 0.906);
defined('V5_AQI_FRAUD_CONSTANT') OR define('V5_AQI_FRAUD_CONSTANT', 0.593);
defined('V5_SGI_FRAUD_CONSTANT') OR define('V5_SGI_FRAUD_CONSTANT', 0.717);
defined('V5_DEPI_FRAUD_CONSTANT') OR define('V5_DEPI_FRAUD_CONSTANT', 0.107);

defined('V8_FRAUD_CONSTANT') OR define('V8_FRAUD_CONSTANT', -4.84);
defined('V8_DSRI_FRAUD_CONSTANT') OR define('V8_DSRI_FRAUD_CONSTANT', 0.920);
defined('V8_GMI_FRAUD_CONSTANT') OR define('V8_GMI_FRAUD_CONSTANT', 0.528);
defined('V8_AQI_FRAUD_CONSTANT') OR define('V8_AQI_FRAUD_CONSTANT', 0.404);
defined('V8_SGI_FRAUD_CONSTANT') OR define('V8_SGI_FRAUD_CONSTANT', 0.892);
defined('V8_DEPI_FRAUD_CONSTANT') OR define('V8_DEPI_FRAUD_CONSTANT', 0.115);
defined('V8_SGAI_FRAUD_CONSTANT') OR define('V8_SGAI_FRAUD_CONSTANT', 0.172);
defined('V8_TATA_FRAUD_CONSTANT') OR define('V8_TATA_FRAUD_CONSTANT', 4.679);
defined('V8_LVGI_FRAUD_CONSTANT') OR define('V8_LVGI_FRAUD_CONSTANT', 0.327);


/* Config Prod */
//defined('BRISTAR_SERVER') OR define('BRISTAR_SERVER', 'http://api.briconnect.bri.co.id/');
defined('CLIENT_ID') OR define('CLIENT_ID', 'demoapp');
defined('CLIENT_SECRET') OR define('CLIENT_SECRET', 'demopass');

/* Config Dev */
defined('BRISTAR_SERVER') OR define('BRISTAR_SERVER', 'http://172.18.136.165:81/');
//defined('CLIENT_ID') OR define('CLIENT_ID', 'd710f43a5e5d435585a6abc00909e1d5ac829f2e');
//defined('CLIENT_SECRET') OR define('CLIENT_SECRET', '40b3ef2a2c9bf979f8d2bd2b5269ca4ccfdbeb15');

defined('GRANT_TYPE') OR define('GRANT_TYPE', 'client_credentials');