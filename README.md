# Wordpress functions:
note: your can replace the app_ with your theme extension

/* @func: Update Post URLs 
 * @desc: This must be used when you want to update the site URLs once gone on production
 * @param: (string) url
 * @return: (boolean) true
*/
function app_update_post_urls($url=""){
	if(empty($url)) return false;
	update_option('siteurl',$url);
	update_option('home',$url);
	return true;
}

