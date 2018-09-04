<?php
namespace Model;
require 'vendor/autoload.php';

class Field extends \atk4\data\Field_SQL
{
    /**
     * Describes arbitrary validation rules
     */
    public $validate = [];

    function validate($v) {
        if ($this->validate) {
            if (is_array($this->validate)) {
                foreach($this->validate as $k=>$v) {
                    $v->rule($k, $this->short_name, $v);
                }
            } else {
                $v->rule($this->validate, $this->short_name);
            }
        }
    }

}