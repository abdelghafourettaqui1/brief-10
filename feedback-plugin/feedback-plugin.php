<?php

/**
 * @package feedback-plugin
 * /

/* 
    Plugin Name: feedback
    Plugin URI: http://abdelghafour.com/plugin
    Description: A simple way to add a feedback part to your website
    Version: 1.0.0
    Author: abdelghafour ettaqui
    Author URI: https://github.com/abdelghafourettaqui1
    License: GPLv2 or later
    Text Domain: feedback-plugin

 */

//  if( ! defined('ABSPATH') ){
//    die;
//  }
defined('ABSPATH') or die('you do not have access to this file');

class feedBackPlugin
{
   function __construct()
   {
      add_action('init', array($this, 'custom_post_type'));
      add_action('wp_enqueue_scripts', array($this, 'load_assets'));
      add_shortcode('feedback-form', array($this, 'load_shortcode'));
   }

   function activate()
   {
      //generated a CPT
      $this->custom_post_type();

      //flush-rewrite_rules
      flush_rewrite_rules();
   }
   function deactivate()
   {
      //flush-rewrite_rules
      flush_rewrite_rules();
   }
   function uninstall()
   {
   }
   function custom_post_type()
   {
      $arr = array(
         'public' => true,
         'has_archive' => true,
         'supports' => array('title'),
         'exclude_from_search' => true,
         'publicly_queryable' => false,
         'capability' => 'manage_options',
         'labels' => array(
            'name' => 'feedback',
            'singular_name' => 'Contact Form Entry',
         ),
         'menu_icon' => 'dashicons-feedback',
      );
      register_post_type('feedBackPlugin', $arr);
   }
   public function load_assets()
   {
      wp_enqueue_style(
         'feedBackPlugin',
         plugin_dir_url(__FILE__) . 'css/style.css',
         array(),
         1,
         'all'
      );
      wp_enqueue_script(
         'cosmic-plugin',
         plugin_dir_url(__FILE__) . 'js/script.js',
         array(),
         1,
         'all'
      );
   }
   public function load_shortcode()
   {
?>
      <script src="https://cdn.tailwindcss.com"></script>
      
      <div class="flex justify-center">
         <form style="width: 500px; height:400px;" action="" method="POST" id="form" class=" flex flex-col items-center rounded-lg p-5">
            <H1 class="text-center text-lga font-bold">Give us your feedback </H1>
            <div class="relative z-0 w-full mb-6 group">
               <input type="text" name="name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="Name" required />
               <label for="name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Name</label>
            </div>
            <div class="relative z-0 w-full mb-6 group">
               <div class="flex flex-row-reverse justify-end ">
                  <svg class="w-8 h-8 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                     <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                  </svg>
                  <input type="number" max="5" min="1" name="rating" id="Rating" class="block py-2.5 px-0 w-62 text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="rating" required />
               </div>

               <label for="Rating" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Rating</label>
            </div>

            <div class="relative z-0 w-full mb-6 group">
               <input type="text" name="Review" id="Review" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="Review" required />
               <label for="Review" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Review</label>
               <input type="hidden" name="id" value="<?php echo get_the_ID() ?> ">
            </div>


            <button type="submit" name="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
         </form>
      </div>




<?php


   }
}





if (class_exists('feedBackPlugin')) {
   $feedBackPlugin = new feedBackPlugin();
}
//activation
register_activation_hook(__FILE__, array($feedBackPlugin, 'activate'));
//deactivation
register_deactivation_hook(__FILE__, array($feedBackPlugin, 'deactivate'));

global $wpdb;
if (isset($_POST['submit'])) {
   $name = $_POST['name'];
   $rating = $_POST['rating'];
   $review = $_POST['Review'];
   $id = $_POST['id'];
   $wpdb->insert('wp_3_review', array('Name' => $name, 'Rating' => $rating, 'Review' => $review, 'post_id' => $id));
   echo " <script> alert('thank you for send us your feedback ') </script>";
   header('refresh:0', 'Location: ' . $_SERVER['HTTP_REFERER']);
   exit();
}