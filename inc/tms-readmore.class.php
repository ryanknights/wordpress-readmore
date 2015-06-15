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
			$this->addFilters();
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
		 * Adds filters for scripts and shortcode character removal
		 *
		 * @return void		 
		 */

		public function addFilters ()
		{
			add_action('wp_footer', array(&$this, 'printScript'));
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
		 * Accordion callback | Renders shortcode for an accordion
		 *
		 * @param array $atts Attributes passed to the shortcode
		 * @param string $content Content passed into the shortcode
		 * @return void		 
		 */

		public function readmoreShortcode ($atts, $content = '')
		{	
			$this->addScript = true;

			$attributes  = shortcode_atts(array(), $atts);

			$html = '<span class="readmore-content">'.do_shortcode($content).'</span>';

			return $html;
		}	
	}

?>