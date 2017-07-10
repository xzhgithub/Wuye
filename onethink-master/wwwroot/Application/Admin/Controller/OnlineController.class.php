<?php
/**
 * Created by PhpStorm.
 * User: 12195
 * Date: 2017/7/10
 * Time: 11:18
 */

namespace Admin\Controller;


class OnlineController extends AdminController
{
    //保修管理
    public function index(){

        $status=[-1=>'删除',0=>'未处理',1=>'处理完成'];

        $onlines=M('Online')->where('status!=-1')->select();
        $this->assign('onlines',$onlines);
        $this->assign('status',$status);
        $this->display();

    }

    //新增保修
    public function add(){
        if(IS_POST){
//            var_dump(11);exit;
            $Online = M('Online');
            $data = $Online->create();
//            var_dump($data);exit;
            if($data){
                $id = $Online->add();
                if($id){
                    $this->success('新增成功', U('index'));
                    //记录行为
                    action_log('update_online', 'online', $id, UID);
                } else {
                    $this->error('新增失败');
                }
            } else {
                $this->error($Online->getError());
            }
        } else {

            $this->assign('info',null);
            $this->meta_title = '新增报修';
            $this->display('add');
        }
    }

}