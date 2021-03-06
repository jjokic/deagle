<?php

use Phalcon\Mvc\Controller;

/**
 * SessionController
 *
 * Allows to authenticate users
 */
class SessionController extends Controller
{
  
    public function indexAction()
    {
        
        
    }

    /**
     * Register an authenticated user into session data
     *
     * @param Users $user
     */
    private function _registerSession(User $user)
    {
        $this->session->set('auth', [
            'id' => $user->get_id(),
            'name' => $user->get_first()
        ]);
    }

    /**
     * This action authenticate and logs an user into the application
     *
     */
    public function startAction()
    {
        if ($this->request->isPost()) {

            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            
            $user = User::findFirstByEmail($email);
            
            if ($user) {
            if (password_verify($password, $user->get_password())) {
                // The password is valid
                $this->_registerSession($user);
                return $this->response->redirect('index');
            }
        } else {
            // To protect against timing attacks. Regardless of whether a user exists or not, the script will take roughly the same amount as it will always be computing a hash.
            $this->security->hash(rand());
        }
            $this->view->pick("index/index");
        // The validation has failed
            $this->flash->error('Wrong email/password');
            $this->flashSession->error('Wrong email/password');
        }

         $this->response->redirect('index');
    }

    /**
     * Finishes the active session redirecting to the index
     *
     * @return unknown
     */
    public function endAction()
    {
        $this->session->remove('auth');
        $this->flash->success('Goodbye!');

        return $this->response->redirect('index');

    }
}