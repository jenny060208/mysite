<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

/**
 * ThinkPHPæƒ¯ä¾‹é…�ç½®æ–‡ä»¶
 * è¯¥æ–‡ä»¶è¯·ä¸�è¦�ä¿®æ”¹ï¼Œå¦‚æžœè¦�è¦†ç›–æƒ¯ä¾‹é…�ç½®çš„å€¼ï¼Œå�¯åœ¨åº”ç”¨é…�ç½®æ–‡ä»¶ä¸­è®¾å®šå’Œæƒ¯ä¾‹ä¸�ç¬¦çš„é…�ç½®é¡¹
 * é…�ç½®å��ç§°å¤§å°�å†™ä»»æ„�ï¼Œç³»ç»Ÿä¼šç»Ÿä¸€è½¬æ�¢æˆ�å°�å†™
 * æ‰€æœ‰é…�ç½®å�‚æ•°éƒ½å�¯ä»¥åœ¨ç”Ÿæ•ˆå‰�åŠ¨æ€�æ”¹å�˜
 */
defined ( 'THINK_PATH' ) or exit ();
return array(
    /* åº”ç”¨è®¾å®š */
    'APP_USE_NAMESPACE' => true, // åº”ç”¨ç±»åº“æ˜¯å�¦ä½¿ç”¨å‘½å��ç©ºé—´
		'APP_SUB_DOMAIN_DEPLOY' => false, // æ˜¯å�¦å¼€å�¯å­�åŸŸå��éƒ¨ç½²
		'APP_SUB_DOMAIN_RULES' => array (), // å­�åŸŸå��éƒ¨ç½²è§„åˆ™
		'APP_DOMAIN_SUFFIX' => '', // åŸŸå��å�Žç¼€ å¦‚æžœæ˜¯com.cn net.cn ä¹‹ç±»çš„å�Žç¼€å¿…é¡»è®¾ç½®
		'ACTION_SUFFIX' => '', // æ“�ä½œæ–¹æ³•å�Žç¼€
		'MULTI_MODULE' => true, // æ˜¯å�¦å…�è®¸å¤šæ¨¡å�— å¦‚æžœä¸ºfalse åˆ™å¿…é¡»è®¾ç½® DEFAULT_MODULE
		'MODULE_DENY_LIST' => array (
				'Common',
				'Runtime' 
		),
		'CONTROLLER_LEVEL' => 1,
		'APP_AUTOLOAD_LAYER' => 'Controller,Model', // è‡ªåŠ¨åŠ è½½çš„åº”ç”¨ç±»åº“å±‚ å…³é—­APP_USE_NAMESPACEå�Žæœ‰æ•ˆ
		'APP_AUTOLOAD_PATH' => '', // è‡ªåŠ¨åŠ è½½çš„è·¯å¾„ å…³é—­APP_USE_NAMESPACEå�Žæœ‰æ•ˆ
		
		/* Cookieè®¾ç½® */
		'COOKIE_EXPIRE' => 0, // Cookieæœ‰æ•ˆæœŸ
		'COOKIE_DOMAIN' => '', // Cookieæœ‰æ•ˆåŸŸå��
		'COOKIE_PATH' => '/', // Cookieè·¯å¾„
		'COOKIE_PREFIX' => '', // Cookieå‰�ç¼€ é�¿å…�å†²çª�
		'COOKIE_SECURE' => false, // Cookieå®‰å…¨ä¼ è¾“
		'COOKIE_HTTPONLY' => '', // Cookie httponlyè®¾ç½®
		
		/* é»˜è®¤è®¾å®š */
		'DEFAULT_M_LAYER' => 'Model', // é»˜è®¤çš„æ¨¡åž‹å±‚å��ç§°
		'DEFAULT_C_LAYER' => 'Controller', // é»˜è®¤çš„æŽ§åˆ¶å™¨å±‚å��ç§°
		'DEFAULT_V_LAYER' => 'View', // é»˜è®¤çš„è§†å›¾å±‚å��ç§°
		'DEFAULT_LANG' => 'zh-cn', // é»˜è®¤è¯­è¨€
		'DEFAULT_THEME' => '', // é»˜è®¤æ¨¡æ�¿ä¸»é¢˜å��ç§°
		'DEFAULT_MODULE' => 'Home', // é»˜è®¤æ¨¡å�—
		'DEFAULT_CONTROLLER' => 'Index', // é»˜è®¤æŽ§åˆ¶å™¨å��ç§°
		'DEFAULT_ACTION' => 'index', // é»˜è®¤æ“�ä½œå��ç§°
		'DEFAULT_CHARSET' => 'utf-8', // é»˜è®¤è¾“å‡ºç¼–ç �
		'DEFAULT_TIMEZONE' => 'EST', // é»˜è®¤æ—¶åŒº
		'DEFAULT_AJAX_RETURN' => 'JSON', // é»˜è®¤AJAX æ•°æ�®è¿”å›žæ ¼å¼�,å�¯é€‰JSON XML ...
		'DEFAULT_JSONP_HANDLER' => 'jsonpReturn', // é»˜è®¤JSONPæ ¼å¼�è¿”å›žçš„å¤„ç�†æ–¹æ³•
		'DEFAULT_FILTER' => 'htmlspecialchars', // é»˜è®¤å�‚æ•°è¿‡æ»¤æ–¹æ³• ç”¨äºŽIå‡½æ•°...
		
		/* æ•°æ�®åº“è®¾ç½® */
		'DB_TYPE' => '', // æ•°æ�®åº“ç±»åž‹
		'DB_HOST' => '', // æœ�åŠ¡å™¨åœ°å�€
		'DB_NAME' => '', // æ•°æ�®åº“å��
		'DB_USER' => '', // ç”¨æˆ·å��
		'DB_PWD' => '', // å¯†ç �
		'DB_PORT' => '', // ç«¯å�£
		'DB_PREFIX' => '', // æ•°æ�®åº“è¡¨å‰�ç¼€
		'DB_PARAMS' => array (), // æ•°æ�®åº“è¿žæŽ¥å�‚æ•°
		'DB_DEBUG' => TRUE, // æ•°æ�®åº“è°ƒè¯•æ¨¡å¼� å¼€å�¯å�Žå�¯ä»¥è®°å½•SQLæ—¥å¿—
		'DB_FIELDS_CACHE' => true, // å�¯ç”¨å­—æ®µç¼“å­˜
		'DB_CHARSET' => 'utf8', // æ•°æ�®åº“ç¼–ç �é»˜è®¤é‡‡ç”¨utf8
		'DB_DEPLOY_TYPE' => 0, // æ•°æ�®åº“éƒ¨ç½²æ–¹å¼�:0 é›†ä¸­å¼�(å�•ä¸€æœ�åŠ¡å™¨),1 åˆ†å¸ƒå¼�(ä¸»ä»Žæœ�åŠ¡å™¨)
		'DB_RW_SEPARATE' => false, // æ•°æ�®åº“è¯»å†™æ˜¯å�¦åˆ†ç¦» ä¸»ä»Žå¼�æœ‰æ•ˆ
		'DB_MASTER_NUM' => 1, // è¯»å†™åˆ†ç¦»å�Ž ä¸»æœ�åŠ¡å™¨æ•°é‡�
		'DB_SLAVE_NO' => '', // æŒ‡å®šä»Žæœ�åŠ¡å™¨åº�å�·
		
		/* æ•°æ�®ç¼“å­˜è®¾ç½® */
		'DATA_CACHE_TIME' => 0, // æ•°æ�®ç¼“å­˜æœ‰æ•ˆæœŸ 0è¡¨ç¤ºæ°¸ä¹…ç¼“å­˜
		'DATA_CACHE_COMPRESS' => false, // æ•°æ�®ç¼“å­˜æ˜¯å�¦åŽ‹ç¼©ç¼“å­˜
		'DATA_CACHE_CHECK' => false, // æ•°æ�®ç¼“å­˜æ˜¯å�¦æ ¡éªŒç¼“å­˜
		'DATA_CACHE_PREFIX' => '', // ç¼“å­˜å‰�ç¼€
		'DATA_CACHE_TYPE' => 'File', // æ•°æ�®ç¼“å­˜ç±»åž‹,æ”¯æŒ�:File|Db|Apc|Memcache|Shmop|Sqlite|Xcache|Apachenote|Eaccelerator
		'DATA_CACHE_PATH' => TEMP_PATH, // ç¼“å­˜è·¯å¾„è®¾ç½® (ä»…å¯¹Fileæ–¹å¼�ç¼“å­˜æœ‰æ•ˆ)
		'DATA_CACHE_KEY' => '', // ç¼“å­˜æ–‡ä»¶KEY (ä»…å¯¹Fileæ–¹å¼�ç¼“å­˜æœ‰æ•ˆ)
		'DATA_CACHE_SUBDIR' => false, // ä½¿ç”¨å­�ç›®å½•ç¼“å­˜ (è‡ªåŠ¨æ ¹æ�®ç¼“å­˜æ ‡è¯†çš„å“ˆå¸Œåˆ›å»ºå­�ç›®å½•)
		'DATA_PATH_LEVEL' => 1, // å­�ç›®å½•ç¼“å­˜çº§åˆ«
		
		/* é”™è¯¯è®¾ç½® */
		'ERROR_MESSAGE' => 'é¡µé�¢é”™è¯¯ï¼�è¯·ç¨�å�Žå†�è¯•ï½ž', // é”™è¯¯æ˜¾ç¤ºä¿¡æ�¯,é�žè°ƒè¯•æ¨¡å¼�æœ‰æ•ˆ
		'ERROR_PAGE' => '', // é”™è¯¯å®šå�‘é¡µé�¢
		'SHOW_ERROR_MSG' => false, // æ˜¾ç¤ºé”™è¯¯ä¿¡æ�¯
		'TRACE_MAX_RECORD' => 100, // æ¯�ä¸ªçº§åˆ«çš„é”™è¯¯ä¿¡æ�¯ æœ€å¤§è®°å½•æ•°
		
		/* æ—¥å¿—è®¾ç½® */
		'LOG_RECORD' => false, // é»˜è®¤ä¸�è®°å½•æ—¥å¿—
		'LOG_TYPE' => 'File', // æ—¥å¿—è®°å½•ç±»åž‹ é»˜è®¤ä¸ºæ–‡ä»¶æ–¹å¼�
		'LOG_LEVEL' => 'EMERG,ALERT,CRIT,ERR', // å…�è®¸è®°å½•çš„æ—¥å¿—çº§åˆ«
		'LOG_FILE_SIZE' => 2097152, // æ—¥å¿—æ–‡ä»¶å¤§å°�é™�åˆ¶
		'LOG_EXCEPTION_RECORD' => false, // æ˜¯å�¦è®°å½•å¼‚å¸¸ä¿¡æ�¯æ—¥å¿—
		
		/* SESSIONè®¾ç½® */
		'SESSION_AUTO_START' => true, // æ˜¯å�¦è‡ªåŠ¨å¼€å�¯Session
		'SESSION_OPTIONS' => array (), // session é…�ç½®æ•°ç»„ æ”¯æŒ�type name id path expire domain ç­‰å�‚æ•°
		'SESSION_TYPE' => '', // session handerç±»åž‹ é»˜è®¤æ— éœ€è®¾ç½® é™¤é�žæ‰©å±•äº†session handeré©±åŠ¨
		'SESSION_PREFIX' => '', // session å‰�ç¼€
		                      // 'VAR_SESSION_ID' => 'session_id', //sessionIDçš„æ��äº¤å�˜é‡�
		
		/* æ¨¡æ�¿å¼•æ“Žè®¾ç½® */
		'TMPL_CONTENT_TYPE' => 'text/html', // é»˜è®¤æ¨¡æ�¿è¾“å‡ºç±»åž‹
		'TMPL_ACTION_ERROR' => THINK_PATH . 'Tpl/dispatch_jump.tpl', // é»˜è®¤é”™è¯¯è·³è½¬å¯¹åº”çš„æ¨¡æ�¿æ–‡ä»¶
		'TMPL_ACTION_SUCCESS' => THINK_PATH . 'Tpl/dispatch_jump.tpl', // é»˜è®¤æˆ�åŠŸè·³è½¬å¯¹åº”çš„æ¨¡æ�¿æ–‡ä»¶
		'TMPL_EXCEPTION_FILE' => THINK_PATH . 'Tpl/think_exception.tpl', // å¼‚å¸¸é¡µé�¢çš„æ¨¡æ�¿æ–‡ä»¶
		'TMPL_DETECT_THEME' => false, // è‡ªåŠ¨ä¾¦æµ‹æ¨¡æ�¿ä¸»é¢˜
		'TMPL_TEMPLATE_SUFFIX' => '.html', // é»˜è®¤æ¨¡æ�¿æ–‡ä»¶å�Žç¼€
		'TMPL_FILE_DEPR' => '/', // æ¨¡æ�¿æ–‡ä»¶CONTROLLER_NAMEä¸ŽACTION_NAMEä¹‹é—´çš„åˆ†å‰²ç¬¦
		                       // å¸ƒå±€è®¾ç½®
		'TMPL_ENGINE_TYPE' => 'Think', // é»˜è®¤æ¨¡æ�¿å¼•æ“Ž ä»¥ä¸‹è®¾ç½®ä»…å¯¹ä½¿ç”¨Thinkæ¨¡æ�¿å¼•æ“Žæœ‰æ•ˆ
		'TMPL_CACHFILE_SUFFIX' => '.php', // é»˜è®¤æ¨¡æ�¿ç¼“å­˜å�Žç¼€
		'TMPL_DENY_FUNC_LIST' => 'echo,exit', // æ¨¡æ�¿å¼•æ“Žç¦�ç”¨å‡½æ•°
		'TMPL_DENY_PHP' => false, // é»˜è®¤æ¨¡æ�¿å¼•æ“Žæ˜¯å�¦ç¦�ç”¨PHPåŽŸç”Ÿä»£ç �
		'TMPL_L_DELIM' => '{', // æ¨¡æ�¿å¼•æ“Žæ™®é€šæ ‡ç­¾å¼€å§‹æ ‡è®°
		'TMPL_R_DELIM' => '}', // æ¨¡æ�¿å¼•æ“Žæ™®é€šæ ‡ç­¾ç»“æ�Ÿæ ‡è®°
		'TMPL_VAR_IDENTIFY' => 'array', // æ¨¡æ�¿å�˜é‡�è¯†åˆ«ã€‚ç•™ç©ºè‡ªåŠ¨åˆ¤æ–­,å�‚æ•°ä¸º'obj'åˆ™è¡¨ç¤ºå¯¹è±¡
		'TMPL_STRIP_SPACE' => true, // æ˜¯å�¦åŽ»é™¤æ¨¡æ�¿æ–‡ä»¶é‡Œé�¢çš„htmlç©ºæ ¼ä¸Žæ�¢è¡Œ
		'TMPL_CACHE_ON' => false, // Set template compile catch, false=> re-compile every time started, no cache,
		                        // true:==> catch is on; falseåˆ™æ¯�æ¬¡éƒ½ä¼šé‡�æ–°ç¼–è¯‘
		'TMPL_CACHE_PREFIX' => '', // æ¨¡æ�¿ç¼“å­˜å‰�ç¼€æ ‡è¯†ï¼Œå�¯ä»¥åŠ¨æ€�æ”¹å�˜
		'TMPL_CACHE_TIME' => 0, // æ¨¡æ�¿ç¼“å­˜æœ‰æ•ˆæœŸ 0 ä¸ºæ°¸ä¹…ï¼Œ(ä»¥æ•°å­—ä¸ºå€¼ï¼Œå�•ä½�:ç§’)
		'TMPL_LAYOUT_ITEM' => '{__CONTENT__}', // å¸ƒå±€æ¨¡æ�¿çš„å†…å®¹æ›¿æ�¢æ ‡è¯†
		'LAYOUT_ON' => false, // æ˜¯å�¦å�¯ç”¨å¸ƒå±€
		'LAYOUT_NAME' => 'layout', // å½“å‰�å¸ƒå±€å��ç§° é»˜è®¤ä¸ºlayout
		                         
		// Thinkæ¨¡æ�¿å¼•æ“Žæ ‡ç­¾åº“ç›¸å…³è®¾å®š
		'TAGLIB_BEGIN' => '<', // æ ‡ç­¾åº“æ ‡ç­¾å¼€å§‹æ ‡è®°
		'TAGLIB_END' => '>', // æ ‡ç­¾åº“æ ‡ç­¾ç»“æ�Ÿæ ‡è®°
		'TAGLIB_LOAD' => true, // æ˜¯å�¦ä½¿ç”¨å†…ç½®æ ‡ç­¾åº“ä¹‹å¤–çš„å…¶å®ƒæ ‡ç­¾åº“ï¼Œé»˜è®¤è‡ªåŠ¨æ£€æµ‹
		'TAGLIB_BUILD_IN' => 'cx', // å†…ç½®æ ‡ç­¾åº“å��ç§°(æ ‡ç­¾ä½¿ç”¨ä¸�å¿…æŒ‡å®šæ ‡ç­¾åº“å��ç§°),ä»¥é€—å�·åˆ†éš”
		                         // æ³¨æ„�è§£æž�é¡ºåº�
		'TAGLIB_PRE_LOAD' => '', // éœ€è¦�é¢�å¤–åŠ è½½çš„æ ‡ç­¾åº“(é¡»æŒ‡å®šæ ‡ç­¾åº“å��ç§°)ï¼Œå¤šä¸ªä»¥é€—å�·åˆ†éš”
		
		/* URLè®¾ç½® */
		'URL_CASE_INSENSITIVE' => true, // é»˜è®¤false è¡¨ç¤ºURLåŒºåˆ†å¤§å°�å†™ trueåˆ™è¡¨ç¤ºä¸�åŒºåˆ†å¤§å°�å†™
		'URL_MODEL' => 1, // URLè®¿é—®æ¨¡å¼�,å�¯é€‰å�‚æ•°0ã€�1ã€�2ã€�3,ä»£è¡¨ä»¥ä¸‹å››ç§�æ¨¡å¼�ï¼š
		                // 0 (æ™®é€šæ¨¡å¼�); 1 (PATHINFO æ¨¡å¼�); 2 (REWRITE æ¨¡å¼�); 3 (å…¼å®¹æ¨¡å¼�)
		                // é»˜è®¤ä¸ºPATHINFO æ¨¡å¼�
		'URL_PATHINFO_DEPR' => '/', // PATHINFOæ¨¡å¼�ä¸‹ï¼Œå�„å�‚æ•°ä¹‹é—´çš„åˆ†å‰²ç¬¦å�·
		'URL_PATHINFO_FETCH' => 'ORIG_PATH_INFO,REDIRECT_PATH_INFO,REDIRECT_URL', // ç”¨äºŽå…¼å®¹åˆ¤æ–­PATH_INFO
		                                                                        // å�‚æ•°çš„SERVERæ›¿ä»£å�˜é‡�åˆ—è¡¨
		'URL_REQUEST_URI' => 'REQUEST_URI', // èŽ·å�–å½“å‰�é¡µé�¢åœ°å�€çš„ç³»ç»Ÿå�˜é‡� é»˜è®¤ä¸ºREQUEST_URI
		'URL_HTML_SUFFIX' => 'html', // URLä¼ªé�™æ€�å�Žç¼€è®¾ç½®
		'URL_DENY_SUFFIX' => 'ico|png|gif|jpg', // URLç¦�æ­¢è®¿é—®çš„å�Žç¼€è®¾ç½®
		'URL_PARAMS_BIND' => true, // URL variable bonding to action as parameter
		'URL_PARAMS_BIND_TYPE' => 1, // URL access address change in sequence
		'URL_PARAMS_FILTER' => false, // URLå�˜é‡�ç»‘å®šè¿‡æ»¤
		'URL_PARAMS_FILTER_TYPE' => '', // URLå�˜é‡�ç»‘å®šè¿‡æ»¤æ–¹æ³• å¦‚æžœä¸ºç©º è°ƒç”¨DEFAULT_FILTER
		'URL_ROUTER_ON' => false, // æ˜¯å�¦å¼€å�¯URLè·¯ç”±
		'URL_ROUTE_RULES' => array (), // é»˜è®¤è·¯ç”±è§„åˆ™ é’ˆå¯¹æ¨¡å�—
		'URL_MAP_RULES' => array (), // URLæ˜ å°„å®šä¹‰è§„åˆ™
		
		/* ç³»ç»Ÿå�˜é‡�å��ç§°è®¾ç½® */
		'VAR_MODULE' => 'm', // é»˜è®¤æ¨¡å�—èŽ·å�–å�˜é‡�
		'VAR_ADDON' => 'addon', // é»˜è®¤çš„æ�’ä»¶æŽ§åˆ¶å™¨å‘½å��ç©ºé—´å�˜é‡�
		'VAR_CONTROLLER' => 'c', // é»˜è®¤æŽ§åˆ¶å™¨èŽ·å�–å�˜é‡�
		'VAR_ACTION' => 'a', // é»˜è®¤æ“�ä½œèŽ·å�–å�˜é‡�
		'VAR_AJAX_SUBMIT' => 'ajax', // é»˜è®¤çš„AJAXæ��äº¤å�˜é‡�
		'VAR_JSONP_HANDLER' => 'callback',
		'VAR_PATHINFO' => 's', // å…¼å®¹æ¨¡å¼�PATHINFOèŽ·å�–å�˜é‡�ä¾‹å¦‚ ?s=/module/action/id/1
		                     // å�Žé�¢çš„å�‚æ•°å�–å†³äºŽURL_PATHINFO_DEPR
		'VAR_TEMPLATE' => 't', // é»˜è®¤æ¨¡æ�¿åˆ‡æ�¢å�˜é‡�
		'VAR_AUTO_STRING' => false, // è¾“å…¥å�˜é‡�æ˜¯å�¦è‡ªåŠ¨å¼ºåˆ¶è½¬æ�¢ä¸ºå­—ç¬¦ä¸²
		                          // å¦‚æžœå¼€å�¯åˆ™æ•°ç»„å�˜é‡�éœ€è¦�æ‰‹åŠ¨ä¼ å…¥å�˜é‡�ä¿®é¥°ç¬¦èŽ·å�–å�˜é‡�
		
		'HTTP_CACHE_CONTROL' => 'private', // ç½‘é¡µç¼“å­˜æŽ§åˆ¶
		'CHECK_APP_DIR' => true, // æ˜¯å�¦æ£€æŸ¥åº”ç”¨ç›®å½•æ˜¯å�¦åˆ›å»º
		'FILE_UPLOAD_TYPE' => 'Local', // æ–‡ä»¶ä¸Šä¼ æ–¹å¼�
		'DATA_CRYPT_TYPE' => 'Think' 
); // æ•°æ�®åŠ å¯†æ–¹å¼�


