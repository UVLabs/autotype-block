<?php

/*
 * Plugin Name: Auto Type Block
 * Description: Shiny Gutenberg block which auto types a given sentence(s). Makes for great headers!
 * Version:           1.0.0
 * Author:            Uriahs Victor
 * Requires at least: 4.5
 * Tested up to:      5.5
 * Requires PHP: 5.6
 * License:           GPLv2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.html
*/
function autotype_block() {

    // automatically load dependencies and version
    $asset_file = include( plugin_dir_path( __FILE__ ) . 'build/index.asset.php');

    wp_register_script(
        'autotype-block',
        plugins_url( 'build/index.js', __FILE__ ),
        $asset_file['dependencies'],
        $asset_file['version']
    );

    wp_register_script(
        'autotype-block-typedjs',
        plugins_url( 'assets/js/typed.min.js', __FILE__ ),
        $asset_file['dependencies'],
        $asset_file['version']
    );

    wp_register_style( 'autotype-block-fonts', 'https://fonts.googleapis.com/css?family=Sofia' );
    // wp_register_style( 'autotype-block-fonts', 'https://fonts.googleapis.com/css?family=Bangers' );

   register_block_type( 'autotype-block/autotype-block', array(
        'script' => 'autotype-block',
    ) );



}
add_action( 'init', 'autotype_block' );

function autotype_block_is_present(){
  if(is_singular()){
     //We only want the script if it's a singular page
     $id = get_the_ID();

     if(has_block('autotype-block/autotype-block',$id)){

        wp_enqueue_script('autotype-block-misc-scripts', plugins_url( 'assets/js/scripts.js', __FILE__ ), array('autotype-block-typedjs'),'1.0.0',true);
        wp_enqueue_style('autotype-block-styles', plugins_url( 'assets/css/style.css', __FILE__ ), array(),'1.0.0');
        wp_enqueue_style( 'autotype-block-fonts' );
     }
  }
}
add_action('wp_enqueue_scripts','autotype_block_is_present');
