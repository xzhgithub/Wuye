<?php
/**
 * Created by PhpStorm.
 * User: 12195
 * Date: 2017/7/10
 * Time: 10:41
 */

namespace Wechat\Controller;


class OnlineController extends HomeController
{
    public function index(){
        $this->display('online');
    }

    //保存提交的保修信息
    public function up(){
        //获取用户id
        $member_id=session ( 'user_auth' )['uid'];
        //接收表单post传值
        $data['username']=I('post.username');
        $data['tel']=I('post.tel');
        $data['address']=I('post.address');
        $data['title']=I('post.title');
        $data['detail']=I('post.detail');
        $data['member_id']=$member_id;
        $data['status']=0;//0表示未处理，1表示已处理，-1 表示删除
        $data['create_time']=time();
        //保存
        $re=M('Online')->add($data);
        if($re){
            $this->success('操作完成',U('/Index/index'),3);
        }
    }
}