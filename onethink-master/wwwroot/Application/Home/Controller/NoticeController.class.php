<?php
/**
 * Created by PhpStorm.
 * User: 12195
 * Date: 2017/7/7
 * Time: 17:50
 */

namespace Home\Controller;


use Think\Controller;

class NoticeController extends Controller
{
    //小区通知首页
    public function index(){
        $notices=M('document')->select();
        $this->assign('list',$notices);
        $this->display('notice');
    }

    //详情
    public function detail(){
        $id=I('get.id');
        $notice=M('document')->where(['id'=>$id])->find();
        $detail=M('document_article')->where(['id'=>$id])->find();
        $this->assign('notice',$notice);
        $this->assign('detail',$detail);
        $this->display('notice-detail');
    }
}