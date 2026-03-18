<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

function enviarEmailRecuperacao($emailDestino, $senhaTemporaria)
{
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'Email do remetente';
        $mail->Password   = 'Senha do app (Email) do remetente';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('suacuriosidade01@gmail.com', 'Suporte - E-commerce Eniac');
        $mail->addAddress($emailDestino);

        $mail->isHTML(true);
        $mail->Subject = 'Recupere sua Conta!';
        $mail->Body    = "
            <h3>Sua nova senha temporária:</h3>
            <p><b>$senhaTemporaria</b></p>
            <p>Use essa senha para acessar o site e altere-a no painel do usuário.</p>
        ";
        $mail->AltBody = "Sua nova senha temporária: $senhaTemporaria";

        $mail->send();
        return true;
    } catch (Exception $e) {
        return "Erro ao enviar e-mail: {$mail->ErrorInfo}";
    }
}
