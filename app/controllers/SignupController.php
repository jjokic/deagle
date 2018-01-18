<?php

use Phalcon\Mvc\Controller;

class SignupController extends Controller
{

    public function indexAction()
    {
        $form = new UserRegisterForm();
        if ($this->request->isPost()) {
            $first_name = $this->request->getPost('first_name', ['string', 'striptags']);
            $last_name = $this->request->getPost('last_name', ['string', 'striptags']);
            $username = $this->request->getPost('username', 'alphanum');
            $email = $this->request->getPost('email', 'email');
            $password = $this->request->getPost('password');
            $repeatPassword = $this->request->getPost('repeatPassword');
            if ($password != $repeatPassword) {
                $this->flash->error('Passwords are different');
                return false;
            }
            $user = new User();
            $user->set_first($first_name);
            $user->set_last($last_name);
            $user->set_email($email);
            $user->password = sha1($password);
            $user->set_username($username);
            
            $user->created_at = new Phalcon\Db\RawValue('now()');
            $user->active = 'Y';
            if ($user->save() == false) {
                foreach ($user->getMessages() as $message) {
                    $this->flash->error((string) $message);
                }
            } else {
                $this->tag->setDefault('email', '');
                $this->tag->setDefault('password', '');
                $this->flash->success('Thanks for sign-up, please log-in to start twottering');
                return $this->dispatcher->forward(
                    [
                        "controller" => "session",
                        "action"     => "index",
                    ]
                );
            }
        }
        $this->view->form = $form;
    }
}

