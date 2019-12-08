<?php
/**
* Class Form
* Allowed to create some html tags 
*  
*/
namespace libraries;

class Form{
    public function Open(Array $atributes = []){
        $attrs = '';
        foreach ($atributes as $key=>$value){
            $attrs .= $key . "=" . "$value" . ' ';
        }
        return "<form $attrs>";
    }
    public function Input(Array $atributes){
        $attrs = '';
        foreach ($atributes as $key=>$value){
            $attrs .= $key . "=" . "$value " . ' ';
        }
        return "<input $attrs>";
    }
    public function Button($name, Array $atributes){
        $attrs = '';
        foreach ($atributes as $key=>$value){
            $attrs .= $key . "=" . "$value" . ' ';
        }
        return "<button $attrs>" . $name . "</button>";
    }
    public function Textarea(Array $atributes){
        $attrs = '';
        foreach ($atributes as $key=>$value){
            $attrs .= $key . "=" . "$value" . ' ';
        }
        return "<textarea  $attrs > </textarea>";
    }
    public function Password(Array $atributes){
        $attrs = '';
        foreach ($atributes as $key=>$value){
            $attrs .= $key . "=" . "$value" . ' ';
        }
        return "<input type = 'password'  $attrs >";
    }
    public function Close(){
        return "</form>";
    }
    public function CreateTag($tag, array $atributes = []){
        $attrs = '';
        foreach ($atributes as $key=> $value){
            $attrs .= $key . "=" . "$value" . ' ';
        }
        return "<$tag $attrs>";
    }
    public function CloseTag($closeTag){
        return "</$closeTag>";
    }
}
