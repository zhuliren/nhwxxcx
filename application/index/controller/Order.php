<?php


namespace app\index\controller;


use think\Db;

// TODO creat by zhuliren

class Order
{
    //创建订单接口
    public function creatOrder(){
        //订单号、创建时间、用户id、预计送达时间、支付状态
    }

    //订单支付接口
    public function payOrder(){

    }

    //订单列表接口
    public function orderList(){

    }

    //订单详情接口
    public function orderData(){

    }

    //订单发货接口
    public function orderSend(){

    }

    //订单取消接口
    public function orderCanle(){

    }

    //订单送达接口
    public function orderFinish(){

    }

    //删除订单接口
    public function delOrder(){

    }

    public function getFare(){
        $shopid = $_REQUEST['shopid'];
        return json(array('status' => 0, 'msg' => '成功', 'data' => array('fare'=>10)));
    }
}