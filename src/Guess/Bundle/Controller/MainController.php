<?php 
namespace Guess\Bundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller {
	
	public function indexAction() {
		
		return $this->render('GuessBundle:templates:layout.html.php', array('page' => 'homepage'));
		
	}
	
	public function playAction($arg1 = '', $args2 = '') {
		
		return $this->render('GuessBundle:templates:layout.html.php', array('page' => 'play'));
		
	}
	
	public function myScoreAction() {
		
		return $this->render('GuessBundle:templates:layout.html.php', array('page' => 'score'));
		
	}
	
	public function top10Action() {
		
		return $this->render('GuessBundle:templates:layout.html.php', array('page' => 'top10'));
		
	}
	
	public function howtoAction() {
		
		return $this->render('GuessBundle:templates:layout.html.php', array('page' => 'howto'));
		
	}
	
}


?>