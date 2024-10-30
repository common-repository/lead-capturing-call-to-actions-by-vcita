<?php
$success = filter_var($_GET['success'], FILTER_VALIDATE_BOOLEAN);
$uid = filter_var($_GET['uid'], FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH);
$first_name = filter_var($_GET['first_name'], FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH);
$last_name = filter_var($_GET['last_name'], FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH);
$title = filter_var($_GET['title'], FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH);
$confirmation_token = filter_var($_GET['confirmation_token'], FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH);
$confirmed = filter_var($_GET['confirmed'], FILTER_VALIDATE_BOOLEAN);
$engage_delay = filter_var($_GET['engage_delay'], FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH);;
$implementation_key = filter_var($_GET['implementation_key'], FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH);;
$email = filter_var($_GET['email'], FILTER_VALIDATE_EMAIL);
$confirmed = 'true';
if(current_user_can('install_plugins')) {
    vcita_uninstall();
    vcita_clean_expert_data();
    vcita_parse_expert_data(compact(
      'success',
      'uid',
      'first_name',
      'last_name',
      'email',
      'title',
      'confirmation_token',
      'confirmed',
      'engage_delay',
      'implementation_key',
      'confirmed'
    ));

    vcita_set_contact_page();
}
$redirectURL = get_admin_url('', '', 'admin').'admin.php?page='.
    VCITA_WIDGET_UNIQUE_ID.'/vcita-settings-functions.php';
?>
<script type="text/javascript">
window.location = "<?php echo($redirectURL) ?>";
</script>
