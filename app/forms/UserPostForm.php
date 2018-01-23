<?php
use Phalcon\Forms\Form;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Submit;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength as StringLength;

class UserPostForm extends Form {
    
    public function initialize($entity = null, $options = null) {
        
        $content = new TextArea('twext');
        $content->setLabel('Twat text');
        $content->setFilters(['striptags', 'string']);
        $content->addValidators([
            new PresenceOf([
                'message' => 'Twat content is REQUIRED'
            ]),
            
            new StringLength(
        [
            "max"            => 255,
            "min"            => 5,
            "messageMaximum" => "We don't like when u twat that much",
            "messageMinimum" => "We kinda want more of your twat",
        ])
    ]);
            
        $this->add($content);
     
        $this->add(new Submit('Post', array(
        'class' => 'btn btn-primary btn-large btn-success',
        )));
       
    
        }
        
}
