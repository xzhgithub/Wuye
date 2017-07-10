<?php
/**
 * Created by PhpStorm.
 * User: 12195
 * Date: 2017/7/8
 * Time: 13:25
 */

namespace Wechat\Controller;


use Think\Controller;

class XiaoquController extends Controller
{
    //С���
    public function index(){
        $time_now=time();
        $map  = array('status' => 1, 'category_id'=>42,'deadline'=>array('gt',$time_now));
        $active=M('document')->where($map)->limit(2)->select();
        //��ȡͼƬ
        $imgs=[];
        foreach ($active as $act) {
            $picture=M('picture')->where(['id'=>$act['cover_id']])->find();
            $imgs[$act['cover_id']]=$picture['path'];
        }


        $this->assign('list',$active);
        $this->assign('imgs',$imgs);
        $this->display();
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
        $this->display('huodong-detail');
    }

    //ajax�����ȡ��������
    public function get($num){
//        $num=I('num');
        $map  = array('status' => 1, 'category_id'=>42,'deadline'=>array('gt',time()));
        $notices=M('document')->where($map)->limit(2*($num-1),2)->select();
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