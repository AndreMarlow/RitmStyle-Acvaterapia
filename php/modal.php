<?php
require_once("Mail.php");

function sendEmail($email)
{

    $username = '348cb678c23865';
    $password = '9102de2a4bcf6d';
    $smtpHost = 'smtp.mailtrap.io';
    $smtpPort = '25';
    $to = $email;
    $from =  'andreyyybelovvv@gmail.com';

    $subject = "Thanks for Subscribing us - RitmStyle";
    $message = "Thanks for subscribing to our blog. You'll always receive updates from us. And we won't share and sell your information.";

    $name = 'Andrey';


    $headers = array(
        'From' => $name . " <" . $from . ">",
        'To' => $to,
        'Subject' => $subject
    );
    $smtp = Mail::factory('smtp', array(
        'host' => $smtpHost,
        'port' => $smtpPort,
        'auth' => true,
        'username' => $username,
        'password' => $password
    ));


    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        if ($mail = $smtp->send($to, $headers, $message)) {

            return <<<EOD
                    <div class="alert success-alert">
                        Спасибо за запись!
                    </div>
                EOD;
        } else {
            return <<<EOD
                <div class="alert error-alert">
                    Не верный электронный адресс!
                </div>
                EOD;
        }
    } else {
        return <<<EOD
                    <div class="alert error-alert">
                        {$email} Ваша элеткронная почта не валидна!
                    </div>
                EOD;
    }
}


function storeToDatabase($email,$name, $nubmer)
{
    $connection = mysqli_connect("localhost", "root", "1An32bE1!");
    $select_db = mysqli_select_db($connection, "base-spa");

    try {
        $connection->query("INSERT INTO users (email, `name`, `number`) VALUES ('{$email}','{$name}','{$nubmer}')");
    } catch (\Exception $e) {

        return <<<EOD
            <div class="alert error-alert">
                {$e->getMessage()}
            </div>
        EOD;
    }
}
