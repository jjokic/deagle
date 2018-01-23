<?php

use Phalcon\Mvc\Controller;

class IndexController extends Controller
{
    
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
    
}