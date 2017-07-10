<?php
/**
 * Created by PhpStorm.
 * User: 12195
 * Date: 2017/7/9
 * Time: 11:23
 */

namespace Wechat\Controller;


use Think\Controller;

class HuodongController extends Controller
{

    //参加活动
    public function canjia(){

        //获取用户id
        $member_id=session ( 'user_auth' )['uid'];
        if(!$member_id){
            $this->ajaxReturn(['status'=>2]);
//            $this->error('您还没有登录，请先登录！',U('User/login'));
        }else{
            //将参加活动信息保存
            //获取该活动信息
            $id=I('id');
            $huodong=M('document')->where(['id'=>$id])->find();
            //判断是否已参加过
            $map['title']=$huodong['title'];
            $map['member_id']=$member_id;
            $action=M('Huodong')->where($map)->find();
            if($action){//已参加过该活动
                $result=['status'=>-1];
            }else{
                //添加
                $data['title']=$huodong['title'];
                $data['detail']=$huodong['description'];
                $data['deadline']=$huodong['deadline'];
                $data['creat_time']=time();
                $data['member_id']=$member_id;
                $data['status']=0;
                $data['check']=0;
                $re=M('Huodong')->add($data);
                if($re){
                    $result=['status'=>1];

                }else{
                    $result=['status'=>0];
                }
            }


            $this->ajaxReturn($result);



        }


    }
}