<?php 
namespace Guess\Bundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller {
	
	public function indexAction() {
		
		return $this->render('GuessBundle:templates:layout.html.twig');
		
	}
}


?>