<?php


namespace app\index\controller;

// TODO creat by zhuliren

use think\Db;

class Shop
{
    public function addShop()
    {
        $shop_name = $_REQUEST['shopname'];
        $shop_phone = $_REQUEST['shopphone'];
        $shop_add = $_REQUEST['shopadd'];
        $dbreturn = Db::table('tbl_shop')->insert(['shop_name' => $shop_name, 'shop_phone' => $shop_phone, 'shop_add' => $shop_add]);
        if($dbreturn == 1){
            $returndata = array('status' => 0, 'msg' => '成功', 'data' => '');
        }else{
            $returndata = array('status' => 1, 'msg' => '插入失败', 'data' => '');
        }
        return json($returndata);
    }

    public function updateShop()
    {

    }

    //获取店铺信息
    public function getShopInfo()
    {
        $shop_id = $_REQUEST['id'];
        $shopdata = Db::table('tbl_shop')->where('id', $shop_id)->select();
        if ($shopdata) {
            $returndata = array('status' => 0, 'msg' => '成功', 'data' => $shopdata);
        } else {
            $returndata = array('status' => 1, 'msg' => '无数据', 'data' => '');
        }
        return json($returndata);
    }
}