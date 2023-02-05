<?php

class Validate{
    private $_passed = false,
            $_errors = [],
            $_db = null;

    public function __construct(){
        $this->_db = Database::getInstance();
    }

    public function check($source, $items = []){
        foreach($items as $item => $rules){
            foreach($rules as $rule => $rule_value){
                $value = trim($source[$item]);
                $item = Helper::escape($item);

                if($rule === 'required' && empty($value)){
                    $this->addError("{$item} is required.");
                } else if(!empty($value)){
                    switch($rule){
                        case 'min':
                            if(strlen($value) < $rule_value){
                                $this->addError("{$item} must be a minimum of {$rule_value} characters.");
                            }
                        break;
                        case 'max':
                            if(strlen($value) > $rule_value){
                                $this->addError("{$item} must be a maximum of {$rule_value} characters.");
                            }
                        break;
                        case 'matches':
                            if($value != $source[$rule_value]){
                                $this->addError("{$rule_value} must match {$item}.");
                            }
                        break;
                        case 'unique':
                            $check = $this->_db->get($rule_value, [$item, '=', $value]);
                            if($check->count()){
                                $this->addError("{$item} already exists.");
                            }
                        break;
                        case 'email':
                            if(!filter_var($value, FILTER_VALIDATE_EMAIL)){
                                $this->addError("{$item} is not a valid email address.");
                            }
                        break;
                        case 'phone':
                            if(!preg_match('/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/', $value)){
                                $this->addError("{$item} is not a valid phone number.");
                            }
                        break;
                        case 'date':
                            if(!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $value)){
                                $this->addError("{$item} is not a valid date.");
                            }
                        break;
                        case 'time':
                            if(!preg_match('/^[0-9]{2}:[0-9]{2}:[0-9]{2}$/', $value)){
                                $this->addError("{$item} is not a valid time.");
                            }
                        break;
                        case 'datetime':
                            if(!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}$/', $value)){
                                $this->addError("{$item} is not a valid date and time.");
                            }
                        break;
                        case 'number':
                            if(!is_numeric($value)){
                                $this->addError("{$item} is not a valid number.");
                            }
                        break;
                        case 'integer':
                            if(!filter_var($value, FILTER_VALIDATE_INT)){
                                $this->addError("{$item} is not a valid integer.");
                            }
                        break;
                        case 'float':
                            if(!filter_var($value, FILTER_VALIDATE_FLOAT)){
                                $this->addError("{$item} is not a valid float.");
                            }
                        break;
                        case 'boolean':
                            if(!filter_var($value, FILTER_VALIDATE_BOOLEAN)){
                                $this->addError("{$item} is not a valid boolean.");
                            }
                        break;
                        case 'url':
                            if(!filter_var($value, FILTER_VALIDATE_URL)){
                                $this->addError("{$item} is not a valid URL.");
                            }
                        break;
                        case 'ip':
                            if(!filter_var($value, FILTER_VALIDATE_IP)){
                                $this->addError("{$item} is not a valid IP address.");
                            }
                        break;
                        case 'mac':
                            if(!preg_match('/^([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})$/', $value)){
                                $this->addError("{$item} is not a valid MAC address.");
                            }
                        break;
                        case 'alpha':
                            if(!ctype_alpha($value)){
                                $this->addError("{$item} must contain only letters.");
                            }
                        break;
                        case 'alphanumeric':
                            if(!ctype_alnum($value)){
                                $this->addError("{$item} must contain only letters and numbers.");
                            }
                        break;
                    }
                }
            }
        }
    }

    private function addError($error){
        $this->_errors[] = $error;
    }

    public function errors(){
        return $this->_errors;
    }

    public function passed(){
        return $this->_passed;
    }

    public function displayErrors(){
        $html = '';
        foreach($this->errors() as $error){
            $html .= $error . '<br>';
        }
        return $html;
    }
}