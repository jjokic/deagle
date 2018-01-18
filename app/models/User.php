<?php
use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;

class User extends Model
{
    protected $user_id;
    protected $first_name;
    protected $email;
    protected $username;
    protected $password;
    
    public function validation()
    {
        $validator = new Validation();
        
        $validator->add(
            'email',
            new EmailValidator([
            'message' => 'Invalid email given'
        ]));
        $validator->add(
            'email',
            new UniquenessValidator([
            'message' => 'Sorry, The email was registered by another user'
        ]));
        $validator->add(
            'username',
            new UniquenessValidator([
            'message' => 'Sorry, That username is already taken'
        ]));
        
        return $this->validate($validator);
    }
}