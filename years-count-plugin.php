<?php
/*
Plugin Name: L4 Group - Years Count Plugin
Description: A plugin to calculate and display the number of years from a given start year.
Version: 1.3
Author: L4 Group LLC
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Add settings menu
function ycp_add_admin_menu() {
    add_options_page('Years Count Settings', 'Years Count', 'manage_options', 'years-count-plugin', 'ycp_options_page');
}
add_action('admin_menu', 'ycp_add_admin_menu');

// Register settings
function ycp_settings_init() {
    register_setting('ycp_settings', 'ycp_years');

    add_settings_section(
        'ycp_settings_section',
        __('Years Count Settings', 'ycp'),
        'ycp_settings_section_callback',
        'ycp_settings'
    );

    add_settings_field(
        'ycp_years',
        __('Start Years', 'ycp'),
        'ycp_years_render',
        'ycp_settings',
        'ycp_settings_section'
    );
}
add_action('admin_init', 'ycp_settings_init');

function ycp_years_render() {
    $years = get_option('ycp_years');
    if (empty($years)) {
        $years = array('');
    }
    ?>
    <div id="ycp-years-container">
        <?php foreach ($years as $year) : ?>
            <div class="ycp-year-field">
                <input type="number" name="ycp_years[]" value="<?php echo esc_attr($year); ?>" min="1500" max="<?php echo date('Y'); ?>" class="ycp-year-input">
                <button type="button" class="button ycp-remove-year">-</button>
                <input type="text" value='[l4-years-in-business est="<?php echo esc_attr($year); ?>"]' readonly class="ycp-shortcode" onclick="copyToClipboard(this)">
            </div>
        <?php endforeach; ?>
    </div>
    <button type="button" class="button" id="ycp-add-year">+</button>
    <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        function updateShortcodes() {
            var yearFields = document.querySelectorAll('.ycp-year-field');
            yearFields.forEach(function(field) {
                var yearInput = field.querySelector('.ycp-year-input');
                var shortcodeInput = field.querySelector('.ycp-shortcode');
                var year = yearInput.value;
                shortcodeInput.value = '[l4-years-in-business est="' + year + '"]';
            });
        }

        function copyToClipboard(element) {
            var tempInput = document.createElement('input');
            document.body.appendChild(tempInput);
            tempInput.value = element.value;
            tempInput.select();
            document.execCommand('copy');
            document.body.removeChild(tempInput);
            alert('Shortcode copied to clipboard: ' + element.value);
        }

        document.getElementById('ycp-add-year').addEventListener('click', function() {
            var container = document.getElementById('ycp-years-container');
            var div = document.createElement('div');
            div.className = 'ycp-year-field';
            div.innerHTML = '<input type="number" name="ycp_years[]" value="" min="1500" max="<?php echo date('Y'); ?>" class="ycp-year-input"><button type="button" class="button ycp-remove-year">-</button><input type="text" value="" readonly class="ycp-shortcode" onclick="copyToClipboard(this)">';
            container.appendChild(div);
            updateShortcodes();
        });

        document.getElementById('ycp-years-container').addEventListener('click', function(e) {
            if (e.target && e.target.className == 'button ycp-remove-year') {
                e.target.parentNode.remove();
                updateShortcodes();
            }
        });

        document.getElementById('ycp-years-container').addEventListener('input', function(e) {
            if (e.target && e.target.className.includes('ycp-year-input')) {
                updateShortcodes();
            }
        });

        window.copyToClipboard = copyToClipboard;
        updateShortcodes();
    });
    </script>
    <?php
}

function ycp_settings_section_callback() {
    echo __('Enter the start years for calculating the number of years.', 'ycp');
}

function ycp_options_page() {
    ?>
    <form action="options.php" method="post">
        <?php
        settings_fields('ycp_settings');
        do_settings_sections('ycp_settings');
        submit_button();
        ?>
    </form>
    <?php
}

// Shortcode to display the number of years
function ycp_years_count_shortcode($atts) {
    $atts = shortcode_atts(array(
        'est' => ''
    ), $atts, 'l4-years-in-business');

    $start_year = $atts['est'];
    $years = get_option('ycp_years', array());

    if (empty($start_year) || !in_array($start_year, $years)) {
        return '<small><i>[Please set the established year in the plugin settings and use the shortcode properly.]</i></small>';
    }

    $current_year = date('Y');
    $years_count = $current_year - $start_year;
    return $years_count;
}
add_shortcode('l4-years-in-business', 'ycp_years_count_shortcode');