<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        {{ get_title() }}
        {{ stylesheet_link('css/bootstrap.min.css') }}
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Your invoices">
        <meta name="author" content="Phalcon Team">
</head>
    
<body>
        {{ content() }}
        {{ javascript_include('js/jquery.min.js') }}
        {{ javascript_include('js/bootstrap.min.js') }}
        {{ javascript_include('js/utils.js') }}
  

{% if session.get('auth') == null %} {# variable is not set #}

<div class="row">

    <div class="col-md-6">
        <div class="page-header">
            <h2>Log In</h2>
        </div>
        {{ form('session/start', 'role': 'form') }}
            <fieldset>
                <div class="form-group">
                    <label for="email">Username/Email</label>
                    <div class="controls">
                        {{ text_field('email', 'class': "form-control") }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="controls">
                        {{ password_field('password', 'class': "form-control") }}
                    </div>
                </div>
                <div class="form-group">
                    {{ submit_button('Login', 'class': 'btn btn-primary btn-large') }}
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
            {{ link_to('register', 'Sign Up', 'class': 'btn btn-primary btn-large btn-success') }}
        </div>
    </div>
</div>

{% else %} {# variable is set #}
<?php 

 $auth = $this->session->get('auth');
        //Query the active user
        $user = User::findFirst($auth['id']);
        $msg = "Welcome " . $auth['name'];
        $this->flash->success($msg);
        
        // Get all TWATS
        $twats = Post::find();
        echo "There are ", count($twats), "\n";
        
?>
{% endif %}

</body>
</html>