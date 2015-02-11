<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<title>hello world</title>
		<link href="__PUBLIC__/css/bootstrap.min.css" rel="stylesheet" />
        <script src="__PUBLIC__/js/jquery.min.js"></script>
		<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
		<style>
		.guide  {
		 	background: rgb(0, 0, 0); left: 0px; top: 0px; width: 100%; height: 100%; visibility: hidden; position: fixed; z-index: 1987; opacity: 0.97;
		}
		.guide_img {
				background: url("__PUBLIC__/img/share_tips.png") no-repeat 0% 0% / 200px; right: 50px; top: 35px; width: 200px; height: 225px; position: absolute;
			}
		</style>
		<script type="text/javascript">
			wx.config({
				debug: true,
				appId: 'wx05bea89969772c06',
				timestamp: 1422602643,
				nonceStr: 'VQhYOUJRz6RolHqN',
				signature: 'cd20183bad3d4e52d2c00b9b94da77b72390b506',
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

			function getUrlParam(name) {
				var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
				var r = window.location.search.substr(1).match(reg);
				if (r != null) return unescape(r[2]);
				return null;
			}

		function weixinAddContact(name){
			WeixinJSBridge.invoke("addContact", {webtype: "1",username: name}, function(e) {
					alert(e.err_msg);
				WeixinJSBridge.log(e.err_msg);
				//e.err_msg:add_contact:added 已经添加
				//e.err_msg:add_contact:cancel 取消添加
				//e.err_msg:add_contact:ok 添加成功
				if(e.err_msg == 'add_contact:added' || e.err_msg == 'add_contact:ok'){
				    //关注成功，或者已经关注过
				}
			})
		}
			
	   $(function () {
			$("#btnShare").click(function () {
                $('#guide').css('visibility', 'visible');
            });
 
            $('#guide').click(function () {
                $('#guide').css('visibility', 'hidden');
            });
			var uid = '<?php echo ($uid); ?>';
			var action = getUrlParam('action');
			if (uid != null) {
				alert(uid);

			}
			
<?php
 if(isset($_GET['_URL_'][2])){ echo '$("#divStart").css("display", "none");'; echo '$("#divShare").css("display", "block");'; }else{ echo '$("#divStart").css("display", "block");'; } ?>
//			if(action != null)
//			{
//				 $('#divStart').css('display', 'none');
//				 $('#divShare').css('display', 'block');
//			}
//			else
//			{
//				$('#divStart').css('display', 'block');
//			}
//			
			 $('#btnGame').click(function () {
			 	alert("__URL__/index/action");
<?php
 location.href = "__URL__/index/action"; }); }); </script>
		
	</head>


	<body>
		<div id="divStart" style="display: none;">
			<div class="page-header">
				<h1>Sticky footer</h1>
			</div>
			<p class="lead">Pin a fixed-height footer to the bottom of the viewport in desktop browsers with this custom HTML and CSS.</p>
			<p>Use <a href="../sticky-footer-navbar">the sticky footer with a fixed navbar</a> if need be, too.</p>
			<button id="btnGame" class="btn btn-default"  type="button">选择红包跳转</button>
		</div>
		<div id="divShare" style="display: none;">
			<div class="page-header">
				<h1>恭喜获得红包</h1>
			</div>
			<p class="lead"></p>
			<button id="btnShare" class="btn btn-danger" type="button">分享</button>
		</div>
		<div id="guide" class="guide">
		<div class="guide_img"></div>
		</div>
			
	
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="__PUBLIC__/js/bootstrap.min.js"></script>
	</body>

</html>