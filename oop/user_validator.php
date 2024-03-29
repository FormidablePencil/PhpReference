<?php 
//* Creating a validation class for username and email
  //Validate means: check or prove the validity or accuracy of (something)

  class UserValidator {
    private $data;
    private $errors = [];
    private static $fields = ['username', 'email'];

    public function __construct($post_data){
      $this->data = $post_data;
    }
    public function validateForm(){
      foreach(self::$fields As $field){ //??? what is self::
        if(!array_key_exists($field, $this->data)){
          trigger_error("$field is not present in data");
          return;
        }
      }
      $this->validateUsername();
      $this->validateEmail();
      return $this->errors;
    }
    private function validateUsername(){
      $val = trim($this->data['username']);
      if(empty($val)){ 
        $this->addError('username', 'username connot be empty');
      } else {
        if(!preg_match('/^[a-zA-Z0-9]{6,12}$/', $val)){
          $this->addError('username', 'username must be 6-12 chars & alphanumeric');
        }
      }
    }
    private function validateEmail(){
      $val = trim($this->data['email']);
      if(empty($val)){ 
        $this->addError('email', 'email connot be empty');
      } else {
        if(!filter_var($val, FILTER_VALIDATE_EMAIL)){ //This is ajax
          $this->addError('email', 'email must be 6-12 a valid email');
        }
      }
    }
    private function addError($key, $val){ //! notice that this function is fired before these lines where.
      $this->errors[$key] = $val;

    }
  }
  
?>