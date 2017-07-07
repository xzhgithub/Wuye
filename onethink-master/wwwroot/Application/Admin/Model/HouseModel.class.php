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
        array('title', 'require', '���ⲻ��Ϊ��', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
        array('tel', 'require', '�绰����Ϊ��', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
        array('price', 'require', '�۸�绰����Ϊ��', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
        array('address', 'require', '��ַ�绰����Ϊ��', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
        array('size', 'require', '����绰����Ϊ��', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
    );

    protected $_auto = array(
        array('create_time', NOW_TIME, self::MODEL_INSERT),
        array('update_time', NOW_TIME, self::MODEL_BOTH),
        array('status', '1', self::MODEL_INSERT),
    );


}