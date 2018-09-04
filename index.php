<?php

require 'vendor/autoload.php';
    
$app = new \atk4\ui\App('Database');
$app->initLayout('Centered');

$db = $app->dbConnect('mysql://root:root@localhost/local_validation');

class App extends \Model\MyModel {
    public $table = 'app';
    function init(){
        parent::init();

        $this->addField('name');
        $this->addField('short_name', [
             'validate'=>'length',
            'required'=>true,
            'ui'=>[
                'hint'=>'This name may only contain alphanumeric characters and it should be valid namespace identifier, e.g. "MyApp"'
            ]
        ]);
    }
   
    }

    $user = new App($db);
    $table= $app->add('CRUD');
    $table->setModel($user);


