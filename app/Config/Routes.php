<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('login', 'Auth::index');
$routes->get('/logout', 'Auth::logout');
$routes->post('/auth/login', 'Auth::login');
$routes->get('signup', 'Auth::signup');
$routes->post('signup_submit', 'Auth::signup_submit');
$routes->post('send_email_verification_code', 'Auth::send_email_verification_code');
$routes->post('verify_verification_code', 'Auth::verify_verification_code');
$routes->get('forgot_password', 'Auth::forgot_password');
$routes->post('add_notification', 'Notification::add');
$routes->post('get_all_unread_notification', 'Notification::get_all_unread_notification');
$routes->post('mark_read_notification', 'Notification::mark_read_notification');
$routes->post('mark_read_notification/(:any)', 'Notification::mark_read_notification');//for notification in android app













$routes->get('qrcode/(:any)', 'Home::qrcode/$1');
$routes->post('update_user_setting', 'Home::update_user_setting');


$routes->get('/dashboard', 'Dashboard::index');

$routes->get('/register_doc', 'Home::register_doc');
$routes->get('/', 'Home::index');
$routes->post('submit_register_doc', 'Home::submit_register_doc');
$routes->get('tracking_form_print_page/(:any)', 'Home::tracking_form_print_page/$1');
$routes->get('receive_doc', 'Home::receive_doc');
$routes->get('receive_doc_by_qrcode', 'Home::receive_doc_by_qrcode');
$routes->get('confirm_receive_qrcode_data/(:any)', 'Home::confirm_receive_qrcode_data/$1');
$routes->get('confirm_receive_tracking_code_data/(:any)', 'Home::confirm_receive_tracking_code_data/$1');
$routes->post('add_receivelog', 'Home::add_receivelog');
$routes->post('add_releaselog', 'Home::add_releaselog');
$routes->post('submit_delete_doc', 'Home::submit_delete_doc');

$routes->get('receive_doc_by_tracking_code', 'Home::receive_doc_by_tracking_code');
$routes->get('release_doc', 'Home::release_doc');
$routes->get('release_doc_by_qrcode', 'Home::release_doc_by_qrcode');

$routes->get('confirm_release_qrcode_data/(:any)', 'Home::confirm_release_qrcode_data/$1');
$routes->get('confirm_release_tracking_code_data/(:any)', 'Home::confirm_release_tracking_code_data/$1');

$routes->get('release_doc_by_tracking_code', 'Home::release_doc_by_tracking_code');

$routes->get('my_docs', 'Home::my_docs');
$routes->get('onhand', 'Home::onhand');
$routes->get('get_loggeduser_pending_doc_count', 'Home::get_loggeduser_pending_doc_count');//current logged user
$routes->get('get_loggeduser_doc_count', 'Home::get_loggeduser_doc_count');//current logged user

$routes->get('search', 'Home::search');
$routes->post('search/results', 'Home::search_results');
$routes->post('timeline', 'Home::timeline');
$routes->get('timeline_view/(:any)', 'Home::timeline_view/$1');


$routes->post('document_details', 'Home::document_details');



$routes->get('my_profile', 'Profile::my_profile');
$routes->post('upload_profile_pic', 'Upload::upload_profile_pic');
$routes->post('submit_profile_settings', 'Profile::submit_profile_settings');



$routes->get('messages', 'Message::messages');


$routes->get('group', 'Group::group');
$routes->get('group/create', 'Group::create');
$routes->post('group/add_group', 'Group::add_group');
$routes->post('group/user_group_list', 'Group::user_group_list');
$routes->post('group/get_group_profile_data', 'Group::get_group_profile_data');
$routes->post('group/group_members', 'Group::group_members');
$routes->post('group/group_add_member', 'Group::group_add_member');
$routes->post('group/group_add_member_get_search_result', 'Group::group_add_member_get_search_result');
$routes->post('group/group_add_member_get_search_result_add', 'Group::group_add_member_get_search_result_add');
$routes->post('group/group_member_documents', 'Group::group_member_documents');
$routes->post('group/group_member_remove', 'Group::group_member_remove');
$routes->post('group/group_member_set_admin', 'Group::group_member_set_admin');
$routes->post('group/group_member_set_doc_verifier', 'Group::group_member_set_doc_verifier');
$routes->post('group/group_update_document_ca_date', 'Group::group_update_document_ca_date');
$routes->post('group/group_update_document_ada_date', 'Group::group_update_document_ada_date');
$routes->post('group/group_update_document_liquidation_date', 'Group::group_update_document_liquidation_date');







$routes->post('group/group_documents', 'Group::group_documents');
$routes->post('group/group_chatroom', 'Group::group_chatroom');
$routes->post('group/group_settings', 'Group::group_settings');
$routes->post('upload_group_profile_pic', 'Upload::upload_group_profile_pic');
$routes->post('group/group_update_groupname', 'Group::group_update_groupname');






$routes->post('group/group_send_msg', 'Group::group_send_msg');
$routes->post('group/get_chatroom_newest_msg', 'Group::get_chatroom_newest_msg');
$routes->post('group/get_chatroom_older_msg', 'Group::get_chatroom_older_msg');
$routes->post('group/group_leave_group', 'Group::group_leave_group');

























