<?php

namespace App\Includes;

class ViserAssets {

    private $plugin_name;
    private $version;
    private $scope;

    private $styles;
    private $scripts;

    public function __construct( $pluginName, $version ,$scope ) {
        $this->plugin_name = $pluginName;
		$this->version = $version;
		$this->scope = $scope;
        $this->styles = RegisterAssets::$styles;
        $this->scripts = RegisterAssets::$scripts;
        
	}
    
    public function enqueueStyles() {
        foreach (@$this->styles[$this->scope] ?? [] as $style) {
            wp_enqueue_style( $this->plugin_name, plugin_dir_url('/') .$this->plugin_name. "/assets/$this->scope/css/".$style, array(), $this->version, 'all' );
        }
    }

    public function enqueueScripts() {
        foreach (@$this->scripts[$this->scope] ?? [] as $script) {
            wp_enqueue_script( $this->plugin_name, plugin_dir_url('/') .$this->plugin_name.  "/assets/$this->scope/js/".$script, array(), $this->version, 'all' );
        }
    }
}