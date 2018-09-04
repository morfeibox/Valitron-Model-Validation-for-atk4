<?php
namespace Model;
require 'vendor/autoload.php';

class MyModel extends \atk4\data\Model
{
    function init()
    {
        parent::init();
        $this->_default_seed_addField = ['\Model\Field'];
    }

    function validate($intent = null) {
        $v = new \Valitron\Validator($this->get());
        $v->rule('length','short_name',30);

        foreach($this->elements as $key=>$field) {
            if (!$field instanceof \Model\Field) {
                continue;
            }
            $field->validate($v);
        }
        if ($v->validate()===true) {
            return parent::validate($intent);
        }
        $errors = parent::validate($intent);

        foreach($v->errors() as $key=>$e){ 
            if (!isset($errors[$key])) {
                $errors[$key] = array_pop($e);
            }
        }
        return $errors;
    }
}
