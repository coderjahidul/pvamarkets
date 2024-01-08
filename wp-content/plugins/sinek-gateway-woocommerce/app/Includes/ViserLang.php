<?php

namespace App\Includes;

class ViserLang{
    public function load_plugin_textdomain() {

		load_plugin_textdomain(
			VISER_PLUGIN_NAME,
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}
}