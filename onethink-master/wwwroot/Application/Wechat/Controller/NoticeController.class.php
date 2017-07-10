<?php
/**
 * Created by PhpStorm.
 * User: 12195
 * Date: 2017/7/7
 * Time: 17:50
 */

namespace Wechat\Controller;


use Think\Controller;

class NoticeController extends HomeController
{
    //С��֪ͨ��ҳ
    public function index(){

        $notices=M('document')->where(['category_id'=>41])->limit(2)->select();
        //��ȡͼƬ
        $imgs=[];
            foreach ($notices as $notice) {
                $picture=M('picture')->where(['id'=>$notice['cover_id']])->find();
                $imgs[$notice['cover_id']]=$picture['path'];
            }

//        dump($imgs);exit;

        $this->assign('list',$notices);
        $this->assign('imgs',$imgs);
        $this->display('notice');
    }

    //����
    public function detail(){
        $id=I('get.id');
        //���������
        M('document')->where("id=$id")-> setInc('view',1);

        $notice=M('document')->where(['id'=>$id])->find();
        $detail=M('document_article')->where(['id'=>$id])->find();
        $this->assign('notice',$notice);
        $this->assign('detail',$detail);
        $this->display('notice-detail');
    }

    //ajax�����ȡ��������
    public function get(){
        $num=I('num');
        $notices=M('document')->where(['category_id'=>41])->limit(2*($num-1),2)->select();
        //��ȡͼƬ
        $imgs=[];
        foreach ($notices as $notice) {
            $picture=M('picture')->where(['id'=>$notice['cover_id']])->find();
            $imgs[$notice['cover_id']]=$picture['path'];
        }
        $data=[];
        $data['notices']=$notices;
        $data['imgs']=$imgs;

        $this->ajaxReturn($data);
    }
}