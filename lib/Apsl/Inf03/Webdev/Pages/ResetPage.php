<?php

namespace Apsl\Inf03\Webdev\Pages;

use Apsl\Controller\Page;
use Apsl\Http\Request;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;

class ResetPage extends Page
{
    function getRandomString($n)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_+=';
        $randomString = '';

        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }

    public function createResponse(): void
    {
        $templateParams = [
            'title' => 'Password reset',
            'success' => $this->request->getGetValue('success', false)
        ];

        $errors = [];
        if ($this->request->isMethod(Request::METHOD_POST)) {
            $data = $this->request->getValue('reset', []);
            $email = trim($data['email'] ?? '');

            if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                $errors['email'] = 'Wrong email format';
            }

            if (empty($errors)) {
                $transport = Transport::fromDsn("smtp://apsl-dev@gmx.com:apslDEV2023@mail.gmx.com:587");
                $mailer = new Mailer($transport);

                $hash = $this->getRandomString(10);

                $message = "http://localhost/new-password?hash=$hash";

                $msg = new Email();
                $msg->to($email);
                $msg->from('apsl-dev@gmx.com');
                $msg->subject('Message from contact form');
                $sanitizedMessage = htmlentities($message);
                $msg->text("Click below to reset your password:\n$sanitizedMessage");
                $mailer->send($msg);

                $this->response->redirect($this->request->getUri() . '?success=1');
                return;
            }

            $templateParams['data'] = $data;
            $templateParams['errors'] = $errors;
        }

        $this->response->useTemplate('templates/reset.html.php', $templateParams);
    }
}