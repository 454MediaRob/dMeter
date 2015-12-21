<?php
/******************************************************
Plugin Name: Death Meter Plugin
Plugin URI:  http://www.google.com
Description: Plugin description to go here
Version:     0.2
Author:      Zachary Smith
Author URI:  http://URI_Of_The_Plugin_Author
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /languages
Text Domain: my-toolset
******************************************************/
/******************************************************
TODO
menu icon for plugin
add jquery cdn call to function death_meter_script
pull value for shortcode from db
******************************************************/

//create custom menu after pluginn is activated
function add_death_meter_menu() {
    //add menu item to plugin homepage
    add_menu_page (
        'Death Meter Plugin Settings',
        'Death Meter Settings',
        'manage_options',
        'death-meter-plugin-settings',
        'death_meter_admin_page_function',
        plugin_dir_url( __FILE__ ).'icons/my_icon.png',
        '23.56' //hiearchy position of menu
    );
}
//wordpress hooks to trigger settings menu creation
add_action( 'admin_menu', 'add_death_meter_menu' );

//plugin settings panel
function death_meter_admin_page_function() {?>
    <div class="wrap">
        <h2>Death Meter Plugin Options</h2>
        The form and various plugin settings options will go here
    </div>
	<?php
	}

//register css file
function death_meter_styles() {
    // Register the style like this for a plugin:
    wp_register_style( 'custom-style', plugins_url( '/css/style.css', __FILE__ ), array(), '20151221', 'all' );
 
    // For either a plugin or a theme, you can then enqueue the style:
    wp_enqueue_style( 'custom-style' );
	}
add_action( 'wp_enqueue_scripts', 'death_meter_styles' );

//register shortcode function
function death_meter_one_shortcode() {
	//define value for first shortcode
	$shortcode_one_num = 309807979090;//will be pulled from database at later date
	
	//format number to be nice english output with commas
	$english_format_number = number_format($shortcode_one_num);
	
	//multiply shortcode value by 5x
	$shortcode_one_multiplied_five = $shortcode_one_num *5;
	
	//multiply shortcode value by 20x
	$shortcode_one_multiplied_twenty = $shortcode_one_num *20;	
	
	//multiply shortcode value by 100x
	$shortcode_one_multiplied_hundred = $shortcode_one_num *100;	
	
	//return styled value
    /*return
    "<div id=\"shortcode_wrapper\">
    <h2>As Reported By The FDA</h2>
    <div class=\"shortcode_value_holder\">$english_format_number</div>
    <h2>Underreporting Adjustments</h2>
    <div class=\"shortcode_row\">
        <div class=\"shortcode_row_blockone\">$shortcode_one_multiplied_five</div>
        <div class=\"shortcode_row_blockone\">$shortcode_one_multiplied_twenty</div>
        <div class=\"shortcode_row_blockone shortcode_row_blockone_last\">$shortcode_one_multiplied_hundred</div>
    </div><!--#shortcode_row-->
    </div><!--#shortcode_wrapper -->";*/
	
	//read contents of html view
	$templateContent = include('/views/template.html');
	$content = $templateContent;
	
	echo substr($content, 0,101);
	return $english_format_number;
	//echo substr($content, 98,99);
}
 
function death_meter_one_shortcode_register_shortcode() {
    add_shortcode( 'death_meter_one', 'death_meter_one_shortcode' );
}
 
add_action( 'init', 'death_meter_one_shortcode_register_shortcode' );




?>
