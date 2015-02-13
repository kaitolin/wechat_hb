<?php
import('@.Common.Jssdk');

class IndexAction extends AuthAction {
    public function _initialize() {
        //initialize
        parent::_initialize();
    }
 
    public function index(){
        header("Content-Type: text/html; charset=UTF-8");
        header("Cache-Control: no-cache");
		header("expires: -1");
		header("pragma: no-cache;");
// 		$_SESSION["openid"] = 'aaa';
//		$user["nickname"] ="test";
//		session('user',$user);
		
		$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    	$url = "$protocol$_SERVER[HTTP_HOST]";
		$this->url = $url;
		
		$this->assign('uid',$_SESSION["openid"]);
		$this->user = $_SESSION["user"];
		$jssdk = new JSSDK(C("wx_appID"),C("wx_appsecret"));
		$signPackage = $jssdk->GetSignPackage(); 
		$this->signPackage = $signPackage;
		
		if(isset($_POST['action']) && $_POST['action'] == "game")
		{
			$this->bag =$_SESSION["bag"];
			$this->display("Index:game");
			
		}
		else if(isset($_POST['action']) &&$_POST['action'] == "get")
		{
			//当前用户是不是有记录
			$currentUser = $this->getUser($_SESSION["openid"]);
			if(!isset($currentUser))
			{
				$this->addUser();
			}
			//获取当前Bag状态
			//$userBag=$this->getUserBag($_SESSION["openid"]);
			if(isset($_SESSION["bag"]) && isset($_SESSION["user"]))
			{
				$this->addUserBag($_SESSION["bag"]);
				$this->bag =$_SESSION["bag"];
				$this->display("Index:get");
			}
			else
			{
				//显示默认页
				$bag = $this->getRandomBagType();
				$_SESSION["bag"] = $bag; //设置得到的bag的Session
				$this->bag =$_SESSION["bag"];
				$this->display();
			}
		}
		else 
		{
			$par = $_GET['_URL_'][2];   //u
			$get_bagid = $_GET['_URL_'][3];   //openid
			
			if(isset($par) && isset($get_bagid))
			{
				$oldBag = $this->getUserByBagId($get_bagid);
			
				if(isset($oldBag))
				{
				   $oldBag['bagCount'] = $this->getUserBagCount($get_bagid);
				
				   if(isset($_SESSION["openid"]) && $_SESSION["openid"] != $oldBag["openid"])
					{
						$oldBag['utype'] = 1;
						
						//其它用户
						if($oldBag['bagCount'] <3)
						{
							$count = 3 - $oldBag['bagCount'];
				   	  	    $msg = '帮'.$oldBag['nickname'].'拆开'.$oldBag['bagtitle'].'元红包,已经被拆'.$oldBag['bagCount'].'次,还差'.$count.'次就可以拆开了!';
				   		
				   		
				   			$has = $this->hasUserView($_SESSION["openid"], $oldBag);
							if($has == TRUE)
							{
								$msg = $msg."<br>你已经拆过了!"; 
								$oldBag['canChai'] = FALSE;
							}
							else
							{
								$oldBag['canChai'] = TRUE;
							}
						}
						else
						{
							 $msg = $oldBag['nickname'].'的'.$oldBag['bagtitle'].'元红包已被拆开!';
							 $oldBag['canChai'] = FALSE;
						}
					}
				   else
				   {
				   		$oldBag['utype'] = 2;
						$oldBag['canChai'] = FALSE;
				   	  	//当前用户
				   	  	if($oldBag['bagCount'] <3)
						{
							$count = 3 - $oldBag['bagCount'];
				   	  	    $msg = $oldBag['bagtitle'].'元红包已经被拆'.$oldBag['bagCount'].'次,还差'.$count.'次就可以拆开了!';
				   		}
						else
						{
							 $msg = $oldBag['bagtitle'].'元红包已被拆开!';
							 $oldBag['canDui'] = TRUE;
						}
				   }
				    $this->msg =$msg ;
				    $this->chaiMsg =$chaiMsg ;
				    
				   	$this->bag =$oldBag;
				   	$this->display("Index:view");
				}
				else
				{
					//显示默认页
					$bag = $this->getRandomBagType();
					$_SESSION["bag"] = $bag; //设置得到的bag的Session
					$this->bag =$_SESSION["bag"];
					$this->display();
				}
			}
			else //显示默认页
			{
				$bag = $this->getRandomBagType();
				$_SESSION["bag"] = $bag; //设置得到的bag的Session
				$this->bag =$_SESSION["bag"];
				$this->display();
			}
		}
    }
	public function ajaxView()
	{
		$arr->result = FALSE;
		if(isset($_POST['bagid']) )
		{
			$bagid =  $_POST['bagid'];
			//添加访问记录
			$oldBag = $this->getUserByBagId($bagid);
			if(isset($_SESSION["openid"]) && $_SESSION["openid"] != $oldBag["openid"])
			{
				
				$this->addUserView($_SESSION["openid"],$oldBag);
				$oldBag['bagCount'] = $this->getUserBagCount($bagid);
				$arr->result =TRUE;
				$arr->msg = $oldBag['nickname'].'谢谢你帮他拆红包!';
				$arr->count = $oldBag['bagCount'];
				
			}
		}
		$this->ajaxReturn (json_encode($arr),'JSON');
	}
	
	public function view()
	{
		$this->redirect("Index/index",'',0,"请先获取红包");
	}

     private function view2(){
     	 header("Content-Type: text/html; charset=UTF-8");
   		$this->assign('uid',$_SESSION["openid"]);
		
		$jssdk = new JSSDK(C("wx_appID"),C("wx_appsecret"));
		$signPackage = $jssdk->GetSignPackage(); 
		$this->signPackage = $signPackage;
		
		$userBag=$this->getUserBag($_SESSION["openid"]);
		if(isset($userBag))
		{
			$userBag["bagCount"]= $this->getUserBagCount($_SESSION["openid"]);
			
			if($userBag["bagCount"] >=2 && $userBag["isfinish"] == 0)
				$userBag["canExchange"]= TRUE;
			else
				$userBag["canExchange"]= FALSE;
			
			$this->userBag = $userBag;
			
		}
		
			//$this->redirect("Index/index",'',0,"请先获取红包");
		$this->display();
    } 

	private function addUser(){
   		$User = M('user');
		$User->create(); //创建User数据对象
		$User->openid=$_SESSION["openid"];
		$User->nickname = $_SESSION["user"]["nickname"];
		$User->sex = $_SESSION["user"]["sex"];
		$User->subscribe = $_SESSION["user"]["subscribe"];
		$User->language  = $_SESSION["user"]["language"];
		$User->city = $_SESSION["user"]["city"];
		$User->province = $_SESSION["user"]["province"];
		$User->country = $_SESSION["user"]["country"];
		$User->headimgurl   = $_SESSION["user"]["headimgurl"];
		$User->subscribe_time = $_SESSION["user"]["subscribe_time"];
		$User->viewtime = time(); // 设置用户的创建时间
		$User->add(); // 把用户对象写入数据库
    } 

	private function getUser($openid){
   		$User = M('user');
		$con['openid'] = $openid;
		$Data=$User->where($con)->find();
	    return $Data;
    } 
	
	private function getUserBag($openid){
   		$User = M('user_bag');
		$con['openid'] = $openid;
		//$con['isfinish'] = 0;
		$result=$User->where($con)->find();
	    return $result;
    } 

	private function getUserBagCount($bagid){
		$View = M('user_view');
		$c['bagid'] = $bagid;
		$list = $View->where($c)->select();
	   return count($list);
    } 
	
	private function addUserBag($bag){
   		$Bag = M('user_bag');
		$Bag->create(); //创建User数据对象
		$Bag->bagid = $bag["bagcode"];
	    $Bag->openid=$_SESSION["openid"];
		$Bag->nickname = $_SESSION["user"]["nickname"];
		$Bag->bagtitle = $bag["bagtitle"];
		$Bag->bagtype = $bag["bagtype"];
		$Bag->bagcode = $bag["bagcode"];
		$Bag->ctime = time();
		$Bag->add();
    } 
	
	private function addUserView($openid,$userBag){
   		$View = M('user_view');
		$con['openid'] = $userBag["openid"];
		$con['view_openid'] = $openid;
		$con['bagid'] = $userBag["bagid"];
		$result=$View->where($con)->find();
		if($result == FALSE)
		{
			$View = M('user_view');
			$View->create(); 
			$View->bagid = $userBag["bagid"];
			$View->openid = $userBag["openid"];
			$View->view_openid= $openid;
			$View->ctime = time();
			$r = $View->add();
		}
    } 
	
	private function hasUserView($openid,$userBag){
   		$View = M('user_view');
		$con['openid'] = $userBag["openid"];
		$con['view_openid'] = $openid;
		$con['bagid'] = $userBag["bagid"];
		$result=$View->where($con)->find();
		return $result;
    } 
	
	private function getUserByBagId($bagid){
		
		$User = M('user_bag');
		$con['bagid'] = $bagid;
		//$con['isfinish'] = 0;
		$result=$User->where($con)->find();
	    return $result;
	}
	
	private function getRandomBagType(){
		
		$prize_arr =array('a'=>67,'b'=>66,'c'=>66,"d"=>1);
		$r = $this->get_rand($prize_arr);
		if($r==a)
		{
			$bag["bagtype"] =1;
			$bag["bagtitle"] =10;
		}
		else if($r==b)
		{
			$bag["bagtype"] =2;
			$bag["bagtitle"] =15;
		}else if($r==c)
		{
			$bag["bagtype"] =3;
			$bag["bagtitle"] =20;
		}
		else
		{
			$bag["bagtype"] =3;
			$bag["bagtitle"] =20;
		}
	
		$bag["bagcode"]= $this->create_guid_lite();
		//dump($bag);
	    return $bag;
    } 
	private function create_guid() {
	    $charid = strtoupper(md5(uniqid(mt_rand(), true)));
	    $hyphen = chr(45);// "-"
	    $uuid = chr(123)// "{"
	    .substr($charid, 0, 8).$hyphen
	    .substr($charid, 8, 4).$hyphen
	    .substr($charid,12, 4).$hyphen
	    .substr($charid,16, 4).$hyphen
	    .substr($charid,20,12)
	    .chr(125);// "}"
	    return $uuid;
	}
	private function create_guid_lite() {
	    $charid = strtoupper(md5(uniqid(mt_rand(), true)));
	    $uuid =substr($charid, 0, 8)
	    .substr($charid, 8, 4)
	    .substr($charid,12, 4)
	    .substr($charid,16, 4)
	    .substr($charid,20,12);//
	    return $uuid;
	}
	
		/* 
	 * 经典的概率算法， 
	 * $proArr是一个预先设置的数组， 
	 * 假设数组为：array(100,200,300，400)， 
	 * 开始是从1,1000 这个概率范围内筛选第一个数是否在他的出现概率范围之内，  
	 * 如果不在，则将概率空间，也就是k的值减去刚刚的那个数字的概率空间， 
	 * 在本例当中就是减去100，也就是说第二个数是在1，900这个范围内筛选的。 
	 * 这样 筛选到最终，总会有一个数满足要求。 
	 * 就相当于去一个箱子里摸东西， 
	 * 第一个不是，第二个不是，第三个还不是，那最后一个一定是。 
	 * 这个算法简单，而且效率非常 高， 
	 * 关键是这个算法已在我们以前的项目中有应用，尤其是大数据量的项目中效率非常棒。 
	 */  
	private function get_rand($proArr) {   
	    $result = '';    
	    //概率数组的总概率精度   
	    $proSum = array_sum($proArr);    
	    //概率数组循环   
	    foreach ($proArr as $key => $proCur) {   
	        $randNum = mt_rand(1, $proSum);   
	        if ($randNum <= $proCur) {   
	            $result = $key;   
	            break;   
	        } else {   
	            $proSum -= $proCur;   
	        }         
	    }   
	    unset ($proArr);    
	    return $result;   
	} 
}
