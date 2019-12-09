<?php

namespace Sugar\Auth\Service;


class Session extends \Sugar\Component implements AuthServiceInterface {

	/**
	 * SESSION key prefix
	 * @var string
	 */
	protected $prefix;

	/** @var \Base $f3 */
	protected $fw;

	/**
	 * @var mixed
	 */
	protected $auth_value;

	function __construct($prefix='') {
		$this->setPrefix($prefix);
		$this->fw = \Base::instance();
	}

	/**
	 * set session auth prefix key
	 * @param $prefix
	 */
	function setPrefix($prefix) {
		$this->prefix=!empty($prefix)?'.'.$prefix:'';
	}

	/**
	 * check if a user is logged in
	 * @return bool
	 */
	function isAuthenticated() {
		if ($this->fw->exists('SESSION'.$this->prefix.'.authenticated',$value)) {
			$this->auth_value = $value;
			return TRUE;
		}
		return FALSE;
	}

	/**
	 * get authentication value, user or entity data
	 * @return mixed
	 */
	function getAuthValue() {
		return $this->auth_value ?: false;
	}

	/**
	 * authenticated as a specific user/entity
	 * @param $auth_value
	 */
	function loginAs($auth_value) {
		$this->fw->set('SESSION'.$this->prefix.'.authenticated',$auth_value);
		$this->auth_value = $auth_value;
	}

	/**
	 * remove authentication flag
	 */
	function logout() {
		$this->fw->clear('SESSION'.$this->prefix);
	}
}