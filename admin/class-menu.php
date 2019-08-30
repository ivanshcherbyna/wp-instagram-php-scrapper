<?php
require_once __DIR__ . '/class-clipboards.php';

final class IVD_Admin_menu extends IVD_Clipboard
{

    public static $progress_value = [];

    function __construct()
    {
        parent::__construct();

        add_action('admin_menu', array($this, 'IVD_my_plugin_menu_clipboards'));

        self::$progress_value[] = IVD_Clipboard::$first_param;
        self::$progress_value[] = IVD_Clipboard::$second_param;
        self::$progress_value[] = IVD_Clipboard::$third_param;

    }

    /*
     * Add in Settings section plugin menu
     */

    public function IVD_my_plugin_menu_clipboards()
    {

        if (current_user_can('manage_options'))
            add_options_page(
                'My Plugin Clipboards Options',
                'Clipboard-system-IVD',
                'manage_options',
                'id_clipboard_sites',
                array($this, 'IVD_my_plugin_options_clipboard'));
        return;

    }

    /*
     * Add callback function for view menu page
     */
    public function IVD_my_plugin_options_clipboard()

    {
        if (!current_user_can('manage_options')) {
            wp_die(__('You do not have sufficient permissions to access this page.'));
        }

        if (isset($_POST['save'])) {
            //check
            check_admin_referer('clipboard_IVD_post', 'clipboard_IVD_nonce_field');

            if (isset($_POST['first_param']) || isset($_POST['second_param']) || isset($_POST['third_param'])) {

                update_option('first_param', sanitize_text_field($_POST['first_param']));
                update_option('second_param', sanitize_text_field($_POST['second_param']));
                update_option('third_param', sanitize_text_field($_POST['third_param']));

            } //SAVE META OPTION
        }
        ?>

        <h3 class="heading"><?php _e('PLUGIN SETTINGS FOR USE CLIPBOARD PARAMS', 'clipboard'); ?> </h3>
        <img class="plugin-admin-image" src="<?php echo IVD_WP_INSTAGRAM_PHP_SCRAPPER; ?>image.png">
        <h3 style="color: blue; margin-left: 15px"><?php _e('For correct use this plugin you must can fill next data inputs', 'clipboard'); ?></h3>
        <form method="POST">

            <table class="form-table">
                <th>
                    <hr class="divider"/>
                    <tr style="text-align: center">
                        <td>
                            <label style="font-weight: bold; "><?php _e('General settings', 'clipboard') ?></label>
                        </td>
                        <label style="color: white; margin-left: 15px"><?php _e('Default without this params plugin used only source link & title current page', 'clipboard') ?></label>
                    </tr>
                </th>
                <tr>
                    <th><label for="first_param"><?php _e('First param for use clipboard title add', 'clipboard') ?> </label>
                    </th>

                    <td><textarea class="input-text form-control" name="first_param" cols="50">
                                <?php echo !empty($_POST['first_param']) ? esc_html($_POST['first_param']) : IVD_Clipboard::$first_param; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <th><label for="second_param"><?php _e('Second param for use clipboard title add', 'clipboard') ?></label>
                    </th>

                    <td><textarea class="input-text form-control" name="second_param" cols="50"

                        ><?php echo !empty($_POST['second_param']) ? esc_html($_POST['second_param']) : IVD_Clipboard::$second_param; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <th><label for="third_param"><?php _e('Third param for use clipboard title add', 'clipboard') ?></label>
                    </th>
                    <td><textarea class="input-text form-control" name="third_param" cols="50"
                        ><?php echo !empty($_POST['third_param']) ? esc_html($_POST['third_param']) : IVD_Clipboard::$third_param; ?></textarea>
                    </td>
                </tr>
            </table>

            <input class="button button-primary" type="submit" name="save"
                   value="<?php _e('Save changes', 'clipboard'); ?>"/>
            <!-- nonce is here ... -->
            <?php wp_nonce_field('clipboard_IVD_post', 'clipboard_IVD_nonce_field'); ?>
        </form>

        <div class="progress-wrapp">
            <div class="softhardcap_wrap">
                <label><?php _e('Fill params', 'clipboard') ?></label>
                <progress class="softhardcup" max="3" value="<?php echo count(array_filter(self::$progress_value)) ?>"
                          title="<?php echo count(self::$progress_value) ?> in 3"></progress>
            </div>
        </div>

        <?php
        add_filter('admin_footer_text', array($this, 'IVD_footer_admin_text'));//change admin label bottom
    }


    public function IVD_footer_admin_text()
    {
        echo 'Develop <a href="mailto:vanjok137@gmail.com" target="_blank" title="send message to vanjok137@gmail.com">Ivan Developer</a> thank you for using';
        wp_enqueue_style('admin_style', IVD_WP_INSTAGRAM_PHP_SCRAPPER . 'assets/style.css');
    }

}

