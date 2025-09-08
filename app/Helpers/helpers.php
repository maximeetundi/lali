<?php


if (! function_exists('gen_text')) {
    function gen_text($texts, $name, $val = 'fr', $attr = 'name')
    {
        return $texts->where($attr ,$name)->first() <> null ? $texts->where($attr ,$name)->first()->$val : '';
    }
}

if (! function_exists('getUrlMedia')) {
    function getUrlMedia($model)
    {
       if ($model->media->first() == null) {
            return '';
       }
       else{
        return $model->media->first()->getUrl();
       }
    }
}