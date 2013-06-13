<?php
require_once 'class.component.php';

/**
 * Content Handler
 * @package Simple Lightbox
 * @subpackage Content Handlers
 * @author Archetyped
 */
class SLB_Content_Handler extends SLB_Component {
	/* Properties */
	
	/**
	 * Match handler
	 * @var callback
	 */
	protected $match;
	
	/* Matching */
		
	/**
	 * Set matching handler
	 * @param callback $callback Handler callback
	 * @return object Current instance
	 */
	public function set_match($callback) {
		$this->match = ( is_callable($callback) ) ? $callback : null;
		return $this;
	}
	
	/**
	 * Retrieve match handler
	 * @return callback|null Match handler
	 */
	protected function get_match() {
		return $this->match;
	}
	
	/**
	 * Check if valid match set
	 */
	protected function has_match()	{
		return ( is_null($this->match) ) ? false : true;
	}
	
	/**
	 * Match handler against URI
	 * @param string $uri URI to check for match
	 * @return bool TRUE if handler matches URI
	 */
	public function match($uri) {
		$ret = false;
		if ( !!$uri && is_string($uri) && $this->has_match() ) {
			$ret = call_user_func($this->get_match(), $uri);
		}
		return $ret;
	}
}