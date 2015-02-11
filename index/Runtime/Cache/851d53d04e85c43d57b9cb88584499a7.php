<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<title>抢红包</title>
		<link href="__PUBLIC__/css/bootstrap.min.css" rel="stylesheet" />
        <script src="__PUBLIC__/js/jquery.min.js"></script>
		<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
		<script type="text/javascript">
			wx.config({
				debug: false,
				appId: '<?php echo ($signPackage["appId"]); ?>',
				timestamp: <?php echo ($signPackage["timestamp"]); ?>,
				nonceStr: '<?php echo ($signPackage["nonceStr"]); ?>',
				signature: '<?php echo ($signPackage["signature"]); ?>',
				jsApiList: [
					'checkJsApi',
					'onMenuShareTimeline',
					'onMenuShareAppMessage',
					'onMenuShareQQ',
					'onMenuShareWeibo',
					'hideMenuItems',
					'showMenuItems',
					'hideAllNonBaseMenuItem',
					'showAllNonBaseMenuItem',
					'translateVoice',
					'startRecord',
					'stopRecord',
					'onRecordEnd',
					'playVoice',
					'pauseVoice',
					'stopVoice',
					'uploadVoice',
					'downloadVoice',
					'chooseImage',
					'previewImage',
					'uploadImage',
					'downloadImage',
					'getNetworkType',
					'openLocation',
					'getLocation',
					'hideOptionMenu',
					'showOptionMenu',
					'closeWindow',
					'scanQRCode',
					'chooseWXPay',
					'openProductSpecificView',
					'addCard',
					'chooseCard',
					'openCard'
				]
			});
			wx.ready(function () {
//			    wx.checkJsApi({
//			      jsApiList: [
//			         'onMenuShareTimeline',
//			      ],
//			      success: function (res) {
//			        alert(JSON.stringify(res));
//			      }
//			    });
			  //wx.hideOptionMenu();
			});
			wx.error(function (res) {
			  //alert(res.errMsg);
			}); 
	   $(function () {
			
			function post(URL, PARAMS) {        
			    var temp = document.createElement("form");        
			    temp.action = URL;        
			    temp.method = "post";        
			    temp.style.display = "none";        
			    for (var x in PARAMS) {        
			        var opt = document.createElement("textarea");        
			        opt.name = x;        
			        opt.value = PARAMS[x];        
			        // alert(opt.name)        
			        temp.appendChild(opt);        
			    }        
			    document.body.appendChild(temp);        
			    temp.submit();        
			    return temp;        
			}   

			 $('#btnGame').click(function () {
			 	//location.href = "__URL__/game";
			 	post('__URL__/index', {action :'game',cm1:'test'});
            });
             $('#btnView').click(function () {
			 	location.href = "__URL__/view";
            });
            $('#btnOpen').click(function () {
			 	$("#hongbao").css("display", "block");
			 	$("#btnOpen").css("display", "none");
			 	$("#btnGame").css("display", "block");
            });
		 });
		</script>
		<style type="text/css">
			
			.bg{background:url("__PUBLIC__/img/grap-bg.png") no-repeat center fixed;background-size:contain}
		</style>
	</head>


	<body >
		<div id="divStart"  >
			<div class="page-header">
				<h1>红包</h1>
				<!--<h1>
					<div style="width: 30%;">
						<img src="<?php echo ($user["headimgurl"]); ?>" class="img-circle" />
					</div>
				</h1>-->
				<?php
 if(isset($oldUser)) { if($oldUser['bagCount'] <3) echo '帮 '.$oldUser['nickname'].' 拆开红包,已经有'.$oldUser['bagCount'].'个拆开!'; else echo '已经拆开了哦!'; } if(isset($bag['id'])) { echo '你已经领取过红包了!'; } else { echo '我也要领取一个!'; } ?>
			</div>
			<?php
 if(isset($bag['id'])) { ?>
			 
					<div>
						
						你已经领取过 <?php echo ($bag["bagtitle"]); ?>元红包,继续游戏分享红包或查看红包!
					</div>
					<button id="btnGame" class="btn btn-default"  type="button">开始游戏</button>
					<button id="btnView" class="btn btn-default"  type="button">查看红包</button>
			 <?php
 } else { ?>
					<div id="hongbao" style="display: none;">
						恭喜获得 <?php echo ($bag["bagtitle"]); ?>元红包,完成游戏得到红包!
					</div>
					<button id="btnOpen" class="btn btn-default "  type="button" >打开红包</button>
					<button id="btnGame" style="display: none;" class="btn btn-default "  type="button" >开始游戏</button>
			<?php
 } ?>
			
		</div>

		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="__PUBLIC__/js/bootstrap.min.js"></script>
	</body>

</html>