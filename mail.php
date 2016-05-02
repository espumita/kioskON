<?php

if (isset($_POST["submit"])) {
    if (isset($_POST["terms"])) {

        $email_to = "kioskon@kioskon.hol.es";

        $email_subject = "[Contacto] Atención al Cliente Kioskon";

        if(empty($_POST['name']) ||

            empty($_POST['email']) ||

            empty($_POST['select']) ||

            empty($_POST['message'])) {

            die('Complete todos los campos para poder enviar el formulario');

        } else {
            $headers = 'From: '.$_POST['email']."\r\n".

                'Reply-To: '.$_POST['email']."\r\n" .

                'X-Mailer: PHP/' . phpversion();

            $email_message = "Mensaje enviado desde la web de kioskon.\n\n\n";
            $email_message .= "	".$_POST['message']."\n\n\n\n";
            $email_message .= "Enviado por:\n";
            $email_message .= "Nombre:    	".$_POST['name']."\n";
            $email_message .= "Pregunta:    	".$_POST['select']."\n";
            $email_message .= "Mail:	".$_POST['email']."\n\n";

            mail($email_to, $email_subject, $email_message, $headers);
        }

    }

} else {
    die('¿Quieres mandar un correo electrónico?');
}