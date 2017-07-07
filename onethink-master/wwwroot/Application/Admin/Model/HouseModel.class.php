<?php
/**
 * Created by PhpStorm.
 * User: 12195
 * Date: 2017/7/6
 * Time: 14:04
 */

namespace Admin\Model;


use Think\Model;

class HouseModel extends Model
{
    protected $_validate = array(
        array('title', 'require', '标题不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
        array('tel', '/^1[35678]\d{9}$/', '电话不正确', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
        array('price', 'number', '价格不正确', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
        array('address', 'require', '地址不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
        array('size', 'number', '面积不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
        array('detail', 'require', '描述不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
        array('over_time', 'require', '截至时间不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
    );

    protected $_auto = array(
        array('create_time', NOW_TIME, self::MODEL_INSERT),
        array('update_time', NOW_TIME, self::MODEL_BOTH),
        array('status', '1', self::MODEL_INSERT),
    );


}