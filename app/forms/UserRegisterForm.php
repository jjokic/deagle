<?php
use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Password;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;

class UserRegisterForm extends Form
{
    public function initialize($entity = null, $options = null)
    {
        // First Name
        $first_name = new Text('first_name');
        $first_name->setLabel('Your first name');
        $first_name->setFilters(['striptags', 'string']);
        $first_name->addValidators([
            new PresenceOf([
                'message' => 'First name is REQUIRED'
            ])
        ]);
        $this->add($first_name);
        
        // Last Name
        $last_name = new Text('last_name');
        $last_name->setLabel('Your last name');
        $last_name->setFilters(['striptags', 'string']);
        $last_name->addValidators([
            new PresenceOf([
                'message' => 'Last name is REQUIRED'
            ])
        ]);
        $this->add($last_name);
        
        // User Name
        $username = new Text('username');
        $username->setLabel('Username');
        $username->setFilters(['alphanum']);
        $username->addValidators([
            new PresenceOf([
                'message' => 'Please enter your desired username'
            ])
        ]);
        $this->add($username);
        
        // Email
        $email = new Text('email');
        $email->setLabel('E-Mail');
        $email->setFilters('email');
        $email->addValidators([
            new PresenceOf([
                'message' => 'E-mail is required'
            ]),
            new Email([
                'message' => 'E-mail is not valid'
            ])
        ]);
        $this->add($email);
        // Password
        $password = new Password('password');
        $password->setLabel('Password');
        $password->addValidators([
            new PresenceOf([
                'message' => 'Password is REQUIRED'
            ])
        ]);
        $this->add($password);
       
        // Confirm Password
        $repeatPassword = new Password('repeatPassword');
        $repeatPassword->setLabel('Repeat Password');
        $repeatPassword->addValidators([
            new PresenceOf([
                'message' => 'Confirmation password is REQUIRED'
            ])
        ]);
        $this->add($repeatPassword);
        
    }
    

}