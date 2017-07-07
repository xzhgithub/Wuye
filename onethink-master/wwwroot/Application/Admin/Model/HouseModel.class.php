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
        array('tel', 'require', '电话不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
        array('price', 'require', '价格电话不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
        array('address', 'require', '地址电话不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
        array('size', 'require', '面积电话不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
    );

    protected $_auto = array(
        array('create_time', NOW_TIME, self::MODEL_INSERT),
        array('update_time', NOW_TIME, self::MODEL_BOTH),
        array('status', '1', self::MODEL_INSERT),
    );


}