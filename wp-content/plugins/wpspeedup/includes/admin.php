<style>
@import url("http://fonts.googleapis.com/css?family=Open+Sans:400,600,700");
@import url("http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.css");
*, *:before, *:after {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

html, body {
  height: 100%;
}

body {
  font: 14px/1 'Open Sans', sans-serif;
  color: #555;
  background: #eee;
}
.form-table th{
	width: 300px!important;
}
h1 {
  padding: 50px 0;
  font-weight: 400;
  text-align: center;
}

p {
  margin: 0 0 20px;
  line-height: 1.5;
}

main {
  min-width: 320px;
  max-width: 800px;
  padding: 50px;
  margin: 0 auto;
  background: #fff;
}

section {
  display: none;
  padding: 20px 0 0;
  border-top: 1px solid #ddd;
}

label {
  display: inline-block;
  margin: 0 0 -1px;
  padding: 15px 25px;
  font-weight: 600;
  text-align: center;
  color: #bbb;
  border: 1px solid transparent;
}


input:checked + label {
  color: #555;
  border: 1px solid #ddd;
  border-top: 2px solid orange;
  border-bottom: 1px solid #fff;
}
input[name="tabs"] {
	display:none;
}
input[type=text], input[type=search], input[type=radio], input[type=tel], input[type=time], input[type=url], input[type=week], input[type=password], input[type=color], input[type=date], input[type=datetime], input[type=datetime-local], input[type=email], input[type=month], input[type=number], select, textarea{
	width:100%;
}
#wsuc_cache:checked ~ #wsuc_cache_content,
#wsuc_css:checked ~ #wsuc_css_content,
#wsuc_js:checked ~ #wsuc_js_content,
#wsuc_opt_img:checked ~ #wsuc_opt_img_content, 
#wsuc_ll_img:checked ~ #wsuc_ll_img_content {
  display: block;
}
section p span{margin-left:20px;}
@media screen and (max-width: 650px) {
  label {
    font-size: 0;
  }

  label:before {
    margin: 0;
    font-size: 18px;
  }
}
@media screen and (max-width: 400px) {
  label {
    padding: 15px;
  }
}

    </style>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
  <h1>Wp Speedup Cache Settings</h1>
  <?php 
  $result='';
	if($_POST){
		$array['status'] = $_POST['status'];
		$array['cdn'] = $_POST['cdn'];
		$array['js'] = $_POST['js'];
		$array['css'] = $_POST['css'];
		$array['css_mobile'] = $_POST['css_mobile'];
		$array['preload_css'] = $_POST['preload_css'];
		$array['lazy_load'] = $_POST['lazy_load'];
		$array['lazy_load_inner_js'] = $_POST['lazy_load_inner_js'];
		$array['exclude_lazy_load'] = $_POST['exclude_lazy_load'];
		$array['exclude_inner_javascript'] = $_POST['exclude_inner_javascript'];
		$array['exclude_javascript'] = $_POST['exclude_javascript'];
		$array['load_combined_css'] = $_POST['load_combined_css'];
		$array['load_combined_js'] = $_POST['load_combined_js'];
		$array['load_main_css_as'] = $_POST['load_main_css_as'];
		$array['custom_css'] = $_POST['custom_css'];
		$array['exclude_css'] = $_POST['exclude_css'];
		$array['google_fonts'] = $_POST['google_fonts'];
		$array['lazy_load_iframe'] = $_POST['lazy_load_iframe'];
		$array['lazy_load_video'] = $_POST['lazy_load_video'];
		$array['custom_js'] = $_POST['custom_js'];
		$array['custom_js_after_load'] = $_POST['custom_js_after_load'];
		
		
		update_option( 'wnw_wp_speedup_option', $array );
		
		//print_r($result);
	}
	$result = get_option( 'wnw_wp_speedup_option', true );
	
  ?>
  <main>
  
  <input id="wsuc_cache" type="radio" name="tabs" checked>
  <label for="wsuc_cache">Caching</label>
  
  <!--<input id="wsuc_css" type="radio" name="tabs">
  <label for="wsuc_css">Css</label>  
  
  <input id="wsuc_js" type="radio" name="tabs">
  <label for="wsuc_js">Js</label>
  
  <input id="wsuc_opt_img" type="radio" name="tabs">
  <label for="wsuc_opt_img">Images</label>
  
  <input id="wsuc_ll_img" type="radio" name="tabs">
  <label for="wsuc_ll_img">Lazyload Images</label>-->
   	
  <section id="wsuc_cache_content">
  <form method="post">
  <table class="form-table">

<tbody><tr>
<th scope="row">Turn ON optimization</th>
<td><input type="checkbox" name="status" <?php if ($result['status'] == "on") echo "checked";?> ></td>
</tr>
<tr>
<th scope="row">CDN url</th>
<td><input type="text" name="cdn" placeholder="Pleas Enter CDN url here" value="<?php if ($result['cdn']) echo $result['cdn'];?>"></td>
</tr>
<tr>
<th scope="row">Enable js minification</th>
<td><input type="checkbox" name="js" <?php if ($result['js'] == "on") echo "checked";?> ></td>
</tr>
<tr>
<th scope="row">Enable css minification</th>
<td><input type="checkbox" name="css" <?php if ($result['css'] == "on") echo "checked";?> ></td>
</tr>
<tr>
<th scope="row">Separate css cache files for mobile</th>
<td><input type="checkbox" name="css_mobile" <?php if ($result['css_mobile'] == "on") echo "checked";?> ></td>
</tr>
<tr>
<th scope="row">Combine Google fonts</th>
<td><input type="checkbox" name="google_fonts" <?php if ($result['google_fonts'] == "on") echo "checked";?> ></td>
</tr>
<tr>
<th scope="row">Preload css for above the fold content</th>
<td><textarea name="preload_css" rows="10" cols="16" placeholder="Please Enter Preload css here" ><?php if ($result['preload_css']) echo $result['preload_css'];?></textarea></td>
</tr>
<tr>
<tr>
<th scope="row">Exclude css from minification</th>
<td><textarea name="exclude_css" rows="10" cols="16" placeholder="Please Enter Preload css here" ><?php if ($result['exclude_css']) echo $result['exclude_css'];?></textarea></td>
</tr>
<tr>
<th scope="row">Enable lazy Loading Images</th>
<td><input type="checkbox" name="lazy_load" <?php if ($result['lazy_load'] == "on") echo "checked";?> ></td>
</tr>
<tr>
<tr>
<th scope="row">Enable lazy Loading Iframe</th>
<td><input type="checkbox" name="lazy_load_iframe" <?php if ($result['lazy_load_iframe'] == "on") echo "checked";?> ></td>
</tr>
<tr>
<tr>
<th scope="row">Enable lazy Loading Video</th>
<td><input type="checkbox" name="lazy_load_video" <?php if ($result['lazy_load_video'] == "on") echo "checked";?> ></td>
</tr>
<tr>
<tr>
<th scope="row">Exclude images from Lazy Loading</th>
<td><textarea name="exclude_lazy_load" rows="10" cols="16" placeholder="Please Enter matching text of the image here" ><?php if ($result['exclude_lazy_load']) echo $result['exclude_lazy_load'];?></textarea></td>
</tr>
<tr>
<th scope="row">Exclude Javascript from defer</th>
<td><textarea name="exclude_javascript" rows="10" cols="16" placeholder="Please Enter matching text of the javascript here" ><?php if ($result['exclude_javascript']) echo $result['exclude_javascript'];?></textarea></td>
</tr>
<tr>
<th scope="row">Exclude Inner Javascript from defer</th>
<td><textarea name="exclude_inner_javascript" rows="10" cols="16" placeholder="Please Enter matching text of the inner javascript here" ><?php if ($result['exclude_inner_javascript']) echo $result['exclude_inner_javascript'];?></textarea></td>
</tr>
<tr>
<tr>
<th scope="row">Lazy Load inner Js</th>
<td><textarea name="lazy_load_inner_js" rows="10" cols="16" placeholder="Please Enter matching text of the inner javascript here" ><?php if ($result['lazy_load_inner_js']) echo $result['lazy_load_inner_js'];?></textarea></td>
</tr>
<tr>
<th scope="row">Load Combined Css</th>
<td><select name="load_combined_css">
	<option value="on_page_load" <?php echo $result['load_combined_css'] == 'on_page_load' ? 'selected' : '' ;?>>On Page Load</option>
	<option value="after_page_load" <?php echo $result['load_combined_css'] == 'after_page_load' ? 'selected' : '' ;?>>After Page Load</option>
	</select>
</td>
</tr>
<tr>
<th scope="row">Load Combined Js</th>
<td><select name="load_combined_js">
	<option value="on_page_load" <?php echo $result['load_combined_js'] == 'on_page_load' ? 'selected' : '' ;?>>On Page Load</option>
	<option value="after_page_load" <?php echo $result['load_combined_js'] == 'after_page_load' ? 'selected' : '' ;?>>After Page Load</option>
	</select>
</td>
</tr>
<tr>
<th scope="row">Load Main Css as Url</th>

<td><input type="checkbox" name="load_main_css_as" <?php if ($result['load_main_css_as'] == "on") echo "checked";?> ></td>
</tr>
<tr>
<th scope="row">Custom css</th>
<td><textarea name="custom_css" rows="10" cols="16" placeholder="Please Enter css without the style tag." ><?php if ($result['custom_css']) echo stripslashes($result['custom_css']);?></textarea>
</td>
</tr>
<tr>
<th scope="row">Custom Javascript</th>
<td><textarea name="custom_js" rows="10" cols="16" placeholder="Please Enter js without the script tag." ><?php if ($result['custom_js']) echo stripslashes($result['custom_js']);?></textarea>
</td>
</tr>
<tr>
<th scope="row">Custom Javascript after load</th>
<td><textarea name="custom_js_after_load" rows="10" cols="16" placeholder="Please Enter js without the script tag." ><?php if ($result['custom_js_after_load']) echo stripslashes($result['custom_js_after_load']);?></textarea>
</td>
</tr>
<th scope="row"><input type="submit" value="Save"></th>
<td></td>
</tr>
</tbody>
</table>

    
	</form>
    
  </section>
   <!-- 
  <section id="wsuc_css_content">
    
  </section>
    
  <section id="wsuc_opt_img_content">
    
  </section>-->
    
</main>