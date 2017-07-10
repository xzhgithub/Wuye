<?php
/**
 * Created by PhpStorm.
 * User: 12195
 * Date: 2017/7/7
 * Time: 11:46
 */

namespace Wechat\Controller;


use Think\Controller;

class HouseController extends Controller
{

    //小区租售
    public function index(){

        //获取小区租售信息

        $map1  = array('status' => array('gt', -1), 'type'=>0);
        $map2  = array('status' => array('gt', -1), 'type'=>1);
        $house1=D('House')->where($map1)->select();
        $house2=D('House')->where($map2)->select();

        $imgs=M('picture')->select();
        $picture=[];
        foreach($imgs as $img){
            $picture[$img['id']]=$img['path'];
        }

        $this->assign('list',$house1);
        $this->assign('list2',$house2);
        $this->assign('picture',$picture);
        $this->display('zushou');

    }

    //租售详情
    public function detail(){
        $id=I('get.id');
        $map  = array('status' => array('gt', -1), 'id'=>$id);
        $detail=D('House')->where($map)->find();
//        dump($detail);exit;
        $imgs=M('picture')->select();
        $picture=[];
        foreach($imgs as $img){
            $picture[$img['id']]=$img['path'];
        }
//
        $this->assign('detail',$detail);
        $this->assign('picture',$picture);
        $this->display('zushou-detail');
    }
}