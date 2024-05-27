<?php

use App\Models\StoreFront;
use App\Models\StoreFrontMenu;

$robi = 'hello';

if (!function_exists('customHelperFunction')) {
    function domainByUserId() 
    {
        $author = 'https://'.$_SERVER['HTTP_HOST'];
        $parsed_url = parse_url($author);
        $domain = $parsed_url['host'];
        $domain = preg_replace('/^www\./', '', $domain);
        $result = StoreFront::where('domain', $domain)->first();

        if(isset($result)) {
            return $result->user_id; //return user_id
        } else {
            return abort(403, 'Unauthorized access');
        }
    }

    function domainDetail() 
    {
        $author = 'https://'.$_SERVER['HTTP_HOST'];
        $parsed_url = parse_url($author);
        $domain = $parsed_url['host'];
        $domain = preg_replace('/^www\./', '', $domain);
        $result = StoreFront::where('domain', $domain)->first();
        if(isset($result)) {
            return $result;
        } else {
            return abort(403, 'Unauthorized access');
        }
    }

    function Menus()
    {
        $user_id = domainByUserId();
        return StoreFrontMenu::where('user_id', $user_id)->get();
    }
}