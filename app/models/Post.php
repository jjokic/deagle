<?php
use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Email as EmailValidator;

class Post extends Model {
    
    protected $post_id;
    protected $uid;
    protected $content;
    protected $time;
    
    // GETTERS
    
    public function get_pid() {
        return $this->post_id;
    }
    
    public function get_uid() {
        return $this->uid;
    }

    public function get_content() {
        return $this->content;
    }
    
    public function get_time(){
        return $this->time;
    }
    
    // SETTERS
    
    public function set_pid($pid) {
        $this->post_id = $pid;
    }
    
    public function set_uid($uid) {
        $this->uid = $uid;
    }
    
    public function set_content($content) {
        $this->content = $content;
    }
    
    public function set_time($time) {
        $this->time = $time;
    }
    
    // ...
    
    
}