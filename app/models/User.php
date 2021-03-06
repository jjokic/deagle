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
    protected $salt;
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
    
    public function get_salt() {
        return $this->salt;
    }
    
    
     public function get_password() {
        return $this->password;
    }
    
    
    // SETTERS
    
    public function set_id($uid) {
        $this->user_id = $uid;
    }
    
    public function set_first($first) {
        $this->first_name = $first;
    }
    
    public function set_last($last) {
        $this->last_name = $last;
    }
    
    public function set_email($email) {
        $this->email = $email;
    }
    
    public function set_password($pwd) {
        $this->password = $pwd;
    }
    
     public function set_salt($salt) {
        $this->salt = $salt;
    }
    
    public function set_username($username) {
        $this->username = $username;
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