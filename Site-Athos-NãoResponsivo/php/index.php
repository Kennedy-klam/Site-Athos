PHP
<?php
require_once('scr/PHPMailer');
require_once('src/SMTP.php');
require_once('src/Exception.php');
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
 
$mail = new PHPMailer(true);
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $phone = htmlspecialchars($_POST['phone']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);

    try {
        // Configurações do servidor
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  // Defina o servidor SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'seuemail@dominio.com'; // SMTP username
        $mail->Password = 'suasenha'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Remetente e destinatário
        $mail->setFrom('seuemail@dominio.com', 'Instituto Athos');
        $mail->addAddress('destinatario@dominio.com', 'Nome do Destinatário');

        // Conteúdo do email
        $mail->isHTML(true);
        $mail->Subject = 'Nova mensagem do formulário de contato';
        $mail->Body    = "Nome: $name<br>Telefone: $phone<br>Email: $email<br>Mensagem: $message";
        $mail->AltBody = "Nome: $name\nTelefone: $phone\nEmail: $email\nMensagem: $message";

        $mail->send();
        echo 'Mensagem enviada com sucesso';
    } catch (Exception $e) {
        echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
    }
}
?>