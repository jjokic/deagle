<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <?= $this->tag->getTitle() ?>
        <?= $this->tag->stylesheetLink('css/bootstrap.min.css') ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Your invoices">
        <meta name="author" content="Phalcon Team">
</head>
    
<body>
        <?= $this->getContent() ?>
        <?= $this->tag->javascriptInclude('js/jquery.min.js') ?>
        <?= $this->tag->javascriptInclude('js/bootstrap.min.js') ?>
        <?= $this->tag->javascriptInclude('js/utils.js') ?>
  

<?php if ($this->session->get('auth') == null) { ?> 

<div class="row">

    <div class="col-md-6">
        <div class="page-header">
            <h2>Log In</h2>
        </div>
        <?= $this->tag->form(['session/start', 'role' => 'form']) ?>
            <fieldset>
                <div class="form-group">
                    <label for="email">Username/Email</label>
                    <div class="controls">
                        <?= $this->tag->textField(['email', 'class' => 'form-control']) ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="controls">
                        <?= $this->tag->passwordField(['password', 'class' => 'form-control']) ?>
                    </div>
                </div>
                <div class="form-group">
                    <?= $this->tag->submitButton(['Login', 'class' => 'btn btn-primary btn-large']) ?>
                </div>
            </fieldset>
        </form>
</div>


        <div class="page-header">
            <h2>Don't have an account yet?</h2>
        </div>
        <p>Create an account offers the following advantages:</p>
        <ul>
            <li>Create, track and export your invoices online</li>
            <li>Gain critical insights into how your business is doing</li>
            <li>Stay informed about promotions and special packages</li>
        </ul>
        <div class="clearfix center">
            <?= $this->tag->linkTo(['register', 'Sign Up', 'class' => 'btn btn-primary btn-large btn-success']) ?>
        </div>
    </div>
</div>

<?php } else { ?> 
<?php 

 $auth = $this->session->get('auth');
        //Query the active user
        $user = User::findFirst($auth['id']);
        $msg = "Welcome " . $auth['name'];
        $this->flash->success($msg);
        
        // Get all TWATS
        $twats = Post::find();
        echo "There are ", count($twats), "\n";
        
        foreach ($twats as $twat) 
                echo $twat->content . "\n";
                
                
        
?>
<?php } ?>

</body>
</html>