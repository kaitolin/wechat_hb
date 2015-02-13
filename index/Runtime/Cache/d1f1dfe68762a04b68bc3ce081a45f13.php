<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>114家抢红包</title>
<link href="__PUBLIC__/css/bootstrap.min.css" rel="stylesheet" />
<script src="__PUBLIC__/js/jquery.min.js"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<style>
	.guide  {
	 	background: rgb(0, 0, 0); left: 0px; top: 0px; width: 100%; height: 100%; visibility: hidden; position: fixed; z-index: 1987; opacity: 0.87;
	}
	.guide_img {
			background: url("__PUBLIC__/img/share_tips.png") no-repeat 0% 0% / 200px; right: 50px; top: 35px; width: 200px; height: 225px; position: absolute;
		}
</style>
<script type="text/javascript">
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
			    wx.onMenuShareTimeline({
					      title: '114家抢红包',
					      desc: '114家抢红包,精彩等你来抢!',
					      link: '<?php echo ($signPackage["url"]); ?>',
					      imgUrl: '<?php echo ($url); ?>__PUBLIC__/img/logo.jpg',
					      success: function (res) {
					        //alert('已分享');
					      },
					      cancel: function (res) {
					        //alert('已取消');
					      },
					      fail: function (res) {
					        //alert(JSON.stringify(res));
					      }
					    });
					 
				wx.onMenuShareAppMessage({
					      title: '114家抢红包',
					      desc: '114家抢红包,精彩等你来抢!',
					      link: '<?php echo ($signPackage["url"]); ?>',
					      imgUrl: '<?php echo ($url); ?>__PUBLIC__/img/logo.jpg',
					      success: function (res) {
					        //alert('已分享');
					      },
					      cancel: function (res) {
					        //alert('已取消');
					      },
					      fail: function (res) {
					        //alert(JSON.stringify(res));
					      }
					    });
			});
			wx.error(function (res) {
			  //alert(res.errMsg);
			});
	});
</script>
		<script type="text/javascript">
	   $(function () {
			 $('#btnUrl').click(function () {
			 	//location.href = "__URL__/index";
			 	alert('调用接口');
            });
             $('#btnMore').click(function () {
			 	location.href = "__URL__/index";
            });
            
            $('#btnChai').click(function () {
		            $.post("__URL__/ajaxView",
		            	<?php
 echo '{bagid:"'.$bag['bagcode'].'"}'; ?>
		            ,function(d){
		            	var data =JSON.parse(d);
		            	if(data.result)
		            	{
		            		$('#btnChai').css('display', 'none');
		            		$('#divMsg').html(data.msg);
		            		$('#imgbg').attr("src","__PUBLIC__/img/result-bg.png");
		            	}
   				 });
            });
        
            $("#btnShare").click(function () {
				$('#guide').css('visibility', 'visible');
            });
 
            $('#guide').click(function () {
                $('#guide').css('visibility', 'hidden');
            });
            
		 });
		</script>
		<style>
			#start {
				position: absolute;
				bottom: 10%;
				padding: 0px;
				margin-left: -100px;
				text-align: center;
				width: 200px;
				left: 50%;
			}
			#head {
				padding: 0px;
				margin-top: 35%;
			}
			#head h2{
			color:#CC0000;
			font-family: "verdana, geneva, arial, helvetica, sans-serif";
			}
			#head p{
			color:#AD6704;
			font-family: "verdana, geneva, arial, helvetica, sans-serif";
			}
		</style>
	</head>


	<body class="container-fluid">
		<div style="display: none;">
			<img src="__Public__/img/logo.jpg" />
		</div>
		<div id="background" style="position:absolute;z-index:-1;width:100%;height:100%;top:0px;left:0px;">
				<img id="imgbg" src="__PUBLIC__/img/grap-bg.png" width="100%" />
		</div>
		<div id="head" >
			<div class="row-fluid">
				<div class="span1">
				</div>
				<div class="span10">
					<p id='divMsg'>
					<?php echo ($msg); ?>
					</p>
				</div>
				<div class="span1">
				</div>
			</div>
		</div>
		<div id="start">	
				
	<?php  if($bag['utype'] == 2) { if($bag['canDui'] == TRUE) { ?>	
				<script type="text/javascript">
	   $(function () {
	   		$('#imgbg').attr("src","__PUBLIC__/img/result-bg.png");
	   });
	  </script>
					<button id="btnUrl" class="btn btn-default"  type="button">点击兑换</button>
			<br>
	<?php
 } ?>	
			<button id="btnShare" class="btn btn-danger" type="button">分享给更多好友</button>
		<br>
			<button id="btnMore" class="btn btn-default"  type="button">抢更多红包</button>
		
	<?php
 } else if($bag['utype'] == 1) { if($bag['canChai'] == TRUE) { ?>	
		
			<button id="btnChai" class="btn btn-default"  type="button">帮他拆开</button>
		<br>
				
	<?php
 } ?>		
			<button id="btnMore" class="btn btn-default"  type="button">我也要领取一个</button>
		
	<?php
 } ?>	
	</div>
		<div id="guide" class="guide">
		<div class="guide_img"></div>
		</div>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="__PUBLIC__/js/bootstrap.min.js"></script>
	</body>

</html>