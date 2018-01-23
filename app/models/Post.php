<?php
use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Email as EmailValidator;

class Post extends Model {
    
    protected $pid;
    protected $uid;
    protected $content;
    protected $timestamp;
    
    // GETTERS
    
    public function get_pid() {
        return $this->pid;
    }
    
    public function get_uid() {
        return $this->uid;
    }

    public function get_content() {
        return $this->content;
    }
    
    public function get_timestamp(){
        return $this->timestamp;
    }
    
    // SETTERS
    
    public function set_pid($pid) {
        $this->pid = $pid;
    }
    
    public function set_uid($uid) {
        $this->uid = $uid;
    }
    
    public function set_content($content) {
        $this->content = $content;
    }
    
    public function set_timestamp($time) {
        $this->timestamp = $time;
    }
    
    // ...
    
    
}