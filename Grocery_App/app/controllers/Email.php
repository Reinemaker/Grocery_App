<?php

namespace app\controllers;

#[\app\filters\ValidateToken]

class Email
{
    /**
     * @OA\Post(
     *     path="/api/Email",
     *     @OA\Response(response="200", description="Sends an email")
     * )
     */
    function post($payload)
    {
        $logger = new \app\LoggerHelper();
        $logger = $logger->getLogger();
        $logger->debug("Sending email");
        // the message
        $msg = "First line of text\nSecond line of text";

        // use wordwrap() if lines are longer than 70 characters
        $msg = wordwrap($msg, 70);

        // send email
        mail("someone@example.com", "My subject", $msg);
    }
}
