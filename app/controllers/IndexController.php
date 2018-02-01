<?php

use Phalcon\Mvc\Controller;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;
use Phalcon\Acl;
use Phalcon\Acl\Role;
use Phalcon\Acl\Resource;
use Phalcon\Acl\Adapter\Memory as AclList;


class IndexController extends Controller
{
  
  private $acl;
  
    public function initialize(){
    $this->forms->set('poster', new UserPostForm());   
    
    $this->acl = new AclList();

     // Default action is deny access
$this->acl->setDefaultAction(
    Acl::DENY
);

// Create some roles.

$roles = array(
            'users' => new Phalcon\Acl\Role('Users'),
            'admin' => new Phalcon\Acl\Role('Admin'),
            'guests' => new Phalcon\Acl\Role('Guests')
        );
            foreach ($roles as $role)
            {
                $this->acl->addRole($role);
            }

// Admin area resources

$adminResources = array(
            'index' => array('index','addPost','delete'),
            'session' => array('start', 'end'),
            'signup' => array('submit')
        );

            foreach ($adminResources as $resource => $actions)
            {
                $this->acl->addResource(new Phalcon\Acl\Resource($resource), $actions);
            } 

// Public resources

$publicResources = array(
            'session' => array('start', 'end'),
            'notfound' => array('route404')
        );
            foreach ($publicResources as $resource => $actions)
            {
                $this->acl->addResource(new Phalcon\Acl\Resource($resource), $actions);
            }

        //Grant access to public areas to all
        foreach ($roles as $role)
        {
            foreach ($publicResources as $resource => $actions)
            {
                $this->acl->allow($role->getName(), $resource, '*');
            }
        }
        
//Grant access to User area to roles Users and Admin
        foreach ($adminResources as $resource => $actions)
        {
            foreach ($actions as $action)
            {
                $this->acl->allow('Users', $resource, $action);
                $this->acl->allow('Admin', $resource, $action);
            }
        }
        

// Grant DELETE twat action to legit users

$this->acl->allow(
    'Users',
    'index',
    'delete',
    function ($pUID) { // Loadat model s ID
    
        if(!$this->session->has('auth'))
            return False;
    
        $twat = Post::findFirstByPid($pUID);
        $uid = $twat->get_uid();
        $auth = $this->session->get("auth");
            
    }
);
    
    }
    
    public function indexAction()
    {
        

     
     
      if ($this->session->has('auth')) {
//          echo $this->security->getTokenKey();
          
    //      $post = new UserPostForm();
        
          /*
            // Retrieve its value
            $name = $this->session->get('user-name');
            
            // Fetch all twats from DB
            $twats = Post::find();
            
            foreach ($twats as $twat) 
                echo $twat->name, "\n";
                
        */
        
        $currentPage = (int) $_GET['page'];
        
        // Query-builder objekt za paginaciju ?!

        // The data set to paginate
        $twats = Post::find();
        
        // Create a Model paginator, show 10 rows by page starting from $currentPage
        $paginator = new PaginatorModel(
            [
                'data'  => $twats,
                'limit' => 3,
                'page'  => $currentPage,
            ]
        );
        
        // Get the paginated results
        $page = $paginator->getPaginate();
        $this->view->setVar('podaci',$page);
          
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
        
        if ($this->session->has('auth')) {
            $auth = $this->session->get('auth');
            $this->flash->success($auth);
            if ($auth["id"] == 1000)
                $rola = 'Admin';
            else $rola = 'Users'; }
        else $rola = 'Guest';
        
        /*
       switch ($rola) {
           
           case 'Guest':
               $this->flash->error("GTFO u pesky sk1d !!:one::one:11");
             //return $this->response->redirect('index');
               break;
           
           case 'User':
                $twat = Post::findFirstByPid($pid);
                if ($auth['id'] == $twat->get_uid())
                    $this->flash->success("Congrats, u can edit the twat.");
                break;
                
            case 'Admin':
                $this->flash->success("I bow to thy Greatness Mastah");
                break;
           
       }
       
       
           
          */ 
          
          $twat = Post::findFirstByPid($pid);
          $this->flash->success($twat->get_pid());
        
        // Executing a simple query
$query = $this->modelsManager->createQuery("SELECT * FROM Post WHERE pid = $pid");
$twats  = $query->execute();
          
          $uid = $auth["id"];
      //    $puid = 
          
          if ($this->acl->isAllowed($rola, "index", "delete",['pid' => 3]))
            $this->flash->error("Mores proc !");
          
           // Do some ACL magic here
         //      ...
           
        
       $msg = "U haz rolemodel named: $rola";  
       $this->flash->error($msg);   
    
        $twat = Post::findFirstByPid($pid);
        if ($twat !== false) {
            if ($twat->delete() === false)
                echo "We can't remove your twat atm, sorry !";
            else echo "Successfully eliminated the twat!";
//            return $this->response->redirect('index');
        }
        
        
        
    }
}