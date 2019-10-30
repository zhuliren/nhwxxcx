<?php


namespace app\index\controller;


use think\Db;

class Goods
{
    public function addLx(){
        $shop_id = $_REQUEST['shopid'];
        $lx_name = $_REQUEST['lxname'];
        $full = $_REQUEST['full'];
    }

    public function updateLx(){

    }

    public function delLx(){

    }

    public function getLxList(){

    }

    public function addGoods(){

    }

    public function updateGoods(){

    }

    public function delGoods(){

    }

    public function getGoodsList(){

    }
    
    public function getGoodsInfo(){

    }

    public function getGoodsWithLx(){
        $shopid = $_REQUEST['shopid'];
        $lxdata = Db::table('tbl_lx')->where('used',1)->where('shopid',$shopid)->column('id,name,icon as iconName');
        $lx = array();
        $goodswithlx = array();
        $i=0;
        foreach ($lxdata as $item){
            $lxid = $item['id'];
            $item['isDiscount']=false;
            $item['id']='link'.$i;
            $lx[] = $item;
            $goodsdata = Db::table('tbl_goods')->where('used',1)->where('lxid',$lxid)->column('id as no,img as iconName,name as titleName,specs as ingredient,introduce as "describe",uprice as nowPrice');
            $goods = array();
            foreach ($goodsdata as $gitem) {
                $gitem['isEmpty']=false;
                $gitem['soucePrice']='';
                $gitem['selectFlag']='isAdd';
                $goods[]=$gitem;
            }
            $newitem = array('id'=>$item['id'],'linkName'=>$item['name'],'detailed'=>$goods);
            $goodswithlx[] = $newitem;
            $i++;
        }
        $returndata = array('linkList'=>$lx,'detailedList'=>$goodswithlx);
        $data = array('status' => 0, 'msg' => '成功', 'data' => $returndata);
        return json($data);
    }
}