<?php
use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Password;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;

class RegisterForm extends Form
{
    public function initialize($entity = null, $options = null)
    {
        // First Name
        $name = new Text('first_name');
        $name->setLabel('Your first name');
        $name->setFilters(['striptags', 'string']);
        $name->addValidators([
            new PresenceOf([
                'message' => 'First name is REQUIRED'
            ])
        ]);
        $this->add($name);
        
        // Last Name
        $name = new Text('last_name');
        $name->setLabel('Your last name');
        $name->setFilters(['striptags', 'string']);
        $name->addValidators([
            new PresenceOf([
                'message' => 'Last name is REQUIRED'
            ])
        ]);
        $this->add($name);
        
        // User Name
        $name = new Text('username');
        $name->setLabel('Username');
        $name->setFilters(['alpha']);
        $name->addValidators([
            new PresenceOf([
                'message' => 'Please enter your desired user name'
            ])
        ]);
        $this->add($name);
        
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