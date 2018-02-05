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
            <?= $this->tag->linkTo(['signup', 'Sign Up', 'class' => 'btn btn-primary btn-large btn-success']) ?>
        </div>
    </div>
</div>

<?php } else { ?> 
<?php 


$form = new UserPostForm();
$auth = $this->session->get('auth');
        //Query the active user
        $user = User::findFirst($auth['id']);
        $msg = "Welcome " . $auth['name'];
        $this->flash->success($msg);
?>
        <p><a href='<?= $this->url->get('session/end') ?>'>Logout</a></p>
<?php        
        // Get all TWATS
        $twats = Post::find(["limit" => 15]);
        echo "There are ", count($twats), "\n", '<br/>'; 
        ?>
        
    <table>
    <tr>
        <th style="width:50px"> Pid </th>
        <th style="width:50px"> Uid </th>
        <th style="width:200px"> Content </th>
    </tr>
    <?php foreach ($podaci->items as $item) { ?>
    <tr>
        <td><?php echo $item->pid; ?></td>
        <td><?php echo $item->uid; ?></td>
        <td><?php echo $item->content; ?></td>
        <?php if($auth["id"] == $item->uid): ?>
        <td><a href="index/delete/<?=$item->pid ?>">delete</a></td>
        <?php endif; ?>
    </tr>
    <?php } ?>
    </table>

<div>        
    <a href='/'>First</a>
    <a href='?page=<?= $podaci->before; ?>'>Previous</a>
    <a href='?page=<?= $podaci->next; ?>'>Next</a>
    <a href='?page=<?= $podaci->last; ?>'>Last</a>

<p>
<?php echo 'You are in page ', $podaci->current, ' of ', $podaci->total_pages; ?>
</p>

</div>
        
        <?php 
        
        /*
        foreach ($twats as $twat): 
            $p_uid = $twat->get_uid();
            $p_user = User::findFirst($p_uid);
            ?>
            <div>
                <p><?php echo $p_user->get_first() . '<br/>'; ?>
                <?php echo $twat->get_content(); ?>
                <?php $pid = $twat->get_pid();
                if ($p_uid == $auth['id']): ?>
                <a href="index/delete/<?php echo $pid?>"> Delete</a>
                </p>
                <?php endif; ?>
            </div>
        <?php endforeach; 
        */
        
        ?>
        
    <?= $this->tag->form(['index/addPost']) ?>
    <div class="main-wrapper">
            <h4> Twatter box </h4>
            <p>
                <?php echo $form->render('twext'); ?>
            </p>
        
        <?php echo $form->render('Post'); ?>
    </div>       
    </div>

<?php } ?>

</body>
</html>