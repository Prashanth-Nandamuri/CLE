<?php 
include '../connection.php';
if($_SESSION['user_level'] == 6 || $_SESSION['user_level'] == 1)
	include '../header1.php';
else
	include '../header.php';

echo '<!doctype html>
<html>
<head>
    <title>FlexPaper</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="initial-scale=1,user-scalable=no,maximum-scale=1,width=device-width" />
    <style type="text/css" media="screen">
        html, body	{ height:100%; }
        body { margin:0; padding:0; overflow:auto; }
        #flashContent { display:none; }
    </style>

    <link rel="stylesheet" type="text/css" href="css/flexpaper.css" />
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/flexpaper.js"></script>
    <script type="text/javascript" src="js/flexpaper_handlers.js"></script>
</head>
<body>
<div style="position:relative;left:15%;top:20%;">
<div id="documentViewer" class="flexpaper_viewer" style="width:770px;height:500px"></div>';


		echo "<script type='text/javascript'>
    		function getDocumentUrl(document){
        return 'php/services/view.php?doc={doc}&format={format}&page={page}'.replace('{doc}',document);
    		}

    var startDocument = 'Paper';

    $('#documentViewer').FlexPaperViewer(
            { config : {

                SWFFile : 'docs/$_GET[name].swf',

                Scale : 0.6,
                ZoomTransition : 'easeOut',
                ZoomTime : 0.5,
                ZoomInterval : 0.2,
                FitPageOnLoad : true,
                FitWidthOnLoad : false,
                FullScreenAsMaxWindow : false,
                ProgressiveLoading : false,
                MinZoomSize : 0.2,
                MaxZoomSize : 5,
                SearchMatchAll : false,
                InitViewMode : 'Portrait',
                RenderingOrder : 'flash',
                StartAtPage : '',

                ViewModeToolsVisible : true,
                ZoomToolsVisible : true,
                NavToolsVisible : true,
                CursorToolsVisible : true,
                SearchToolsVisible : true,
                WMode : 'window',
                localeChain: 'en_US'
            }}
    );
</script>";


echo '</body>
</html>';
include '../footer.php';
?>




