<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*

| -------------------------------------------------------------------

| AUTO-LOADER

| -------------------------------------------------------------------

| This file specifies which systems should be loaded by default.

|

| In order to keep the framework as light-weight as possible only the

| absolute minimal resources are loaded by default. For example,

| the database is not connected to automatically since no assumption

| is made regarding whether you intend to use it.  This file lets

| you globally define which systems you would like loaded with every

| request.

|

| -------------------------------------------------------------------

| Instructions

| -------------------------------------------------------------------

|

| These are the things you can load automatically:

|

| 1. Packages

| 2. Libraries

| 3. Helper files

| 4. Custom config files

| 5. Language files

| 6. Models

|

*/



/*

| -------------------------------------------------------------------

|  Auto-load Packges

| -------------------------------------------------------------------

| Prototype:

|

|  $autoload['packages'] = array(APPPATH.'third_party', '/usr/local/shared');

|

*/



$autoload['packages'] = array();





/*

| -------------------------------------------------------------------

|  Auto-load Libraries

| -------------------------------------------------------------------

| These are the classes located in the system/libraries folder

| or in your application/libraries folder.

|

| Prototype:

|

|	$autoload['libraries'] = array('database', 'session', 'xmlrpc');

*/



$autoload['libraries'] = array('database', 'session','email','ion_auth','erkanaauth','pagination','Pdf','user_agent');





/*

| -------------------------------------------------------------------

|  Auto-load Helper Files

| -------------------------------------------------------------------

| Prototype:

|

|	$autoload['helper'] = array('url', 'file');

*/



$autoload['helper'] = array('url','file','path', 'form', 'text', 'my_path','captcha');





/*

| -------------------------------------------------------------------

|  Auto-load Config files

| -------------------------------------------------------------------

| Prototype:

|

|	$autoload['config'] = array('config1', 'config2');

|

| NOTE: This item is intended for use ONLY if you have created custom

| config files.  Otherwise, leave it blank.

|

*/



$autoload['config'] = array();





/*

| -------------------------------------------------------------------

|  Auto-load Language files

| -------------------------------------------------------------------

| Prototype:

|

|	$autoload['language'] = array('lang1', 'lang2');

|

| NOTE: Do not include the "_lang" part of your file.  For example

| "codeigniter_lang.php" would be referenced as array('codeigniter');

|

*/



$autoload['language'] = array();





/*

| -------------------------------------------------------------------

|  Auto-load Models

| -------------------------------------------------------------------

| Prototype:

|

|	$autoload['model'] = array('model1', 'model2');

|

*/

$autoload['model'] = array('usersmodel', 'role','bcrypt','loginattemptsmodel','lockedipsmodel','profilesmodel','passwordpoliciesmodel','rolesmodel','rolefunctionpermissionmodel','rolepermissionmodel','audittrailmodel','countiesmodel', 'organizationsmodel','reportinglinesmodel','levelsofoperationmodel','organizationtypesmodel','partnersmodel','sectorsmodel','subsectorsmodel','beneficiarytypesmodel','donorsmodel','projectactivitystatusmodel','departmentsmodel','staffmodel','documentsmodel','documentcategoriesmodel','projectsmodel','calendarmodel','currenciesmodel','projectbeneficiariesmodel','projectdonorsmodel','projectsectorsmodel','projectscountiesmodel','projectpartnersmodel','projectobjectivesmodel','projectobjectiveindicatorsmodel','projectoutcomesmodel','projectoutcomeindicatorsmodel','projectoutputsmodel','projectoutputindicatorsmodel','projectplannedactivitiesmodel','projectbeneficiariesmodel','rollingactionplansmodel','rollingactionplandependanciesmodel','rollingactionplanassigneesmodel','rollingactionplanmilestonesmodel','activitiesmodel','projectactivitiesbeneficiariesmodel','projectactivitiesmodel', 'projectdiversitiesmodel','activityphotosmodel','projectsmandeplansmodel','mapsmodel','reportsmodel','savedreportsmodel','formcategoriesmodel','formsmodel','formelementsmodel','rollingactionplanlogsmodel','beneficiaryregistrationmodel','cashforworkmodel','noncashdistributionmodel','typesofsupportmodel','programmeareasmodel','trainingreportsmodel','monthlyreportsmodel','indicatorstrackingmodel','activitycategoriesmodel','attendancelistmodel','outcomeindicatortrackingmodel','managementreportsmodel','districtsmodel','beneficiarysubcategoriesmodel','projectactivitiesbeneficiarycategoriesmodel','projectsdistrictsmodel','aggregationtypesmodel','countriesmodel','taskcategoriesmodel','tasksmodel','statisticalreportsmodel','permissionsmodel');

/* End of file autoload.php */

/* Location: ./application/config/autoload.php */