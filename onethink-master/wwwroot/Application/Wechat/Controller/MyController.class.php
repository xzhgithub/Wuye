<?php
/**
 * Created by PhpStorm.
 * User: 12195
 * Date: 2017/7/10
 * Time: 10:31
 */

namespace Wechat\Controller;


class MyController extends HomeController
{
    public function index(){
        $this->display('my');
    }

}