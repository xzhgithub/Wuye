<?php
/**
 * Created by PhpStorm.
 * User: 12195
 * Date: 2017/7/6
 * Time: 12:00
 */

namespace Admin\Controller;


use Admin\Model\AuthGroupModel;

class HouseController extends AdminController
{
    //房屋租售列表
    public function index(){
        //获取数据总条数
        $count=D('House')->where(['status'=>1])->count();
        //实例化分页类
        $page = new \Think\Page($count ,5);
        //限制输出
        $limit = $page->firstRow . ',' . $page->listRows;
        $list = M('House')->where(['status'=>1])->order('level DESC,id DESC')->limit($limit)->select();

        //设置分页主体，显示共有多少条记录
        $page->setconfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $this->assign('list', $list);
        $this->assign('page', $page->show());
        $this->meta_title = '租售管理';
        $this->display();
    }

    //添加房屋租售
    public function add(){
        if(IS_POST){
//            var_dump(11);exit;
            $House = D('House');
            $data = $House->create();
//            var_dump($data);exit;
            if($data){
                $id = $House->add();
                if($id){
                    $this->success('新增成功', U('index'));
                    //记录行为
                    action_log('update_house', 'house', $id, UID);
                } else {
                    $this->error('新增失败');
                }
            } else {
                $this->error($House->getError());
            }
        } else {

            $this->assign('info',null);
            $this->meta_title = '新增租售';
            $this->display('add');
        }
    }

    //修改房屋租售
    public function edit($id = 0){
        if(IS_POST){
            $House = D('House');
            $data = $House->create();
            if($data){
                    if($House->save()){
                        //记录行为
                        action_log('update_house', 'house', $data['id'], UID);
                        $this->success('编辑成功', U('index'));
                    } else {
                        $this->error('编辑失败');
                    }

            } else {
                $this->error($House->getError());
            }
        } else {
            $info = array();
            /* 获取数据 */
            $info = M('House')->find($id);

            if(false === $info){
                $this->error('获租售信息错误');
            }
            $this->assign('info',$info);
            $this->meta_title = '修改租售';
            $this->display('add');
        }
    }

    //删除
    public function del(){
        //接收并移除重复的id
        $id = array_unique((array)I('id',0));

        if ( empty($id) ) {
            $this->error('请选择要操作的数据!');
        }

        $map = array('id' => array('in', $id) );
        if(M('House')->where($map)->delete()){
            //记录行为
            action_log('update_house', 'house', $id, UID);
            $this->success('删除成功');
        } else {
            $this->error('删除失败！');
        }
    }

    //批量删除
    public function changeStatus($method=null){
        $id = array_unique((array)I('id',0));

        $id = is_array($id) ? implode(',',$id) : $id;
        if ( empty($id) ) {
            $this->error('请选择要操作的数据!');
        }

        $map['id'] =   array('in',$id);
        switch ( strtolower($method) ){
            case 'forbidhouse':
                $this->forbid('House', $map );
                break;
            case 'resumehouse':
                $this->resume('House', $map );
                break;
            case 'deletehouse':
                $this->delete('House', $map );
                break;
            default:
                $this->error('参数非法');
        }
    }

    /**
     * 文档排序
     * @author huajie <banhuajie@163.com>
     */
    public function sort(){
        if(IS_GET){
            //获取左边菜单
            $this->getMenu();

            $ids        =   I('get.ids');
            $cate_id    =   I('get.cate_id');
            $pid        =   I('get.pid');

            //获取排序的数据
            $map['status'] = array('gt',-1);
            if(!empty($ids)){
                $map['id'] = array('in',$ids);
            }else{
                if($cate_id !== ''){
                    $map['category_id'] = $cate_id;
                }
                if($pid !== ''){
//                    $map['pid'] = $pid;
                }
            }
            $list = M('House')->where($map)->field('id,title')->order('level DESC,id DESC')->select();

            $this->assign('list', $list);
            $this->meta_title = '文档排序';
            $this->display();
        }elseif (IS_POST){
            $ids = I('post.ids');
            $ids = array_reverse(explode(',', $ids));
            foreach ($ids as $key=>$value){
                $res = M('House')->where(array('id'=>$value))->setField('level', $key+1);
            }
            if($res !== false){
                $this->success('排序成功！');
            }else{
                $this->error('排序失败！');
            }
        }else{
            $this->error('非法请求！');
        }
    }


    /**
     * 显示左边菜单，进行权限控制
     * @author huajie <banhuajie@163.com>
     */
    protected function getMenu(){
        //获取动态分类
        $cate_auth  =   AuthGroupModel::getAuthCategories(UID); //获取当前用户所有的内容权限节点
        $cate_auth  =   $cate_auth == null ? array() : $cate_auth;
        $cate       =   M('Category')->where(array('status'=>1))->field('id,title,pid,allow_publish')->order('pid,sort')->select();

        //没有权限的分类则不显示
        if(!IS_ROOT){
            foreach ($cate as $key=>$value){
                if(!in_array($value['id'], $cate_auth)){
                    unset($cate[$key]);
                }
            }
        }

        $cate           =   list_to_tree($cate);    //生成分类树

        //获取分类id
        $cate_id        =   I('param.cate_id');
        $this->cate_id  =   $cate_id;

        //是否展开分类
        $hide_cate = false;
        if(ACTION_NAME != 'recycle' && ACTION_NAME != 'draftbox' && ACTION_NAME != 'mydocument'){
            $hide_cate  =   true;
        }

        //生成每个分类的url
        foreach ($cate as $key=>&$value){
            $value['url']   =   'Article/index?cate_id='.$value['id'];
            if($cate_id == $value['id'] && $hide_cate){
                $value['current'] = true;
            }else{
                $value['current'] = false;
            }
            if(!empty($value['_child'])){
                $is_child = false;
                foreach ($value['_child'] as $ka=>&$va){
                    $va['url']      =   'Article/index?cate_id='.$va['id'];
                    if(!empty($va['_child'])){
                        foreach ($va['_child'] as $k=>&$v){
                            $v['url']   =   'Article/index?cate_id='.$v['id'];
                            $v['pid']   =   $va['id'];
                            $is_child = $v['id'] == $cate_id ? true : false;
                        }
                    }
                    //展开子分类的父分类
                    if($va['id'] == $cate_id || $is_child){
                        $is_child = false;
                        if($hide_cate){
                            $value['current']   =   true;
                            $va['current']      =   true;
                        }else{
                            $value['current']   =   false;
                            $va['current']      =   false;
                        }
                    }else{
                        $va['current']      =   false;
                    }
                }
            }
        }
        $this->assign('nodes',      $cate);
        $this->assign('cate_id',    $this->cate_id);

        //获取面包屑信息
        $nav = get_parent_category($cate_id);
        $this->assign('rightNav',   $nav);

        //获取回收站权限
        $this->assign('show_recycle', IS_ROOT || $this->checkRule('Admin/article/recycle'));
        //获取草稿箱权限
        $this->assign('show_draftbox', C('OPEN_DRAFTBOX'));
        //获取审核列表权限
        $this->assign('show_examine', IS_ROOT || $this->checkRule('Admin/article/examine'));
    }






}