<?php

use Phalcon\Mvc\Controller;

class IndexController extends Controller
{
  
    public function initialize(){
    $this->forms->set('poster', new UserPostForm());   
    }
    
    public function indexAction()
    {
     
      if ($this->session->has('auth')) {
          echo $this->security->getTokenKey();
          
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
      $form = $this->forms->get('poster');
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
          
          $content = $this->request->getPost('twext', ['string', 'striptags']);
          $auth = $this->session->get('auth');
          
 //       $this->flash->success($content);
          $post = new Post();
          $post->set_content($content);
          $post->set_timestamp(time());
          $post->set_uid($auth["id"]);
           if ($post->save() == false) {
                $this->flash->error('nije sejvan post');
                foreach ($post->getMessages() as $message) 
                    $this->flash->error((string) $message);
                } else { 
             
                $this->flash->success('Thanks for the twat, we appreciate your effort');
                return $this->response->redirect('index');
            }
          
      }
    
    }
    
    public function deleteAction($pid)
    {
        $twat = Post::findFirstByPid($pid);
        if ($twat !== false) {
            if ($twat->delete() === false)
                echo "We can't remove your twat atm, sorry !";
            else echo "Successfully eliminated the twat!";
            return $this->response->redirect('index');
        }
        
    }
}