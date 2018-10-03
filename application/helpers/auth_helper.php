<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Auth {

	public static $errors = [];
	public static $context = null;

	public static function init()
	{
		static::$context =& get_instance();
	}

	public static function login($username, $password)
	{
		static::$errors = [];
		$success = false;
		$is_validated = true;

		if (isset(static::$context->session->userdata['user'])) {
			$success = true;
			return compact('success');
		} else {
			$userdata = null;
			$user_type = 'psychic';
			$usermatches = static::$context->Psychic_model->all([
				'where' => [
					'or_where'	=> [
						'username'			=> $username,
						'email_address'		=> $username
					]
				]
			]);
			if (!count($usermatches)) {
				$user_type = 'member';
				$usermatches = static::$context->Member_model->all([
					'where' => [
						'or_where'	=> [
							'username'	=> $username,
							'email'		=> $username
						]
					]
				]);
			}
			foreach ($usermatches as $user) {
				// echo $user->validated;die;
				$validate = isset($user->validated)? $user->validated : 1;
				if ($validate == 0) {
					$is_validated = false;
					break;
				} else {
					if (password_verify($password, $user->password)) {
						$userdata = $user;
						break;
					}
				}
				
			}

			if (!$userdata) {
				if ($is_validated == false) {
					static::$errors[] = 'Please check your email to activate account';
				} else {
					static::$errors[] = 'Invalid username or password';
				}
				
			} else {
				if ($user_type == 'member') {
					static::$context->session->set_userdata('member_is_logged', json_encode($userdata));
				} else {
					static::$context->session->set_userdata('user', json_encode($userdata));
				}
				
			}
			
		}

		return compact('user_type', 'success');
	}

	public static function is_logged_in()
	{
		return (boolean) static::me();
	}

	public static function me()
	{
		$me_data = array();
		if (isset(static::$context->session->userdata['user'])) {
			
			$userdata = json_decode(static::$context->session->userdata['user']);
			foreach($userdata as $key => $value) {
				if ($key != "password")
					$me_data[$key] = $value;
			}
			return $me_data;
			//return json_decode(static::$context->session->userdata['user']);
		} else if (isset(static::$context->session->userdata['member_is_logged'])) {
			$userdata = json_decode(static::$context->session->userdata['member_is_logged']);
			foreach($userdata as $key => $value) {
				if ($key != "password")
					$me_data[$key] = $value;
			}
			return $me_data;
		}else {
			return null;
		}
	}

	public static function logout()
	{
		static::$context->session->unset_userdata('user', null);
		static::$context->session->unset_userdata('member_is_logged', null);
	}

	public static function hash($password)
	{
		return password_hash($password, PASSWORD_BCRYPT, [
			'cost' => static::$context->config->item('password_cost'),
			'salt' => static::$context->config->item('password_salt')
		]);
	}
}

Auth::init();