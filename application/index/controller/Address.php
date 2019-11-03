<?php


namespace app\index\controller;


use think\Db;

class Address
{
    public function creatAdd(){
        $userid = $_REQUEST['userid'];
        $name = $_REQUEST['name'];
        $phone = $_REQUEST['phone'];
        $address = $_REQUEST['address'];
        $fulladdress = $_REQUEST['fulladdress'];
        $default = $_REQUEST['default'];
        $defaultint = 0;
        if($default){
            Db::table('tbl_address')->where('userid',$userid)->where('default',1)->update(['default'=>0]);
            $defaultint = 1;
        }
        $dbreturn = Db::table('tbl_address')->insertGetId(['userid'=>$userid,'name'=>$name,'phone'=>$phone,'address'=>$address,'fulladdress'=>$fulladdress,'default'=>$defaultint,]);
        if($dbreturn){
            return json(array('status' => 0, 'msg' => '成功', 'data' => ''));
        }else{
            return json(array('status' => 1, 'msg' => '失败', 'data' => ''));
        }
    }

    public function updateAdd(){
        $addid = $_REQUEST['addid'];
        $name = $_REQUEST['name'];
        $phone = $_REQUEST['phone'];
        $address = $_REQUEST['address'];
        $fulladdress = $_REQUEST['fulladdress'];
        $default = $_REQUEST['default'];
        $defaultint = 0;
        if($default){
            $defaultint = 1;
        }
        $dbreturn = Db::table('tbl_address')->where('id',$addid)->update(['name'=>$name,'phone'=>$phone,'address'=>$address,'fulladdress'=>$fulladdress,'default'=>$defaultint,]);
        if($dbreturn==1){
            return json(array('status' => 0, 'msg' => '成功', 'data' => ''));
        }else{
            return json(array('status' => 1, 'msg' => '失败', 'data' => ''));
        }
    }

    public function getAddList(){
        $userid = $_REQUEST['userid'];

    }
}