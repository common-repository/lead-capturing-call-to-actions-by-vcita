<?php
/*
Plugin Name: Contact Form and Calls To Action
Plugin URI: https://www.vcita.com
Description: vCita Lead Capturing Call-To-Actions plugin for WordPress helps you capture twice as many leads!
Version: 2.7.1
Author: vCita.com
Author URI: https://www.vcita.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

*/

# Check if another vCita plugin already activated
if (defined('VCITA_SERVER_BASE')) {
  add_action('admin_notices', 'vcita_lead_cta_other_plugin_installed_warning');
} else {
  define('VCITA_SERVER_BASE', 'www.vcita.com'); # Don't include the protocol, added dynamically
  define('VCITA_WIDGET_VERSION', '3.2.0');
  define('VCITA_WIDGET_PLUGIN_NAME', 'Client Management and CRM by vCita');
  define('VCITA_WIDGET_KEY', 'vcita_scheduler');
  define('VCITA_WIDGET_API_KEY', 'wp-v-schd');
  define('VCITA_WIDGET_MENU_NAME', 'vCita Lead Capturing');
  define('VCITA_WIDGET_SHORTCODE', 'vCitaMeetingScheduler');
  define('VCITA_CALENDAR_WIDGET_SHORTCODE', 'vCitaSchedulingCalendar');
  define('VCITA_WIDGET_UNIQUE_ID', 'lead-capturing-call-to-actions-by-vcita');
  define('VCITA_WIDGET_UNIQUE_LOCATION', __FILE__);
  define('VCITA_WIDGET_CONTACT_FORM_WIDGET', 'true');
  define('VCITA_WIDGET_CALENDAR_WIDGET', 'true');
  define('VCITA_WIDGET_SHOW_EMAIL_PRIVACY', 'true');
  define('VCITA_WIDGET_INVITE_CODE', 'WP-V-AE');
  define('VCITA_LOGIN_PATH', VCITA_SERVER_BASE.'/integrations/wordpress/new');
  define('VCITA_CHANGE_EMAIL_PATH', VCITA_SERVER_BASE.'/integrations/wordpress/change_email');
  define('VCITA_SCHEDULING_PATH', VCITA_SERVER_BASE.'/settings/business');
  define('VCITA_SCHEDULING_TEST_DRIVE_PATH', VCITA_SERVER_BASE.'/integrations/wordpress/scheduling_test_drive');
  define('VCITA_SCHEDULING_TEST_DRIVE_DEMO_PATH', VCITA_SERVER_BASE.'/v/wordpress.demo/set_meeting');
  define('VCITA_WIDGET_DEMO_UID', 'wordpress.demo'); # vCita.com/meet2know.com demo user uid: wordpress.demo
  require_once(WP_PLUGIN_DIR.'/'.VCITA_WIDGET_UNIQUE_ID.'/vcita-utility-functions.php');
  require_once(WP_PLUGIN_DIR.'/'.VCITA_WIDGET_UNIQUE_ID.'/vcita-widgets-functions.php');
  require_once(WP_PLUGIN_DIR.'/'.VCITA_WIDGET_UNIQUE_ID.'/vcita-settings-functions.php');
  require_once(WP_PLUGIN_DIR.'/'.VCITA_WIDGET_UNIQUE_ID.'/vcita-ajax-function.php');
  
  add_action('plugins_loaded', 'vcita_init');
  add_shortcode(VCITA_WIDGET_SHORTCODE, 'vcita_add_contact');
  add_action('admin_menu', 'vcita_admin_actions');
  add_action('wp_head', 'vcita_add_active_engage');
  add_action('wp_enqueue_scripts', 'vcita_jqeury_enqueue');

  # Make AJAX URL available in frontend
  add_action('wp_enqueue_scripts', 'vcita_add_ajax_url');
  function vcita_add_ajax_url() {
    wp_localize_script('vcita_ajax_request', 'vcitaAjax',
        array('ajaxurl' => admin_url('vcita-ajax.php')));
  }
}

# Notify about other vCita plugin already available
function vcita_lead_cta_other_plugin_installed_warning() {
  echo '<div id="vcita-warning" class="error"><p><b>'.
    __('Another vCita Plugin is already installed', "vcita").
    '</b>, '.__("please deactivate the other vCita plugin").'.
    </p></div>';
}

