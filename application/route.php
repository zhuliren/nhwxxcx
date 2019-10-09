<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use think\Route;

//Route::rule('路由表达式','路由地址','请求类型','路由参数（数组）','变量规则（数组）');

//Shop模块路由
Route::rule('getShopInfo','index/Shop/getShopInfo');
Route::rule('addShop','index/Shop/addShop');
Route::rule('delShop','index/Shop/delShop');
Route::rule('updateShop','index/Shop/updateShop');
Route::rule('getShopList','index/Shop/getShopList');

//Order模块路由


