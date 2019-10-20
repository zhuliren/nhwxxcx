<?php


namespace app\index\controller;


use think\Db;

class User
{
    public function login(){
        $code = $_REQUEST['code'];
        $appid = 'wx4e2c7fa0914cd4a1';
        $secret= '7e5ce5d55bd3dbbbc3bbb5ec72182d70';
        $URL = "https://api.weixin.qq.com/sns/jscode2session?appid=$appid&secret=$secret&js_code=$code&grant_type=authorization_code";
        $header[] = "Cookie: " . "appver=1.5.0.75771;";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $URL);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($ch, CURLOPT_REFERER, '');
        $output = curl_exec($ch);
        curl_close($ch);
        $output = json_decode($output, true);
        if (isset($output['openid']) || (isset($output['errcode']) ? $output['errcode'] : 0) == 0) {
            $openid = $output['openid'];
            //判断是否为代理商
            $userdata = Db::table('tbl_user')->where('wxid', $openid)->find();
            if ($userdata) {
                $uid = $userdata['id'];
                $data = array('status' => 0, 'msg' => '成功', 'data' => array('uid'=>$uid,'f'=>1));
            } else {
                $uid = Db::table('tbl_user')->insertGetId(['wxid' => $openid, 'creattime' => date("Y-m-d H:i:s", time())]);
                $data = array('status' => 0, 'msg' => '成功', 'data' => array('uid'=>$uid,'f'=>0));
            }
            return json($data);
        } else if ($output['errcode'] == 40029) {
            $data = array('status' => 1, 'msg' => 'code无效', 'data' => '');
            return json($data);
        } else if ($output['errcode'] == 45011) {
            $data = array('status' => 1, 'msg' => '频率限制，每个用户每分钟100次', 'data' => '');
            return json($data);
        } else if ($output['errcode'] == -1) {
            $data = array('status' => 1, 'msg' => '微信系统繁忙稍后再试', 'data' => '');
            return json($data);
        } else if ($output['errcode'] == 40163) {
            $data = array('status' => 1, 'msg' => 'code已经被使用了', 'data' => '');
            return json($data);
        }
    }

    public function updateUserInfo(){
        $nickName = $_REQUEST['nickName'];
        $avatarUrl = $_REQUEST['avatarUrl'];
        $gender = $_REQUEST['gender'];
        $city = $_REQUEST['city'];
        $province = $_REQUEST['province'];
        $country = $_REQUEST['country'];
        $uid = $_REQUEST['uid'];
        $dbreturn  = Db::table('tbl_user')->where('id',$uid)->update(['avatarUrl'=>$avatarUrl,'nickName'=>$nickName,'gender'=>$gender,'city'=>$city,'province'=>$province,'country'=>$country]);
        if($dbreturn == 1){
            $returndata = array('status' => 0, 'msg' => '成功', 'data' => '');
        }else{
            $returndata = array('status' => 1, 'msg' => '更新失败', 'data' => '');
        }
        return json($returndata);
    }
}