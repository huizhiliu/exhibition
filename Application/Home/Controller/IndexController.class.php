<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        /*
          URL_MODEL
          1.默认模式
          http://localhost/tp/index.php/Home/Index/user/id/1.html
          0.普通模式
          http://localhost/tp/index.php?m=Home&c=Index&a=user&id=1
          2.重写模式
          http://localhost/tp/Home/Index/user/id/1.html
          3.兼容模式
          http://localhost/tp/index.php?s=/Home/Index/user/id/1.html
        */
        $this->display();
    }

    public function data(){
        $group = M("group");
        $team = M('team');

        $list = $group->field('group')->select();

        $ret = [];
        foreach ($list as $k => $v) {
            $_group = $v['group'];
            $_teamTmp = $team->where("belongs='$_group'")->field('team')->select();
            $__team = [];
            foreach ($_teamTmp as $__v) {
                $__team[] = $__v['team'];
            }
            $ret[$_group] = $__team;
        }
        echo $this->ajaxReturn($ret);
    }

    public function bg(){
        $bg = M('bgi');
        $bgi = $bg->where('ID=1')->select();
        echo $this->ajaxReturn($bgi);
    }


}