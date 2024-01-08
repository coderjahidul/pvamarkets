<?php

namespace App\Includes;

use App\Includes\ViserAssets;
use App\Includes\ViserLang;

class ViserPlugin {

    protected $loader;
    protected $plugin_name;
    protected $version;

    public function run() {
		if ( defined( 'HYIPLAB_VERSION' ) ) {
			$this->version = VISER_PLUGIN_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = VISER_PLUGIN_NAME;

		$this->setLocal();
		$this->loadDependencies();
		$this->defineAdminHooks();
		$this->definePublicHooks();

	}
	
	private function setLocal()
	{
		$lang = new ViserLang();
		add_action( 'plugins_loaded', [$lang,'load_plugin_textdomain']);
	}

	private function defineAdminHooks() {
		$plugin_admin = new ViserAssets( $this->plugin_name, $this->version, 'admin' );
		add_action('admin_enqueue_scripts', [$plugin_admin, 'enqueueStyles']);
		add_action('admin_enqueue_scripts', [$plugin_admin, 'enqueueScripts']);
	}

	private function definePublicHooks() {
		$plugin = new ViserAssets( $this->plugin_name, $this->version, 'public');
		add_action('wp_enqueue_scripts', [$plugin, 'enqueueStyles']);
		add_action('wp_enqueue_scripts', [$plugin, 'enqueueScripts']);
	}

	private function loadDependencies()
	{
		$dep = new ViserRegisteredDependencies();
		$dep->load();
	}
}