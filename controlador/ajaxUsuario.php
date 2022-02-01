<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// PHPMAILER
require dirname(__file__, 2) . '/librerias/PHPMailer/Exception.php';
require dirname(__file__, 2) . '/librerias/PHPMailer/PHPMailer.php';
require dirname(__file__, 2) . '/librerias/PHPMailer/SMTP.php';
// modelo
include dirname(__file__, 2) . '/modelo/usuario.php';
include dirname(__file__, 2) .  "/librerias/encrypt/mcript.php";

$emaiEncrypt = isset($_REQUEST['emailEncript']) ? $_REQUEST['emailEncript'] : "";
$id_usuario = isset($_REQUEST['idUser']) ? $_REQUEST['idUser'] : "";
$password = isset($_REQUEST['password']) ? $_REQUEST['password'] : "";

$usuario = new Usuario();
$tipo  = isset($_REQUEST['tipo']) ? $_REQUEST['tipo'] : "";

if ($tipo == 'inserta') {
    if ($usuario->insertaUsuario($_REQUEST)) {
        echo $r = '1';
    } else {
        echo $r = '0';
    }
}

if ($tipo == 'consulta') {
    $resultado = $usuario->consultaUsuario($_GET);
    if ($resultado) {
        echo json_encode($resultado); //imprime el json
    } else {
        return 'No se consulto';
    }
}

if ($tipo == 'edita') {
    if ($usuario->editaUsuario($_REQUEST)) {
        echo $r = '1';
    } else {
        echo $r = '0';
    }
}

if ($tipo == 'elimina_logico') {
    if ($usuario->eliminaLogicoUsuario($_GET)) {
        return '1';
    } else {
        return '0';
    }
}

if ($tipo == 'cerrar_sesion') {
    session_start();
    session_destroy();
    echo "si";
}
// actualizar contraseña
if ($tipo == 'actualizar') {
    $fecha = date('d-m-Y');
    $tokens = $usuario->getEstadoFecha($emaiEncrypt, $fecha);
    if ($tokens) {
        for ($i = 0; $i < count($tokens); $i++) {
            $pss = sha1($password);
            $udpatePss = $usuario->updatePassword($id_usuario, $pss);
            if ($udpatePss) {
                $estado = $usuario->updateEstado($tokens[$i]['token']);
                if ($estado) {
                    echo "Tu contraseña ha sido reestrablecida";
                } else {
                    echo "Si no fuiste tú fue un error o tienes dudas, escríbenos a instantmailcorreo@gmail.com o llámanos al 3107700611. Estamos por aquí de lunes a sabado 8 a.m. a 5 p.m.";
                }
            } else {
                echo "Si no fuiste tú fue un error o tienes dudas, escríbenos a instantmailcorreo@gmail.com o llámanos al 3107700611. Estamos por aquí de lunes a sabado 8 a.m. a 5 p.m.";
            }
        }
    } else {
        echo "Este correo ya expiro intenta de nuevo";
    }
}
// recuperar contraseña
if ($tipo == 'recuperar') {
    $email = $_POST['email'];
    $token = $encriptar($email);
    $emails = $usuario->getCorreosClientes($email);
    if ($emails[0]["cantidad"] > 0) {
        $id_usuario = $emails[0]['id_usuario'];
        $tokens = $usuario->getTokens($token);
        if ($tokens) {
            // si existe
            createToken($email, $id_usuario, 1);
        } else {
            // no existe
            createToken($email, $id_usuario, 2);
        }
    } else {
        echo "El correo electrónico escrito no se encuentra en nuestra base de datos , por favor verifique";
    }
}
// crear token
function createToken($email, $id_usuario, $number)
{
    include dirname(__file__, 2) .  "/librerias/encrypt/mcript.php";
    $emaiEncrypt = $encriptar($email);
    sendEmail($emaiEncrypt, $email, $id_usuario, $number);
}
// enviar correo
function sendEmail($emaiEncrypt, $email, $id_usuario, $number)
{
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;        //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.office365.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'megalabs.app@outlook.com';                     //SMTP username
        $mail->Password   = 'MiAppMegalabs!';                               //SMTP password
        $mail->SMTPSecure = 'STARTTLS';            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('megalabs.app@outlook.com');
        $mail->addAddress($email);

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Recuperar contrasena';
        $mail->Body    = '
        
        <div>
<table width="100%" align="center" border="0" cellspacing="0" cellpadding="0" style="max-width:768px">
    <tbody><tr>
      <td>
        <table width="100%" align="center" border="0" cellspacing="0" cellpadding="0" style="max-width:670px;border:solid 1px #dcdcdc">
          <tbody><tr>
            <td style="text-align:center">
              <img src="https://scontent-bog1-1.xx.fbcdn.net/v/t39.30808-6/239576024_107840798282365_6569353946472121371_n.jpg?_nc_cat=110&ccb=1-5&_nc_sid=09cbfe&_nc_eui2=AeFmMwZVEBT4otbxgLMy86LXoJT5GweUfvCglPkbB5R-8FlPv6dtujwEAJrg5uOYX8A&_nc_ohc=57FG5HY3f-AAX_VNIfP&_nc_ht=scontent-bog1-1.xx&oh=00_AT-Z72OCVJ94vRlgHs550ih9L6NpenpPGnQ-i4-Ja9sIQw&oe=61FD011C" style="width:100%;max-width:100px;padding:20px 0px 0px;border:0" alt="" class="CToWUd">
            </td>
          </tr>
          <tr>
            <td style="padding:0px 10%">
              <table width="100%" align="center" cellspacing="0" cellpadding="0" border="0" style="max-width:500px;font-family:Lucida Sans Unicode,Lucida Grande,sans-serif;font-size:16px;line-height:1.3;color:#8e8e8e;text-align:center">
                <tbody><tr>
                  <td width="100%" style="padding:20px 10% 15px">
                    <span style="font-size:20px;font-weight:bold;color:#210049">Ingresa tu nueva contraseña</span> 
                  </td>
                </tr>
                <tr>
                  <td width="100%" style="padding:0px 0px 30px">
                  <a href="http://localhost/kronosSoluciones/InstantMail/vista/usuarios/contrasena-nueva.php?email=' . $emaiEncrypt . '' . "&idUser=" . '' . $id_usuario . '">Aquí</a>
                  </td>
                </tr>
                <tr>
                  <td width="100%" style="padding:30px 0px 30px;border-top:dashed 1px #dcdcdc;border-bottom:dashed 1px #dcdcdc">
                  Si no fuiste tú fue un error o tienes dudas, escríbenos a instantmailcorreo@gmail.com o llámanos al 3107700611. Estamos por aquí de lunes a sabado 8 a.m. a 5 p.m.
                  </td>
                </tr>
            
                <tr>
                  <td width="100%" style="padding:20px 10% 10px">
                  Recuerda seguirnos en Facebook e Instagram, siempre tenemos cosas nuevas.<br><br>¡Hasta pronto!
                </td></tr>
            
                <tr>
                  <td>
                    <table align="center" cellspacing="0" cellpadding="0" border="0" style="padding:0px 100px 45px">
                      <tbody><tr>
                        <td><a href="https://www.facebook.com/Mensajer%C3%ADa-Instant-Mail-107835328282912" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://www.facebook.com/appnequi&amp;source=gmail&amp;ust=1643729973008000&amp;usg=AOvVaw2Xn14MbCkUTNj41Iq8vA_3"><img src="https://ci4.googleusercontent.com/proxy/7yJcuYXYflu9TV9qjKjy--KtW4os1enDkhu3Oc1AOMbSWH7cO_MlNjhDb7dl5sbwyjUPfBZ8KUeOnQtslwOrZbWKt6zllWTxNKkqQmU=s0-d-e1-ft#http://s3.amazonaws.com/mail-nequi-co/img/ico_facebook.png" alt="facebook" style="height:40px;width:40px;padding:0px 10px 0px" class="CToWUd"></a></td>
                        <td><a href="https://www.instagram.com/instantmailmensajeria/" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://www.instagram.com/nequi_&amp;source=gmail&amp;ust=1643729973008000&amp;usg=AOvVaw2kAZHI2hCLKyarPWtHfPYb"><img src="https://ci4.googleusercontent.com/proxy/dThPSVzU3G9NQdMYcpw5ZMSfHbjC_A-Guo-jTTE30BOabuV7GCyl24nUrsYcNpcTQrI1M3Tz5G_kGj-8kt7DtRw4MNhTQFvZwoN1O0M5=s0-d-e1-ft#http://s3.amazonaws.com/mail-nequi-co/img/ico_instagram.png" alt="instagram" style="height:40px;width:40px;padding:0px 10px 0px" class="CToWUd"></a></td>
                      </tr>
                    </tbody></table>
                  </td>
                </tr>
              </tbody></table>
            </td>
          </tr>
        </tbody></table>
      </td>
    </tr>
</tbody></table>

<table width="100%" align="center" cellspacing="0" cellpadding="0" border="0" style="max-width:670px;font-family:Lucida Sans Unicode,Lucida Grande,sans-serif;font-size:11px;text-align:center;padding-top:15px">
  <tbody><tr style="color:#b0a4bd"> 
    <td>Copyright ©2020, All rights reserved</td>
  </tr>
</tbody></table>   
</div>';

        $mail->send();
        echo "Se ha realizado el envío del link para el cambio de contraseña al correo $email , por favor ingresé y siga las instrucciones, para reestablecer la contraseña";
        postDataEmail($emaiEncrypt, $id_usuario, $number);
    } catch (Exception $e) {
        echo "No se pudo enviar el correo. Error de correo: {$mail->ErrorInfo}";
    }
}
// guardar datos en DB
function postDataEmail($email, $id_usuario, $number)
{
    $fecha = date('d-m-Y');
    $usuario = new Usuario();
    if ($number === 1) {
        // si el usuario ya existe lo actualiza
        $usuario->updateTablaTokens($email, $fecha);
    } else if ($number === 2) {
        // si el usuario no existe lo agrega
        $usuario->postTablaTokens($email, $id_usuario, $fecha);
    }
}
