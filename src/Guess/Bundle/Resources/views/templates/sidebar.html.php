<h2><span>Top 10 Scores and player</span></h2>
<div id="top10header1">
	<span>1D-Top 10 Scorer</span>
</div>
<div id="one-d">
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
<div id="top10header2">
	<span>2D-Top 10 Scorer</span>
</div>
<div id="two-d">
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
<div id="top10header3">
	<span>3D-Top 10 Scorer</span>
</div>
<div id="three-d">
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
