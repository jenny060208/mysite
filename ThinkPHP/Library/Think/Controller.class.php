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
namespace Think;

/**
 * ThinkPHP æŽ§åˆ¶å™¨åŸºç±» æŠ½è±¡ç±»
 */
abstract class Controller {
	
	/**
	 * è§†å›¾å®žä¾‹å¯¹è±¡
	 *
	 * @var view
	 * @access protected
	 */
	protected $view = null;
	
	/**
	 * æŽ§åˆ¶å™¨å�‚æ•°
	 *
	 * @var config
	 * @access protected
	 */
	protected $config = array ();
	
	/**
	 * æž¶æž„å‡½æ•° å�–å¾—æ¨¡æ�¿å¯¹è±¡å®žä¾‹
	 *
	 * @access public
	 */
	public function __construct() {
		Hook::listen ( 'action_begin', $this->config );
		// å®žä¾‹åŒ–è§†å›¾ç±»
		$this->view = Think::instance ( 'Think\View' );
		// æŽ§åˆ¶å™¨åˆ�å§‹åŒ–
		if (method_exists ( $this, '_initialize' ))
			$this->_initialize ();
	}
	
	/**
	 * æ¨¡æ�¿æ˜¾ç¤º è°ƒç”¨å†…ç½®çš„æ¨¡æ�¿å¼•æ“Žæ˜¾ç¤ºæ–¹æ³•ï¼Œ
	 *
	 * @access protected
	 * @param string $templateFile
	 *        	æŒ‡å®šè¦�è°ƒç”¨çš„æ¨¡æ�¿æ–‡ä»¶
	 *        	é»˜è®¤ä¸ºç©º ç”±ç³»ç»Ÿè‡ªåŠ¨å®šä½�æ¨¡æ�¿æ–‡ä»¶
	 * @param string $charset
	 *        	è¾“å‡ºç¼–ç �
	 * @param string $contentType
	 *        	è¾“å‡ºç±»åž‹
	 * @param string $content
	 *        	è¾“å‡ºå†…å®¹
	 * @param string $prefix
	 *        	æ¨¡æ�¿ç¼“å­˜å‰�ç¼€
	 * @return void
	 */
	protected function display($templateFile = '', $charset = '', $contentType = '', $content = '', $prefix = '') {
		$this->view->display ( $templateFile, $charset, $contentType, $content, $prefix );
	}
	
	/**
	 * è¾“å‡ºå†…å®¹æ–‡æœ¬å�¯ä»¥åŒ…æ‹¬Html å¹¶æ”¯æŒ�å†…å®¹è§£æž�
	 *
	 * @access protected
	 * @param string $content
	 *        	è¾“å‡ºå†…å®¹
	 * @param string $charset
	 *        	æ¨¡æ�¿è¾“å‡ºå­—ç¬¦é›†
	 * @param string $contentType
	 *        	è¾“å‡ºç±»åž‹
	 * @param string $prefix
	 *        	æ¨¡æ�¿ç¼“å­˜å‰�ç¼€
	 * @return mixed
	 */
	protected function show($content, $charset = '', $contentType = '', $prefix = '') {
		$this->view->display ( '', $charset, $contentType, $content, $prefix );
	}
	
	/**
	 * èŽ·å�–è¾“å‡ºé¡µé�¢å†…å®¹
	 * è°ƒç”¨å†…ç½®çš„æ¨¡æ�¿å¼•æ“Žfetchæ–¹æ³•ï¼Œ
	 *
	 * @access protected
	 * @param string $templateFile
	 *        	æŒ‡å®šè¦�è°ƒç”¨çš„æ¨¡æ�¿æ–‡ä»¶
	 *        	é»˜è®¤ä¸ºç©º ç”±ç³»ç»Ÿè‡ªåŠ¨å®šä½�æ¨¡æ�¿æ–‡ä»¶
	 * @param string $content
	 *        	æ¨¡æ�¿è¾“å‡ºå†…å®¹
	 * @param string $prefix
	 *        	æ¨¡æ�¿ç¼“å­˜å‰�ç¼€*
	 * @return string
	 */
	protected function fetch($templateFile = '', $content = '', $prefix = '') {
		return $this->view->fetch ( $templateFile, $content, $prefix );
	}
	
	/**
	 * åˆ›å»ºé�™æ€�é¡µé�¢
	 *
	 * @access protected
	 *         @htmlfile ç”Ÿæˆ�çš„é�™æ€�æ–‡ä»¶å��ç§°
	 *         @htmlpath ç”Ÿæˆ�çš„é�™æ€�æ–‡ä»¶è·¯å¾„
	 * @param string $templateFile
	 *        	æŒ‡å®šè¦�è°ƒç”¨çš„æ¨¡æ�¿æ–‡ä»¶
	 *        	é»˜è®¤ä¸ºç©º ç”±ç³»ç»Ÿè‡ªåŠ¨å®šä½�æ¨¡æ�¿æ–‡ä»¶
	 * @return string
	 */
	protected function buildHtml($htmlfile = '', $htmlpath = '', $templateFile = '') {
		$content = $this->fetch ( $templateFile );
		$htmlpath = ! empty ( $htmlpath ) ? $htmlpath : HTML_PATH;
		$htmlfile = $htmlpath . $htmlfile . C ( 'HTML_FILE_SUFFIX' );
		Storage::put ( $htmlfile, $content, 'html' );
		return $content;
	}
	
	/**
	 * æ¨¡æ�¿ä¸»é¢˜è®¾ç½®
	 *
	 * @access protected
	 * @param string $theme
	 *        	æ¨¡ç‰ˆä¸»é¢˜
	 * @return Action
	 */
	protected function theme($theme) {
		$this->view->theme ( $theme );
		return $this;
	}
	
	/**
	 * æ¨¡æ�¿å�˜é‡�èµ‹å€¼
	 *
	 * @access protected
	 * @param mixed $name
	 *        	è¦�æ˜¾ç¤ºçš„æ¨¡æ�¿å�˜é‡�
	 * @param mixed $value
	 *        	å�˜é‡�çš„å€¼
	 * @return Action
	 */
	protected function assign($name, $value = '') {
		$this->view->assign ( $name, $value );
		return $this;
	}
	public function __set($name, $value) {
		$this->assign ( $name, $value );
	}
	
	/**
	 * å�–å¾—æ¨¡æ�¿æ˜¾ç¤ºå�˜é‡�çš„å€¼
	 *
	 * @access protected
	 * @param string $name
	 *        	æ¨¡æ�¿æ˜¾ç¤ºå�˜é‡�
	 * @return mixed
	 */
	public function get($name = '') {
		return $this->view->get ( $name );
	}
	public function __get($name) {
		return $this->get ( $name );
	}
	
	/**
	 * æ£€æµ‹æ¨¡æ�¿å�˜é‡�çš„å€¼
	 *
	 * @access public
	 * @param string $name
	 *        	å��ç§°
	 * @return boolean
	 */
	public function __isset($name) {
		return $this->get ( $name );
	}
	
	/**
	 * é­”æœ¯æ–¹æ³• æœ‰ä¸�å­˜åœ¨çš„æ“�ä½œçš„æ—¶å€™æ‰§è¡Œ
	 *
	 * @access public
	 * @param string $method
	 *        	æ–¹æ³•å��
	 * @param array $args
	 *        	å�‚æ•°
	 * @return mixed
	 */
	public function __call($method, $args) {
		if (0 === strcasecmp ( $method, ACTION_NAME . C ( 'ACTION_SUFFIX' ) )) {
			if (method_exists ( $this, '_empty' )) {
				// å¦‚æžœå®šä¹‰äº†_emptyæ“�ä½œ åˆ™è°ƒç”¨
				$this->_empty ( $method, $args );
			} elseif (file_exists_case ( $this->view->parseTemplate () )) {
				// æ£€æŸ¥æ˜¯å�¦å­˜åœ¨é»˜è®¤æ¨¡ç‰ˆ å¦‚æžœæœ‰ç›´æŽ¥è¾“å‡ºæ¨¡ç‰ˆ
				$this->display ();
			} else {
				E ( L ( '_ERROR_ACTION_' ) . ':' . ACTION_NAME );
			}
		} else {
			E ( __CLASS__ . ':' . $method . L ( '_METHOD_NOT_EXIST_' ) );
			return;
		}
	}
	
	/**
	 * æ“�ä½œé”™è¯¯è·³è½¬çš„å¿«æ�·æ–¹æ³•
	 *
	 * @access protected
	 * @param string $message
	 *        	é”™è¯¯ä¿¡æ�¯
	 * @param string $jumpUrl
	 *        	é¡µé�¢è·³è½¬åœ°å�€
	 * @param mixed $ajax
	 *        	æ˜¯å�¦ä¸ºAjaxæ–¹å¼� å½“æ•°å­—æ—¶æŒ‡å®šè·³è½¬æ—¶é—´
	 * @return void
	 */
	protected function error($message = '', $jumpUrl = '', $ajax = false) {
		$this->dispatchJump ( $message, 0, $jumpUrl, $ajax );
	}
	
	/**
	 * æ“�ä½œæˆ�åŠŸè·³è½¬çš„å¿«æ�·æ–¹æ³•
	 *
	 * @access protected
	 * @param string $message
	 *        	æ��ç¤ºä¿¡æ�¯
	 * @param string $jumpUrl
	 *        	é¡µé�¢è·³è½¬åœ°å�€
	 * @param mixed $ajax
	 *        	æ˜¯å�¦ä¸ºAjaxæ–¹å¼� å½“æ•°å­—æ—¶æŒ‡å®šè·³è½¬æ—¶é—´
	 * @return void
	 */
	protected function success($message = '', $jumpUrl = '', $ajax = false) {
		$this->dispatchJump ( $message, 1, $jumpUrl, $ajax );
	}
	
	/**
	 * Ajaxæ–¹å¼�è¿”å›žæ•°æ�®åˆ°å®¢æˆ·ç«¯
	 *
	 * @access protected
	 * @param mixed $data
	 *        	è¦�è¿”å›žçš„æ•°æ�®
	 * @param String $type
	 *        	AJAXè¿”å›žæ•°æ�®æ ¼å¼�
	 * @param int $json_option
	 *        	ä¼ é€’ç»™json_encodeçš„optionå�‚æ•°
	 * @return void
	 */
	protected function ajaxReturn($data, $type = '', $json_option = 0) {
		if (empty ( $type ))
			$type = C ( 'DEFAULT_AJAX_RETURN' );
		switch (strtoupper ( $type )) {
			case 'JSON' :
				// è¿”å›žJSONæ•°æ�®æ ¼å¼�åˆ°å®¢æˆ·ç«¯ åŒ…å�«çŠ¶æ€�ä¿¡æ�¯
				header ( 'Content-Type:application/json; charset=utf-8' );
				exit ( json_encode ( $data, $json_option ) );
			case 'XML' :
				// è¿”å›žxmlæ ¼å¼�æ•°æ�®
				header ( 'Content-Type:text/xml; charset=utf-8' );
				exit ( xml_encode ( $data ) );
			case 'JSONP' :
				// è¿”å›žJSONæ•°æ�®æ ¼å¼�åˆ°å®¢æˆ·ç«¯ åŒ…å�«çŠ¶æ€�ä¿¡æ�¯
				header ( 'Content-Type:application/json; charset=utf-8' );
				$handler = isset ( $_GET [C ( 'VAR_JSONP_HANDLER' )] ) ? $_GET [C ( 'VAR_JSONP_HANDLER' )] : C ( 'DEFAULT_JSONP_HANDLER' );
				exit ( $handler . '(' . json_encode ( $data, $json_option ) . ');' );
			case 'EVAL' :
				// è¿”å›žå�¯æ‰§è¡Œçš„jsè„šæœ¬
				header ( 'Content-Type:text/html; charset=utf-8' );
				exit ( $data );
			default :
				// ç”¨äºŽæ‰©å±•å…¶ä»–è¿”å›žæ ¼å¼�æ•°æ�®
				Hook::listen ( 'ajax_return', $data );
		}
	}
	
	/**
	 * Actionè·³è½¬(URLé‡�å®šå�‘ï¼‰ æ”¯æŒ�æŒ‡å®šæ¨¡å�—å’Œå»¶æ—¶è·³è½¬
	 *
	 * @access protected
	 * @param string $url
	 *        	è·³è½¬çš„URLè¡¨è¾¾å¼�
	 * @param array $params
	 *        	å…¶å®ƒURLå�‚æ•°
	 * @param integer $delay
	 *        	å»¶æ—¶è·³è½¬çš„æ—¶é—´ å�•ä½�ä¸ºç§’
	 * @param string $msg
	 *        	è·³è½¬æ��ç¤ºä¿¡æ�¯
	 * @return void
	 */
	protected function redirect($url, $params = array(), $delay = 0, $msg = '') {
		$url = U ( $url, $params );
		redirect ( $url, $delay, $msg );
	}
	
	/**
	 * é»˜è®¤è·³è½¬æ“�ä½œ æ”¯æŒ�é”™è¯¯å¯¼å�‘å’Œæ­£ç¡®è·³è½¬
	 * è°ƒç”¨æ¨¡æ�¿æ˜¾ç¤º é»˜è®¤ä¸ºpublicç›®å½•ä¸‹é�¢çš„successé¡µé�¢
	 * æ��ç¤ºé¡µé�¢ä¸ºå�¯é…�ç½® æ”¯æŒ�æ¨¡æ�¿æ ‡ç­¾
	 *
	 * @param string $message
	 *        	æ��ç¤ºä¿¡æ�¯
	 * @param Boolean $status
	 *        	çŠ¶æ€�
	 * @param string $jumpUrl
	 *        	é¡µé�¢è·³è½¬åœ°å�€
	 * @param mixed $ajax
	 *        	æ˜¯å�¦ä¸ºAjaxæ–¹å¼� å½“æ•°å­—æ—¶æŒ‡å®šè·³è½¬æ—¶é—´
	 * @access private
	 * @return void
	 */
	private function dispatchJump($message, $status = 1, $jumpUrl = '', $ajax = false) {
		if (true === $ajax || IS_AJAX) { // AJAXæ��äº¤
			$data = is_array ( $ajax ) ? $ajax : array ();
			$data ['info'] = $message;
			$data ['status'] = $status;
			$data ['url'] = $jumpUrl;
			$this->ajaxReturn ( $data );
		}
		if (is_int ( $ajax ))
			$this->assign ( 'waitSecond', $ajax );
		if (! empty ( $jumpUrl ))
			$this->assign ( 'jumpUrl', $jumpUrl );
		// æ��ç¤ºæ ‡é¢˜
		$this->assign ( 'msgTitle', $status ? L ( '_OPERATION_SUCCESS_' ) : L ( '_OPERATION_FAIL_' ) );
		// å¦‚æžœè®¾ç½®äº†å…³é—­çª—å�£ï¼Œåˆ™æ��ç¤ºå®Œæ¯•å�Žè‡ªåŠ¨å…³é—­çª—å�£
		if ($this->get ( 'closeWin' ))
			$this->assign ( 'jumpUrl', 'javascript:window.close();' );
		$this->assign ( 'status', $status ); // çŠ¶æ€�
		                                  // ä¿�è¯�è¾“å‡ºä¸�å�—é�™æ€�ç¼“å­˜å½±å“�
		C ( 'HTML_CACHE_ON', false );
		if ($status) { // å�‘é€�æˆ�åŠŸä¿¡æ�¯
			$this->assign ( 'message', $message ); // æ��ç¤ºä¿¡æ�¯
			                                    // æˆ�åŠŸæ“�ä½œå�Žé»˜è®¤å�œç•™1ç§’
			if (! isset ( $this->waitSecond ))
				$this->assign ( 'waitSecond', '1' );
			// é»˜è®¤æ“�ä½œæˆ�åŠŸè‡ªåŠ¨è¿”å›žæ“�ä½œå‰�é¡µé�¢
			if (! isset ( $this->jumpUrl ))
				$this->assign ( "jumpUrl", $_SERVER ["HTTP_REFERER"] );
			$this->display ( C ( 'TMPL_ACTION_SUCCESS' ) );
		} else {
			$this->assign ( 'error', $message ); // æ��ç¤ºä¿¡æ�¯
			                                  // å�‘ç”Ÿé”™è¯¯æ—¶å€™é»˜è®¤å�œç•™3ç§’
			if (! isset ( $this->waitSecond ))
				$this->assign ( 'waitSecond', '3' );
			// é»˜è®¤å�‘ç”Ÿé”™è¯¯çš„è¯�è‡ªåŠ¨è¿”å›žä¸Šé¡µ
			if (! isset ( $this->jumpUrl ))
				$this->assign ( 'jumpUrl', "javascript:history.back(-1);" );
			$this->display ( C ( 'TMPL_ACTION_ERROR' ) );
			// ä¸­æ­¢æ‰§è¡Œ é�¿å…�å‡ºé”™å�Žç»§ç»­æ‰§è¡Œ
			exit ();
		}
	}
	
	/**
	 * æž�æž„æ–¹æ³•
	 *
	 * @access public
	 */
	public function __destruct() {
		// æ‰§è¡Œå�Žç»­æ“�ä½œ
		Hook::listen ( 'action_end' );
	}
}
// è®¾ç½®æŽ§åˆ¶å™¨åˆ«å�� ä¾¿äºŽå�‡çº§
class_alias ( 'Think\Controller', 'Think\Action' );
