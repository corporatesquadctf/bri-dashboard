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
$route['default_controller'] = 'logins';
// $route['performance/(:any)'] = 'performance/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/* Start of Routing Account Planning Menengah Module */
/* Disposisi */
$route["disposisi/account_planning_menengah/disposisi_customer"] = "disposisi/account_planning_menengah/DisposisiCustomer";
$route["disposisi/account_planning_menengah/disposisi_customer/process_disposisi"] = "disposisi/account_planning_menengah/DisposisiCustomer/process_disposisi";
$route["disposisi/account_planning_menengah/disposisi_customer/page"] = "disposisi/account_planning_menengah/DisposisiCustomer/page";
$route["disposisi/account_planning_menengah/disposisi_customer/page/(:any)"] = "disposisi/account_planning_menengah/DisposisiCustomer/page/$1";
$route["disposisi/account_planning_menengah/disposisi_customer/search"] = "disposisi/account_planning_menengah/DisposisiCustomer/search";
$route["disposisi/account_planning_menengah/disposisi_customer/search/(:any)"] = "disposisi/account_planning_menengah/DisposisiCustomer/search/$1";

/* Tasklist */
/* Create Account Planning */
$route["tasklist/account_planning_menengah/create_account_planning"] = "tasklist/account_planning_menengah/CreateAccountPlanning";
$route["tasklist/account_planning_menengah/create_account_planning/process_create"] = "tasklist/account_planning_menengah/CreateAccountPlanning/process_create";
$route["tasklist/account_planning_menengah/create_account_planning/page"] = "tasklist/account_planning_menengah/CreateAccountPlanning/page";
$route["tasklist/account_planning_menengah/create_account_planning/page/(:any)"] = "tasklist/account_planning_menengah/CreateAccountPlanning/page/$1";
$route["tasklist/account_planning_menengah/create_account_planning/search"] = "tasklist/account_planning_menengah/CreateAccountPlanning/search";
$route["tasklist/account_planning_menengah/create_account_planning/search/(:any)"] = "tasklist/account_planning_menengah/CreateAccountPlanning/search/$1";

/* Manage Account Planning */
$route["tasklist/account_planning_menengah/manage_account_planning"] = "tasklist/account_planning_menengah/ManageAccountPlanning";
$route["tasklist/account_planning_menengah/manage_account_planning/page"] = "tasklist/account_planning_menengah/ManageAccountPlanning/page";
$route["tasklist/account_planning_menengah/manage_account_planning/page/(:any)"] = "tasklist/account_planning_menengah/ManageAccountPlanning/page/$1";
$route["tasklist/account_planning_menengah/manage_account_planning/search"] = "tasklist/account_planning_menengah/ManageAccountPlanning/search";
$route["tasklist/account_planning_menengah/manage_account_planning/search/(:any)/(:any)/(:any)"] = "tasklist/account_planning_menengah/ManageAccountPlanning/search/$1/$2/$3";
$route["tasklist/account_planning_menengah/manage_account_planning/search/(:any)/(:any)/(:any)/(:any)"] = "tasklist/account_planning_menengah/ManageAccountPlanning/search/$1/$2/$3/$4";

/* View Input Account Planning */
$route["tasklist/account_planning_menengah/manage_account_planning/input/(:any)"] = "tasklist/account_planning_menengah/ManageAccountPlanning/input/$1";
$route["tasklist/account_planning_menengah/manage_account_planning/input/(:any)/(:any)"] = "tasklist/account_planning_menengah/ManageAccountPlanning/input/$1/$2";
$route["tasklist/account_planning_menengah/manage_account_planning/input/(:any)/(:any)/(:any)"] = "tasklist/account_planning_menengah/ManageAccountPlanning/input/$1/$2/$3";
$route["tasklist/account_planning_menengah/manage_account_planning/services_get_company_information/(:any)/(:any)"] = "tasklist/account_planning_menengah/ManageAccountPlanning/services_get_company_information/$1/$2";
$route["tasklist/account_planning_menengah/manage_account_planning/services_get_bri_starting_position/(:any)/(:any)"] = "tasklist/account_planning_menengah/ManageAccountPlanning/services_get_bri_starting_position/$1/$2";
$route["tasklist/account_planning_menengah/manage_account_planning/services_get_client_needs/(:any)/(:any)"] = "tasklist/account_planning_menengah/ManageAccountPlanning/services_get_client_needs/$1/$2";
$route["tasklist/account_planning_menengah/manage_account_planning/services_get_action_plans/(:any)/(:any)"] = "tasklist/account_planning_menengah/ManageAccountPlanning/services_get_action_plans/$1/$2";

/* Input Account Planning - Company Information */
$route["tasklist/account_planning_menengah/manage_account_planning/input_debitur_overview/(:any)/(:any)"] = "tasklist/account_planning_menengah/ManageAccountPlanning/input_debitur_overview/$1/$2";
$route["tasklist/account_planning_menengah/manage_account_planning/process_input_debitur_overview"] = "tasklist/account_planning_menengah/ManageAccountPlanning/process_input_debitur_overview";
$route["tasklist/account_planning_menengah/manage_account_planning/input_key_shareholders/(:any)"] = "tasklist/account_planning_menengah/ManageAccountPlanning/input_key_shareholders/$1";
$route["tasklist/account_planning_menengah/manage_account_planning/process_input_key_shareholders"] = "tasklist/account_planning_menengah/ManageAccountPlanning/process_input_key_shareholders";
$route["tasklist/account_planning_menengah/manage_account_planning/input_business_organization/(:any)/(:any)"] = "tasklist/account_planning_menengah/ManageAccountPlanning/input_business_organization/$1/$2";
$route["tasklist/account_planning_menengah/manage_account_planning/process_input_business_organization"] = "tasklist/account_planning_menengah/ManageAccountPlanning/process_input_business_organization";
$route["tasklist/account_planning_menengah/manage_account_planning/input_strategic_plan/(:any)/(:any)"] = "tasklist/account_planning_menengah/ManageAccountPlanning/input_strategic_plan/$1/$2";
$route["tasklist/account_planning_menengah/manage_account_planning/process_input_strategic_plan"] = "tasklist/account_planning_menengah/ManageAccountPlanning/process_input_strategic_plan";
$route["tasklist/account_planning_menengah/manage_account_planning/input_coverage_mapping/(:any)/(:any)"] = "tasklist/account_planning_menengah/ManageAccountPlanning/input_coverage_mapping/$1/$2";
$route["tasklist/account_planning_menengah/manage_account_planning/process_input_coverage_mapping"] = "tasklist/account_planning_menengah/ManageAccountPlanning/process_input_coverage_mapping";

/* Input Account Planning - BRI Starting Position */
$route["tasklist/account_planning_menengah/manage_account_planning/input_financial_highlight/(:any)/(:any)"] = "tasklist/account_planning_menengah/ManageAccountPlanning/input_financial_highlight/$1/$2";
$route["tasklist/account_planning_menengah/manage_account_planning/process_input_financial_highlight"] = "tasklist/account_planning_menengah/ManageAccountPlanning/process_input_financial_highlight";
$route["tasklist/account_planning_menengah/manage_account_planning/input_facilities_banking/(:any)/(:any)"] = "tasklist/account_planning_menengah/ManageAccountPlanning/input_facilities_banking/$1/$2";
$route["tasklist/account_planning_menengah/manage_account_planning/process_input_facilities_banking"] = "tasklist/account_planning_menengah/ManageAccountPlanning/process_input_facilities_banking";
$route["tasklist/account_planning_menengah/manage_account_planning/input_wallet_share/(:any)/(:any)"] = "tasklist/account_planning_menengah/ManageAccountPlanning/input_wallet_share/$1/$2";
$route["tasklist/account_planning_menengah/manage_account_planning/process_input_wallet_share"] = "tasklist/account_planning_menengah/ManageAccountPlanning/process_input_wallet_share";
$route["tasklist/account_planning_menengah/manage_account_planning/input_competition_analysis/(:any)/(:any)"] = "tasklist/account_planning_menengah/ManageAccountPlanning/input_competition_analysis/$1/$2";
$route["tasklist/account_planning_menengah/manage_account_planning/process_input_competition_analysis"] = "tasklist/account_planning_menengah/ManageAccountPlanning/process_input_competition_analysis";

/* Input Account Planning - Client Needs */
$route["tasklist/account_planning_menengah/manage_account_planning/input_fundings/(:any)"] = "tasklist/account_planning_menengah/ManageAccountPlanning/input_fundings/$1";
$route["tasklist/account_planning_menengah/manage_account_planning/process_input_fundings"] = "tasklist/account_planning_menengah/ManageAccountPlanning/process_input_fundings";
$route["tasklist/account_planning_menengah/manage_account_planning/input_services/(:any)"] = "tasklist/account_planning_menengah/ManageAccountPlanning/input_services/$1";
$route["tasklist/account_planning_menengah/manage_account_planning/process_input_services"] = "tasklist/account_planning_menengah/ManageAccountPlanning/process_input_services";

/* Input Account Planning - Action Plans */
$route["tasklist/account_planning_menengah/manage_account_planning/input_estimated_financial/(:any)/(:any)"] = "tasklist/account_planning_menengah/ManageAccountPlanning/input_estimated_financial/$1/$2";
$route["tasklist/account_planning_menengah/manage_account_planning/process_input_estimated_financial"] = "tasklist/account_planning_menengah/ManageAccountPlanning/process_input_estimated_financial";
$route["tasklist/account_planning_menengah/manage_account_planning/input_initiatives_action/(:any)"] = "tasklist/account_planning_menengah/ManageAccountPlanning/input_initiatives_action/$1";
$route["tasklist/account_planning_menengah/manage_account_planning/process_input_initiatives_action"] = "tasklist/account_planning_menengah/ManageAccountPlanning/process_input_initiatives_action";

/* Submit Approval Account Planning */
$route["tasklist/account_planning_menengah/manage_account_planning/submit_account_planning"] = "tasklist/account_planning_menengah/ManageAccountPlanning/submit_account_planning";
$route["tasklist/account_planning_menengah/manage_account_planning/retrieve_account_planning/(:any)"] = "tasklist/account_planning_menengah/ManageAccountPlanning/retrieve_account_planning/$1";
/* End of Routing Account Planning Menengah Module */

/* Start of Routing Master Customer Menengah Module */
$route["admin/customer_menengah"] = "admin/CustomerMenengah";
$route["admin/customer_menengah/serviceCheckCIFCustomer"] = "admin/CustomerMenengah/serviceCheckCIFCustomer";
$route["admin/customer_menengah/serviceCheckNPWPCustomer"] = "admin/CustomerMenengah/serviceCheckNPWPCustomer";
$route["admin/customer_menengah/add_customer"] = "admin/CustomerMenengah/add_customer";
$route["admin/customer_menengah/edit_customer"] = "admin/CustomerMenengah/edit_customer";

/* Start routing Kajian Ekonomi Makro Module */
$route["macro_economy/economy_research"] = "macro_economy/EconomyResearch";
$route["macro_economy/economy_research/serviceGetTreeData"] = "macro_economy/EconomyResearch/serviceGetTreeData";
$route["macro_economy/economy_research/serviceCreateSector"] = "macro_economy/EconomyResearch/serviceCreateSector";
$route["macro_economy/economy_research/serviceUpdateSector"] = "macro_economy/EconomyResearch/serviceUpdateSector";
$route["macro_economy/economy_research/serviceDeleteSector"] = "macro_economy/EconomyResearch/serviceDeleteSector";
$route["macro_economy/economy_research/processUploadFile"] = "macro_economy/EconomyResearch/processUploadFile";
$route["macro_economy/economy_research/processCreateAnalysis"] = "macro_economy/EconomyResearch/processCreateAnalysis";
$route["macro_economy/economy_research/serviceGetAnalysis/(:any)"] = "macro_economy/EconomyResearch/serviceGetAnalysis/$1";
$route["macro_economy/economy_research/serviceGetDetailAnalysis/(:any)"] = "macro_economy/EconomyResearch/serviceGetDetailAnalysis/$1";
$route["macro_economy/economy_research/serviceGetFileUpload/(:any)"] = "macro_economy/EconomyResearch/serviceGetFileUpload/$1";
$route["macro_economy/economy_research/serviceRemoveFileUpload"] = "macro_economy/EconomyResearch/serviceRemoveFileUpload";
$route["macro_economy/economy_research/serviceDeleteAnalysis"] = "macro_economy/EconomyResearch/serviceDeleteAnalysis";
$route["macro_economy/economy_research/downloadAnalysis/(:any)"] = "macro_economy/EconomyResearch/downloadAnalysis/$1";
$route["macro_economy/economy_research/servicePinAnalysis"] = "macro_economy/EconomyResearch/servicePinAnalysis";
$route["macro_economy/economy_research/serviceGetMyFiles/(:any)"] = "macro_economy/EconomyResearch/serviceGetMyFiles/$1";
$route["macro_economy/economy_research/serviceGetRecentAnalysis/(:any)"] = "macro_economy/EconomyResearch/serviceGetRecentAnalysis/$1";
$route["macro_economy/economy_research/serviceGetPinAnalysis/(:any)"] = "macro_economy/EconomyResearch/serviceGetPinAnalysis/$1";
$route["macro_economy/economy_research/serviceGetPrimaryTreeData"] = "macro_economy/EconomyResearch/serviceGetPrimaryTreeData";
$route["macro_economy/economy_research/serviceMoveAnalysis"] = "macro_economy/EconomyResearch/serviceMoveAnalysis";