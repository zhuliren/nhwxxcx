<?php
namespace app\index\controller;

use think\Db;

class Index
{
    public function index()
    {
        $shop_id = $_REQUEST['shopid'];
        //首先查询商品类型表并返回相关数据
        $lxdata = Db::table('tbl_goods_lx')->where('shop_id',$shop_id)->select();
        //定义一个空数据用于存放整合后需要返回的数据
        $returndata =array();
        //foreach遍历循环将数据库查询出来的数组进行遍历 按照循环次数赋值给新的变量$item
        foreach($lxdata as $item){
            //将item中id值取出
            $lx_id = $item['id'];
            //根据商品类型id查询对应的商品列表
            $goodsdata = Db::table('tbl_goods')->where('goods_lx_id',$lx_id)->select();
            //将查询结果复制给item中新建的键名
            $item['goodslist']=$goodsdata;
            //复制给之前定义的空数组
            $returndata[]=$item;
        }

       return json($returndata);
    }
}
