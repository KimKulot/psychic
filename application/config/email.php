<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
$config['protocol'] 	= 'smtp';
$config['smtp_host']	= 'smtp.gmail.com';
$config['smtp_user']	= 'ellentxtapsy@gmail.com';
$config['smtp_pass']	= 'lfyqhcpjdlzocofh';
$config['smtp_port']	= 465;
$config['mailtype']		= 'html';
$config['smtp_crypto'] 	= 'ssl';
$config['_smtp_auth']	= TRUE;
$config['newline']		= "\r\n";
$config['wordwrap']		= TRUE;
$config['charset']		= 'utf-8';
*/

$config['protocol']   = 'sendmail';
$config['mailpath']   = '/usr/sbin/sendmail';
$config['smtp_port']  = 25;
$config['mailtype']   = 'html';
$config['charset']    = 'utf=8';
$config['wordwrap']   = TRUE;
