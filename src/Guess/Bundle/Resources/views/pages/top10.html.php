<?php $view->extend('::base.html.php') ?>
<?php $view['slots'] -> set('title', 'Guess game')?>
<?php 
$view['slots']->start('menu');
echo $view->render('::header.html.php', array('page' => $page));
$view['slots']->stop();
?>
<div id="content-home">
<h2>Top 10 Scores and Players</h2>
<p>Following are the list of Top 10 players and his socres in different game</p>
</div>
<div id="play-1d">
<h2>1 Dimention Top 10</h2>
<ul id="toplist">
	<?php $top1d = $top10['d_1']; 
	if(count($top1d)>0) {
		foreach($top1d as $topd1) {
			echo "<li> <span><strong><font color='green'>".$topd1->getPlayer()->getName().
				 "</font> : <font color='#FF4000'>".$topd1->getScore()."</font></strong></span>";
			echo "<span style='margin:0; padding:0; float:right; margin-right:10px'>".$topd1->getDate()."</span></li>";
		} 
	}
	?>
</ul>
</div>
<div id="play-2d">
<h2>2 Dimention top 10</h2>
<ul id="toplist">
	<?php $top2d = $top10['d_2']; 
	if(count($top2d)>0) {
		foreach($top2d as $topd2) {
			echo "<li> <span><strong><font color='green'>".$topd2->getPlayer()->getName().
				 "</font> : <font color='#FF4000'>".$topd2->getScore()."</font></strong></span>";
			echo "<span style='margin:0; padding:0; float:right; margin-right:10px'>".$topd2->getDate()."</span></li>";
		}
	}
	?>
</ul>
</div>
<div id="play-3d">
<h2>3 Dimention top 10</h2>
<ul id="toplist">
	<?php $top3d = $top10['d_3']; 
	if(count($top3d)>0) {
		foreach($top3d as $topd3) {
			echo "<li> <span><strong><font color='green'>".$topd3->getPlayer()->getName().
				 "</font> : <font color='#FF4000'>".$topd3->getScore()."</font></strong></span>";
			echo "<span style='margin:0; padding:0; float:right; margin-right:10px'>".$topd3->getDate()."</span></li>";
		}
	}
	?>
</ul>
</div>