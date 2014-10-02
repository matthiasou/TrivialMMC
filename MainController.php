<?php
error_reporting(E_ALL);
$GLOBALS["siteUrl"]="/trivia/";
?>

<?php
require_once 'technics/log/Logger.php';

DAO::connect("trivia");
$ctrl=new MainController();
$ctrl->run();

function __autoload($myClass){
	if(file_exists("controllers/".$myClass.".php"))
		require_once("controllers/".$myClass.".php");
	else if(file_exists("classes/".$myClass.".php"))
		require_once("classes/".$myClass.".php");
	else if(file_exists("technics/".$myClass.".php"))
		require_once("technics/".$myClass.".php");
}
class MainController{
	private $urlParts;
	
	public function __construct(){
		if(!$this->isValid())
			$this->onInvalidControl();
	}
	
	public function index(){
		
	}
	public function isValid(){
		return true;
	}
	
	/**
	 * 
	 */
	public function onInvalidControl() {
		//header("location:CtrlLogin");
	}

	
	public function run(){
		session_start();
		Logger::init();
		$url=$_GET["c"];
		if(StrUtils::endswith($url, "/"))
			$url=substr($url, 0,strlen($url)-1);
		$this->urlParts=explode("/", $url);
		
		$u=$this->urlParts;
		$urlSize=sizeof($this->urlParts);

		if(class_exists($this->urlParts[0])){
			//Construction de l'instance de la classe (1er élément du tableau)
			try{
				$obj=new $this->urlParts[0]();
				try{
					switch ($urlSize) {
						case 1:
							$obj->index();
						break;
						case 2:
							//Appel de la méthode (2ème élément du tableau)
							$obj->$u[1]();
							break;
						default:
							//Appel de la méthode en lui passant en paramètre le reste du tableau
							$obj->$u[1](array_slice($u, 2));
						break;
					}
				}catch (Exception $e){
					print "Error!: " . $e->getMessage() . "<br/>";
					die();
				}
			}catch (Exception $e){
				print "Error!: " . $e->getMessage() . "<br/>";
				die();
			}

		}else{
			print "Le contrôleur ".$u[0]." n'existe pas <br/>";
		}
	}
}
?>