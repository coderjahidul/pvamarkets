var tcx_link_match_regex=/(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!,.;:<>]*[-A-Z0-9+&@#\/%=~_|<>])/ig;var tcx_file_suffix_check=["zip","pdf","txt","mp3","mpa","ogg","wav","wma","7z","rar","db","xml","csv","sql","apk","exe","jar","otf","ttf","fon","fnt","ai","psd","tif","tiff","ps","msi","doc","docx",];var wplc_baseurl=config.baseurl;var WPLC_SOCKET_URI=config.serverurl;function wplc_safe_html(s){return jQuery("<div>").text(s).html().replace("'",'&apos;').replace('"','&quot;')}
function wplc_uploaded_file_decorator(url){var nmsg='';url=wplc_sanitize_url(url);if(url){var ext=url.split(/\#|\?/)[0].split('.').pop().trim();if(ext.match(/jpg|jpeg|gif|bmp|png/)){nmsg='<p><a href="'+url+'" target="_blank"><img src="'+url+'" style="max-width:64px;max-height:64px" alt="image"/></a></p>'}
if(nmsg==''){nmsg=wp_url_decorator(url)}}
return nmsg}
function wplcFormatParser(msg){msg=wplc_safe_html(msg);var tags=['img','link','video','vid'];for(var i=0;i<tags.length;i++){var url=msg.match(new RegExp('^'+tags[i]+':(.*?):'+tags[i]+'$'));if(url&&url[1]){return wplc_uploaded_file_decorator(url[1])}}
if(msg.match(tcx_link_match_regex)){return wp_url_decorator(msg)}
if(msg.search(/\:(\S+)(\:)(\S+)\:/g)!==-1){msg=msg.replace(/\:(\S+)(\:)(\S+)\:/g,function(match,p1,p2,p3){return[":",p1,"::",p3,":"].join('')})}
if(typeof wdtEmojiBundle!=="undefined"){msg=wdtEmojiBundle.render(msg)}
var italics_match=msg.match(/_([^*]*?)_/g);if(italics_match!==null){for(var i=0,len=italics_match.length;i<len;i++){var to_find=italics_match[i];var to_replace=to_find.substring(1,to_find.length-1);msg=msg.replace(to_find,"<em>"+to_replace+"</em>")}}
var bold_match=msg.match(/\*\s*([^*]*?)\s*\*/g);if(bold_match!==null){for(var i=0,len=bold_match.length;i<len;i++){var to_find=bold_match[i];var to_replace=to_find.substring(1,to_find.length-1);msg=msg.replace(to_find,"<strong>"+to_replace+"</strong>")}}
var pre_match=msg.match(/```([^*]*?)```/g);if(pre_match!==null){for(var i=0,len=pre_match.length;i<len;i++){var to_find=pre_match[i];var to_replace=to_find.substring(3,to_find.length-3);msg=msg.replace(to_find,"<pre>"+to_replace+"</pre>")}}
var code_match=msg.match(/`([^*]*?)`/g);if(code_match!==null){for(var i=0,len=code_match.length;i<len;i++){var to_find=code_match[i];var to_replace=to_find.substring(1,to_find.length-1);msg=msg.replace(to_find,"<code>"+to_replace+"</code>")}}
msg=msg.replace(/\n/g,"<br />");return msg}
function wp_url_decorator(content){return content.replace(tcx_link_match_regex,function(url){url=encodeURI(url);return'<a href="'+url+'" target="_BLANK">'+wp_attachment_label_filter(url)+'</a>'})}
function wp_attachment_label_filter(content){var fileExt=content.split('.').pop();var fileName=wplc_safe_html(content.split('/').pop());fileExt=fileExt.toLowerCase();for(var i in tcx_file_suffix_check){if(fileExt===tcx_file_suffix_check[i]){return'<p class="wplc_uploaded_file"><i class="fa fa-file"></i><span>'+fileName+'</span></p>'}}
return content}
function wplc_sanitize_url(url){return url.replace(/[^-A-Za-z0-9+&@#/%?=~_|!:,.;\(\)]/,'')}
function wplc_get_clean_gifurl(message_content){var url=message_content.match(gifExtensionPattern);if(url&&url[0]){return wplc_sanitize_url(url[0])}
return""}