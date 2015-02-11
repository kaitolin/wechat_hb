<?php
import('@.Common.Jssdk');

class UserAction extends Action {
	
    public function index() {
    	
    	$value =  'hello,ThinkPHP';
    	//$this->assign('$action',$action);
		$this->assign('uid',$value);
	     $jssdk = new JSSDK(C("wx_appID"),C("wx_appsecret"));
		$signPackage = $jssdk->GetSignPackage(); 
		$this->signPackage = $signPackage;
		
		$this->display('User:game');
    }
    
      public function game() {
      	$this->display();
      }
}