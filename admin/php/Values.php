<?php


class Values{
	const local_base_url = "http://localhost/blogger/";
	const base_url = "http://varunshrivastava.azurewebsites.net/";
	const admin_home_url = "admin/adminHome.php";
	const admin_login_url = "admin";

	public function getBaseUrl(){
		return self::base_url;
	}
	public function getAdminHomeUrl(){
		return self::base_url.self::admin_home_url;
	}
	public function getLocalAdminHomeUrl(){
		return self::local_base_url . self::admin_home_url;
	}
	public function getLocalAdminLoginUrl(){
		return self::local_base_url . self::admin_login_url;
	}
	public function getAdminLoginUrl(){
		return self::base_url . self::admin_login_url;
	}

}


?>