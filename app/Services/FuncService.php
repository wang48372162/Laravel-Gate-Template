<?php

namespace App\Services;

use Parsedown;
use HTMLPurifier;
use HTMLPurifier_Config;

class FuncService
{
    public function slug($text, $slugStr = '_')
    {
        $text = preg_replace('/[ |\/]/', $slugStr, $text);
        $text = strtolower($text);
        return $text;
    }

    public function htmlpurifier($text)
    {
        $config = HTMLPurifier_Config::createDefault();
        $config->set('HTML.Allowed', 'div,span,cite,del,i,b,p,img[src],a[href],br,h1,h2,h3,h4,h5,h6,ul,ol,li,table,tbody,thead,tfoot,tr,th,td,pre,code,blockquote');
        $purifier = new HTMLPurifier($config);
        return $purifier->purify($text);
    }

    public function parsedown($text)
    {
        return $this->htmlpurifier(Parsedown::instance()->text($text));
    }
}
