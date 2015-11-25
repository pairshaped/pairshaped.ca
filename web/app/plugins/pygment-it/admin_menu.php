<?php 
add_action('admin_menu', 'my_plugin_menu');

function my_plugin_menu() {
  add_options_page('Pygment It', 'Pygment It',
                   'manage_options', 'TpN6aJc5tLk40rVxIA5DCNg3434RQXL1', 'my_plugin_options' );
}

function my_plugin_options() {
  if(!current_user_can('manage_options' )){
    wp_die(__( 'You do not have sufficient permissions to access this page.' ));
  }

  $default_theme_opt_val    = get_option(DEFAULT_THEME_OPTION_NAME, DEFAULT_THEME);
  $pygment_ins_opt_val      = get_option(PYGMENT_INS_OPTION_NAME);
  $default_language_opt_val = get_option(DEFAULT_LANGUAGE_OPTION_NAME);
  $default_theme_field      = 'default_theme';
  $pygment_ins_field        = 'pygment_is_ins';
  $def_language_field       = 'default_language';

  $theme_options        = array(
                           'desert', 'freya', 'github', 'inkpot', 'monokai', 'mustang', 'no_quarter',
                           'nuvola', 'peaksea', 'railscasts', 'rdark', 'slate', 'wombat'
                          );
  $pygments_ins_options = array(
                            array('a', 'auto check'), array('y', 'yes, use locally'), array('n', 'no, use external api')
                          );
  $default_lang_options = array('html', 'html+php', 'java', 'javascript', 'php', 'python', 'ruby');

  if($_POST):
    update_option(DEFAULT_THEME_OPTION_NAME, $_POST[$default_theme_field]);
    update_option(PYGMENT_INS_OPTION_NAME, $_POST[$pygment_ins_field]);
    update_option(DEFAULT_LANGUAGE_OPTION_NAME, $_POST[$def_language_field]);
    $default_theme_opt_val    = get_option(DEFAULT_THEME_OPTION_NAME, DEFAULT_THEME); 
    $pygment_ins_opt_val      = get_option(PYGMENT_INS_OPTION_NAME);
    $default_language_opt_val = get_option(DEFAULT_LANGUAGE_OPTION_NAME);

    ?>
    <div class="updated"><p><strong><?php _e('Settings saved', 'menu-test' ); ?></strong></p></div>
  <?php endif ?>
  <div class="wrap">
    <h2><?php _e('Pygment It - Settings', 'menu-test') ?></h2>
    <form name="form1" method="post" action="">
      <p><?php _e("Theme:", 'menu-test'); ?> 
        <select name="<?php echo $default_theme_field ?>">
          <?php foreach($theme_options as $c): ?>
            <option value="<?php echo $c ?>" <?php echo $c == $default_theme_opt_val ? 'selected' : '' ?>>
              <?php echo $c ?>
            </option>
          <?php endforeach ?>
        </select>
      </p>
      <p><?php _e("Pygment is installed?", 'menu-test'); ?> 
        <select name="<?php echo $pygment_ins_field ?>">
          <?php foreach($pygments_ins_options as $c): ?>
            <option value="<?php echo $c[0] ?>" <?php echo $c[0] == $pygment_ins_opt_val ? 'selected' : '' ?>>
              <?php echo $c[1] ?>
            </option>
          <?php endforeach ?>
        </select>
      </p>
      <p><?php _e("Default language (used when without explicity \"language\" attribute)", 'menu-test'); ?> 
        <select name="<?php echo $def_language_field ?>">
          <?php foreach($default_lang_options as $c): ?>
            <option value="<?php echo $c ?>" <?php echo $c == $default_language_opt_val ? 'selected' : '' ?>>
              <?php echo $c ?>
            </option>
          <?php endforeach ?>
        </select>
      </p>
      <p class="submit">
        <input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
      </p>
    </form>
  </div>
<?php } ?>