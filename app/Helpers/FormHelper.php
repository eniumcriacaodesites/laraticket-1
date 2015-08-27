<?php

namespace App\Helpers;


class FormHelper
{
    public static function objectsToKeyValueArray($objectArray,$keyProperty,$valueProperty){
        $array = [];
        foreach($objectArray as $object){
            $arrayItem = self::objectToKeyValueArray($object,$keyProperty,$valueProperty);
            if($arrayItem){
                $array[$arrayItem['key']] = $arrayItem['value'];
            }
        }
        return $array;
    }
    public static function objectToKeyValueArray($object,$keyProperty,$valueProperty){
        $arrayItem = false;
        if(isset($object->$keyProperty) && isset($object->$valueProperty)){
            $arrayItem = [
                'key' => $object->$keyProperty,
                'value' => $object->$valueProperty,
            ];
        }
        return $arrayItem;
    }
}