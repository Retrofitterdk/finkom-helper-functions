<?php
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'admin_menu', 'fhf_team_add_admin_menu' );
add_action( 'admin_init', 'fhf_team_settings_init' );

function fhf_team_add_admin_menu() {
  add_submenu_page(
    'edit.php?post_type=team-member',
    esc_html__( 'Team Settings', 'finkom_helper_functions' ),
    esc_html__( 'Settings',      'finkom_helper_functions' ),
    'manage_options',
    'team-settings',
    'fhf_team_options_page'
  );
}

function fhf_team_settings_init() {

  register_setting( 'fhf_team_settings', 'fhf_team_settings', 'fhf_team_validate_settings' );

  add_settings_section(
    'general',
    esc_html__( 'General Settings', 'finkom_helper_functions' ),
    'fhf_team_section_general_callback',
    'fhf_team_settings'
  );

  add_settings_field(
    'fhf_team_title',
    esc_html__( 'Title', 'finkom_helper_functions' ),
    'fhf_team_title_render',
    'fhf_team_settings',
    'general'
  );

  add_settings_field(
    'fhf_team_description',
    esc_html__( 'Description', 'finkom_helper_functions' ),
    'fhf_team_description_render',
    'fhf_team_settings',
    'general'
  );
}

function fhf_team_validate_settings( $settings ) {

  $settings['fhf_team_title']        = $settings['fhf_team_title']        ? strip_tags( $settings['fhf_team_title'] )                     : esc_html__( 'Members', 'finkom_helper_functions' );
  // Kill evil scripts.
  $settings['fhf_team_description'] = stripslashes( wp_filter_post_kses( addslashes( $settings['fhf_team_description'] ) ) );

  // Return the validated/sanitized settings.
  return $settings;

}

function fhf_team_get_title_setting() {
$options = get_option( 'fhf_team_settings' );
$setting = $options['fhf_team_title'];
return $setting;
}

function fhf_team_get_description_setting() {
$options = get_option( 'fhf_team_settings' );
$setting = $options['fhf_team_description'];
return $setting;
}

function fhf_team_title_render() { ?>
  <label>
    <input type='text' class="regular-text" name='fhf_team_settings[fhf_team_title]' value='<?php echo fhf_team_get_title_setting(); ?>'>
    <br />
    <span class="description"><?php esc_html_e( 'The name of your team section. May be used for the page title of your team archive and other places, depending on your theme.', 'finkom_helper_functions' ); ?></span>
  </label>
  <?php }

function fhf_team_description_render() {

  wp_editor(
    fhf_team_get_description_setting(),
    'fhf_team_description',
    array(
      'textarea_name'    => 'fhf_team_settings[fhf_team_description]',
      'drag_drop_upload' => true,
      'editor_height'    => 150
    )
  ); ?>
  <p>
    <span class="description"><?php esc_html_e( 'Description of your team section. This may be shown on your team archive and other places, depending on your theme.', 'finkom_helper_functions' ); ?></span>
  </p>
  <?php }

function fhf_team_section_general_callback() { ?>
  <p class="description">
    <?php esc_html_e( 'General team settings for your site.', 'finkom_helper_functions' ); ?>
  </p>
<?php }



function fhf_team_options_page() {

  if ( !current_user_can( 'manage_options' ) )  {
    wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
  }
  ?>
  <div class="wrap">
    <h1><?php esc_html_e( 'Team Settings', 'finkom_helper_functions' ); ?></h1>

    <?php settings_errors(); ?>

    <form method="post" action="options.php">

      <?php
      settings_fields( 'fhf_team_settings' );
      do_settings_sections( 'fhf_team_settings' );
      submit_button( esc_attr__( 'Update Settings', 'finkom_helper_functions' ), 'primary' );
      ?>

    </form>
  </div><!-- wrap -->
  <?php

}
