<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>抢红包</title>
    <link rel="icon" type="image/GIF" href="./res/favicon.ico"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="full-screen" content="yes"/>
    <meta name="screen-orientation" content="portrait"/>
    <meta name="x5-fullscreen" content="true"/>
    <meta name="360-fullscreen" content="true"/>
    <style>
        /*body, canvas, div {
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
            -khtml-user-select: none;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        }*/
    </style>
 <script type="text/javascript">
        var GameSetting = {
                type:1,
            };
            alert(<?php echo ($uid); ?>);
    </script>
    <base href="/weixin_auth/" />
</head>
<body style="padding:0; margin: 0; ">
	<input id="u" type="hidden" value="<?php echo ($bag['bagcode']); ?>" />
<canvas id="gameCanvas" width="800" height="450"></canvas>

<script src="game.min.js"></script>
</body>
</html>