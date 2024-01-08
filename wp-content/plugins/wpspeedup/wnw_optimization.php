<?php
/*
Plugin Name: WpSpeedup
Plugin URI: https://w3speedup.com/
Description: Speedup the site with good scores on google page speed test and Gtmetrix
Version: 4.0.3
Author: Automattic
Author URI: https://w3speedup.com/
License: GPLv2 or later
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2005-2015 Automattic, Inc.
*/

function wnw_opti_activation(){
  global $wpdb ;
  /*----------------R(26-02-2019)----------*/
	$table_name = 'wp_speedup';
	if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
		 $sql = "CREATE TABLE IF NOT EXISTS `wp_speedup` (
		  `ID` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
		  `type` VARCHAR(11) NOT NULL,
		  `path` text NOT NULL,
		  `newpath` text NOT NULL
		) ENGINE=InnoDB AUTO_INCREMENT=".rand(1,100)." DEFAULT CHARSET=utf8;";
		 $wpdb->query($sql) ;
	}
/*----------------end----------*/
}
register_activation_hook( __FILE__, 'wnw_opti_activation' );

function md5bust($string) {
  return md5($string.'a');
}

function wnw_opti_deactivation()
{
   global $wpdb;
   $wpdb->query("DROP TABLE IF EXISTS `wp_speedup` ;");
}

register_deactivation_hook(__FILE__, 'wnw_opti_deactivation');


add_action('wp','wnw_remove_emoji');
function wnw_remove_emoji(){
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
}
wnw_prime_time('parse_start');

global $wpdb,$exclude_optimization,$optimize_image_array,$sitename, $image_home_url,$home_url,$full_url,$full_url_without_param, $secure,$additional_img,$wnw_exclude_lazyload,$exclude_css,$full_url_array,$main_css_url, $current_user,$lazy_load_js,$document_root,$fonts_api_links,$lazyload_inner_js,$lazyload_inner_ads_js,$lazyload_inner_ads_js_arr,$css_ext,$js_ext,$cache_folder_path, $speedup_options,$exclude_css_from_minify;
$speedup_options = get_option( 'wnw_wp_speedup_option', true );
$optimize_image_array = array();
$secure =  (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
$home_url = $secure.$_SERVER['HTTP_HOST'];

$image_home_url = !empty($speedup_options['cdn']) ? $speedup_options['cdn'] : $secure.$_SERVER['HTTP_HOST'];//;

$sitename = 'home';
$document_root = $_SERVER['DOCUMENT_ROOT'];
$full_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$full_url_array = explode('?',$full_url);
$full_url_without_param = $full_url_array[0];
$exclude_optimization = array();
$useragent=$_SERVER['HTTP_USER_AGENT'];
$cache_folder_path = '/wp-content/cache';
$exclude_css_from_minify = !empty($speedup_options['exclude_css']) ? explode("\r\n", $speedup_options['exclude_css']) : array();
if(!empty($speedup_options['css_mobile']) && wp_is_mobile()){
    $css_ext = 'mob.css';
    $js_ext = 'mob.js';
    $exclude_css = !empty($speedup_options['preload_css_mobile']) ? explode("\r\n", $speedup_options['preload_css_mobile']) : array();
}else{
    $css_ext = '.css';
    $js_ext = '.js';
	$exclude_css  = !empty($speedup_options['preload_css']) ? explode("\r\n", $speedup_options['preload_css']) : array();
}
 //$exclude_css = array();

$exclude_inner_js= !empty($speedup_options['exclude_inner_javascript']) ? explode("\r\n", $speedup_options['exclude_inner_javascript']) : array('google-analytics', 'hbspt','/* <![CDATA[ */');
$additional_img = array();
$lazyload_inner_js_arr = !empty($speedup_options['lazy_load_inner_js']) ? explode("\r\n", $speedup_options['lazy_load_inner_js']) : array('googletagmanager','connect.facebook.net','static.hotjar.com','js.driftt.com');
foreach($lazyload_inner_js_arr as $arr){
	$lazyload_inner_js[$arr] = '';
}
$lazyload_inner_js[$k] = $v;
$lazyload_inner_ads_js = array();//key=>value
$main_css_url = array();
$lazy_load_js = array();


function wnw_isexternal($url) {
  $components = parse_url($url);
  return !empty($components['host']) && strcasecmp($components['host'], $_SERVER['HTTP_HOST']);
}

function wnw_compress( $minify )
{
	$minify = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $minify );
	$minify = str_replace( array("\r\n", "\r", "\n", "\t",'  ','    ', '    '), ' ', $minify );
	return $minify;
}
function endswith($string, $test) {
    $strlen = strlen($string);
    $testlen = strlen($test);
    if ($testlen > $strlen) return false;
    return substr_compare($string, $test, $strlen - $testlen, $testlen) === 0;
}
function create_blank_file($path){
    $file = fopen($path,'w');
    fwrite($file,'//Silence is gloden');
    fclose($file);
}
function wnw_prime_time($text){
    /*if(empty($_REQUEST['rest'])){
        return;
    }
    global $starttime;
    if(empty($starttime)){
        $starttime = microtime(true);
    }else{
        $endtime = microtime(true);
        $duration = $endtime-$starttime;
        $hours = (int)($duration/60/60);
        $minutes = (int)($duration/60)-$hours*60;
        $seconds = (int)$duration-$hours*60*60-$minutes*60;
        echo $duration.$text.'<br>';
    }*/
}

//function wnw_str_replace_first($from, $to, $content)
//{
//    $from = '/'.preg_quote($from, '/').'/';
//    return preg_replace($from, $to, $content, 1);
//}
function wnw_parse_link($tag,$link){
	$xmlDoc = new DOMDocument();
	if (@$xmlDoc->loadHTML($link) === false){
		return array();
	}

	//$xmlDoc->loadHTML($link);

    $tag_html = $xmlDoc->getElementsByTagName($tag);
    $link_arr = array();
	if(!empty($tag_html[0])){
		foreach ($tag_html[0]->attributes as $attr) {
			$link_arr[$attr->nodeName] = $attr->nodeValue;
		}
	}
    return $link_arr;
}
function parse_script($tag,$link){
    //$link_arr = get_tags_data('>','</script>',$link);
    $data_exists = strpos($link,'>');
    if(!empty($data_exists)){
        $end_tag_pointer = strpos($link,'</script>',$data_exists);
        $link_arr = substr($link, $data_exists+1, $end_tag_pointer-$data_exists-1);
    }
    return $link_arr;
}
function implode_link_array($tag,$array){
    $link = '<'.$tag.' ';
    foreach($array as $key => $arr){
        $link .= $key.'="'.$arr.'" ';
    }
    $link .= '>';
    return $link;
}
function implode_script_array($tag,$array){
    $link = '<script ';
    foreach($array as $key => $arr){
        $link .= $key.'="'.$arr.'" ';
    }
    $link .= '></script>';
    return $link;
}
function str_replace_set($str,$rep){
    global $str_replace_str_array, $str_replace_rep_array;
    $str_replace_str_array[] = $str;
    $str_replace_rep_array[] = $rep;
}
function str_replace_bulk($html){
    global $str_replace_str_array, $str_replace_rep_array;
    $html = str_replace($str_replace_str_array,$str_replace_rep_array,$html);
    return $html;
}
function start_site_optimization(){
    ob_start();
}
function create_file_cache_js($path){
	global $document_root,$cache_folder_path;
	$cache_path = $cache_folder_path.'/wnw-cache/js';
	$cache_file_path = $cache_path.'/'.md5bust($path).'.js';
	if(!file_exists($document_root.$cache_file_path) || (file_exists($document_root.$cache_file_path) && filemtime($document_root.$cache_file_path) < filemtime($document_root.$path))){
		if(!file_exists($document_root.$cache_path)){
			mkdir($document_root.$cache_path);
			create_blank_file($document_root.$cache_path.'/index.php');
		}
		include_once 'includes/jsmin.php';
		$html = file_get_contents($document_root.$path);
		$src_array = explode('/',$path);
		$count = count($src_array);
		unset($src_array[$count-1]);
		$minify = JSMin::minify($html);
		$minify = str_replace('sourceMappingURL=','sourceMappingURL='.implode('/',$src_array),$minify.";\n");
		$file = fopen($document_root.$cache_file_path,'w');
		fwrite($file,$minify);
		fclose($file);
	}
	return $cache_file_path;
}
function create_file_cache_css($path){
	global $document_root,$home_url,$cache_folder_path;
	$cache_path = $cache_folder_path.'/wnw-cache/css';
	$cache_file_path = $cache_path.'/'.md5bust($path).'.css';

	if(!file_exists($document_root.$cache_file_path) || (file_exists($document_root.$cache_file_path) && filemtime($document_root.$cache_file_path) < filemtime($document_root.$path))){
		if(!file_exists($document_root.$cache_path)){
			mkdir($document_root.$cache_path);
			create_blank_file($document_root.$cache_path.'/index.php',0777,true);
		}
		$minify = wnw_compress(gz_relative_to_absolute_path($home_url.$path,file_get_contents($document_root.$path)));
		$file = fopen($document_root.$cache_file_path,'w');
		fwrite($file,$minify);
		fclose($file);
	}
	return $cache_file_path;
}
function create_file_cache_cssurl($url){
	global $document_root,$cache_folder_path;
	$cache_path = $cache_folder_path.'/wnw-cache/css';
	$cache_file_path = $cache_path.'/'.md5bust($url).'.css';
    if(!file_exists($document_root.$cache_file_path) || (file_exists($document_root.$cache_file_path) && time() - filemtime($document_root.$cache_file_path)) > 18000){
        $minify = wnw_compress(gz_relative_to_absolute_path($url,file_get_contents($url)));
        $file = fopen($document_root.$cache_file_path,'w');
        fwrite($file,$minify);
        fclose($file);
    }
	return $cache_file_path;
}
function create_file_cache($path){
	global $document_root;
	$ext = pathinfo($path, PATHINFO_EXTENSION);
	if($ext == 'js'){
		return create_file_cache_js($path);
	}elseif($ext == 'css'){
		return create_file_cache_css($path);
	}

}


function get_site_optimized($html){
    global $wpdb, $sitename, $image_home_url,$home_url,$full_url,$full_url_without_param, $secure,$additional_img,$wnw_exclude_lazyload,$exclude_css,$full_url_array,$main_css_url, $current_user,$lazy_load_js,$document_root,$fonts_api_links,$lazyload_inner_js,$css_ext,$js_ext,$exclude_inner_js,$exclude_optimization,$lazyload_inner_ads_js,$lazyload_inner_ads_js_arr,$cache_folder_path,$speedup_options,$exclude_css_from_minify;
	if(!empty($_REQUEST['orgurl'])){
        return $html;
    }
	if (function_exists( 'is_amp_endpoint' ) && is_amp_endpoint()) {
		return $html;
	}
    $value = $speedup_options['status'];
    if(empty($value) && empty($_REQUEST['tester'])){
         return $html;
    }
    if(is_admin()){
        return $html;
    }
    if(is_404() || (!empty($current_user) && current_user_can('edit_others_pages')) ){//
        return $html;
    }

    $current_url = !empty($full_url_without_param) ? trim($full_url_without_param,'/') : $sitename;
    $url_array = explode('/',trim(str_replace($home_url,'',$full_url),'/'));
    $sanitize_url = $current_url;
    $display_css = false;
    $full_cache_path = $document_root.$cache_folder_path.'/wnw-cache';
    $encoded_url = '';
    if(!empty($url_array)){
         if(!file_exists($document_root.$cache_folder_path)){
            mkdir($document_root.$cache_folder_path);
            create_blank_file($document_root.$cache_folder_path.'/index.php');
        }
		if(!file_exists($full_cache_path)){
            mkdir($full_cache_path,0777,true);
            create_blank_file($full_cache_path.'/index.php');
        }
        /* for($i=0; $i < count($url_array); $i++){
            $full_cache_path .= '/'.md5bust($url_array[$i]);
            $encoded_url .= '/'.md5bust($url_array[$i]);
            if(!file_exists($full_cache_path)){
                mkdir($full_cache_path,0777,true);
                create_blank_file($full_cache_path.'/index.php');
            }
        } */
    }

    /*if(!class_exists('JSMin')){
        require_once('jsmin.php');
    }*/

    $all_js= '';
    $all_js1= '';
	$all_css='';
    $all_js_html = '';
    $uri_parts = explode('?', trim(str_replace($home_url,'',$full_url),'/'), 2);
    $current_url = $full_url_without_param;
    wnw_prime_time('parse_html');
	$all_links = wnw_setAllLinks($html);

    wnw_prime_time('parse_html_done');
    //str_replace_set('id="div-gpt-ad-','class="lazyload-ads" id="div-gpt-ad-',$html);
   // str_replace_set('id=\'div-gpt-ad-','class="lazyload-ads" id=\'div-gpt-ad-',$html);
    $script_links = $all_links['script'];
    $is_js_file_updated = 0;
    //echo '<!--<pre>'; print_r($script_links);echo '</pre>-->';
	$included_js = array();
	$final_merge_js = array();
	$js_file_name = '';
	if(!empty($script_links) && $speedup_options['js'] == 'on'){
		$exclude_js_arr  = !empty($speedup_options['exclude_javascript']) ? explode("\r\n", $speedup_options['exclude_javascript']) : array();
		foreach($script_links as $script){
			//$script = str_replace(array('~~'),array("\n"),$script);
			//echo $script;
			$script_text='';
			$script_obj = array();
			$script_obj = wnw_parse_link('script',$script);
			if(!array_key_exists('src',$script_obj)){
				//echo '<!--<pre>'; print_r($script);echo '</pre>-->';
				$script_text = parse_script('<script',$script);
				//echo '<!--<pre>'; print_r($script_text);echo '</pre>-->';
				//echo '<!--<pre>'.$script; print_r($script_obj);echo '</pre>-->';
			}

			if(!empty($script_obj['type']) && strtolower($script_obj['type']) != 'text/javascript'){
				continue;
			}
			//echo '<pre>'; print_r($script_obj);echo '</pre>';
			if(!empty($script_obj['src'])){
				$url_array = parse_url($script_obj['src']);
				$exclude_js = 0;
				foreach($exclude_js_arr as $ex_js){
					if(strpos($script,$ex_js) !== false){
						$exclude_js = 1;
					}
				}
				if($exclude_js){
					continue;
				}
				if(!wnw_isexternal($script_obj['src']) && file_exists($document_root.$url_array['path']) && endswith($url_array['path'], '.js')){

					$old_path = $url_array['path'];
					$url_array['path'] = create_file_cache($url_array['path']);
					$script_obj['src'] = $home_url.$url_array['path'];

					/*--------r(26-02-2019)-----------*/

						$f_path = "SELECT ID FROM 	wp_speedup WHERE type='js' AND path='".$old_path."'";
						$exit_id = $wpdb->get_var($f_path);
						if(empty($exit_id)){
							$query = $wpdb->prepare('INSERT INTO wp_speedup SET type=%s, path= %s, newpath = %s' , array('js' ,$old_path, $script_obj['src']) ) ;
							$wpdb->query($query) ;
							$lastid = $wpdb->insert_id;
							$included_js[$script_obj['src']] = $lastid;
						}else{
							$included_js[$script_obj['src']] = $exit_id;
						}

					/*--------end-----------*/

				}
				$val = $script_obj['src'];


				if(!empty($val) && !wnw_isexternal($val) && strpos($script, '.js')){
					$filename = $document_root . $url_array['path'];
					$all_js .= file_get_contents($filename).";\n";
					str_replace_set($script,'',$html);

					/*--------R(26-02-2019-----------*/
					if(is_array($included_js) && array_key_exists ($val , $included_js) ){
						$final_merge_js[] = $included_js[$val];
					}
					/*--------end-----------*/

				}else{


							$lazy_load_js[] = $script_obj;
							str_replace_set($script,'',$html);

					//$html = str_replace($script,$script_obj->outertext,$html);
					//$html = str_replace('</body>',$script_obj->outertext.'</body>',$html);
				}


			}else{
			  //echo '<!--<pre>'; print_r($script_text);echo '</pre>-->';
			  $inner_js = $script_text;
			  /*if(strpos($script,'Five9SocialWidget')){
				  str_replace_set($script,'',$html);
				  continue;
			  }*/
			  $md5_inner_js = md5bust($inner_js);
			    /*-------------R(26-02-2019)-------------*/
					$f_path = "SELECT ID FROM wp_speedup WHERE type='js' AND newpath='".$md5_inner_js."'";
					$exit_id = $wpdb->get_var($f_path);
					if(empty($exit_id)){
						$query = $wpdb->prepare('INSERT INTO wp_speedup SET type=%s, path= %s, newpath = %s' , array('js' ,'', $md5_inner_js));
						$wpdb->query($query) ;
						$lastid = $wpdb->insert_id;
						$final_merge_js[] = $lastid;
					}else{
						$final_merge_js[] = $exit_id;
					}
				/*-------------end--------------*/

			  $lazy_loadjs = 0;
			  $exclude_js_bool = 0;
				if(!empty($exclude_inner_js)){
				  foreach($exclude_inner_js as $js){
					  if(strpos($inner_js,$js) !== false){
						 $exclude_js_bool=1;
					  }
				  }
			  }
			  if(!empty($exclude_js_bool)){
				  continue;
			  }
			  if(!empty($lazyload_inner_js)){
				  foreach($lazyload_inner_js as $key => $js){
					  if(strpos($script,$key)){
						  $lazyload_inner_js[$key] .= $inner_js.";\n";
						  $lazy_loadjs = 1;
					  }
				  }
			  }
			  if(!empty($lazyload_inner_ads_js)){
				  foreach($lazyload_inner_ads_js as $key => $js){
					  if(strpos($script,$key)){
						  $lazyload_inner_ads_js_arr[] = $inner_js;
						  $lazy_loadjs = 1;
					  }
				  }
			  }

			  if(!$lazy_loadjs){
				$all_js .= $inner_js.";\n";
			  }
			  //$all_js_html .= $script."\n";
			  str_replace_set($script,'',$html);
			}
		}
		//exit;
			$js_exists = 0;
		//remove_oldfiles($full_cache_path);
		if(!empty($all_js)){
			/*-------------R(26-02-2019)-------------*/
				$file_name = is_array($final_merge_js) ? implode('-', $final_merge_js) : '';
				if(!empty($file_name)){
					if (!file_exists($document_root.$cache_folder_path.'/wnw-cache/all-js')) {
						mkdir($document_root.$cache_folder_path.'/wnw-cache/all-js', 0775, true);
					}
					$js_file_name = md5bust($file_name).$js_ext;
          //$js_file_name = 'e4efee113ddeb2c7d6d8fd4044860af8.js';

					if(!file_exists($document_root.$cache_folder_path.'/wnw-cache/all-js/'.$js_file_name)){
						$file = fopen($document_root.$cache_folder_path.'/wnw-cache/all-js/'.$js_file_name,'w');
						//fwrite($file,str_replace(array('jQuery(document).ready(','$('),array('jQuery(document).on("onready",','jQuery('),$all_js).';jQuery(window).trigger("onready");jQuery(window).trigger("load");');
						//fwrite($file,$all_js.';jQuery(window).trigger("load");');
						fwrite($file,$all_js.(!empty($speedup_options['custom_js']) ? stripslashes($speedup_options['custom_js']) : '').';setTimeout(function(){jQuery(window).trigger("load");},100);');
						fclose($file);
					}
				}
			/*----------end-----------------*/
			/* $js_exists = rand(1,10);
			$file = fopen($full_cache_path.'/all-js'.$js_exists.$js_ext,'w');
			fwrite($file,$all_js);
			fclose($file); */
		}
	}
	if(!empty($speedup_options['custom_js_after_load'])){
		$lazyload_inner_js['custom_js'] = stripslashes($speedup_options['custom_js_after_load']);
	}
    //exit;
	if(!empty($speedup_options['lazy_load_iframe'])){
		$iframe_links = $all_links['iframe'];
		foreach($iframe_links as $img){
			//echo '<br><pre>'.print_r($img);
			$img_obj = wnw_parse_link('iframe',$img);
			$img_obj['data-src'] = $img_obj['src'];
			$img_obj['src'] = 'about:blank';
			$img_obj['data-class'] = 'LazyLoad';
			str_replace_set($img,implode_link_array('iframe',$img_obj),$html);
		}
	}
	if(!empty($speedup_options['lazy_load_video'])){
		$iframe_links = $all_links['video'];
		foreach($iframe_links as $img){
			//echo '<br><pre>'.print_r($img);
			$v_src = $image_home_url.'/blank.mp4';
			$img_new = str_replace('src=','data-class="LazyLoad" src="'.$v_src.'" data-src=',$img);
			str_replace_set($img,$img_new,$html);
		}
	}
	$excluded_img = !empty($speedup_options['exclude_lazy_load']) ? explode("\r\n",$speedup_options['exclude_lazy_load']) : array();
    $img_links = $all_links['img'];
	if(!empty($speedup_options['lazy_load'])){
    foreach($img_links as $img){
        $img_obj = wnw_parse_link('img',$img);
        $img_obj['src'] = str_replace($home_url,$image_home_url,$img_obj['src']);
		$val = $img_obj['src'];
        //$html .= $val.'<br>';


		$exclude_image = 0;
		foreach( $excluded_img as $ex_img ){
			if(strpos($img,$ex_img)!==false){
				$exclude_image = 1;
			}
		}
		if($exclude_image){
			continue;
		}

		$wnw_exclude_lazyload_img=0;
		if(!empty($wnw_exclude_lazyload)){
            foreach($wnw_exclude_lazyload as $key => $ex_img){
				if(strpos($img_obj[$key], $ex_img) !== false){
                    $wnw_exclude_lazyload_img = 1;
				}
            }
        }
        $exclude_optimization_img=1;

        if(!empty($val)){
            $url_arr = parse_url($val);
            $img_obj['src'] = $image_home_url.'/blank.png';
            if(wnw_isexternal($val) && !file_exists($document_root.$url_arr['path'])){
                if($wnw_exclude_lazyload_img){
                   $img_obj['src'] = $val;
                }else{
                    $img_obj['data-src'] = $val;
					$img_obj['data-class'] = 'LazyLoad';
                }
            }else{
                if(!$exclude_optimization_img){
                    $cache_img = get_image_cache_path($home_url.$url_arr['path'],$img_obj['title'],$img_obj['alt'] );
                }else{
                    $cache_img = 'notfound';
                }
                if($wnw_exclude_lazyload_img){
                    if(file_exists($document_root.$cache_img)){
                        $img_obj['src'] = $image_home_url.$cache_img;
                    }
                    else
                        $img_obj['src'] = $image_home_url.$url_arr['path'];
                }else{
                    if(file_exists($document_root.$cache_img) ){
                        if(!empty($img_obj['srcset'])){
                            $srcset = optimize_srcset($img_obj['srcset']);
                            $img_obj['data-srcset'] = $srcset;
                            $img_obj['srcset'] = $image_home_url.'/blank.png 500w, '.$image_home_url.'/blank.png 1000w ';
                        }
                        $img_obj['data-src'] = $image_home_url.$cache_img;
                        $img_obj['data-opt'] = 'yes';
                    }else{
                        if(!empty($img_obj['srcset'])){
                            $img_obj['data-srcset'] = str_replace($home_url,$image_home_url,$img_obj['srcset']);
                            $img_obj['srcset'] = $image_home_url.'/blank.png 500w, '.$image_home_url.'/blank.png 1000w ';
                        }
                        $img_obj['data-src'] = $image_home_url.$url_arr['path'];
                    }
					$img_obj['data-class'] = 'LazyLoad';
                }
            }

            str_replace_set($img,implode_link_array('img',$img_obj),$html);

        }

    }
}
    //exit;
    if(!empty($additional_img)){
        foreach($additional_img as $tag => $attr){
            $regex = "/(<".$tag."[^>]+>)/i";
            preg_match_all($regex, $html, $img_links);
            $img_obj = new simple_html_dom();
            foreach($img_links[0] as $img){
                $img_obj->load($img);
                if(!empty($img_obj->find($tag)[0])){
                    foreach ($img_obj->find($tag)[0]->{'attr'} as $key=>$val){
                        if($key == $attr && !empty($val) && !wnw_isexternal($val)){
                            $val = str_replace(array('http://','https://','//'),'',$val);
                            $cache_img = get_image_cache_path($secure.$val,'','');
                            if(file_exists($document_root.$cache_img)){
                                $img_obj->find($tag)[0]->{$attr} = $image_home_url.$cache_img;
                                str_replace_set($img,$img_obj->outertext,$html);
                            }
                        }
                    }
                }
            }
        }
    }
    wnw_prime_time('defer_images_done');
    $all_css1 = '';

    $css_links = $all_links['link'];
    $fonts_api_links = array();
    $i= 1;
if(!empty($css_links) && $speedup_options['css'] == 'on'){
    //echo '<pre>'; print_r($css_links);echo '</pre>'; exit;
	$included_css = array();
	$main_included_css = array();
	$final_merge_css = array();
	$final_merge_main_css = array();
	$css_file_name = '';

    foreach($css_links as $css){
        $css_obj = wnw_parse_link('link',$css);

		if($css_obj['rel'] == 'stylesheet'){
			$org_css = '';
            $media = '';
			$exclude_css1 = 0;
			if(!empty($exclude_css_from_minify)){
                foreach($exclude_css_from_minify as $ex_css){
					if(strpos($css, $ex_css) !== false){
                        $exclude_css1 = 1;
                    }
                }
            }
			if($exclude_css1){
				continue;
			}
            if(!empty($css_obj['media']) && $css_obj['media'] != 'all' && $css_obj['media'] != 'screen'){
                $media = $css_obj['media'];
            }
            $url_array = parse_url($css_obj['href']);
            if(!wnw_isexternal($css_obj['href']) && file_exists($document_root.$url_array['path']) ){
				if(!endswith($css_obj['href'], '.css') && strpos($css_obj['href'], '.css?') === false){
					continue;
					$org_css = $css_obj['href'];
					$url_array['path'] = create_file_cache_cssurl($css_obj['href']);
					$css_obj['href'] = $home_url.$url_array['path'];
				}else{
					$org_css = $home_url.$url_array['path'];
					$url_array['path'] = create_file_cache($url_array['path']);
					$css_obj['href'] = $home_url.$url_array['path'];
					/*-------------R(26-02-2019--------*/
						$f_path = "SELECT ID FROM wp_speedup WHERE type='css' AND path='".$org_css."'";
						$exit_id = $wpdb->get_var($f_path);
						if(empty($exit_id)){
							$query = $wpdb->prepare('INSERT INTO wp_speedup SET type=%s, path= %s, newpath = %s' , array('css' ,$org_css, $css_obj['href']));
							$wpdb->query($query) ;
							$lastid = $wpdb->insert_id;
							$included_css[$css_obj['href']] =  $lastid;
						}else{
							$included_css[$css_obj['href']] =  $exit_id;
						}
					/*----------end-----------------*/

				}
			}
			$full_css_url = $css_obj['href'];
            $url = explode('?',$full_css_url);
            $url_array = parse_url($full_css_url);

            if($url_array['host'] == 'fonts.googleapis.com'){
				if(empty($speedup_options['google_fonts'])){
					continue;
				}
                parse_str($url_array['query'], $get_array);
                if(!empty($get_array['family'])){
                    $font_array = explode('|',$get_array['family']);
                    foreach($font_array as $font){
                        $font_split = explode(':',$font);
                        $fonts_api_links[$font_split[0]] = explode(',',$font_split[1]);
                    }
                }
                str_replace_set($css,'', $html);
                continue;
            }
            $src = $url[0];
            $include_as_inline = 0;
            if(!empty($exclude_css)){
                foreach($exclude_css as $ex_css){
					if(strpos($org_css, $ex_css) !== false){
                        $include_as_inline = 1;
                    }
                }
            }
			$src = $full_css_url;
			if(!empty($src) && !wnw_isexternal($src) && !empty($include_as_inline) && endswith($src, '.css') ){

                $path = parse_url($src, PHP_URL_PATH);
                $filename = $document_root.$path;
                $inline_css_var = file_get_contents($filename);
                $inline_css[$filename]['filename'] = $filename;
				$inline_css[$filename]['media'] = $media;//!empty($media) ? '@'.$media.'{'.$inline_css_var.'}' : $inline_css_var ;
				/*-------------R(26-02-2019--------*/
					if(is_array($included_css) && array_key_exists ($src , $included_css) ){
						$final_merge_main_css[] = $included_css[$src];
					}
				/*-------------end--------*/
                str_replace_set($css,'',$html);
            }elseif(!empty($src) && !wnw_isexternal($src) && endswith($src, '.css')){
                $path = parse_url($src, PHP_URL_PATH);
                $filename = $document_root.$path;
                if(filesize($filename) > 0){
                    $inline_css_var = file_get_contents($filename);
                    $all_css .= !empty($media) ? '@'.$media.'{'.$inline_css_var.'}' : $inline_css_var ;
                }
				/*-------------R(26-02-2019--------*/
					if(is_array($included_css) && array_key_exists ($src , $included_css) ){
						$final_merge_css[] = $included_css[$src];
					}
				/*-------------end--------*/

                str_replace_set($css,'',$html);
            }elseif(endswith($full_css_url, '.css') || strpos($full_css_url, '.css?')){
                $main_css_url[] = $full_css_url;
                str_replace_set($css,'',$html);
            }
        }
    }

    //exit;
    $css_exists = 0;
    if(!empty($all_css)){
		/*-------------R(26-02-2019--------*/
			$file_name = is_array($final_merge_css) ? implode('-', $final_merge_css) : '';

			if(!empty($file_name)){
				if (!file_exists($document_root.$cache_folder_path.'/wnw-cache/all-css')) {
					mkdir($document_root.$cache_folder_path.'/wnw-cache/all-css');
				}
				$css_file_name = md5bust($file_name).$css_ext;
        //$css_file_name = 'e197720a612662e5c7572146655440b3.css';
				if(!file_exists($document_root.$cache_folder_path.'/wnw-cache/all-css/'.$css_file_name)){
					$file = fopen($document_root.$cache_folder_path.'/wnw-cache/all-css/'.$css_file_name,'w');
					fwrite($file,$all_css);
					fclose($file);
				}
			}
		/*-------------end--------*/

		/* $css_exists = rand(1,10);
		$file = fopen($full_cache_path.'/all-css'.$css_exists.$css_ext,'w');
		fwrite($file,$all_css);
		fclose($file); */
    }
}

    //print_r($fonts_api_links); exit;
    wnw_prime_time('defer_css_done');
	$appendonstyle = 0;
    if(strpos($html,'<style') !== false){
    	$appendonstyle=1;
    }

    if(!empty($fonts_api_links)){
        //$fonts_api_links = implode('|', $fonts_api_links);
        $all_links = '';
        foreach($fonts_api_links as $key => $links){
            //$html = str_replace('</head>','<style>'.get_curl_url($secure."fonts.googleapis.com/css?family=".$links).'</style></head>',$html);
            $all_links .= $key.':'.implode(',',$links).'|';
        }
        global $google_font;
        $google_font[] = $secure."fonts.googleapis.com/css?family=".urlencode(trim($all_links,'|'));
		/*$google_font_text = get_curl_url($google_font);
		if($appendonstyle){
        	$html = preg_replace('/<style/', '<style>'.$google_font_text.'</style><style', $html, 1);
        }else{
        	$html = preg_replace('/<script/', '<style>'.$google_font_text.'</style><script', $html, 1);
        }*/
    }
    $encoded_url= trim($encoded_url,'/');
    $encoded_url = !empty($encoded_url) ? '/'.$encoded_url.'/' : '/';
    $html = gz_relative_to_absolute_path($home_url.'/test.html',$html);
    $html = str_replace_bulk($html);

	//$inline_css = (count($inline_css) > 0 ) ? array_reverse($inline_css) : $inline_css ;
    $all_inline_css = '';
    foreach($inline_css as $inline){
		//$html .= file_get_contents($inline['filename']);
        $all_inline_css .= !empty($inline['media']) ? '@'.$inline['media'].'{'.file_get_contents($inline['filename']).'}' : file_get_contents($inline['filename']) ;
    }
	$all_inline_css .= (!empty($speedup_options['custom_css']) ? stripslashes($speedup_options['custom_css']) : '').'@keyframes fadeIn {  to {    opacity: 1;  }}.fade-in {  opacity: 0;  animation: fadeIn .5s ease-in 1 forwards;}.is-paused {  animation-play-state: paused;}';
	if($speedup_options['load_main_css_as'] == 'on' && !empty($all_inline_css)){
		$file_name = is_array($final_merge_main_css) ? implode('-', $final_merge_main_css) : '';
		$main_css_file_name = md5bust($file_name).$css_ext;
    //$main_css_file_name = 'e197720a612662e5c7572146655440b3.css';

		$main_css_link = $home_url.$cache_folder_path.'/wnw-cache/all-css/'.$main_css_file_name ;
		if(!file_exists($document_root.$cache_folder_path.'/wnw-cache/all-css/'.$main_css_file_name)){
			if (!file_exists($document_root.$cache_folder_path.'/wnw-cache/all-css')) {
				mkdir($document_root.$cache_folder_path.'/wnw-cache/all-css');
			}
			$file = fopen($document_root.$cache_folder_path.'/wnw-cache/all-css/'.$main_css_file_name,'w');
			fwrite($file,$all_inline_css);
			fclose($file);
		}

		if($appendonstyle){
			$html = preg_replace('/<style/', '<link rel="stylesheet" href="'.$main_css_link.'" /><style', $html, 1);
		}else{
			$html = preg_replace('/<script/', '<link rel="stylesheet" href="'.$main_css_link.'" /><script', $html, 1);
		}
	}else{
		if($appendonstyle && !empty($all_inline_css)){
			$html = preg_replace('/<style/', '<style>'.$all_inline_css.'</style><style', $html, 1);
		}else{
			$html = preg_replace('/<script/', '<style>'.$all_inline_css.'</style><script', $html, 1);
		}
	}
    if(!empty($css_file_name)){
      //$css_file_name='e197720a612662e5c7572146655440b3.css';
        //$main_css_link = $home_url.$cache_folder_path.'/wnw-cache'.$encoded_url.'all-css'.$css_exists.$css_ext;
		$main_css_link = $home_url.$cache_folder_path.'/wnw-cache/all-css/'.$css_file_name ;
		if($speedup_options['load_combined_css'] == 'after_page_load'){
			$main_css_url[] = $main_css_link;
		}else{
			if($appendonstyle){
				$html = preg_replace('/<style/',  '<link rel="stylesheet" href="'.$main_css_link.'" /><style', $html, 1);
			}else{
				$html = preg_replace('/<script/',  '<link rel="stylesheet" href="'.$main_css_link.'" /><script', $html, 1);
			}
		}
    }
   if(!empty($js_file_name)){
     //$js_file_name = 'e4efee113ddeb2c7d6d8fd4044860af8.js';
        //$main_js_url = $home_url.$cache_folder_path.'/wnw-cache'.$encoded_url.'all-js'.$js_exists.$js_ext;
		$main_js_url = $home_url.$cache_folder_path.'/wnw-cache/all-js/'.$js_file_name;
		if($speedup_options['load_combined_js'] == 'after_page_load'){
			$lazy_load_js[] = array('src'=>$main_js_url);
		}else{
			$html = str_replace('</body>','<script defer="defer" id="main-js" src="'.$main_js_url.'"></script></body>',$html);
		}
		/*if(wp_is_mobile() && strpos($full_url,'/epayments/') !== true ){
			$lazy_load_js[] = $main_js_url;
		}else{*/
			//$html = str_replace('</body>','<script defer="defer" id="main-js" src="'.$main_js_url.'"></script></body>',$html);
			//$lazy_load_js[] = array('src'=>$main_js_url);
        //}
    }
    $html = str_replace('</body>','<script>'.lazy_load_images().'</script></body>',$html);

    wnw_prime_time('html_done');
	return $html;

}
function lazy_load_images(){
    global $home_url, $full_url_without_param, $image_home_url,$wnw_exclude_lazyload,$main_css_url, $lazy_load_js,$document_root,$optimize_image_array,$lazyload_inner_js,$lazyload_inner_ads_js_arr,$google_font;
    $script = 'var lazy_load_js='.json_encode($lazy_load_js).';
        var lazy_load_css='.json_encode($main_css_url).';
        var optimize_images_json='.json_encode($optimize_image_array).';
		var googlefont='.json_encode($google_font).';
        var lazyload_inner_js = '.json_encode($lazyload_inner_js).';
        var lazyload_inner_ads_js = '.json_encode($lazyload_inner_ads_js_arr).';
        var wnw_first_js = false;
        var wnw_first_inner_js = false;
        var wnw_first_css = false;
		var wnw_first_google_css = false;
        var wnw_first = false;
        var wnw_optimize_image = false;
		var mousemoveloadimg = false;
        /*load_extJS();*/
		setTimeout(function(){load_googlefont();},1000);
        window.addEventListener("load", function(event){
			     setTimeout(function(){load_extJS();},10000);
           setTimeout(function(){load_innerJS();},10000);
            lazyloadimages(0);
        });
        window.addEventListener("scroll", function(event){
           load_all_js();
		});
		window.addEventListener("mousemove", function(){
			load_all_js();
		});
		window.addEventListener("touchstart", function(){
			load_all_js();
		});
		function load_googlefont(){
			if(wnw_first_google_css == false && typeof googlefont != undefined && googlefont != null && googlefont.length > 0){
				googlefont.forEach(function(src) {
					var load_css = document.createElement("link");
					load_css.rel = "stylesheet";
					load_css.href = src;
					load_css.type = "text/css";
					var godefer2 = document.getElementsByTagName("link")[0];
					if(godefer2 == undefined){
						document.getElementsByTagName("head")[0].appendChild(load_css);
					}else{
						godefer2.parentNode.insertBefore(load_css, godefer2);
					}
				});

				wnw_first_google_css = true;
			}
		}
		function load_all_js(){
			if(wnw_first_js == false && lazy_load_js.length > 0){
				load_extJS();
			}
			if(wnw_first_inner_js == false){
				load_innerJS();
			}
			if(mousemoveloadimg == false){
				var top = this.scrollY;
				lazyloadimages(top);
				mousemoveloadimg = true;
			}
		}
        function load_innerJS(){
            if(wnw_first_inner_js == false){
                for(var key in lazyload_inner_js){
                    if(lazyload_inner_js[key] != ""){
                        var s = document.createElement("script");
                        s.innerHTML =lazyload_inner_js[key];
                        document.getElementsByTagName("body")[0].appendChild(s);
                    }
                }
                wnw_first_inner_js = true;
            }
        }
        function load_extJS() {
            if(wnw_first_js == false && lazy_load_js.length > 0){

               lazy_load_js.forEach(function(script) {
                    var s = document.createElement("script");
                    s["type"] = "text/javascript";
					for(var key in script){
						console.log(key);
						s.setAttribute(key, script[key]);
					}
					console.log(s);
                    document.getElementsByTagName("head")[0].appendChild(s);

                });
				load_extCss();
                wnw_first_js = true;
            }
        }
    var exclude_lazyload = '.json_encode($wnw_exclude_lazyload).';
    var win_width = screen.availWidth;
    function load_extCss(){
        if(wnw_first_css == false && lazy_load_css.length > 0){
            lazy_load_css.forEach(function(src) {
                var load_css = document.createElement("link");
                load_css.rel = "stylesheet";
                load_css.href = src;
                load_css.type = "text/css";
                var godefer2 = document.getElementsByTagName("link")[0];
				if(godefer2 == undefined){
					document.getElementsByTagName("head")[0].appendChild(load_css);
				}else{
					godefer2.parentNode.insertBefore(load_css, godefer2);
				}
            });
            wnw_first_css = true;
        }
    }


    window.addEventListener("scroll", function(event){
         var top = this.scrollY;
         lazyloadimages(top);
         lazyloadiframes(top);

    });
    setInterval(function(){lazyloadiframes(top);},8000);
    setInterval(function(){lazyloadimages(0);},3000);
    function lazyload_img(imgs,bodyRect,window_height,win_width){
        for (i = 0; i < imgs.length; i++) {

            if(imgs[i].getAttribute("data-class") == "LazyLoad"){
                var elemRect = imgs[i].getBoundingClientRect(),
                offset   = elemRect.top - bodyRect.top;
                if(elemRect.top != 0 && elemRect.top - window_height < 200 ){
                    /*console.log(imgs[i].getAttribute("data-src")+" -- "+elemRect.top+" -- "+window_height);*/
                    var src = imgs[i].getAttribute("data-src") ? imgs[i].getAttribute("data-src") : imgs[i].src ;
                    var srcset = imgs[i].getAttribute("data-srcset") ? imgs[i].getAttribute("data-srcset") : "";
					imgs[i].onload = function () {
						console.log("The image has loaded!");
						if (this.classList.contains("is-paused")){
						  this.classList.remove("is-paused");
						}
					};
					imgs[i].className += " fade-in is-paused";
                    imgs[i].src = src;
                    if(imgs[i].srcset != null & imgs[i].srcset != ""){
                        imgs[i].srcset = srcset;
                    }
                    delete imgs[i].dataset.class;
                    imgs[i].setAttribute("data-done","Loaded");
                }
            }
        }
    }
    function lazyload_video(imgs,top,window_height,win_width){
        for (i = 0; i < imgs.length; i++) {
            var source = imgs[i].getElementsByTagName("source")[0];
		    if(typeof source != "undefined" && source.getAttribute("data-class") == "LazyLoad"){
                var elemRect = imgs[i].getBoundingClientRect();
        	    if(elemRect.top - window_height < 0 && top > 0){
		            var src = source.getAttribute("data-src") ? source.getAttribute("data-src") : source.src ;
                    var srcset = source.getAttribute("data-srcset") ? source.getAttribute("data-srcset") : "";
                    imgs[i].src = src;
                    if(source.srcset != null & source.srcset != ""){
                        source.srcset = srcset;
                    }
                    delete source.dataset.class;
                    source.setAttribute("data-done","Loaded");
                }
            }
        }
    }
    function lazyloadimages(top){
        var imgs = document.getElementsByTagName("img");
        var ads = document.getElementsByClassName("lazyload-ads");
        var sources = document.getElementsByTagName("video");
        var bodyRect = document.body.getBoundingClientRect();
        var window_height = window.innerHeight;
        var win_width = screen.availWidth;
        lazyload_img(imgs,bodyRect,window_height,win_width);
        lazyload_video(sources,top,window_height,win_width);
    }

    lazyloadimages(0);
    function lazyloadiframes(top){
        var bodyRect = document.body.getBoundingClientRect();
        var window_height = window.innerHeight;
        var win_width = screen.availWidth;
        var iframes = document.getElementsByTagName("iframe");
        lazyload_img(iframes,bodyRect,window_height,win_width);
    }';
    return $script;
}
if(!empty($_REQUEST['set-opt'])){
    //echo 'asdfasd'; exit;
    if(empty($_POST['images123'])){
        exit;
    }
    global $full_url_without_param, $home_url, $secure,$image_home_url,$cache_folder_path;
    $images = json_decode(stripslashes($_POST['images123']));
    foreach($images as $image){
        if(!empty($image->url) /*&& !empty($image->width) && $image->width > 5*/ && (strpos($image->url,'.jpg') || strpos($image->url,'.png') || strpos($image->url,'.jpeg'))){
            $img_url = explode('?',$image->url);
            $path = parse_url($image->url, PHP_URL_PATH);
            $image_path = str_replace($home_url,'',$img_url[0]);
            $url_array = explode('/',trim(str_replace($secure,'',$image_path),'/'));
            $full_path = $document_root.$cache_folder_path.'/wnw-images';
            if(!file_exists($full_path)){
                mkdir($full_path);
            }
            for($i=0; $i < count($url_array); $i++){
                $full_path .= '/'.$url_array[$i];
                if($i+1 == count($url_array)){
                    break;
                }
                if(!file_exists($full_path)){
                    mkdir($full_path);
                    create_blank_file($full_path.'/index.php');
                }
            }
            $info = explode('.',$image_path);
            $extension = '.'.end($info);
            //$info = @getimagesize($document_root.$image_path);
            //$extension = image_type_to_extension($info[2]);
            if(!file_exists($full_path.'min'.$extension)){
                $info = @getimagesize($document_root.$image_path);
                if(!empty($info[0])){
                    $new_image1024 = optimize_image($info[0],$img_url[0]);
                }
                file_put_contents($full_path.'min'.$extension, $new_image1024);
            }
            echo $full_path.'min'.$extension;
        }
    }
    //print_r($images);
    exit;
}
function get_curl_url($url){
    $agent= 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_VERBOSE, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_REFERER, true);
    $User_Agent = 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.43 Safari/537.31';
    $request_headers = array();
    $request_headers[] = 'User-Agent: '. $User_Agent;
    $request_headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
    curl_setopt($ch, CURLOPT_USERAGENT, $agent);
    curl_setopt($ch, CURLOPT_URL,$url);
    $result=curl_exec($ch);
    curl_close($ch);
    return $result;
}
function optimize_image($width,$url){
    $width = $width < 1920 ? $width : 1920;
	echo 'https://w3speedup.com/optimize/basic.php?width='.$width.'&url='.urlencode($url);
    return get_curl_url('https://w3speedup.com/optimize/basic.php?width='.$width.'&url='.urlencode($url));
}


function sanitize_output($buffer){

    $search = '/<!--(.|\s)*?-->/';

    $replace = '';

    $buffer = preg_replace($search, $replace, $buffer);

    return $buffer;
}

$uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
$current_url = $uri_parts[0];
$url_array = explode('/',trim($current_url,'/'));
$url_array = array_reverse($url_array);
if(!empty($_REQUEST['testing'])){
    echo '<pre>';
    print_r($_SERVER);
    exit;
    echo $current_url;
    print_r($url_array);
    exit;
}
function create_log($data){
    global $document_root;
    $f = fopen($document_root.'/cache_log.txt','a');
    fwrite($f,$data."\n");
    fclose($f);
}

function gz_relative_to_absolute_path($url, $string){
    global $image_home_url, $home_url,$document_root,$secure,$fonts_api_links;
	$url_arr = parse_url($url);
    $url = $home_url.$url_arr['path'];
    $matches = wnw_get_tags_data($string,'url(',')');
	$replaced = array();
    $replaced_new = array();
    $replace_array = explode('/',str_replace('\'','/',$url));
    $replace_array = array_reverse($replace_array);
    unset($replace_array[0]);
    //echo '<pre>'; print_r($matches); echo '</pre>';
    foreach($matches as $match){
		if(strpos($match,'data:') !== false || strpos($match,'(#') !== false){
            continue;
        }
        $org_match = $match;
        //echo '<pre>'; print_r($replace_array); echo '</pre>'; exit();
		$match1 = str_replace(array('url(',')',"url('","')",')',"'",'"','&#039;'), '', html_entity_decode($match));
        $match1 = trim($match1);
		if(strpos($match1,'//') > 7){
            $match1 = substr($match1, 0, 7).str_replace('//','/', substr($match1, 7));
        }

        $url_arr = parse_url($match1);
        //$match1 = $url_arr['path'];
		//echo $match1.'<br>';
        if(strpos($match,'fonts.googleapis.com') !== false){

            $string = str_replace('@import '.$match.';','', $string);
            parse_str($url_arr['query'], $get_array);
            if(!empty($get_array['family'])){
                $font_array = explode('|',$get_array['family']);
                foreach($font_array as $font){
                    $font_split = explode(':',$font);
                    $fonts_api_links[$font_split[0]] = explode(',',$font_split[1]);
                }
            }
            //$fonts_api_links[] = str_replace(array('family=','&'), '', $url_arr['query']);
            continue;
        }


        if(wnw_isexternal($match1)){
            continue;
        }
		$match1 = str_replace($home_url,$image_home_url,$match1);
		$match1 = $url_arr['path'];
		$match1= trim($match1);
        if(empty($match1)){
            $string = str_replace($org_match, '', $string);
            continue;
        }
        /*if(strpos($match1,'//') !== false ){
            continue;
        }*///commented due to image not optimizing.
        $url_array = explode('/',$match1);
        $image_name = end($url_array);
        $image_start_array = trim($url_array[0]);
        //echo '<pre>'; print_r($url_array); echo '</pre>';
        if(empty($image_start_array)){
            $replacement = $image_home_url.trim($match1);
            if(strpos($replacement,'.jpg') || strpos($replacement,'.png') || strpos($replacement,'.jpeg') ){
                $replacement = str_replace(array("'",$home_url),array('',$image_home_url), $replacement);
            }
        }else{
            $i=1;
            if(strpos($match1,'.jpg') === false && strpos($match1,'.png') === false && strpos($match1,'.jpeg') === false && strpos($match1,'.woff') === false && strpos($match1,'.woff2') === false && strpos($match1,'.svg') === false && strpos($match1,'.ttf') === false  && strpos($match1,'.eot') === false && strpos($match1,'.gif') === false && strpos($match1,'.webp') === false && strpos($match1,'.css') === false ){
                continue;
            }
            $replace_array1 = $replace_array;
            foreach($url_array as $key => $slug){
                $slug = str_replace("'", '', $slug);
                if($slug == '.' ){
					unset($url_array[$key]);
					$i--;
				}elseif($slug == '..' ){
                    if($url != $home_url){
                        unset($replace_array1[$i]);
                    }
                    unset($url_array[$key]);
                }

                $i++;
            }

            $replace_array1 = array_reverse($replace_array1);
            $replacement = trim(implode('/',$replace_array1),'/').'/'.trim(implode('/',$url_array),'/');
            if(strpos($replacement,'jpg') || strpos($replacement,'png') || strpos($replacement,'jpeg') ){
                $replacement = str_replace(array("'",$home_url),array('',$image_home_url), $replacement);
            }

        }
		if(!in_array($image_name , $replaced)){
			$replaced['org'] = $match;
			$replaced_new['match'][] = $match;
            $replaced_new['replacement'][] = 'url('.$replacement.')';
        }

    }
	$string = str_replace($replaced_new['match'], $replaced_new['replacement'], $string);

    return $string;
}

function get_random_string(){
    $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
     $string = '';
     $random_string_length = 20;
     $max = strlen($characters) - 1;
     for ($i = 0; $i < $random_string_length; $i++) {
          $string .= $characters[mt_rand(0, $max)];
     }
    return $string;
}

 function rrmdir($dir) {
  if (is_dir($dir)) {
    $objects = scandir($dir);
    foreach ($objects as $object) {
      if ($object != "." && $object != "..") {
        if (filetype($dir."/".$object) == "dir")
            rrmdir($dir."/".$object);
        else{
			/*if(time() - filemtime($dir."/".$object) > 86400 ){*/
				@unlink($dir."/".$object);
			//}
        }
      }
    }
    reset($objects);
    @rmdir($dir);
  }
 }

function wnw_remove_cache_files_hourly_event_callback() {
    global $document_root,$cache_folder_path, $wpdb;
	$wpdb->query("DROP TABLE IF EXISTS wp_speedup");
	wnw_opti_activation();
	rrmdir($document_root.$cache_folder_path.'/wnw-cache');
}

function wnw_remove_cache_redirect(){
	header("Location:".add_query_arg(array('delete_wp_speedup_cache'=>1),$_SERVER['HTTP_REFERER']));
	exit;
}
if(!empty($_REQUEST['delete-wnw-cache'])){
	add_action('init','wnw_remove_cache_files_hourly_event_callback');
    add_action('init','wnw_remove_cache_redirect');
}

function get_image_cache_path($url, $title, $alt){
    global $home_url, $full_url_without_param, $image_home_url,$document_root, $optimize_image_array;;
    //echo '----'.$url.'------';
    $img_url = explode('?',$url);
    $parse_url = parse_url($url);
    $image_path = $parse_url['path'];
    $url_array = explode('/',trim($image_path,'/'));
    $full_path = '/wnw-images';
    for($i=0; $i < count($url_array); $i++){
        $full_path .= '/'.$url_array[$i];
    }
    $info = explode('.',$image_path);
    $extension = '.'.end($info);
    //$info = @getimagesize($document_root.$image_path);
    //$extension = image_type_to_extension($info[2]);
    $new_path = $full_path.'min'.$extension;
    if(!file_exists($document_root.$new_path) && ($extension == '.jpg' || $extension == '.jpeg' || $extension == '.png') && !wnw_isexternal($url) && count($optimize_image_array) < 30 ){
        $info = @getimagesize($document_root.$image_path);
        $optimize_image_array[] = array('url'=>$img_url[0],'width'=>$info[0],'title'=>'','alt'=>'','win_width'=>0);
    }elseif(file_exists($document_root.$new_path) ){
        $info = @getimagesize($document_root.$image_path);
        $info_new = @getimagesize($document_root.$new_path);
        //echo $info[0].' != '.$info_new[0].$new_path.'<br>';
        if($info[0] != $info_new[0] && $info_new[0] != 1920 ){
            unlink($document_root.$new_path);
        }

    }
    return $new_path;
}
function optimize_srcset($srcset){
    global $home_url, $full_url_without_param, $image_home_url,$document_root, $optimize_image_array, $secure;
    $images_array = explode(',',$srcset);
    $final_srcset_array = array();
    foreach($images_array as $images_full){
        $images = $secure.str_replace(array('https://','http://','//'),'',trim($images_full));
        $images = str_replace($image_home_url,$home_url,$images);
        $image = explode(' ',trim($images));
        $img_url = explode('?',$image[0]);
        if(wnw_isexternal($img_url[0])){
           $final_srcset_array[] = $images;
            continue;
        }
        $image_path = str_replace($home_url,'',$img_url[0]);
        $url_array = explode('/',trim($image_path,'/'));
        $full_path = '/wnw-images';
        for($i=0; $i < count($url_array); $i++){
            $full_path .= '/'.$url_array[$i];
        }
        $info = explode('.',$image_path);
        $extension = '.'.end($info);
        //$info = @getimagesize($document_root.$image_path);
        //$extension = image_type_to_extension($info[2]);
        $new_path = $full_path.'min'.$extension;
        if(!file_exists($document_root.$new_path) && ($extension == '.jpg' || $extension == '.jpeg' || $extension == '.png') && count($optimize_image_array) < 30){
            $optimize_image_array[] = array('url'=>$img_url[0],'width'=>$info[0],'title'=>'','alt'=>'','win_width'=>0);
            $final_srcset_array[] = $img_url[0].' '.$image[1];
        }else{
            $final_srcset_array[] = $images_full;
        }
    }
    return implode(', ',$final_srcset_array);
}
function compress_js($html){
    $html = JSMin::minify($html);
    return $html;
}
function wnw_microtime_float()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}
function wnw_setAllLinks($data){
    $comment_tag = wnw_get_tags_data($data,'<!--','-->');
    foreach($comment_tag as $comment){
        $data = str_replace($comment,'',$data);
    }
    $script_tag = wnw_get_tags_data($data,'<script','</script>');
    $img_tag = wnw_get_tags_data($data,'<img','>');
    $link_tag = wnw_get_tags_data($data,'<link','>');
    $style_tag = wnw_get_tags_data($data,'<style','</style>');
    $iframe_tag = wnw_get_tags_data($data,'<iframe','>');
    $video_tag = wnw_get_tags_data($data,'<video','</video>');
    return array('script'=>$script_tag,'img'=>$img_tag,'link'=>$link_tag,'style'=>$style_tag,'iframe'=>$iframe_tag,'video'=>$video_tag);


}

function wnw_get_tags_data($data,$start_tag,$end_tag){
    $data_exists = 0; $i=0;
    $tag_char_len = strlen($start_tag);
    $end_tag_char_len = strlen($end_tag);
    $script_array = array();
    while($data_exists != -1 && $i<500) {
        $data_exists = strpos($data,$start_tag,$data_exists);
        if(!empty($data_exists)){
            $end_tag_pointer = strpos($data,$end_tag,$data_exists);
            $script_array[] = substr($data, $data_exists, $end_tag_pointer-$data_exists+$end_tag_char_len);
            $data_exists = $end_tag_pointer;
        }else{
            $data_exists = -1;
        }
        $i++;
    }
    return $script_array;
}

 //echo get_site_optimized(file_get_contents(__DIR__.'/test.html')); exit;

function wnw_start_optimization_callback() {
    ob_start("get_site_optimized");

}

function wnw_ob_end_flush() {
	if (ob_get_level() != 0) {
		ob_end_flush();
     }
}
if(!is_admin() && !(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest')){
	register_shutdown_function('wnw_ob_end_flush');
	add_action('wp_loaded', 'wnw_start_optimization_callback',1);
}

if(!empty($_REQUEST['optimize_image'])){
	global $document_root;
	$image_url = $_REQUEST['url'];
	$image_width = !empty($_REQUEST['width']) ? $_REQUEST['width'] : '';
	$url_array = parse_url($image_url);
	$image_size = !empty($image_width) ? array($image_width) : getimagesize($document_root.$url_array['path']);
    $optmize_image = optimize_image($image_size[0],$image_url);
    $optimize_image_size = @imagecreatefromstring($optmize_image);
    if(empty($optimize_image_size)){
        echo 'invalid image'; exit;
    }else{
        $image_type = array('gif','jpg','png','jpeg');
        $type = explode('.',$image_url);
        $type = array_reverse($type);
        if(in_array($type[0],$image_type)){
            rename($document_root.$url_array['path'],$document_root.$url_array['path'].'org.'.$type[0]);
            file_put_contents($document_root.$url_array['path'],$optmize_image);
			chmod($document_root.$url_array['path'], 0775);
			echo $document_root.$url_array['path'];
        }

    }


   exit;

}
add_action( 'admin_bar_menu', 'toolbar_link_to_wp_speedup', 999 );

function toolbar_link_to_wp_speedup( $wp_admin_bar ) {
	//echo"ghlgfd";exit;
	$args = array(
		'id'    => 'wp_speedup',
		'title' => 'Delete Wp Speed cache',
		'href'  => '/?delete-wnw-cache=1',
		'meta'  => array( 'class' => 'wp-speedup-page' )
	);
	$wp_admin_bar->add_node( $args );
}
function wp_speedup_register_settings() {
   add_option( 'myplugin_option_name', 'This is my option value.');
   register_setting( 'myplugin_options_group', 'myplugin_option_name', 'myplugin_callback' );
}
add_action( 'admin_init', 'wp_speedup_register_settings' );
function wp_speedup_register_options_page() {
  add_options_page('Wp Speedup', 'Wp Speedup', 'manage_options', 'wp_speedup', 'wp_speedup_options_page');
}
add_action('admin_menu', 'wp_speedup_register_options_page');
function wp_speedup_options_page()
{
	load_template( dirname( __FILE__ ) . "/includes/admin.php" );
}
