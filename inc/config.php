<?php

/*
 *  Copyright (c) 2010-2013 Tinyboard Development Group
 *  
 *  WARNING: This is a project-wide configuration file and is overwritten when upgrading to a newer
 *  version of Tinyboard. Please leave this file unchanged, or it will be a lot harder for you to upgrade.
 *  If you would like to make instance-specific changes to your own setup, please use instance-config.php.
 * 
 *
 *  This is the default configuration. You can copy values from here and use them in
 *  your instance-config.php
 *
 *  You can also create per-board configuration files. Once a board is created, locate its directory and
 *  create a new file named config.php (eg. b/config.php). Like instance-config.php, you can copy values
 *  from here and use them in your per-board configuration files.
 *
 *  Some directives are commented out. This is either because they are optional and examples, or because
 *  they are "optionally configurable", and given their default values by Tinyboard's code later if unset.
 *
 *  More information: http://tinyboard.org/docs/?p=Config
 *
 *  Tinyboard documentation: http://tinyboard.org/docs/
 *
 */

 
defined('TINYBOARD') or exit;

/*
 * =======================
 *  General/misc settings
 * =======================
 */

	// Global announcement -- the very simple version.
	// This used to be wrongly named $config['blotter'] (still exists as an alias).
	// $config['global_message'] = 'This is an important announcement!';
	$config['blotter'] = &$config['global_message'];

	// Directory where temporary files will be created.
	$config['tmp'] = sys_get_temp_dir();

	// The HTTP status code to use when redirecting. http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html
	// Can be either 303 "See Other" or 302 "Found". (303 is more correct but both should work.)
	// There is really no reason for you to ever need to change this.
	$config['redirect_http'] = 303;

	// A tiny text file in the main directory indicating that the script has been ran and the board(s) have
	// been generated. This keeps the script from querying the database and causing strain when not needed.
	$config['has_installed'] = '.installed';

	// Use syslog() for logging all error messages and unauthorized login attempts.
	$config['syslog'] = true;

	// Use `host` via shell_exec() to lookup hostnames, avoiding query timeouts. May not work on your system.
	// Requires safe_mode to be disabled.
	$config['dns_system'] = false;

	// Check validity of the reverse DNS of IP addresses. Highly recommended.
	$config['fcrdns'] = true;

	// When executing most command-line tools (such as `convert` for ImageMagick image processing), add this
	// to the environment path (seperated by :).
	$config['shell_path'] = '/usr/local/bin';
 

	// Allow all visitors watch mod log
	$config['public_log'] = false;
 

	$config['allow_create_userboards'] = false;
	$config['allow_create_userboards_from_darknet'] = false;
	$config['allow_create_userboards_timeout'] = 10; // in minutes
	
/*
 * ====================
 *   PERSONALIZATION 
 * ====================
 * */
$config['header']['logo'] = '/static/logo3.png';
$config['header']['pages'] = array(
	// name or css class (localization) =>	ссылка
	"l_latest_threads" 					=> '/all/',
	"/b"								=> '/b/',
	"/kpop"								=> '/kpop/',
	"/jp"								=> '/jp/',
	"/mu"								=> '/mu/'
);


$config['favicon']['normal'] = 'static/favicon.ico';
$config['favicon']['new'] = 'static/favicon-new.ico';
$config['favicon']['you'] = 'static/favicon-you.ico';

 
	
/*
 * ====================
 *   ENCRYPT POST SUPPORT
 * ====================
 * */
$config['encryption']['enable'] = true;


	
/*
 * ====================
 *   CAPTCHA SETTINGS
 * ====================
 */

$config['captcha'] = array();


// Enable one captcha for post !NEED REBUILD
$config['captcha']['enabled_for_post'] = false;

// Enable one captcha for create thread !NEED REBUILD
$config['captcha']['enabled_for_thread'] = false;


// Get captcha script 
$config['captcha']['provider_get'] = '/captcha.php';

// captcha width size
$config['captcha']['width'] = 180;

// captcha height size
$config['captcha']['height'] = 60;

// Captcha expiration:
$config['captcha']['expires_in'] = 180; // 120 seconds

// Captcha length:
$config['captcha']['length'] = 6;

// Custom captcha extra field (eg. charset)
$config['captcha']['extra'] = 'abcdefghijklmnopqrstuvwxyz';



// 'Мягкий' режим капчи
$config['captcha']['light_mode'] = false;


// Captcha expiration:
$config['captcha']['expires_in'] = 120; // 120 seconds

// Captcha length:
$config['captcha']['length'] = 6;



// Use CAPTCHA for reports?
$config['report_captcha'] = false;



/* ANTISPAM OVERRIDES ALL CAPTCHA SETTINGS */


// Enable special antispam check for www users (value = captcha count)
$config['captcha']['antispam']['enable_www'] = 0;

// Enable special antispam check for tor/onion users (value = captcha count)
$config['captcha']['antispam']['enable_darknet'] = 3;


$config['captcha']['antispam']['max_posts'] = 5;


$config['captcha']['antispam']['cookie_time'] = 60 * 60 * 24 * 7;




/*
 * ====================
 * Onion / I2P settings
 * ====================
 */


$config['tor_posting'] = true;	// разрешить постинг из даркнета
$config['tor_image_posting'] = true;
$config['tor_service_ips'] = ['127.0.0.2', '127.0.0.1'];
$config['tor_allow_reports'] = true;

$config['tor'] = [];
$config['tor']['cookie_time'] = 60 * 60 * 24 * 7;
$config['tor']['max_posts'] = 100;
$config['tor']['max_fails'] = 3;
$config['tor']['need_capchas'] = 5;


/*
 * ====================
 *  I2P settings
 * ====================
 */
$config['i2p_service_ips']= ['127.0.0.3'];

/*
 * ====================
 *  Users ip
 * ====================
 */
/*
*
* 	0 - записывать айпи (режим по умолчания на всех бордах vichan/infinity/8ch/etc)
*	1 - ip шифруется установленным значением из security_mode_salt (режим на движке OpenIB)
*	2 - параноидальный режим: ip шифруется случайным значением, которое хранится в памяти и обновляется через указанное время security_mode_time
		Применяется для скрытия ip постеров, если есть риск неавторизированного доступа к серверу.
		* Требуется отключение серверных логов, для невозможности сопостовления времени запроса с временем поста в базе.
		* Баны с удалением всех постов, история  - в этом режиме перестают корректно работать.
*/
$config['security_mode'] = 0;

$config['security_mode_salt'] = 'put here random numbers';

// актуальное время жизни хэша (сутки)
$config['security_mode_time'] = 60*60*24;
 


/*
 * ====================
 *  Database settings
 * ====================
 */

	// Database driver (http://www.php.net/manual/en/pdo.drivers.php)
	// Only MySQL is supported by Tinyboard at the moment, sorry.
	$config['db']['type'] = 'mysql';
	// Hostname, IP address or Unix socket (prefixed with ":")
	$config['db']['server'] = 'localhost';
	// Example: Unix socket
	// $config['db']['server'] = ':/tmp/mysql.sock';
	// Login
	$config['db']['user'] = '';
	$config['db']['password'] = '';
	// Tinyboard database
	$config['db']['database'] = '';
	// Table prefix (optional)
	$config['db']['prefix'] = '';
	// Use a persistent database connection when possible
	$config['db']['persistent'] = false;
	// Anything more to add to the DSN string (eg. port=xxx;foo=bar)
	$config['db']['dsn'] = '';
	// Connection timeout duration in seconds
	$config['db']['timeout'] = 30;

/*
 * ====================
 *  Cache settings
 * 
 * 	Support : memcache, memcached, apc, redis, xcache
 * ====================
 */

	//$config['cache']['enabled'] = 'xcache';
	//$config['cache']['enabled'] = 'apc';
	//$config['cache']['enabled'] = 'memcache';
	$config['cache']['enabled'] = 'memcached';
	// $config['cache']['enabled'] = 'redis';

	// Default timeout 
	$config['cache']['timeout'] = 60 * 60 * 48; // 48 hours

	// Memcached servers 
	$config['cache']['memcached'] = array(
		array('localhost', 11211)
	);

	// Memcache server
	$config['cache']['memcache'] =array('localhost', 11211);

	// Redis server to use. Location, port, password, database id.
	$config['cache']['redis'] = array('localhost', 6379, '', 1);

	// EXPERIMENTAL: Should we cache configs? Warning: this changes board behaviour, i'd say, a lot.
	// If you have any lambdas/includes present in your config, you should move them to instance-functions.php
	// (this file will be explicitly loaded during cache hit, but not during cache miss).
	$config['cache_config'] = false;

/*
 * ====================
 *  Cookie settings
 * ====================
 */
	$config['cookies']['general'] = 'u';

	// Used for moderation login.
	$config['cookies']['mod'] = 'mod';

	// Used for communicating with Javascript; telling it when posts were successful.
	$config['cookies']['js'] = 'serv';

	// Cookies path. Defaults to $config['root']. If $config['root'] is a URL, you need to set this. Should
	// be '/' or '/board/', depending on your installation.
	// $config['cookies']['path'] = '/';
	// Where to set the 'path' parameter to $config['cookies']['path'] when creating cookies. Recommended.
	$config['cookies']['jail'] = true;

	// How long should the cookies last (in seconds). Defines how long should moderators should remain logged
	// in (0 = browser session).
	$config['cookies']['expire'] = 60 * 60 * 24 * 30 * 6; // ~6 months

	// Make this something long and random for security.
	$config['cookies']['salt'] = 'abcdefghijklmnopqrstuvwxyz09123456789!@#$%^&*()';

	// Whether or not you can access the mod cookie in JavaScript. Most users should not need to change this.
	$config['cookies']['httponly'] = true;

 
/*
 * ====================
 * Media resolver
 * ====================
 */

// Искать информацию и обложку трека в файле (требует установки exiftool)
$config['music_info_extract'] = true;

// Искать обложку трека через базу musicbrainz.org (если она не была найдена в файле)
// (!) Может существенно задерживать отправку поста, нерекомендуется использовать.
$config['music_covers_resolve'] = true;


$config['youtube_title_resolve'] = true;
$config['youtube_link_template'] = '<a href=":link" target="_blank"><i class="fa fa-youtube-play" style="cursor:pointer;color:#da0000"></i></a><a href=":link" rel="nofollow" target="_blank" class="y-link" data-id=":id"> :title</a>';
$config['youtube_api_key'] = 'AIzaSyBw-cmbb0_u5bKx3ekgH9jaFfcN9CTLKD4'; 


$config['vlive_title_resolve'] = true;
$config['vlive_link_template'] = '<a href=":link" target="_blank"><i class="fa fa-angellist" style="cursor:pointer;color:#49bec3"></i></a><a href=":link" rel="nofollow" target="_blank" class="vlive-link" data-id=":id"> :title</a>';


$config['vimeo_title_resolve'] = true;
$config['vimeo_link_template'] = '<a href=":link" target="_blank"><i class="fa fa-vimeo-square" style="cursor:pointer;color:#00ADEF"></i></a><a href=":link" rel="nofollow" target="_blank" class="vimeo-link" data-id=":id"> :title</a>';

 /*
 * ====================
 *  Настройки опросов
 * ====================
 */
$config['polls']['enable'] = true;			// можно создавать опросы
$config['polls']['darknet_enable'] = true;	// можно голосовать из даркнета

$config['polls']['ro_min_sec'] = 60 * 10;
$config['polls']['postcount_min'] = 0;


 /*
 * ====================
 *  Настройки рейтинга тредов/постов (лаки и дизлайки)
 * ====================
 */
$config['rating']['thread'] = false;	// включено голосование за тред
$config['rating']['post'] = false;		// включено голосование за любой пост
$config['rating']['darknet'] = false;	// можно голосовать из сетей  tor/i2p




$config['neotube']['enable'] = true;


 /*
 * ====================
 *  Настройки оп-модерации
 * ====================
 */
$config['opmod']['enable'] = true;
$config['opmod']['public_bans'] = true;


$config['tippy_tooltips'] = true;


/* 
 * ====================
 *  Flood/spam settings
 * ====================
 */

	/*
	 * To further prevent spam and abuse, you can use DNS blacklists (DNSBL). A DNSBL is a list of IP
	 * addresses published through the Internet Domain Name Service (DNS) either as a zone file that can be
	 * used by DNS server software, or as a live DNS zone that can be queried in real-time.
	 *
	 * Read more: http://tinyboard.org/docs/?p=Config/DNSBL
	 */

	// Prevents most Tor exit nodes from making posts. Recommended, as a lot of abuse comes from Tor because
	// of the strong anonymity associated with it.
	$config['dnsbl'][] = array('exitnodes.tor.dnsbl.sectoor.de', 1);

	// http://www.sorbs.net/using.shtml
	// $config['dnsbl'][] = array('dnsbl.sorbs.net', array(2, 3, 4, 5, 6, 7, 8, 9));

	// http://www.projecthoneypot.org/httpbl.php
	// $config['dnsbl'][] = array('<your access key>.%.dnsbl.httpbl.org', function($ip) {
	//	$octets = explode('.', $ip);
	//	
	//	// days since last activity
	//	if ($octets[1] > 14)
	//		return false;
	//	
	//	// "threat score" (http://www.projecthoneypot.org/threat_info.php)
	//	if ($octets[2] < 5)
	//		return false;
	//	
	//	return true;
	// }, 'dnsbl.httpbl.org'); // hide our access key

	// Skip checking certain IP addresses against blacklists (for troubleshooting or whatever)
	$config['dnsbl_exceptions'][] = '127.0.0.1';

	/*
	 * Introduction to Tinyboard's spam filter:
	 *
	 * In simple terms, whenever a posting form on a page is generated (which happens whenever a
	 * post is made), Tinyboard will add a random amount of hidden, obscure fields to it to
	 * confuse bots and upset hackers. These fields and their respective obscure values are
	 * validated upon posting with a 160-bit "hash". That hash can only be used as many times
	 * as you specify; otherwise, flooding bots could just keep reusing the same hash.
	 * Once a new set of inputs (and the hash) are generated, old hashes for the same thread
	 * and board are set to expire. Because you have to reload the page to get the new set
	 * of inputs and hash, if they expire too quickly and more than one person is viewing the
	 * page at a given time, Tinyboard would return false positives (depending on how long the
	 * user sits on the page before posting). If your imageboard is quite fast/popular, set
	 * $config['spam']['hidden_inputs_max_pass'] and $config['spam']['hidden_inputs_expire'] to
	 * something higher to avoid false positives.
	 *
	 * See also: http://tinyboard.org/docs/?p=Your_request_looks_automated
	 *
	 */
	
	// Whether to use Unicode characters in hidden input names and values.
	$config['spam']['unicode'] = false;
 

 

	// Разрешает посетителям просматривать удалённые посты 
	$config['allow_watch_deleted'] = true;


	/*
	 * Custom filters detect certain posts and reject/ban accordingly. They are made up of a condition and an
	 * action (for when ALL conditions are met). As every single post has to be put through each filter,
	 * having hundreds probably isn't ideal as it could slow things down.
	 *
	 * By default, the custom filters array is populated with basic flood prevention conditions. This
	 * includes forcing users to wait at least 5 seconds between posts. To disable (or amend) these flood
	 * prevention settings, you will need to empty the $config['filters'] array first. You can do so by
	 * adding "$config['filters'] = array();" to inc/instance-config.php. Basic flood prevention used to be
	 * controlled solely by config variables such as $config['flood_time'] and $config['flood_time_ip'], and
	 * it still is, as long as you leave the relevant $config['filters'] intact. These old config variables
	 * still exist for backwards-compatability and general convenience.
	 *
	 * Read more: http://tinyboard.org/docs/index.php?p=Config/Filters
	 */

	// Minimum time between between each post by the same IP address.
	$config['flood_time'] = 7;
	// Minimum time between between each post with the exact same content AND same IP address.
	$config['flood_time_ip'] = 30;
	// Same as above but by a different IP address. (Same content, not necessarily same IP address.)
	$config['flood_time_same'] = 2;

	// Minimum time between posts by the same IP address (all boards).
	$config['filters'][] = array(
		'condition' => array(
			'flood-match' => array('ip'), // Only match IP address
			'flood-time' => &$config['flood_time']
		),
		'action' => 'reject',
		'message' => &$config['error']['flood']
	);

	// Minimum time between posts by the same IP address with the same text.
	$config['filters'][] = array(
		'condition' => array(
			'flood-match' => array('ip', 'body'), // Match IP address and post body
			'flood-time' => &$config['flood_time_ip'],
			'!body' => '/^$/', // Post body is NOT empty
		),
		'action' => 'reject',
		'message' => &$config['error']['flood']
	);

	// Minimum time between posts with the same text. (Same content, but not always the same IP address.)
	/*$config['filters'][] = array(
		'condition' => array(
			'flood-match' => array('body'), // Match only post body
			'flood-time' => &$config['flood_time_same'],
			'!body' => '/^$/', // Post body is NOT empty
		),
		'action' => 'reject',
		'message' => &$config['error']['flood']
	);*/

	// Example: Minimum time between posts with the same file hash.
	// $config['filters'][] = array(
	// 	'condition' => array(
	// 		'flood-match' => array('file'), // Match file hash
	// 		'flood-time' => 60 * 2 // 2 minutes minimum
	// 	),
	// 	'action' => 'reject',
	// 	'message' => &$config['error']['flood']
	// );

	// Example: Use the "flood-count" condition to only match if the user has made at least two posts with
	// the same content and IP address in the past 2 minutes.
	// $config['filters'][] = array(
	// 	'condition' => array(
	// 		'flood-match' => array('ip', 'body'), // Match IP address and post body
	// 		'flood-time' => 60 * 2, // 2 minutes
	// 		'flood-count' => 2 // At least two recent posts
	// 	),
	// 	'!body' => '/^$/',
	// 	'action' => 'reject',
	// 	'message' => &$config['error']['flood']
	// );

	// Example: Blocking an imaginary known spammer, who keeps posting a reply with the name "surgeon",
	// ending his posts with "regards, the surgeon" or similar.
	// $config['filters'][] = array(
	// 	'condition' => array(
	// 		'name' => '/^surgeon$/',
	// 		'body' => '/regards,\s+(the )?surgeon$/i',
	// 		'OP' => false
	// 	),
	// 	'action' => 'reject',
	// 	'message' => 'Go away, spammer.'
	// );

	// Example: Same as above, but issuing a 3-hour ban instead of just reject the post and
	// add an IP note with the message body
	// $config['filters'][] = array(
	// 	'condition' => array(
	// 		'name' => '/^surgeon$/',
	// 		'body' => '/regards,\s+(the )?surgeon$/i',
	// 		'OP' => false
	// 	),
	// 	'action' => 'ban',
	//	'add_note' => true,
	// 	'expires' => 60 * 60 * 3, // 3 hours
	// 	'reason' => 'Go away, spammer.'
	// );

	// Example: PHP 5.3+ (anonymous functions)
	// There is also a "custom" condition, making the possibilities of this feature pretty much endless.
	// This is a bad example, because there is already a "name" condition built-in.
	// $config['filters'][] = array(
	// 	'condition' => array(
	// 		'body' => '/h$/i',
	// 		'OP' => false,
	// 		'custom' => function($post) {
	// 			if($post['name'] == 'Anonymous')
	// 				return true;
	// 			else
	// 				return false;
	// 		}
	// 	),
	// 	'action' => 'reject'
	// );
	
	// Filter flood prevention conditions ("flood-match") depend on a table which contains a cache of recent
	// posts across all boards. This table is automatically purged of older posts, determining the maximum
	// "age" by looking at each filter. However, when determining the maximum age, Tinyboard does not look
	// outside the current board. This means that if you have a special flood condition for a specific board
	// (contained in a board configuration file) which has a flood-time greater than any of those in the
	// global configuration, you need to set the following variable to the maximum flood-time condition value.
	// $config['flood_cache'] = 60 * 60 * 24; // 24 hours

/*
 * ====================
 *  Post settings
 * ====================
 */

	// old update thread system
	$config['modern_update_system'] = false;
 
	// Do you need a body for your reply posts?
	$config['force_body'] = false;
	// Do you need a user or country flag for your posts?
	$config['force_flag'] = false;
	// Do you need a body for new threads?
	$config['force_body_op'] = true;
	// Require an image for threads?
	$config['force_image_op'] = false;
	// Require a subject for threads?
	$config['force_subject_op'] = false;

	// Strip superfluous new lines at the end of a post.
	$config['strip_superfluous_returns'] = true;
	// Strip combining characters from Unicode strings (eg. "Zalgo").
	$config['strip_combining_chars'] = true;

	// Minimum post body length.
	$config['min_body'] = 0;
	// Maximum post body length.
	$config['max_body'] = 3200;
	// Maximum number of newlines. (0 for unlimited)
	$config['max_newlines'] = 0;
	// Maximum number of post body lines to show on the index page.
	$config['body_truncate'] = 15;
	// Maximum number of characters to show on the index page.
	$config['body_truncate_char'] = 2500;

	
	$config['min_links'] = 0;
	// Typically spambots try to post many links. Refuse a post with X links?
	$config['max_links'] = 50;
	// Maximum number of cites per post (prevents abuse, as more citations mean more database queries).
	$config['max_cites'] = 45;
	// Maximum number of cross-board links/citations per post.
	$config['max_cross'] = $config['max_cites'];

	// Track post citations (>>XX). Rebuilds posts after a cited post is deleted, removing broken links.
	// Puts a little more load on the database.
	$config['track_cites'] = true;

	// Maximum filename length (will be truncated).
	$config['max_filename_len'] = 255;
	// Maximum filename length to display (the rest can be viewed upon mouseover).
	$config['max_filename_display'] = 30;

	// Allow users to delete their own posts?
	$config['allow_delete'] = true;
	// How long after posting should you have to wait before being able to delete that post? (In seconds.)
	$config['delete_time'] = 10;
	// Reply limit (stops bumping thread when this is reached).
	$config['reply_limit'] = 500;

	// Image hard limit (stops allowing new image replies when this is reached if not zero).
	$config['image_hard_limit'] = 0;
	// Reply hard limit (stops allowing new replies when this is reached if not zero).
	$config['reply_hard_limit'] = 0;


	$config['robot_enable'] = false;
	// Strip repeating characters when making hashes.
	$config['robot_strip_repeating'] = true;
	// Enabled mutes? Tinyboard uses ROBOT9000's original 2^x implementation where x is the number of times
	// you have been muted in the past.
	$config['robot_mute'] = true;
	// How long before Tinyboard forgets about a mute?
	$config['robot_mute_hour'] = 336; // 2 weeks
	// If you want to alter the algorithm a bit. Default value is 2.
	$config['robot_mute_multiplier'] = 2; // (n^x where x is the number of previous mutes)
	$config['robot_mute_descritpion'] = _('You have been muted for unoriginal content.');

	// Automatically convert things like "..." to Unicode characters ("…").
	$config['auto_unicode'] = true;
	// Whether to turn URLs into functional links.
	$config['markup_urls'] = true;
	
	$config['markup_paragraphs'] = true;

	// Optional URL prefix for links (eg. "http://anonym.to/?").
	$config['link_prefix'] = ''; 
	$config['url_ads'] = &$config['link_prefix'];	 // leave alias
	

	// The timeout for the above, in seconds.
	$config['upload_by_url_timeout'] = 15;

	// A wordfilter (sometimes referred to as just a "filter" or "censor") automatically scans users’ posts
	// as they are submitted and changes or censors particular words or phrases.

	// For a normal string replacement:
	// $config['wordfilters'][] = array('cat', 'dog');	
	// Advanced raplcement (regular expressions):
	// $config['wordfilters'][] = array('/ca[rt]/', 'dog', true); // 'true' means it's a regular expression

	// Always act as if the user had typed "noko" into the email field.
	$config['always_noko'] = true;


	// Example: Custom secure tripcode.
	// $config['custom_tripcode']['##securetrip'] = '!!somethingelse';


	// Allow users to mark their image as a "spoiler" when posting. The thumbnail will be replaced with a
	// static spoiler image instead (see $config['spoiler_image']).
	$config['spoiler_images'] = true;

	// With the following, you can disable certain superfluous fields or enable "forced anonymous".

	// When true, all names will be set to $config['anonymous'].
	$config['field_disable_name'] = false;
	// When true, all names of the thread page will be set to $config['anonymous'].
	$config['force_anon_thread'] = false;
	// When true, there will be no email field.
	$config['field_disable_email'] = true;
	// When true, there will be no subject field.
	$config['field_disable_subject'] = false;
	// When true, there will be no subject field for replies.
	$config['field_disable_reply_subject'] = &$config['field_disable_name'];
	// When true, a blank password will be used for files (not usable for deletion).
	$config['field_disable_password'] = false;

	// When true, users are instead presented a selectbox for email. Contains, blank, noko and sage.
	$config['field_email_selectbox'] = &$config['field_disable_name'];

	// Prevent users from uploading files.
	$config['disable_images'] = false;

	// When false, the sage won't be displayed
	$config['show_sages'] = true;

	// Использовать геолокацию nginx если возможно (установка флажков)
	$config['geoip_nginx_enable'] = false; 

	// Использовать геолокацию cloudflare если возможно (установка флажков)
	$config['geoip_cloudflare_enable'] = false; 
 
	
	// Attach country flags to posts.
	$config['country_flags'] = false;
 


	// Allow the user to decide whether or not he wants to display his country
	$config['allow_no_country'] = false;

	// Load all country flags from one file
	$config['country_flags_condensed'] = false;
	$config['country_flags_condensed_css'] = 'static/flags/flags.css';

	// Allow the user choose a /pol/-like user_flag that will be shown in the post. For the user flags, please be aware
	// that you will have to disable BOTH country_flags and contry_flags_condensed optimization (at least on a board
	// where they are enabled).
	$config['user_flag'] = false;
	
	// List of user_flag the user can choose. Flags must be placed in the directory set by $config['uri_flags']
	$config['user_flags'] = array();
	/* example: 
	$config['user_flags'] = array (
		'nz' => 'Nazi',
		'cm' => 'Communist',
		'eu' => 'Europe'
	);
	*/

	// Allow dice rolling: an email field of the form "dice XdY+/-Z" will result in X Y-sided dice rolled and summed,
	// with the modifier Z added, with the result displayed at the top of the post body.
	$config['allow_roll'] = true;
	
	// Отображать статистику сколько человек онлайн
	$config['allow_online'] = false;

	
/*
* ====================
*  Ban settings
* ====================
*/

	// Require users to see the ban page at least once for a ban even if it has since expired.
	$config['require_ban_view'] = true;

	// Show the post the user was banned for on the "You are banned" page.
	$config['ban_show_post'] = false;

	// Optional HTML to append to "You are banned" pages. For example, you could include instructions and/or
	// a link to an email address or IRC chat room to appeal the ban.
	$config['ban_page_extra'] = '';

	// Allow users to appeal bans through Tinyboard.
	$config['ban_appeals'] = true;

	// Do not allow users to appeal bans that are shorter than this length (in seconds).
	$config['ban_appeals_min_length'] = 60 * 60 * 6; // 6 hours

	// How many ban appeals can be made for a single ban?
	$config['ban_appeals_max'] = 1;
	
	// Blacklisted board names. Default values to protect existing folders in the core codebase.
	$config['banned_boards'] = array(
		'_css',
		'.git',
		'inc',
		'js',
		'static',
		'stylesheets',
		'templates',
		'tools',
		'all',
	);

	// Show moderator name on ban page.
	$config['show_modname'] = false;

/*
 * ====================
 *  Markup settings
 * ====================
 */
srand(time());

	// JIS ASCII art. This *must* be the first markup or it won't work.
	$config['markup'][] = array(
		"/\[(aa|code)\](.+?)\[\/(?:aa|code)\]/ms", 
		function($matches) {
			$markupchars = array('_', '\'', '~', '*', '=', '-');
			$replacement = $markupchars;
			array_walk($replacement, function(&$v) {
				$v = "&#".ord($v).";";
			});

			// These are hacky fixes for ###board-tags###, ellipses and >quotes.
			$markupchars[] = '###';
			$replacement[] = '&#35;&#35;&#35;';
			$markupchars[] = '&gt;';
			$replacement[] = '&#62;';
			$markupchars[] = '...';
			$replacement[] = '..&#46;';

			if ($matches[1] === 'aa') {
				return '<span class="aa">' . str_replace($markupchars, $replacement, $matches[2]) . '</span>';
			} else {
				return str_replace($markupchars, $replacement, $matches[0]);
			}
		}
	);


	$config['markup'][] = array( 
	"/!roll(\d+)\-(\d+)/ms", 
	function($matches) 
	{

		srand(time());
		$min =  $matches[1];
		$max =  $matches[2];
		$val = rand($min, $max);
		return "<table class='rtable'><tbody><tr><td><div class='roll-img'></div></td><td>$min-$max  -  выпадает: <b>$val</b> </td></tr></tbody></table>";
	});
		

	$config['markup'][] = array( 
	"/!roll(\d+)/ms", 
	function($matches) 
	{
		srand(time());
		$max = $matches[1];
		$val = rand(0, $max); 
		return "<table class='rtable'><tbody><tr><td><div class='roll-img'></div></td><td>0-$max  -  выпадает: <b>$val</b> </td></tr></tbody></table>";
	});
 

	
	// !roll(100)
	$config['markup'][] = array( 
		"/roll\((\d+)\)/ms", 
		function($matches) 
		{
			srand(time());
			$max = $matches[1];
			$val = rand(0, $max); 
			return "<table class='rtable'><tbody><tr><td><div class='roll-img'></div></td><td>0-$max  -  выпадает: <b>$val</b> </td></tr></tbody></table>";
		});
		
	// !roll(10,100)
	$config['markup'][] = array( 
		"/roll\((\d+),(\d+)\)/ms", 
		function($matches) 
		{
			srand(time());
			$min =  $matches[1];
			$max =  $matches[2];
			$val = rand($min, $max);
			return "<table class='rtable'><tbody><tr><td><div class='roll-img'></div></td><td>$min-$max  -  выпадает: <b>$val</b> </td></tr></tbody></table>";
		});
			
	// !roll(variant1,var2, threeee)
	$config['markup'][] = array( 
		"/roll\(([^\)]+)\)/ms", 
		function($matches) 
		{
			srand(time());
			$variants = explode(",", $matches[1]);
			
			if(count($variants)<2)
				return $matches[0];

			$rhtml = "<table class='rtable'><tbody><tr><td><div class='roll-img'></div></td><td>";
			
			$selected = random_int(0, count($variants)-1);
			$variants[$selected] = "<i class='fa fa-check'></i>[b]" . $variants[$selected] . "[/b]";

			foreach($variants as $variant)
				$rhtml.="$variant\n";
				
			return $rhtml . "</td></tr></tbody></table>";
		});





	$config['markup'][] = array( 
		"/spoiler\(([^\)]+)\)/ms", 
		function($matches) 
		{
			$variants = explode(",", $matches[1]);
			$title = $variants[0];
			unset($variants[0]);
			$text = implode(",", $variants);
			$spid = time();
	
			return "<a href='javascript:void(0)' onclick=\"$('#$spid').show();$(this).hide()\">$title</a><div id='$spid' style='display: none'>$text</div>";

		});
 

	$config['markup'][] = array('/[\x{200B}-\x{200D}\x{FEFF}]/u', '');


	// "Wiki" markup syntax ($config['wiki_markup'] in pervious versions):
	$config['markup'][] = array("/(^|\n){1}(&gt;(?!&gt;)[^\n]*)/", "$1<blockquote>\$2</blockquote>");
	$config['markup'][] = array("/%%(.*?)%%/", "<del>\$1</del>");

	$config['markup'][] = array("/'''(.+?)'''/", "<strong>\$1</strong>");
	$config['markup'][] = array("/''(.+?)''/", "<em>\$1</em>");
	$config['markup'][] = array("/\*\*(.+?)\*\*/", "<del>\$1</del>");
	$config['markup'][] = array("/\(\(\((.+?)\)\)\)/", "<span class=\"detected\">(((\$1)))</span>");
	$config['markup'][] = array("/^[ |\t]*==(.+?)==[ |\t]*$/m", "<span class=\"heading\">\$1</span>");
	$config['markup'][] = array("/:+([a-zA-Z0-9_\.-]+):+/", "<i class='s42 s42-\$1' title=':\$1:'></i>"); 


	$config['markup'][] = array("/\[b\]([^\[]*)\[\/b\]/", "<strong>\$1</strong>");
	$config['markup'][] = array("/\[i\]([^\[]*)\[\/i\]/", "<i>\$1</i>");
	$config['markup'][] = array("/\[spoiler\]([^\[]*)\[\/spoiler\]/", "<del>\$1</del>");
	$config['markup'][] = array("/\[love\]([^\[]*)\[\/love\]/", "<love>\$1</love>");
	$config['markup'][] = array("/\[s\]([^\[]*)\[\/s\]/", "<s>\$1</s>");
	$config['markup'][] = array("/\\[code\]([\s\S]*)\[\/code\]/", "<code><div class='code'>\$1</div></code>");

	
 
	$config['markup'][] = array("/\[b\]([^\[]*)\[\/b\]/", "<strong>\$1</strong>");
	$config['markup'][] = array("/\[i\]([^\[]*)\[\/i\]/", "<i>\$1</i>");
	$config['markup'][] = array("/\[spoiler\]([^\[]*)\[\/spoiler\]/", "<del>\$1</del>");
	$config['markup'][] = array("/\[love\]([^\[]*)\[\/love\]/", "<love>\$1</love>");
	$config['markup'][] = array("/\[s\]([^\[]*)\[\/s\]/", "<s>\$1</s>");

	$config['markup'][] = array("/\[b\]([^\[]*)\[\/b\]/", "<strong>\$1</strong>");
	$config['markup'][] = array("/\[i\]([^\[]*)\[\/i\]/", "<i>\$1</i>");
	$config['markup'][] = array("/\[spoiler\]([^\[]*)\[\/spoiler\]/", "<del>\$1</del>");
	$config['markup'][] = array("/\[love\]([^\[]*)\[\/love\]/", "<love>\$1</love>");
	$config['markup'][] = array("/\[s\]([^\[]*)\[\/s\]/", "<s>\$1</s>");



 
	$config['markup'][] = array("/(^|\n){1}\s*(&gt;(?!&gt;)[^\n]*)/", "$1<blockquote>\$2</blockquote>");
	$config['markup'][] = array("/%%([^%]*)%%/", "<del>\$1</del>");

	


	// Highlight PHP code wrapped in <code> tags (PHP 5.3+)
	// $config['markup'][] = array(
	// 	'/^&lt;code&gt;(.+)&lt;\/code&gt;/ms',
	// 	function($matches) {
	// 		return highlight_string(html_entity_decode($matches[1]), true);
	// 	}
	// );

	// Repair markup with HTML Tidy. This may be slower, but it solves nesting mistakes. Tinyboad, at the
	// time of writing this, can not prevent out-of-order markup tags (eg. "**''test**'') without help from
	// HTML Tidy.
	$config['markup_repair_tidy'] = false;

	// Always regenerate markup. This isn't recommended and should only be used for debugging; by default,
	// Tinyboard only parses post markup when it needs to, and keeps post-markup HTML in the database. This
	// will significantly impact performance when enabled.
	$config['always_regenerate_markup'] = false;

/*
 * ====================
 *  Image settings
 * ====================
 */

	// Maximum number of images allowed. Increasing this number enabled multi image.
	// If you make it more than 1, make sure to enable the below script for the post form to change.
	$config['max_images'] = 10;


	$config['additional_javascript'][] = 'js/jquery-3.1.0.min.js'; 
	$config['additional_javascript'][] = 'js/vanilla.js';
	$config['additional_javascript'][] = 'js/storage.js';
	$config['additional_javascript'][] = 'js/player.js';
	$config['additional_javascript'][] = 'js/base.js';
	$config['additional_javascript'][] = 'js/loc.js';
	$config['additional_javascript'][] = 'js/api.js';


	$config['additional_javascript'][] = 'js/time.js';

	$config['additional_javascript'][] = 'js/group-menu.js'; 
	$config['additional_javascript'][] = 'js/menu-options.js';   


	
	$config['additional_javascript'][] = 'js/file-selector.js'; 
	$config['additional_javascript'][] = 'js/post-hover-tree.js';   
	$config['additional_javascript'][] = 'js/ajax.js';

	$config['additional_javascript'][] = $config['modern_update_system'] ? 'js/reload.modern.js' : 'js/reload.js';

	
	$config['additional_javascript'][] = 'js/mod.js';
	$config['additional_javascript'][] = 'js/show-own-posts.js';
	$config['additional_javascript'][] = 'js/show-op.js';
	$config['additional_javascript'][] = 'js/replybox-float.js';
	
	$config['additional_javascript'][] = 'js/media.js'; 
	$config['additional_javascript'][] = 'js/notice.js';
	$config['additional_javascript'][] = 'js/edit.js';
	$config['additional_javascript'][] = 'js/love.js';
	$config['additional_javascript'][] = 'js/hotkeys.js';

	$config['additional_javascript'][] = 'js/nsfm.js';
	$config['additional_javascript'][] = 'js/test.js';
	$config['additional_javascript'][] = 'js/smile-picker.js';

	$config['additional_javascript'][] = 'js/show-backlinks.js';
	$config['additional_javascript'][] = 'js/filter.js';
	$config['additional_javascript'][] = 'js/vendor/tippy.all.js';
	$config['additional_javascript'][] = 'js/tooltips.js';

	if($config['encryption']['enable']){
		$config['additional_javascript'][] = 'js/vendor/jsencrypt.min.js';  
		$config['additional_javascript'][] = 'js/vendor/crypto-js.min.js';  
		$config['additional_javascript'][] = 'js/crypto.js';  
	}

	$config['additional_javascript'][] = 'js/tripcode-mask.js';
	$config['additional_javascript'][] = 'js/user_jscss.js'; 
	
	$config['additional_javascript'][] = 'js/webm-settings.js'; 
	$config['additional_javascript'][] = 'js/auth.js';


	// audio - player 
	$config['additional_javascript'][] = 'js/vendor/plyr.3.5.2.js'; 
 

	$config['additional_javascript'][] = 'js/audio-player.js';
	$config['additional_javascript'][] = 'js/audio.js'; 

	$config['additional_javascript'][] = 'js/neotube.js'; 

 
	$config['additional_javascript'][] = 'js/screenshot.js';
 

	// Method to use for determing the max filesize. 
	// "split" means that your max filesize is split between the images. For example, if your max filesize
	// is 2MB, the filesizes of all files must add up to 2MB for it to work. 
	// "each" means that each file can be 2MB, so if your max_images is 3, each post could contain 6MB of 
	// images. "split" is recommended.
	$config['multiimage_method'] = 'each';

	// For resizing, maximum thumbnail dimensions.
	$config['thumb_width'] = 200;
	$config['thumb_height'] = 200;
	// Maximum thumbnail dimensions for thread (OP) images.
	$config['thumb_op_width'] = 250;
	$config['thumb_op_height'] = 250;

	// Thumbnail extension ("png" recommended). Leave this empty if you want the extension to be inherited
	// from the uploaded file.
	$config['thumb_ext'] = 'png';

	// Maximum amount of animated GIF frames to resize (more frames can mean more processing power). A value
	// of "1" means thumbnails will not be animated. Requires $config['thumb_ext'] to be 'gif' (or blank) and
	//  $config['thumb_method'] to be 'imagick', 'convert', or 'convert+gifsicle'. This value is not
	// respected by 'convert'; will just resize all frames if this is > 1.
	$config['thumb_keep_animation_frames'] = 1;

	/*
	 * Thumbnailing method:
	 *
	 *   'gd'		   PHP GD (default). Only handles the most basic image formats (GIF, JPEG, PNG).
	 *				  GD is a prerequisite for Tinyboard no matter what method you choose.
	 *
	 *   'imagick'	  PHP's ImageMagick bindings. Fast and efficient, supporting many image formats. 
	 *				  A few minor bugs. http://pecl.php.net/package/imagick
	 *
	 *   'convert'	  The command line version of ImageMagick (`convert`). Fixes most of the bugs in
	 *				  PHP Imagick. `convert` produces the best still thumbnails and is highly recommended.
	 *
	 *   'gm'		   GraphicsMagick (`gm`) is a fork of ImageMagick with many improvements. It is more
	 *				  efficient and gets thumbnailing done using fewer resources.
	 *
	 *   'convert+gifscale'
	 *	OR  'gm+gifsicle'  Same as above, with the exception of using `gifsicle` (command line application)
	 *					   instead of `convert` for resizing GIFs. It's faster and resulting animated
	 *					   thumbnails have less artifacts than if resized with ImageMagick.
	 */
	$config['thumb_method'] = 'convert';


	// Command-line options passed to ImageMagick when using `convert` for thumbnailing. Don't touch the
	// placement of "%s" and "%d".
	$config['convert_args'] = '-size %dx%d %s -thumbnail %dx%d -auto-orient +profile "*" %s'; 
	$config['convert_args'] = '-size %dx%d %s -thumbnail %dx%d -quality 85%% -background \'#d6daf0\' -alpha remove -auto-orient +profile "*" %s';
	

	// Strip EXIF metadata from JPEG files.
	$config['strip_exif'] = false;
	// Use the command-line `exiftool` tool to strip EXIF metadata without decompressing/recompressing JPEGs.
	// Ignored when $config['redraw_image'] is true. This is also used to adjust the Orientation tag when
	//  $config['strip_exif'] is false and $config['convert_manual_orient'] is true.
	$config['use_exiftool'] = false;
	
	// Redraw the image to strip any excess data (commonly ZIP archives) WARNING: This might strip the
	// animation of GIFs, depending on the chosen thumbnailing method. It also requires recompressing
	// the image, so more processing power is required.
	$config['redraw_image'] = false;
	
	// Automatically correct the orientation of JPEG files using -auto-orient in `convert`. This only works
	// when `convert` or `gm` is selected for thumbnailing. Again, requires more processing power because
	// this basically does the same thing as $config['redraw_image']. (If $config['redraw_image'] is enabled,
	// this value doesn't matter as $config['redraw_image'] attempts to correct orientation too.)
	$config['convert_auto_orient'] = false;
	
	// Is your version of ImageMagick or GraphicsMagick old? Older versions may not include the -auto-orient
	// switch. This is a manual replacement for that switch. This is independent from the above switch;
	// -auto-orrient is applied when thumbnailing too.
	$config['convert_manual_orient'] = false;

	// Regular expression to check for an XSS exploit with IE 6 and 7. To disable, set to false.
	// Details: https://github.com/savetheinternet/Tinyboard/issues/20
	$config['ie_mime_type_detection'] = '/<(?:body|head|html|img|plaintext|pre|script|table|title|a href|channel|scriptlet)/i';

	// Config panel, fileboard: allowed upload extensions
	$config['fileboard_allowed_types'] = array('zip', '7z', 'tar', 'gz', 'bz2', 'xz', 'swf', 'txt', 'pdf', 'torrent');

	// Allowed image file extensions.
	$config['allowed_ext'][] = 'jpg';
	$config['allowed_ext'][] = 'jpeg';
	$config['allowed_ext'][] = 'gif';
	$config['allowed_ext'][] = 'png'; 
	// $config['allowed_ext'][] = 'svg';

	// Ошибки при ресайзер изображения будут скрыты 
	// и заменены оригинальной картинкой
	$config['enable_resize_fix'] = true;
	$config['resize_fix_maxsize'] = 2048*1024;
	

	// Allowed extensions for OP. Inherits from the above setting if set to false. Otherwise, it overrides both allowed_ext and
	// allowed_ext_files (filetypes for downloadable files should be set in allowed_ext_files as well). This setting is useful
	// for creating fileboards.
	$config['allowed_ext_op'] = false;

	// Allowed additional file extensions (not images; downloadable files).
	$config['allowed_ext_files'][] = 'txt';
	$config['allowed_ext_files'][] = 'zip';
	$config['allowed_ext_files'][] = 'rar';
	$config['allowed_ext_files'][] = '7z';
	$config['allowed_ext_files'][] = 'torrent';
	$config['allowed_ext_files'][] = 'mp3';
	$config['allowed_ext_files'][] = 'wav';
	$config['allowed_ext_files'][] = 'ogg';
	$config['allowed_ext_files'][] = 'flac';
	$config['allowed_ext_files'][] = 'm4a';
	$config['allowed_ext_files'][] = 'webm';
	$config['allowed_ext_files'][] = 'mp4';
 
	
	

	// An alternative function for generating image filenames, instead of the default UNIX timestamp.
	// $config['filename_func'] = function($post) {
	//	  return sprintf("%s", time() . substr(microtime(), 2, 3));
	// };

	// Thumbnail to use for the non-image file uploads.
	$config['file_icons']['default'] = 'file.png';
	$config['file_icons']['zip'] = 'zip.png';
	$config['file_icons']['webm'] = 'video.png';
	$config['file_icons']['mp4'] = 'video.png';
	// Example: Custom thumbnail for certain file extension.
	// $config['file_icons']['extension'] = 'some_file.png';

	// Location of above images.
	$config['file_thumb'] = 'static/%s';
	// Location of thumbnail to use for spoiler images.
	$config['spoiler_image'] = 'static/spoiler.png';
	// Location of thumbnail to use for deleted images.
	$config['image_deleted'] = 'static/deleted.png';
	// Location of placeholder image for fileless posts in catalog.
	$config['no_file_image'] = 'static/no-file.png';

	// When a thumbnailed image is going to be the same (in dimension), just copy the entire file and use
	// that as a thumbnail instead of resizing/redrawing.
	$config['minimum_copy_resize'] = false;

	// Maximum image upload size in bytes.
	$config['max_filesize'] = 1024 * 1024 * 100; // 100MB
	// Maximum image dimensions.
	$config['max_width'] = 10000;
	$config['max_height'] = 10000;
	// Reject duplicate image uploads.

	// при загрузке md5 файла будет проверятся по стоп-листу
	$config['hash_filter'] = true;


 

	

	
	$config['image_reject_repost'] = false;

	// Reject duplicate image uploads within the same thread. Doesn't change anything if
	//  $config['image_reject_repost'] is true.
	$config['image_reject_repost_in_thread'] = false;

	// Display the aspect ratio of uploaded files.
	$config['show_ratio'] = true;
	// Display the file's original filename.
	$config['show_filename'] = false;

	// WebM Settings
	$config['webm']['use_ffmpeg'] = true;
	$config['webm']['allow_audio'] = true;
	$config['webm']['max_length'] =  60 * 120;;
	$config['webm']['ffmpeg_path'] = 'ffmpeg';
	$config['webm']['ffprobe_path'] = 'ffprobe';

	// Display image identification links for ImgOps, regex.info/exif, Google Images and iqdb.
	$config['image_identification'] = false;
	// Which of the identification links to display. Only works if $config['image_identification'] is true.
	$config['image_identification_imgops'] = true;
	$config['image_identification_exif'] = true;
	$config['image_identification_google'] = true;
	// Anime/manga search engine.
	$config['image_identification_iqdb'] = false;
	
	// Set this to true if you're using a BSD
	$config['bsd_md5'] = false;

	// Number of posts in a "View Last X Posts" page
	$config['noko50_count'] = 50;
	// Number of posts a thread needs before it gets a "View Last X Posts" page.
	// Set to an arbitrarily large value to disable.
	$config['noko50_min'] = 100;
/*
 * ====================
 *  Board settings
 * ====================
 */

	// Maximum amount of threads to display per page.
	$config['threads_per_page'] = 15;
	// Maximum number of pages. Content past the last page is automatically purged.
	$config['max_pages'] = 64;
	// Replies to show per thread on the board index page.
	$config['threads_preview'] = 3;
	// Same as above, but for stickied threads.
	$config['threads_preview_sticky'] = 1;

	// How to display the URI of boards. Usually '/%s/' (/b/, /mu/, etc). This doesn't change the URL. Find
	//  $config['board_path'] if you wish to change the URL.
	$config['board_abbreviation'] = '/%s/';

	// The default name (ie. Anonymous). Can be an array - in that case it's picked randomly from the array.
	// Example: $config['anonymous'] = array('Bernd', 'Senpai', 'Jonne', 'ChanPro');
	$config['anonymous'] = '';

	// Number of reports you can create at once.
	$config['report_limit'] = 3;

	// Allow unfiltered HTML in board subtitle. This is useful for placing icons and links.
	$config['allow_subtitle_html'] = false;

/*
 * ====================
 *  Display settings
 * ====================
 */

	// Tinyboard has been translated into a few languages. See inc/locale for available translations.
	$config['locale'] = 'en'; // (en, ru_RU.UTF-8, fi_FI.UTF-8, pl_PL.UTF-8)

	// Supported languages
	$config['default_language'] = 'en';
	$config['sup_languages']['ru'] = 'Русский';
	$config['sup_languages']['en'] = 'English';
	$config['sup_languages']['de'] = 'Deutsch';
	$config['sup_languages']['pl'] = 'Polski';
	$config['sup_languages']['jp'] = '日本語';
	$config['sup_languages']['ko'] = '한국어';

	 
	// Timezone to use for displaying dates/tiems.
	$config['timezone'] = 'UTC';
	// The format string passed to strftime() for displaying dates.
	// http://www.php.net/manual/en/function.strftime.php
	//$config['post_date'] = '%m/%d/%y (%a) %H:%M:%S';
	$config['post_date'] = '(%m/%d/%y)  %H:%M:%S';

	// Same as above, but used for "you are banned' pages.
	$config['ban_date'] = '%A %e %B, %Y';

	// The names on the post buttons. (On most imageboards, these are both just "Post").
	$config['button_newtopic'] = _('New Topic');
	$config['button_reply'] = _('New Reply');

	// Assign each poster in a thread a unique ID, shown by "ID: xxxxx" before the post number.
	$config['poster_ids'] = false;

	// TOR IP hash
	$config['tor_ip_hash'] = '$2a$07$qFmQx6sdNCcVeTknVtBSUOgylNGQokMgcxRsQ/1lb1Vz9jvckO6j2';

	// Number of characters in the poster ID (maximum is 40).
	$config['poster_id_length'] = 5;

	// Show thread subject in page title.
	$config['thread_subject_in_title'] = true;

	// Additional lines added to the footer of all pages.
	// $config['footer'][] = _('All trademarks, copyrights, comments, and images on this page are owned by and are the responsibility of their respective parties.');

	// Characters used to generate a random password (with Javascript).
	$config['genpassword_chars'] = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+';

	// Optional banner image at the top of every page.
	// $config['url_banner'] = '/banner.php';
	// Banner dimensions are also optional. As the banner loads after the rest of the page, everything may be
	// shifted down a few pixels when it does. Making the banner a fixed size will prevent this.
	// $config['banner_width'] = 300;
	// $config['banner_height'] = 100;

	// Custom stylesheets available for the user to choose. See the "stylesheets/" folder for a list of
	// available stylesheets (or create your own).

	$config['default_theme'] = 'light_blue';

	$config['stylesheets']['Brchan']	= 'brchan.css';
	$config['stylesheets']['BrchanSimple']	= 'brchansimple.css';
	$config['stylesheets']['Cuber']		= 'cuber.css';
	$config['stylesheets']['Dark']   	= 'dark.css';
	$config['stylesheets']['Light'] 	= 'light.css'; // Default; there is no additional/custom stylesheet for this.
	$config['stylesheets']['Light Blue']= 'light_blue.css';
	$config['stylesheets']['Lolifox']	= 'lolifox.css'; 
	$config['stylesheets']['Makaba']	= 'makaba.css';
	$config['stylesheets']['Photon']  	= 'photon.css';	 
	$config['stylesheets']['Persik']  	= 'persik.css';
	$config['stylesheets']['Persik Red']= 'persik_red.css'; 
	$config['stylesheets']['Rose']= 'rose.css'; 
	$config['stylesheets']['Yotsuba']	= 'yotsuba.css';
	$config['stylesheets']['Yotsuba B']	= 'yotsuba_b.css'; 
	$config['stylesheets']['Native Lolifox']	= 'native-lolifox.css'; 
	$config['stylesheets']['Native Makaba']	= 'native-makaba.css'; 


	 

	// The prefix for each stylesheet URI. Defaults to $config['root']/stylesheets/
	// $config['uri_stylesheets'] = 'http://static.example.org/stylesheets/';

	// The default stylesheet to use.
	$config['default_stylesheet'] = array('Light', $config['stylesheets']['Light']);

	// Make stylesheet selections board-specific.
	$config['stylesheets_board'] = false;

	// Use Font-Awesome for displaying lock and pin icons, instead of the images in static/.
	// http://fortawesome.github.io/Font-Awesome/icon/pushpin/
	// http://fortawesome.github.io/Font-Awesome/icon/lock/
	$config['font_awesome'] = true;
	$config['font_awesome_css'] = 'stylesheets/font-awesome/css/font-awesome.css';

	/*
	 * For lack of a better name, “boardlinks” are those sets of navigational links that appear at the top
	 * and bottom of board pages. They can be a list of links to boards and/or other pages such as status
	 * blogs and social network profiles/pages.
	 *
	 * "Groups" in the boardlinks are marked with square brackets. Tinyboard allows for infinite recursion
	 * with groups. Each array() in $config['boards'] represents a new square bracket group.
	 */

	// $config['boards'] = array(
	// 	array('a', 'b'),
	// 	array('c', 'd', 'e', 'f', 'g'),
	// 	array('h', 'i', 'j'),
	// 	array('k', array('l', 'm')),
	// 	array('status' => 'http://status.example.org/')
	// );

	// Whether or not to put brackets around the whole board list
	$config['boardlist_wrap_bracket'] = false;

	// Show page navigation links at the top as well.
	$config['page_nav_top'] = false;

	// Show "Catalog" link in page navigation. Use with the Catalog theme.
	$config['catalog_link'] = 'catalog.html';

	// Board categories. Only used in the "Categories" theme.
	// $config['categories'] = array(
	// 	'Group Name' => array('a', 'b', 'c'),
	// 	'Another Group' => array('d')
	// );
	// Optional for the Categories theme. This is an array of name => (title, url) groups for categories
	// with non-board links.
	// $config['custom_categories'] = array(
	// 	'Links' => array(
	// 		'Tinyboard' => 'http://tinyboard.org',
	// 		'Donate' => 'donate.html'
	// 	)
	// );

	// Automatically remove unnecessary whitespace when compiling HTML files from templates.
	$config['minify_html'] = true;

	/*
	 * Advertisement HTML to appear at the top and bottom of board pages.
	 */

	// $config['ad'] = array(
	//	'top' => '',
	//	'bottom' => '',
	// );

	// Display flags (when available). This config option has no effect unless poster flags are enabled (see
	// $config['country_flags']). Disable this if you want all previously-assigned flags to be hidden.
	$config['display_flags'] = true;

	// Location of post flags/icons (where "%s" is the flag name). Defaults to static/flags/%s.png.
	// $config['uri_flags'] = 'http://static.example.org/flags/%s.png';

	// Width and height (and more?) of post flags. Can be overridden with the Tinyboard post modifier:
	// <tinyboard flag style>.
	// $config['flag_style'] = 'width:16px;height:11px;';
	$config['flag_style'] = '';

/*
 * ====================
 *  Javascript
 * ====================
 */

	// Additional Javascript files to include on board index and thread pages. See js/ for available scripts.
	// $config['additional_javascript'][] = 'js/inline-expanding.js';
	// $config['additional_javascript'][] = 'js/local-time.js';

	// Some scripts require jQuery. Check the comments in script files to see what's needed. When enabling
	// jQuery, you should first empty the array so that "js/query.min.js" can be the first, and then re-add
	// "js/inline-expanding.js" or else the inline-expanding script might not interact properly with other
	// scripts.
	// $config['additional_javascript'] = array();
	// $config['additional_javascript'][] = 'js/jquery.min.js';
	// $config['additional_javascript'][] = 'js/inline-expanding.js';
	// $config['additional_javascript'][] = 'js/auto-reload.js';
	// $config['additional_javascript'][] = 'js/post-hover.js';
	// $config['additional_javascript'][] = 'js/style-select.js';

	// Where these script files are located on the web. Defaults to $config['root'].
	// $config['additional_javascript_url'] = 'http://static.example.org/tinyboard-javascript-stuff/';

	// Compile all additional scripts into one file ($config['file_script']) instead of including them seperately.
	$config['additional_javascript_compile'] = true;

	$config['minify_js'] = false;


/*
 * ====================
 *  Error messages
 * ====================
 */

	// Error messages
	$config['error']['bot']			= _('You look like a bot.');
	$config['error']['referer']		= _('Your browser sent an invalid or no HTTP referer.');
	$config['error']['toolong']		= _('The %s field was too long.');
	$config['error']['toolong_body']	= _('The body was too long.');
	$config['error']['tooshort_body']	= _('The body was too short or empty.');
	$config['error']['noimage']		= _('You must upload an image.');
	$config['error']['toomanyimages'] = _('You have attempted to upload too many images!');
	$config['error']['nomove']		= _('The server failed to handle your upload.');
	$config['error']['fileext']		= _('Unsupported image format.');
	$config['error']['noboard']		= _('Invalid board!');
	$config['error']['nonexistant']		= _('Thread specified does not exist.');
	$config['error']['reply_hard_limit']	= _('Thread has reached its maximum reply limit.');
	$config['error']['image_hard_limit']	= _('Thread has reached its maximum image limit.');
	$config['error']['nopost']		= _('You didn\'t make a post.');
	$config['error']['flood']		= 'Это похоже на флуд, пост отклонён. Извините :(';
	$config['error']['spam']		= _('Your request looks automated; Post discarded. Try refreshing the page. If that doesn\'t work, please post the board, thread and browser this error occurred on on /operate/.');
	$config['error']['unoriginal']		= _('Unoriginal content!');
	$config['error']['muted']		= _('Unoriginal content! You have been muted for %d seconds.');
	$config['error']['youaremuted']		= _('You are muted! Expires in %d seconds.');
	$config['error']['dnsbl']		= _('Your IP address is listed in %s.');
	$config['error']['toomanylinks']	= _('Too many links; flood detected.');
	$config['error']['notenoughlinks']	= _('OPs are required to have at least %d links on this board.');
	$config['error']['toomanycites']	= _('Too many cites; post discarded.');
	$config['error']['toomanycross']	= _('Too many cross-board links; post discarded.');
	$config['error']['nodelete']		= _('You didn\'t select anything to delete.');
	$config['error']['noreport']		= _('You didn\'t select anything to report.');
	$config['error']['report_limit_50']     = _('Your report must not exceed 50 characters.');
	$config['error']['toomanyreports']	= _('You can\'t report that many posts at once.');
	$config['error']['invalidpassword']	= _('Wrong password…');
	$config['error']['invalidimg']		= _('Invalid image.');
	$config['error']['unknownext']		= _('Unknown file extension.');
	$config['error']['filesize']		= _('Maximum file size: %maxsz% bytes<br>Your file\'s size: %filesz% bytes');
	$config['error']['maxsize']		= _('The file was too big.');
	$config['error']['genwebmerror']	= _('There was a problem processing your webm.');
	$config['error']['webmerror'] 		= _('There was a problem processing your webm.');//Is this error used anywhere ?
	$config['error']['invalidwebm'] 	= _('Invalid webm uploaded.');
	$config['error']['webmhasaudio'] 	= _('The uploaded webm contains an audio or another type of additional stream.');
	$config['error']['webmtoolong'] 	= _('The uploaded webm is longer than %d seconds.');
	$config['error']['fileexists']		= _('That file <a href="%s">already exists</a>!');
	$config['error']['fileexistsinthread']	= _('That file <a href="%s">already exists</a> in this thread!');
	$config['error']['delete_too_soon']	= _('You\'ll have to wait another %s before deleting that.');
	$config['error']['mime_exploit']	= _('MIME type detection XSS exploit (IE) detected; post discarded.');
	$config['error']['invalid_embed']	= _('Couldn\'t make sense of the URL of the video you tried to embed.');
	$config['error']['captcha']		= 'Капча введена неверно.';
	$config['error']['images_disabled'] = _('Uploading files is disabled on this board.');

	// mod.php errors
	$config['error']['toomanyunban']	= _('You are only allowed to unban %s users at a time. You tried to unban %u users.');
	$config['error']['invalid']		= _('Invalid username and/or password.');
	$config['error']['notamod']		= _('You are not a mod…');
	$config['error']['invalidafter']	= _('Invalid username and/or password. Your user may have been deleted or changed.');
	$config['error']['malformed']		= _('Invalid/malformed cookies.');
	$config['error']['missedafield']	= _('Your browser didn\'t submit an input when it should have.');
	$config['error']['required']		= _('The %s field is required.');
	$config['error']['invalidfield']	= _('The %s field was invalid.');
	$config['error']['boardexists']		= _('There is already a %s board.');
	$config['error']['invalidpost']		= _('That post doesn\'t exist…');
	$config['error']['404']			= _('Page not found.');
	$config['error']['modexists']		= _('That mod <a href="?/users/%d">already exists</a>!');
	$config['error']['invalidtheme']	= _('That theme doesn\'t exist!');
	$config['error']['csrf']		= _('Invalid security token! Please go back and try again.');
	$config['error']['badsyntax']		= _('Your code contained PHP syntax errors. Please go back and correct them. PHP says: ');
	$config['error']['fail'] = "Operation failed";



	$config['error']['invalid_auth']		= 'Неправильное имя или пароль';
	$config['error']['noaccess']	 = "Не хватает прав.";
	$config['error']['noban']	 = "Бан не найден.";
	$config['error']['nobanforyou']	 = "Это не ваш бан.";
	
	$config['error']['wrong_params'] = "Ошибка в параметрах запроса.";
	
	$config['error']['storage_error'] = "Ошибка при сохранении большого файла.";
	$config['error']['ftp_auth'] = "Ошибка при авторизации на ftp сервере.";
	$config['error']['ftp_upload'] =  "Ошибка загрузки файла в хранилище.";
	$config['error']['ftp_delete'] =  "Ошибка удаления файла из хранилища.";
	$config['error']['file_404'] =  "Ошибка, файл не найден";
	$config['error']['no_log'] =  "Лог отключён";

	 
	
/*
 * =========================
 *  Directory/file settings
 * =========================
 */
	$config['root'] = '/';

	// The root directory, including the trailing slash, for Tinyboard.
	// Examples: '/', 'http://boards.chan.org/', '/chan/'.
	if (isset($_SERVER['REQUEST_URI'])) {
		$request_uri = $_SERVER['REQUEST_URI'];
		if (isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] !== '')
			$request_uri = substr($request_uri, 0, - 1 - strlen($_SERVER['QUERY_STRING']));
		$config['root']	 = str_replace('\\', '/', dirname($request_uri)) == '/'
			? '/' : str_replace('\\', '/', dirname($request_uri)) . '/';
		unset($request_uri);
	} 

	// The scheme and domain. This is used to get the site's absolute URL (eg. for image identification links).
	// If you use the CLI tools, it would be wise to override this setting.
	$config['domain'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ? 'https://' : 'http://';
	$config['domain'] .= isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost';

	// If for some reason the folders and static HTML index files aren't in the current working direcotry,
	// enter the directory path here. Otherwise, keep it false.
	$config['root_file'] = false;

	// Location of files.
	$config['file_index'] = 'index.html';
	$config['file_page'] = '%d.html';
	$config['file_page50'] = '%d+50.html';
	$config['file_mod'] = 'mod.php';
	$config['file_usermod'] = 'usermod.php';
	$config['file_post'] = 'post.php?neo23';
	$config['file_script'] = 'main.js';

	// Board directory, followed by a forward-slash (/).
	$config['board_path'] = '%s/';
	// Misc directories.
	$config['dir']['img'] = 'src/';
	$config['dir']['thumb'] = 'thumb/';
	$config['dir']['res'] = 'res/';

	// Images in a seperate directory - For CDN or media servers
	// This is a particularly advanced feature - contact ctrlcctrlv or rails unless you
	//   really know what you're doing
	$config['dir']['img_root'] = '';
	// DO NOT COMMENT OUT, LEAVE BLANK AND OVERRIDE IN INSTANCE CONFIG
	// Though, you shouldnt be editing this file, so what do I know?
	

	// For load balancing, having a seperate server (and domain/subdomain) for serving static content is
	// possible. This can either be a directory or a URL. Defaults to $config['root'] . 'static/'.
	// $config['dir']['static'] = 'http://static.example.org/';

	// Where to store the .html templates. This folder and the template files must exist.
	$config['dir']['template'] = getcwd() . '/templates';
	// Location of Tinyboard "themes".
	$config['dir']['themes'] = getcwd() . '/templates/themes';
	// Same as above, but a URI (accessable by web interface).
	$config['dir']['themes_uri'] = 'templates/themes';
	// Home directory. Used by themes.
	$config['dir']['home'] = '';


	// If you want to put images and other dynamic-static stuff on another (preferably cookieless) domain.
	// This will override $config['root'] and $config['dir']['...'] directives. "%s" will get replaced with
	//  $board['dir'], which includes a trailing slash.
	// $config['uri_thumb'] = 'http://images.example.org/%sthumb/';
	// $config['uri_img'] = 'http://images.example.org/%ssrc/';

	// Set custom locations for stylesheets and the main script file. This can be used for load balancing
	// across multiple servers or hostnames.
	// $config['url_stylesheet'] = 'http://static.example.org/style.css'; // main/base stylesheet
	// $config['url_javascript'] = 'http://static.example.org/main.js';

	// Try not to build pages when we shouldn't have to.
	$config['try_smarter'] = true;


/*
 * ====================
 *  Mod settings
 * ====================
 */

	// Limit how many bans can be removed via the ban list. Set to false (or zero) for no limit.
	$config['mod']['unban_limit'] = false;

	// Whether or not to lock moderator sessions to IP addresses. This makes cookie theft ineffective.
	$config['mod']['lock_ip'] = true;

	// The page that is first shown when a moderator logs in. Defaults to the dashboard (?/).
	$config['mod']['default'] = '/';

	// Mod links (full HTML).
	$config['mod']['link_delete'] = 'D';
	$config['mod']['link_ban'] = 'B';
	$config['mod']['link_range_ban'] = 'RB';
	$config['mod']['link_bandelete'] = 'B&amp;D';
	$config['mod']['link_bandeletebyip'] = 'B&amp;D+';
	$config['mod']['link_bandeletebyip_thread'] = 'B&amp;D*';
	$config['mod']['link_deletefile'] = 'F';
	$config['mod']['link_deletefilebyip'] = 'F+';
	$config['mod']['link_deletefilebyip_thread'] = 'F*';
	$config['mod']['link_spoilerimage'] = 'S';
	$config['mod']['link_spoilerimages'] = 'S+';
	$config['mod']['link_deletebyip'] = 'D+';
	$config['mod']['link_deletebyip_global'] = 'D++';
	$config['mod']['link_sticky'] = 'Sticky';
	$config['mod']['link_desticky'] = '-Sticky';
	$config['mod']['link_lock'] = 'Lock';
	$config['mod']['link_unlock'] = '-Lock';
	$config['mod']['link_bumplock'] = 'Sage';
	$config['mod']['link_bumpunlock'] = '-Sage';
	$config['mod']['link_editpost'] = 'Edit';
	$config['mod']['link_move'] = 'Move';
	$config['mod']['link_cycle'] = 'Cycle';
	$config['mod']['link_uncycle'] = '-Cycle';

	// Moderator capcodes.
	$config['capcode'] = ' <span class="capcode capcode-%s">## %s</span>';

	// Enable the moving of single replies
	$config['move_replies'] = false;

	// How often (minimum) to purge the ban list of expired bans (which have been seen). Only works when
	//  $config['cache'] is enabled and working.
	$config['purge_bans'] = 60 * 60 * 12; // 12 hours

	// Do DNS lookups on IP addresses to get their hostname for the moderator IP pages (?/IP/x.x.x.x).
	$config['mod']['dns_lookup'] = true;
	// How many recent posts, per board, to show in ?/IP/x.x.x.x.
	$config['mod']['ip_recentposts'] = 25;
	
	$config['mod']['ip_less_recentposts'] = 25;

	// Number of posts to display on the reports page.
	$config['mod']['recent_reports'] = 100;
	// Number of actions to show per page in the moderation log.
	$config['mod']['modlog_page'] = 350;
	// Number of bans to show per page in the ban list.
	$config['mod']['banlist_page'] = 350;
	// Number of news entries to display per page.
	$config['mod']['news_page'] = 40;
	// Number of results to display per page.
	$config['mod']['search_page'] = 200;
	// Number of entries to show per page in the moderator noticeboard.
	$config['mod']['noticeboard_page'] = 50;
	// Number of entries to summarize and display on the dashboard.
	$config['mod']['noticeboard_dashboard'] = 5;

	// Check public ban message by default.
	$config['mod']['check_ban_message'] = false;
	// Default public ban message. In public ban messages, %length% is replaced with "for x days" or
	// "permanently" (with %LENGTH% being the uppercase equivalent).
	$config['mod']['default_ban_message'] = _('USER WAS BANNED FOR THIS POST');
	// $config['mod']['default_ban_message'] = 'USER WAS BANNED %LENGTH% FOR THIS POST';
	// HTML to append to post bodies for public bans messages (where "%s" is the message).
	$config['mod']['ban_message'] = '<span class="public_ban">(%s)</span>';

	// When moving a thread to another board and choosing to keep a "shadow thread", an automated post (with
	// a capcode) will be made, linking to the new location for the thread. "%s" will be replaced with a
	// standard cross-board post citation (>>>/board/xxx)
	$config['mod']['shadow_mesage'] = _('Moved to %s.');
	// Capcode to use when posting the above message.
	$config['mod']['shadow_capcode'] = 'Mod';
	// Name to use when posting the above message. If false, $config['anonymous'] will be used.
	$config['mod']['shadow_name'] = false;

	// PHP time limit for ?/rebuild. A value of 0 should cause PHP to wait indefinitely.
	$config['mod']['rebuild_timelimit'] = 0;

	// PM snippet (for ?/inbox) length in characters.
	$config['mod']['snippet_length'] = 75;

	// Max PMs that can be sent by one user per hour.
	$config['mod']['pm_ratelimit'] = 100;

	// Maximum size of a PM.
	$config['mod']['pm_maxsize'] = 8192;

	// Edit raw HTML in posts by default.
	$config['mod']['raw_html_default'] = false;

	// Automatically dismiss all reports regarding a thread when it is locked.
	$config['mod']['dismiss_reports_on_lock'] = true;

	// Replace ?/config with a simple text editor for editing inc/instance-config.php.
	$config['mod']['config_editor_php'] = false;

/*
 * ====================
 *  Mod permissions
 * ====================
 */

	// Probably best not to change this unless you are smart enough to figure out what you're doing. If you
	// decide to change it, remember that it is impossible to redefinite/overwrite groups; you may only add
	// new ones.
	$config['mod']['groups'] = array(
		0 	=> 'User',
		10	=> 'Janitor',
		19	=> 'BoardVolunteer',
		20	=> 'Mod',
		25	=> 'GlobalVolunteer',
		30	=> 'Admin'
	);

	// If you add stuff to the above, you'll need to call this function immediately after.
	define_groups();

	// Example: Adding a new permissions group.
	// $config['mod']['groups'][0] = 'NearlyPowerless';
	// define_groups();

	// Capcode permissions.
	$config['mod']['capcode'] = array(
		JANITOR			=> array('Janitor'), 
		BOARDVOLUNTEER	=> array('Volunteer'),
		MOD				=> array('Mod'),
		GLOBALVOLUNTEER	=> array('Mod', 'GlobalMod'),
		ADMIN			=> true
	);

	$config['custom_capcode']['Admin'] = array(
		'<span class="capcode" title="This post was written by the global administrator."> <i class="fa fa-wheelchair" style="color:blue;"></i> <span style="color:red">8chan Administrator</span></span>',
	);

	// Example: Allow mods to post with "## Moderator" as well
	// $config['mod']['capcode'][MOD][] = 'Moderator';
	// Example: Allow janitors to post with any capcode
	// $config['mod']['capcode'][JANITOR] = true;

	// Set any of the below to "DISABLED" to make them unavailable for everyone.

	// Don't worry about per-board moderators. Let all mods moderate any board.
	$config['mod']['skip_per_board'] = false;



	/* Post Controls */
	// View IP addresses
	$config['mod']['show_ip'] = MOD;
	// Delete a post
	$config['mod']['delete'] = JANITOR;
	// Ban a user for a post
	$config['mod']['ban'] = MOD;
	// Ban and delete (one click; instant)
	$config['mod']['bandelete'] = MOD;
	// Ban and delete by ip (one click; instant)
	$config['mod']['bandeletebyip'] = MOD;
	// Ban and delete by in in thread (one click; instant)
	$config['mod']['bandeletebyip_thread'] = MOD;
	// ban by file hash
	$config['mod']['banfilehash'] = MOD;
	// Remove bans
	$config['mod']['unban'] = MOD;
	// Spoiler image
	$config['mod']['spoilerimage'] = JANITOR;
	// Delete file (and keep post)
	$config['mod']['deletefile'] = JANITOR;
	// Delete file by ip (and keep post)
	$config['mod']['deletefilebyip'] = ADMIN;
	// Delete file by ip in thread (and keep post)
	$config['mod']['deletefilebyip_thread'] = ADMIN;
	// Delete all posts by IP
	$config['mod']['deletebyip'] = MOD;
	// Delete all posts by IP across all boards
	$config['mod']['deletebyip_global'] = ADMIN;
	// Sticky a thread
	$config['mod']['sticky'] = MOD;
	// Cycle a thread
	$config['mod']['cycle'] = MOD;
	$config['cycle_limit'] = &$config['reply_limit'];
	// Lock a thread
	$config['mod']['lock'] = MOD;
	// Post in a locked thread
	$config['mod']['postinlocked'] = MOD;
	// Prevent a thread from being bumped
	$config['mod']['bumplock'] = MOD;
	// View whether a thread has been bumplocked ("-1" to allow non-mods to see too)
	$config['mod']['view_bumplock'] = MOD;
	// Edit posts
	$config['mod']['editpost'] = ADMIN;
	// Bypass "field_disable_*" (forced anonymity, etc.)
	$config['mod']['bypass_field_disable'] = MOD;
	// Post bypass unoriginal content check on robot-enabled boards
	$config['mod']['postunoriginal'] = ADMIN;
	// Bypass flood check
	$config['mod']['bypass_filters'] = ADMIN;
	$config['mod']['flood'] = &$config['mod']['bypass_filters'];
	// Raw HTML posting
	$config['mod']['rawhtml'] = ADMIN;
	
	// Clean System
	// Post edits remove local clean?
	$config['clean']['edits_remove_local'] = true;
	// Post edits remove global clean?
	$config['clean']['edits_remove_global'] = true;
	// Mark post clean for board rule
	$config['mod']['clean'] = JANITOR;
	// Mark post clean for global rule
	$config['mod']['clean_global'] = MOD;
	
	/* Administration */
	// View the report queue
	$config['mod']['reports'] = JANITOR;
	// Dismiss an abuse report
	$config['mod']['report_dismiss'] = JANITOR;
	// Remove global status from a report
	$config['mod']['report_demote'] = JANITOR;
	// Elevate a global report to a local report.
	$config['mod']['report_promote'] = JANITOR;
	// Dismiss all abuse reports by an IP
	$config['mod']['report_dismiss_ip'] = JANITOR;
	// Dismiss all abuse reports on an individual post or thread
	$config['mod']['report_dismiss_content'] = JANITOR;
	// View list of bans
	$config['mod']['view_banlist'] = MOD;
	// View the username of the mod who made a ban
	$config['mod']['view_banstaff'] = MOD;
	// If the moderator doesn't fit the $config['mod']['view_banstaff'] (previous) permission, show him just
	// a "?" instead. Otherwise, it will be "Mod" or "Admin".
	$config['mod']['view_banquestionmark'] = false;
	// Show expired bans in the ban list (they are kept in cache until the culprit returns)
	$config['mod']['view_banexpired'] = true;
	// View ban for IP address
	$config['mod']['view_ban'] = $config['mod']['view_banlist'];
	// View IP address notes
	$config['mod']['view_notes'] = JANITOR;
	// Create notes
	$config['mod']['create_notes'] = $config['mod']['view_notes'];
	// Remote notes
	$config['mod']['remove_notes'] = ADMIN;
	// Create a new board
	$config['mod']['newboard'] = ADMIN;
	// Manage existing boards (change title, etc)
	$config['mod']['manageboards'] = ADMIN;
	// Delete a board
	$config['mod']['deleteboard'] = ADMIN;
	// List/manage users
	$config['mod']['manageusers'] = MOD;
	// Promote/demote users
	$config['mod']['promoteusers'] = ADMIN;
	// Edit any users' login information
	$config['mod']['editusers'] = ADMIN;
	// Change user's own password
	$config['mod']['edit_profile'] = JANITOR;
	// Delete a user
	$config['mod']['deleteusers'] = ADMIN;
	// Create a user
	$config['mod']['createusers'] = ADMIN;
	// View the moderation log
	$config['mod']['modlog'] = ADMIN;
	// View IP addresses of other mods in ?/log
	$config['mod']['show_ip_modlog'] = ADMIN;
	// View relevant moderation log entries on IP address pages (ie. ban history, etc.) Warning: Can be
	// pretty resource intensive if your mod logs are huge.
	$config['mod']['modlog_ip'] = MOD;
	// Create a PM (viewing mod usernames)
	$config['mod']['create_pm'] = JANITOR;
	// Create a PM for anyone 
	$config['mod']['pm_all'] = ADMIN;
	// Bypass PM ratelimit
	$config['mod']['bypass_pm_ratelimit'] = ADMIN;
	// Read any PM, sent to or from anybody
	$config['mod']['master_pm'] = ADMIN;
	// Rebuild everything
	$config['mod']['rebuild'] = ADMIN;
	// Search through posts, IP address notes and bans
	$config['mod']['search'] = JANITOR;
	// Allow searching posts (can be used with board configuration file to disallow searching through a
	// certain board)
	$config['mod']['search_posts'] = JANITOR;
	// Read the moderator noticeboard
	$config['mod']['noticeboard'] = JANITOR;
	// Post to the moderator noticeboard
	$config['mod']['noticeboard_post'] = MOD;
	// Delete entries from the noticeboard
	$config['mod']['noticeboard_delete'] = ADMIN;
	// Public ban messages; attached to posts
	$config['mod']['public_ban'] = MOD;
	// Manage and install themes for homepage
	$config['mod']['themes'] = ADMIN;
	// Post news entries
	$config['mod']['news'] = ADMIN;
	// Custom name when posting news
	$config['mod']['news_custom'] = ADMIN;
	// Delete news entries
	$config['mod']['news_delete'] = ADMIN;
	// Look through all cache values for debugging when APC is enabled (?/debug/apc)
	$config['mod']['debug_apc'] = ADMIN;
	// Edit the current configuration (via web interface)
	$config['mod']['edit_config'] = ADMIN;
	// View ban appeals
	$config['mod']['view_ban_appeals'] = MOD;
	// Accept and deny ban appeals
	$config['mod']['ban_appeals'] = MOD;
	// View the recent posts page
	$config['mod']['recent'] = MOD;
	// Create pages
	$config['mod']['edit_pages'] = MOD;
	
	$config['pages_max'] = 10;

	// Config editor permissions
	$config['mod']['config'] = array();
	
	$config['mod']['config'][JANITOR] = array(
		'!', // Allow editing ONLY the variables listed (in this case, nothing).
	);
	
	$config['mod']['config'][MOD] = array(
		'!', // Allow editing ONLY the variables listed (plus that in $config['mod']['config'][JANITOR]).
		'global_message',
	);
	
	// File board. Like 4chan /f/
	$config['file_board'] = false;

	// Thread tags. Set to false to disable
	// Example: array('A' => 'Chinese cartoons', 'M' => 'Music', 'P' => 'Pornography');
	$config['allowed_tags'] = false;

/*
 * ====================
 *  Public post search
 * ====================
 */
	$config['search'] = array();

	// Enable the search form
	$config['search']['enable'] = false;

	// Enable search in the board index.
	$config['board_search'] = false;

	// Maximal number of queries per IP address per minutes
    $config['search']['queries_per_minutes'] = Array(15, 2);

	// Global maximal number of queries per minutes
    $config['search']['queries_per_minutes_all'] = Array(50, 2);

	// Limit of search results
    $config['search']['search_limit'] = 100;
		
	// Boards for searching
    //$config['search']['boards'] = array('a', 'b', 'c', 'd', 'e');

/*
 * ====================
 *  Events (PHP 5.3.0+)
 * ====================
 */

	// http://tinyboard.org/docs/?p=Events

	// event_handler('post', function($post) {
	// 	// do something
	// });

	// event_handler('post', function($post) {
	// 	// do something else
	// 	
	// 	// return an error (reject post)
	// 	return 'Sorry, you cannot post that!';
	// });

/*
 * =============
 *  API settings
 * =============
 */

	// Whether or not to enable the 4chan-compatible API, disabled by default. See
	// https://github.com/4chan/4chan-API for API specification.
	$config['api']['enabled'] = true;

	// Extra fields in to be shown in the array that are not in the 4chan-API. You can get these by taking a
	// look at the schema for posts_ tables. The array should be formatted as $db_column => $translated_name.
	// Example: Adding the pre-markup post body to the API as "com_nomarkup".
	// $config['api']['extra_fields'] = array('body_nomarkup' => 'com_nomarkup');

/*
 * ====================
 *  Other/uncategorized
 * ====================
 */
	$config['early_404'] = false;
	$config['early_404_page'] = 5;
	$config['early_404_replies'] = 10;

	$config['cron_bans'] = true;
	$config['hash_masked_ip'] = true;
	$config['mask_db_error'] = true;
	$config['katex'] = false;
 
 
	// Meta keywords. It's probably best to include these in per-board configurations.
	// $config['meta_keywords'] = 'chan,anonymous discussion,imageboard,tinyboard';

	// Link imageboard to your Google Analytics account to track users and provide traffic insights.
	// $config['google_analytics'] = 'UA-xxxxxxx-yy';
	// Keep the Google Analytics cookies to one domain -- ga._setDomainName()
	// $config['google_analytics_domain'] = 'www.example.org';

	// Link imageboard to your Statcounter.com account to track users and provide traffic insights without the Google botnet.
	// Extract these values from Statcounter's JS tracking code:
	// $config['statcounter_project'] = '1234567';
	// $config['statcounter_security'] = 'acbd1234';

	// If you use Varnish, Squid, or any similar caching reverse-proxy in front of Tinyboard, you can
	// configure Tinyboard to PURGE files when they're written to.
	// $config['purge'] = array(
	// 	array('127.0.0.1', 80)
	// 	array('127.0.0.1', 80, 'example.org')
	// );

	// Connection timeout for $config['purge'], in seconds.
	$config['purge_timeout'] = 3;

	// Additional mod.php?/ pages. Look in inc/mod/pages.php for help.
	// $config['mod']['custom_pages']['/something/(\d+)'] = function($id) {
	// 	global $config;
	// 	if (!hasPermission($config['mod']['something']))
	// 		error($config['error']['noaccess']);
	// 	// ...
	// };

	// You can also enable themes (like ukko) in mod panel like this:
	// require_once("templates/themes/ukko/theme.php");
	//
	// $config['mod']['custom_pages']['/\*/'] = function() {
	//        global $mod;
	//
	//        $ukko = new ukko();
	//        $ukko->settings = array();
	//        $ukko->settings['uri'] = '*';
	//        $ukko->settings['title'] = 'derp';
	//        $ukko->settings['subtitle'] = 'derpity';
	//        $ukko->settings['thread_limit'] = 15;
	//        $ukko->settings['exclude'] = '';
	//
	//        echo $ukko->build($mod);
	// };

	// Example: Add links to dashboard (will all be in a new "Other" category).
	// $config['mod']['dashboard_links']['Something'] = '?/something';

	// Remote servers. I'm not even sure if this code works anymore. It might. Haven't tried it in a while.
	// $config['remote']['static'] = array(
	// 	'host' => 'static.example.org',
	// 	'auth' => array(
	// 		'method' => 'plain',
	// 		'username' => 'username',
	// 		'password' => 'password!123'
	// 	),
	// 	'type' => 'scp'
	// );


	// Regex for board URIs. Don't add "`" character or any Unicode that MySQL can't handle. 58 characters
	// is the absolute maximum, because MySQL cannot handle table names greater than 64 characters.
	$config['board_regex'] = '[0-9a-zA-Z\+$_\x{0080}-\x{FFFF}]{1,58}';

	// Regex for matching links.
	$config['link_regex'] = '((?:(?:https?:)?\/\/|ftp:\/\/|irc:\/\/)[^\s<>()"]+?(?:\([^\s<>()"]*?\)[^\s<>()"]*?)*)((?:\s|<|>|"|\.|\]|!|\?|,|&\#44;|&quot;)*(?:[\s<>()"]|$))';

	// Allowed URLs in ?/settings
	$config['allowed_offsite_urls'] = array('https://i.imgur.com/', 'https://media.8ch.net/', 'https://fonts.googleapis.com/', 'https://fonts.gstatic.com/');

	// Use read.php?
	// read.php is a file that dynamically displays pages to users instead of the build on demand system in use in Tinyboard since 2010.
	//
	// read.php is basically a watered down mod.php -- if coupled with caching, it improves performance and allows for easier replication
	// across machines.
	$config['use_read_php'] = false;

	// Use oekaki?
	$config['oekaki'] = false;

	// Twig cache?
	$config['twig_cache'] = false;


	// Allowed HTML tags in ?/edit_pages.
	$config['allowed_html'] = 'a[href|title],p,br,li,ol,ul,strong,em,u,h2,b,i,tt,div,img[src|alt|title],hr,h1,h2,h3,h4,h5';

	// Use custom assets? (spoiler file, etc; this is used by ?/settings and ?/assets)
	$config['custom_assets'] = false;

	// If you use CloudFlare set these for some features to work correctly.
	$config['cloudflare'] = array();
	$config['cloudflare']['enabled'] = false;
	$config['cloudflare']['zone'] = 'zone';
	$config['cloudflare']['token'] = 'token';
	$config['cloudflare']['email'] = 'email';
	$config['cloudflare']['domain'] = 'example.com';

	// Version
	$config['footer_title'] = '<a href="https://github.com/neochaner/neochan" target="_blank">Neoboard @ 2018</a> ';
	$config['footer'] = "Все права и копирайты на этой странице принадлежат правообладателям. Все комментарии принадлежат лицам, отправившим их.";
	$config['footer'] .= "<br> Если вы обнаружили информацию, размещённую против правил, пожалуйста, <a href='mailto:admin@neochan.ru'>сообщите нам</a> об этом.";
	
	   
	  
	$config['hashSalt'] = "usesomadasdsadsadsadasdasdasdsadesillystringfors";
