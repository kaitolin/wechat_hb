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
			 	post('__URL__/index/u/<?php echo ($bag['bagcode']); ?>', {action :'get'});
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
				<h1>玩游戏得红包</h1>
				<button id="btnGame" class="btn btn-default"  type="button">开始游戏</button>
			</div>
			
		</div>

		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="__PUBLIC__/js/bootstrap.min.js"></script>
	</body>

</html>