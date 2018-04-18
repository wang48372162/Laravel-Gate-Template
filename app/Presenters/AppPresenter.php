<?php

namespace App\Presenters;

use Parsedown;
use App\Services\FuncService;

class AppPresenter
{
    protected $func;

    public function __construct(FuncService $funcService)
    {
        $this->func = $funcService;
    }

    public function parsedown($text)
    {
        return $this->func->parsedown($text);
    }

    public function parsedown_str($text)
    {
        return strip_tags($this->parsedown($text));
    }
}
