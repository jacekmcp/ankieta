<?php
/**
 * Created by PhpStorm.
 * User: jacek
 * Date: 30.01.19
 * Time: 00:08
 */

class formCreator
{

    private $algType;
    private $sqlHandler;


    public function createForm(){

        require_once "sqlHandler.php";

        $sqlHandler = new sqlHandler();


        $algType = $sqlHandler->getAlgType();


        return $this->getPhotosNODB($algType);
    }


    private function getPhotosNODB($algType){

        $groundtruth = [];

        $pathGT = $this->preparePathPattern('groundtruth');
        $algPath = $this->preparePathPattern($algType);
        for($i = 1; $i < 25; $i++){
            $groundtruth[] = array($pathGT.'/'.$i.'.jpg',$algPath.'/'.$i.'.jpg');
        }


        return $groundtruth;
    }

    private function preparePathPattern($algType){

        return 'resources/touringTest/'.$algType;

    }


}