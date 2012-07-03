<div id="menu">
	<ul>
		<li class="<?php echo ($page == 'homepage' ? 'selected' : '') ?>">
		<a href="<?php echo $view['router']->generate('_homepage') ?>">
        Home page
        </a>
        </li>
		<li class="<?php echo ($page == 'play' ? 'selected' : '') ?>">
		<a href="<?php echo $view['router']->generate('_play') ?>">
        Play Game
        </a>
		</li>
		<li class="<?php echo ($page == 'score' ? 'selected' : '') ?>">
		<a href="<?php echo $view['router']->generate('_score') ?>">
		Your score
		</a>
		</li>
		<li class="<?php echo ($page == 'top10' ? 'selected' : '') ?>">
		<a href="<?php echo $view['router']->generate('_top10') ?>">
		Top 10 score
		</a></li>
		<li class="<?php echo ($page == 'howto' ? 'selected' : 'last') ?>">
		<a href="<?php echo $view['router']->generate('_howtoplay') ?>">
		How to play
		</a></li>
	</ul>
</div>
<div id="logo">
	<div style="float:left; padding-left: 10px;">
	<img src="<?php echo $view['assets'] -> getUrl('bundles/guess/images/guesslogo.png') ?>" 
	align="right" height="100px" width="80" alt="Guess Game">
	</div>
	<div style="float:left"> 
	<h1><a href="#">Number Guess Game</a></h1>
	<h2 style="color: white;"> Exmine your thinking, play the game right now</h2>
	</div>
</div>
