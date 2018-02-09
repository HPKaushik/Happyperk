<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Pekeepa API Encryption Class
 */
  class Hash 
  {
  	function encrypt_decrypt($action, $string)
  	{
  		$output = false;
  	
  		$encrypt_method = "AES-256-CBC";
  		$secret_key = 'PETKEEPAAPIKEY';
  		$secret_iv = 'PETKEEPAAPIKEY';
  	
  		// hash
  		$key = hash('sha256', $secret_key);
  	
  		// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
  		$iv = substr(hash('sha256', $secret_iv), 0, 16);
  	
  		if( $action == 'encrypt' ) {
  			$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
  			$output = base64_encode($output);
  		}
  		else if( $action == 'decrypt' ){
  			$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
  		}
  	
  		return $output;
  	}
  	
	//Encrypt Algorithm 
	function doEncrypt($string)
	{
		$key = 'PETKEEPAAPIKEY';
		$iv = mcrypt_create_iv(	mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC),MCRYPT_DEV_URANDOM);
		$encrypted = base64_encode($iv . mcrypt_encrypt(MCRYPT_RIJNDAEL_128,hash('sha256', $key, true),	$string, MCRYPT_MODE_CBC, $iv));
		return $encrypted;
	}
	
	// Decrypt Algorithm
	function doDecrypt($encrypted)
	{
		$key = 'PETKEEPAAPIKEY';
		$data = base64_decode($encrypted);
		$iv = substr($data, 0, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC));
		$decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_128, hash('sha256', $key, true),substr($data, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC)), MCRYPT_MODE_CBC, $iv),"\0");
		return $decrypted;
	}
  }
?>