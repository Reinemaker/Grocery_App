<?php

namespace app\controllers;

// #[\app\filters\ValidateToken]
class Email
{
    function post($payload)
    {
        // the message
        $msg = "love";

        // use wordwrap() if lines are longer than 70 characters
        $msg = wordwrap($msg, 70);

        // send email
        mail("itai.bolyasni25@gmail.com", "Bebito hungrito. also love", $msg);
    }
}
