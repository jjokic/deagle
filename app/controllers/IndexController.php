<?php

use Phalcon\Mvc\Controller;

class IndexController extends Controller
{
  
    public function initialize(){
      
    }
    
    public function indexAction()
    {
     
      if ($this->session->has('auth')) {
          
    //      $post = new UserPostForm();
        
          /*
            // Retrieve its value
            $name = $this->session->get('user-name');
            
            // Fetch all twats from DB
            $twats = Post::find();
            
            foreach ($twats as $twat) 
                echo $twat->name, "\n";
                
        */
          
        }
    }
    
    public function addPostAction(){

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
      
      
       }
    
    }
}