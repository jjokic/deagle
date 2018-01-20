<?php

use Phalcon\Mvc\Controller;

class SignupController extends Controller
{
    public function initialize() {
    $this->forms->set('register', new UserRegisterForm());   
    }
    
    public function indexAction() {
        
    }
    
    public function submitAction() {
    
     $form = $this->forms->get('register');
    
    if ($this->request->isPost()) {
            if (!$form->isValid($this->request->getPost())) {
                $messages = $form->getMessages();
                foreach ($messages as $message) {
                    $this->flash->error($message);
                return $this->dispatcher->forward(
                    [
                        "controller" => "index",
                        "action"     => "index",
                    ]
                );
                }
            }
                
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
            $user->set_password($this->security->hash($password));
            $user->set_username($username);
            
            $user->created_at = new Phalcon\Db\RawValue('now()');
            $user->active = 'Y';
            if ($user->save() == false) {
                $this->flash->error('nije sejvan juzer');
                foreach ($user->getMessages() as $message) 
                    $this->flash->error((string) $message);
                } else { 
             
                $this->flash->success('Thanks for sign-up, please log-in to start twottering');
//              return $this->response->redirect('....');
            }
        }
    }
}
    
    
