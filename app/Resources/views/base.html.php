<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title><?php $view['slots']->output('title', 'Guess Game') ?></title>

<link href="<?php echo $view['assets']->getUrl('bundles/guess/images/guess.png') ?>" rel="shortcut icon" />
<link rel="stylesheet" href="<?php echo $view['assets']->getUrl('bundles/guess/css/styles.css') ?>" />

<link rel="stylesheet" href="<?php echo $view['assets']->getUrl('bundles/guess/css/content.css') ?>" />
<script src="<?php echo $view['assets']->getUrl('bundles/guess/js/jQuery.js') ?>" type="text/javascript"></script>
<script type="text/javascript" >
$(document).ready(function() {
    setHeight('#sidebar', '#content');
    $("#top10header1").click(function(){
  	  $("#one-d").toggle();
  	});
    $("#top10header2").click(function(){
    	  $("#two-d").toggle();
    });
    $("#top10header3").click(function(){
    	  $("#three-d").toggle();
    });
});

var maxHeight = 0;
function setHeight(sidebar, content) {
    column1 = $(sidebar);
    column2 = $(content);
    maxHeight = column1.height();
    if(column2.height() > maxHeight) {
       maxHeight = column2.height();
    }
    //Set the height
    column1.height(maxHeight);
    column2.height(maxHeight);
}

</script>
</head>
<body>
<!-- Main div for all element -->
<div id="main" >
<!-- Div for header -->
<div id="header">
<?php $view['slots'] -> output('menu')?>
</div>
<!-- Div for content -->
<div id="content">
<?php $view['slots']->output('_content') ?>
</div>
<!-- Div for content -->
<div id="sidebar">
<?php  echo $view['actions']->render('GuessBundle:DB:getTop10'); ?>
</div>
<!-- Div for footer -->
<div id="footer">
<p>All Right reserved with Group 01</p>
</div>
</div>

</body>
</html>
