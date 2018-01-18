<?php
use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;

class User extends Model
{
    protected $user_id;
    protected $first_name;
    protected $last_name;
    protected $email;
    protected $username;
    protected $password;
    
    // GETTERS
    
    public function get_id() {
        return $this->user_id;
    }
    
    public function get_first() {
        return $this->first_name;
    }
    
    public function get_last() {
        return $this->last_name;
    }
    
    public function get_email() {
        return $this->email;
    }
    
    public function get_username() {
        return $this->username;
    }
    
    
    // SETTERS
    
    public function set_id($uid) {
        $this->user_id = $uid;
    }
    
    public function set_first($first) {
        $this->first = $first;
    }
    
    public function set_last($last) {
        $this->last = $last;
    }
    
    public function set_email($email) {
        $this->email = $email;
    }
    
    public function set_password($pwd) {
        $this->password = $pwd;
    }
    
    
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