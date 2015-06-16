<?php
	
	class TmsReadMore 
	{
		private $addScript;

		/**
		 * Initialises the plugin by registering assets & adding the shortcodes
		 *
		 * @return void		 
		 */

		public function __construct ()
		{	
			$this->enqueueAssets();
			$this->addShortcodes();
			$this->addActionsFilters();
		}

		/**
		 * Adds hooks for assets to be added
		 *
		 * @return void		 
		 */

		public function enqueueAssets ()
		{	
			add_action('wp_enqueue_scripts', array(&$this, 'registerScript'));
		}

		/**
		 * Adds filters/actions for scripts and shortcode character removal
		 *
		 * @return void		 
		 */

		public function addActionsFilters ()
		{
			add_action('wp_footer', array(&$this, 'printScript'));
			add_action('admin_head', array(&$this, 'addToTinyMCE'));
			//add_filter('the_content', array(&$this, 'removeChars'));
		}

		/**
		 * Register the JS Script
		 *
		 * @return void		 
		 */

		public function registerScript ()
		{
			wp_register_script('tms-readmore', plugin_dir_url(__FILE__) . 'assets/js/tms-readmore.min.js', array(), '1.0', true);
			wp_register_style('tms-readmore', plugin_dir_url(__FILE__) . 'assets/css/tms-readmore.css');
		}

		/**
		 * Prints the JS Script
		 *
		 * @return void		 
		 */

		public function printScript ()
		{
			if (!$this->addScript)
			{
				return false;
			}

			wp_enqueue_script('tms-readmore');
			wp_enqueue_style('tms-readmore');
		}

		/**
		 * Adds the shortcodes into Wordpress 'add_shortcode' method
		 *
		 * @return void		 
		 */

		public function addShortcodes ()
		{
			add_shortcode('readmore', array(&$this, 'readmoreShortcode'));
		}

		/**
		 * Read More/Less callback | Renders shortcode for a read more link
		 *
		 * @param array $atts Attributes passed to the shortcode
		 * @param string $content Content passed into the shortcode
		 * @return void		 
		 */

		public function readmoreShortcode ($atts, $content = '')
		{	
			$this->addScript = true;

			$attributes  = shortcode_atts(array(), $atts);

			$html = '<div class="readmore-content">'.do_shortcode($content).'</div>';

			return $html;
		}

		/**
		 * Removes <br /> & <p> tags from inside shortcode so formatting can be used
		 *
		 * @param array $content Content of the post
		 * @return String $html content without the troublesome tags		 
		 */

		public function removeChars ($content)
		{
			$block = join("|",array("readmore"));
			$rep   = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);
			$rep   = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)?/","[/$2]",$rep);

			return $rep;
		}

		/**
		 * Sets up filters to include JS file & add button into tinymce editor
		 *
		 * @return void		 
		 */	

		public function addToTinyMCE ()
		{
			if (!current_user_can('edit_posts') && !current_user_can('edit_pages'))
			{
				return false;
			}

			if (get_user_option('rich_editing') === 'true')
			{
				add_filter('mce_external_plugins', function ($plugin_array)
				{
					$plugin_array['readmore_button'] = plugin_dir_url(__FILE__) . 'assets/js/tms-readmore-tinymce.min.js';

					return $plugin_array;
				});

				add_filter('mce_buttons', function ($buttons)
				{
					array_push($buttons, 'readmore_button');

					return $buttons;
				});
			}
		}
	}

?>