<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<title>查看红包</title>
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
<?php
 if(isset($_POST['action'])){ echo '$("#divStart").css("display", "none");'; echo '$("#divShare").css("display", "block");'; }else{ echo '$("#divStart").css("display", "block");'; } ?>	
			 $('#btnGame').click(function () {
			 	//location.href = "__URL__/index";
			 	alert('调用接口');
            });
		 });
		</script>
		
	</head>


	<body>
		<div id="divStart">
			<div class="page-header">
				<h1>查看红包</h1>
			</div>
			<p class="lead">这是红包查看界面 openId:<?php echo ($uid); ?></p>
			<button id="btnGame" class="btn btn-default"  type="button">查看</button>
		</div>
		
	
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="__PUBLIC__/js/bootstrap.min.js"></script>
	</body>

</html>