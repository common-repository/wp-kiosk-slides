<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       www.enformio.at
 * @since      1.0.0
 *
 * @package    Enformio_Kiosk_Slides
 * @subpackage Enformio_Kiosk_Slides/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">

    <h2><?php echo esc_html(get_admin_page_title()); ?></h2>
    <form method="post" name="kiosk_mode_options" action="options.php">
        <?php
            //Grab all options
            $options = get_option($this->plugin_name);

            $default_interval = $options['default_interval'];
            if ($default_interval == '')
                $default_interval = 3000; // milliseconds
            $post_category_slug = $options['post_category_slug'];

            settings_fields($this->plugin_name);
            do_settings_sections($this->plugin_name);
        ?>

        <fieldset>
            <legend class="screen-reader-text"><span>Default interval [milliseconds]</span></legend>
            <label for="<?php echo $this->plugin_name; ?>-default_interval">
                <span><?php esc_attr_e('Default interval [milliseconds]', $this->plugin_name); ?></span>
            </label>
            <input type="number" class="" id="<?php echo $this->plugin_name; ?>-default_interval" name="<?php echo $this->plugin_name; ?>[default_interval]" value="<?php echo $default_interval; ?>"/>
        </fieldset>
        <fieldset>
            <legend class="screen-reader-text"><span>Post category slug</span></legend>
            <label for="<?php echo $this->plugin_name; ?>-post_category_slug">
                <span><?php esc_attr_e('Post category slug', $this->plugin_name); ?></span>
            </label>
            <input type="text" class="large-text" id="<?php echo $this->plugin_name; ?>-post_category_slug" name="<?php echo $this->plugin_name; ?>[post_category_slug]" value="<?php echo $post_category_slug; ?>">
        </fieldset>

        <?php submit_button('Save all changes', 'primary','submit', TRUE); ?>
    </form>
</div>
