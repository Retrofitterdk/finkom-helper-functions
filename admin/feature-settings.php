<?php
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'admin_menu', 'fhf_feature_add_admin_menu' );
add_action( 'admin_init', 'fhf_feature_settings_init' );

function fhf_feature_add_admin_menu() {
  add_submenu_page(
    'edit.php?post_type=feature',
    esc_html__( 'Feature Settings', 'finkom_helper_functions' ),
    esc_html__( 'Settings',      'finkom_helper_functions' ),
    'manage_options',
    'feature-settings',
    'fhf_feature_options_page'
  );

}

function fhf_feature_settings_init() {

  register_setting( 'fhf_feature_settings', 'fhf_feature_settings', 'fhf_feature_validate_settings' );

  add_settings_section(
    'general',
    esc_html__( 'General Settings', 'finkom_helper_functions' ),
    'fhf_feature_section_general_callback',
    'fhf_feature_settings'
  );

  add_settings_field(
    'fhf_feature_title',
    esc_html__( 'Title', 'finkom_helper_functions' ),
    'fhf_feature_title_render',
    'fhf_feature_settings',
    'general'
  );

  add_settings_field(
    'fhf_feature_description',
    esc_html__( 'Description', 'finkom_helper_functions' ),
    'fhf_feature_description_render',
    'fhf_feature_settings',
    'general'
  );
}

function fhf_feature_validate_settings( $settings ) {

  $settings['fhf_feature_title']        = $settings['fhf_feature_title']        ? strip_tags( $settings['fhf_feature_title'] )                     : esc_html__( 'Services', 'finkom_helper_functions' );
  // Kill evil scripts.
  $settings['fhf_feature_description'] = stripslashes( wp_filter_post_kses( addslashes( $settings['fhf_feature_description'] ) ) );

  // Return the validated/sanitized settings.
  return $settings;

}

function fhf_feature_get_title_setting() {
$options = get_option( 'fhf_feature_settings' );
$setting = $options['fhf_feature_title'];
return $setting;
}

function fhf_feature_get_description_setting() {
$options = get_option( 'fhf_feature_settings' );
$setting = $options['fhf_feature_description'];
return $setting;
}

function fhf_feature_title_render(  ) { ?>
  <label>
    <input type='text' class="regular-text" name='fhf_feature_settings[fhf_feature_title]' value='<?php echo fhf_feature_get_title_setting(); ?>'>
    <br />
    <span class="description"><?php esc_html_e( 'The name of your feature section. May be used for the page title of your feature archive and other places, depending on your theme.', 'finkom_helper_functions' ); ?></span>
  </label>
  <?php }


function fhf_feature_description_render(  ) {

  wp_editor(
    fhf_feature_get_description_setting(),
    'fhf_feature_description',
    array(
      'textarea_name'    => 'fhf_feature_settings[fhf_feature_description]',
      'drag_drop_upload' => true,
      'editor_height'    => 150
    )
  ); ?>
  <p>
    <span class="description"><?php esc_html_e( 'Description of your feature section. This may be shown on your feature archive and other places, depending on your theme.', 'finkom_helper_functions' ); ?></span>
  </p>
  <?php }

function fhf_feature_section_general_callback() { ?>
  <p class="description">
    <?php esc_html_e( 'General feature settings for your site.', 'finkom_helper_functions' ); ?>
  </p>
<?php }


function fhf_feature_options_page(  ) {
  if ( !current_user_can( 'manage_options' ) )  {
    wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
  }
  ?>
  <div class="wrap">
    <h1><?php esc_html_e( 'Feature Settings', 'finkom_helper_functions' ); ?></h1>

    <?php settings_errors(); ?>

    <form method="post" action="options.php">

      <?php
      settings_fields( 'fhf_feature_settings' );
      do_settings_sections( 'fhf_feature_settings' );
      submit_button( esc_attr__( 'Update Settings', 'finkom_helper_functions' ), 'primary' );
      ?>

    </form>
  </div><!-- wrap -->
  <?php

}
