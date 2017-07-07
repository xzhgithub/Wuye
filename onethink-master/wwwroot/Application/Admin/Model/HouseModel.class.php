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
        array('tel', '/^1[35678]\d{9}$/', '�绰����ȷ', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
        array('price', 'number', '�۸���ȷ', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
        array('address', 'require', '��ַ����Ϊ��', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
        array('size', 'number', '�������Ϊ��', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
        array('detail', 'require', '��������Ϊ��', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
        array('over_time', 'require', '����ʱ�䲻��Ϊ��', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
    );

    protected $_auto = array(
        array('create_time', NOW_TIME, self::MODEL_INSERT),
        array('update_time', NOW_TIME, self::MODEL_BOTH),
        array('status', '1', self::MODEL_INSERT),
    );


}