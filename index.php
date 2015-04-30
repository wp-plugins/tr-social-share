<?php
/**
 * Plugin Name: TR Social Share
 * Plugin URI: http://themeroad.net/
 * Description: Display Social share Icons below every post.
 * Version:  1.1.0
 * Author: Theme Road
 * Author URI: http://themeroad.net/
 * License:  GPL2
 *Text Domain: tmrd
 *  Copyright 2015 GIN_AUTHOR_NAME  (email : BestThemeRoad@gmail.com
 *
 *	This program is free software; you can redistribute it and/or modify
 *	it under the terms of the GNU General Public License, version 2, as
 *	published by the Free Software Foundation.
 *
 *	This program is distributed in the hope that it will be useful,
 *	but WITHOUT ANY WARRANTY; without even the implied warranty of
 *	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *	GNU General Public License for more details.
 *
 *	You should have received a copy of the GNU General Public License
 *	along with this program; if not, write to the Free Software
 *	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 *
 */

//Add Menu
function tr_social_share_submenu(){

    add_submenu_page(

        'options-general.php',
        'Social Share',
        'Social Share',
        'manage_options',
        'social-share',
        'social_share_submenu_cb'

    );

}

add_action('admin_menu', 'tr_social_share_submenu');



//Register Settings

add_action('admin_init','tr_social_share_settings');

function tr_social_share_settings(){
    add_settings_section(
        'social_share_plugin_page',
        '',
        null,
        'social-share'

    );

    add_settings_field(
        'social_share_fb',
        'Display Facebook',
        'social_share_facebook_cb',
        'social-share',
        'social_share_plugin_page'
    );
        add_settings_field(
        'social-share-twitter',
        'Display Twitter',
        'social_share_twitter_cb',
        'social-share',
        'social_share_plugin_page'
    );
      add_settings_field(
        'social-share-linkedin',
        'Display Linkedin',
        'social_share_linkedin_cb',
        'social-share',
        'social_share_plugin_page'
    );

     add_settings_field(
        'social-share-reddit',
        'Display Reddit',
        'social_share_reddit_cb',
        'social-share',
        'social_share_plugin_page'
    );

    register_setting(
        'social_share_plugin_page',
        'social_share_fb'
    );
        register_setting(
        'social_share_plugin_page',
        'social-share-twitter'
    );
     register_setting(
        'social_share_plugin_page',
        'social-share-linkedin'
    );
          register_setting(
        'social_share_plugin_page',
        'social-share-reddit'
    );



}


function social_share_submenu_cb(){
    ?>
<div class="wrap">

    <h2>Social Share</h2>

    <form action="options.php" method="post">
    <?php
    settings_fields('social_share_plugin_page');
    do_settings_sections('social-share');
    submit_button();

    ?>

    </form>
</div>


<?php
}


// Field Callback

function social_share_facebook_cb(){?>

    <input type="checkbox" name="social_share_fb" value="1" <?php checked(1, get_option('social_share_fb'), true);?>/>Check for Show


<?php

}


function social_share_twitter_cb()
{  
   ?>
        <input type="checkbox" name="social-share-twitter" value="1" <?php checked(1, get_option('social-share-twitter'), true); ?> /> Check for Show
   <?php
}

function social_share_linkedin_cb()
{  
   ?>
        <input type="checkbox" name="social-share-linkedin" value="1" <?php checked(1, get_option('social-share-linkedin'), true); ?> /> Check for Show
   <?php
}

function social_share_reddit_cb()
{  
   ?>
        <input type="checkbox" name="social-share-reddit" value="1" <?php checked(1, get_option('social-share-reddit'), true); ?> /> Check for Show
   <?php
}


// Display



function add_social_share_icons($content)
{
    $html = "<div class='social-share-wrapper'><div class='share-on'>Share on: </div>";
 
    global $post;
 
    $url = get_permalink($post->ID);
    $url = esc_url($url);
 
    if(get_option("social_share_fb") == 1)
    {
        $html = $html . "<div class='facebook'><a target='_blank' href='https://www.facebook.com/sharer/sharer.php?u=" . $url . "'><i class='fa fa-facebook'></i></a></div>";
    }
 
    if(get_option("social-share-twitter") == 1)
    {
        $html = $html . "<div class='twitter'><a target='_blank' href='https://twitter.com/share?url=" . $url . "'><i class='fa fa-twitter'></i></a></div>";
    }
 
    if(get_option("social-share-linkedin") == 1)
    {
        $html = $html . "<div class='linkedin'><a target='_blank' href='http://www.linkedin.com/shareArticle?url=" . $url . "'><i class='fa fa-linkedin'></i></a></div>";
    }
 
    if(get_option("social-share-reddit") == 1)
    {
        $html = $html . "<div class='reddit'><a target='_blank' href='http://reddit.com/submit?url=" . $url . "'><i class='fa fa-reddit'></i></a></div>";
    }
 
    $html = $html . "<div class='clear'></div></div>";
 
    return $content = $content . $html;
}
 
add_filter("the_content", "add_social_share_icons");





function tr_social_share_style() 
{
    wp_register_style("social-share-style-file", plugin_dir_url(__FILE__) . "style.css");
    wp_enqueue_style("social-share-style-file");
    wp_enqueue_style("social-share-font-awesome", "https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css");
}
 
add_action("wp_enqueue_scripts", "tr_social_share_style");


