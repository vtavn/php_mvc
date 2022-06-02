<?php

class Response
{
    public function redirect($uri=''){
        if (preg_match('~^(http|https)~is', $uri)){
            $url = $uri;
        }else{
            $url = _WEB_ROOT.'/'.$uri;
        }
        echo $url;
        header('Location: '.$url);
        exit();
    }
}