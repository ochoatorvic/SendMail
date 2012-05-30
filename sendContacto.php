<?
/*
 * Autor: Victor Hugo Ochoa Flores
 * Año: 2009
 */
include_once 'system/common.php';

include_once 'sendMail/sendMail.php';
include_once 'sendMail/captcha/securimage/securimage.php';
$securimage = new Securimage();

/*
 * VALORES FUNCIONALIDAD
 */
$CMD 					= 'send';
$VARIABLE_POST 			= "entity";
$ENVIAR_POR_SMTP 		= true;
$ENVIAR_EMAIL_A_USUARIO = false;
$TEST 					= true;
$EMAIL_TEST 			= 'victor@vicomstudio.com';


/*
 * FORMULARIO
 */
$fields[] = array("name" =>"Nombre",		"type" => "string", "required" => true);
$fields[] = array("name" =>"Telefono",		"type" => "phone", 	"required" => true);
$fields[] = array("name" =>"E-Mail", 		"type" => "email", 	"required" => true);
$fields[] = array("name" =>"Estado", 		"type" => "string", "required" => true);
$fields[] = array("name" =>"Ciudad", 		"type" => "string", "required" => true);
$fields[] = array("name" =>"Comentarios", 	"type" => "string", "required" => true);


/*
 * MENSAJES VALIDACION
 */
$messages['ok'] 		= "La información se envió correctamente.";
$messages['empty'] 		= "El campo <b>{field}</b> no debe estar vacío.";
$messages['incorrect'] 	= "El campo <b>{field}</b> debe ser un valor válido.";
$messages['outlimit'] 	= "Field <b>{field}</b> should be a value between {min} and {max}";
$messages['captcha']	= "El código insertado es incorrecto. Intente nuevamente.";


/*
 * VALORES E-MAIL
 */
$redirect 		= getScript();
$subject_title 	= "Formaulario de contacto";
$asunto_title 	= "Formaulario de contacto";

if(!class_exists('Config')){
	$domain 		= "dominio.com";
	$to 			= $TEST ? $EMAIL_TEST : "usuario@dominio.com";
	$from 			= "VICOM";
	$img 			= "http://vicomstudio.com/espanol/imahome2010/menu/vicom.gif";
	$colorth 		= '#000000';
	$colortd 		= '#000000';
	$backimg 		= '#FFFFFF';
	$email_noreply 	= "noreply@$domain";
}else{
	$config 		= Config::getGlobalConfiguration();
	$domain 		= $config["project_domain"];
	$to 			= $TEST ? $EMAIL_TEST : $config["project_email"];
	$from 			= $config["project_name"];
	$email_noreply	= $config["smpt_mail_from"];
	$img 			= $config["logo_email"];
	$colorth 		= $config["color_th"];
	$colortd 		= $config["color_td"];
	$backimg 		= $config["bakground_logo"];
}

$subject 		= "$subject_title - $from";
$asunto			= "$asunto_title - $from";
$comentarios 	= 'Alguien envió la siguiente información a través del formulario de contacto:';



if($_POST['cmd'] == $CMD){
	$entity = array();
	foreach ($_POST[$VARIABLE_POST] as $key => $value){
		$entity[$key] = strip_tags($value);
		$entity[$key] = Application::hackedString($entity[$key]) ? '' : $entity[$key];
		$_POST[$VARIABLE_POST][$key] = Application::hackedString($_POST[$VARIABLE_POST][$key]) ? '' : $_POST[$VARIABLE_POST][$key];
	}
	
	$result = validar($VARIABLE_POST,$fields,$messages,$redirect);
	if($result['status']){
		if ($securimage->check($_POST['captcha_code']) == false){
			die('<script languaje="javascript" type="text/javascript">alert("'.$messages['captcha'].'");history.go(-1);</script>');
		}
		// REGISTRO EN LA BASE DE DATOS DE LA FORMA
		$tabla	= 'formacontacto';
		$campos	= array('nombre'		=>	$entity['Nombre'],
						'telefono'		=>	$entity['Telefono'],
						'email'			=>	$entity['E-Mail'],
						'estado'		=>	$entity['Estado'],
						'ciudad'		=>	$entity['Ciudad'],
						'comentarios'	=>	$entity['Comentarios']);
		
		$sql = "INSERT INTO $tabla SET ";
		foreach($campos as $campo => $valor)$sql .= "`$campo` = '$valor',";
		$sql = substr($sql,0,-1);
		
		if(class_exists('DB')){
			$db = new ProjectLibrary_SDO_Core_DB();
			$db->sqlExecute($sql);
		}else{
			$server 	= 'localhost';
			$username	= 'root';
			$password	= '';
			$db_name	= 'lacuisine';
			
			mysql_connect($server,$username,$password);
			mysql_select_db($db_name);
			mysql_query($sql);
		}
		///////////////////////////////////////////////////
		$FieldsTable 	= genericHTMLFieldsTable($_POST[$VARIABLE_POST],$colorth,$colortd);
		$HTML 			= genericHTMLMail($img,$backimg,$comentarios,$FieldsTable);
		sendMail($HTML,$from,$to,$subject,$email_noreply,$ENVIAR_POR_SMTP);
		if($ENVIAR_EMAIL_A_USUARIO){
			ob_start();
			include('autoreplay/email3.php');
			$body = ob_get_contents();
			ob_end_clean();
	        mail( $_POST['entity']["email"], $asunto, $body, $header);
		}
		//  ALERT DE CONFIRMACION  //
		echo $result['msg'];
	}else{
		//  ASIGNACION DE VARIABLES DE VALIDACION  //
		$empty = $result['empty'];
		$msg = $result['msg'];	
		$campos = $_POST[$VARIABLE_POST];
	}
}
?>