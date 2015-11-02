<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    //admin页面的渲染
    public function index(){
        if(!session('admin')){
            $this->redirect('index/login');
            return;
        }
        $Group = M("group");
        $data = $Group->field('group')->select();
        $this->assign('group',$data);
        $Team = M("team");
        $list= $Team->select();
        $this->assign('list',$list);
        $this->display();
    }



    //admin页面的主要操作
    public function groupAdd() {
        $Group = M("group");
        $group = I('post.group');
        if($group == ''){
            $this->error('请输入数据','/exhibition/index.php/Admin/');
        }
        $data['group'] = $group;
        $result = $Group->add($data);
        if($result){
            $this->success('添加成功','/exhibition/index.php/Admin/');
        }
    }

    public function groupDelete(){
        $Group = M("group");
        $Team = M("team");
        $group = I('post.group');
        $map = array(
          'group'=>  $group
        );
        $teamMap = array(
            'belongs'=> $group
        );
        $result = $Group->where($map)->delete();
        $teamResult = $Team->where($teamMap)->delete();
        if($result && $teamResult){
            $this->success('删除成功','/exhibition/index.php/Admin/');
        }else{
            $this->error('队名错误，删除失败','/exhibition/index.php/Admin/');
        }

    }
    public function teamAdd(){
        $Team = M("team");
        $team = I('post.team');
        $group = I('post.group');
        $data = array(
            team=>$team,
            belongs=>$group
        );
        $result = $Team->add($data);
        if($result){
            $this->success('添加成功','/exhibition/index.php/Admin/');
        }
    }

    public function delete(){
        $num = I('post.id');
        $Team = M("team");
        $result = $Team->where('num='.$num)->delete();
    }


    public function update() {
        $id = I('post.id');
        $group = I('post.group');
        $team = I('post.team');
        echo $group;
        $Team = M("team");
        $data['team'] = $team;
        $data['belongs'] = $group;
        $result = $Team->where('num='.$id)->save($data);
        dump($result);
        $data=$Team->select();
        dump($data);
    }



    //上传操作

    public  function upload(){
        $upload = new \Think\Upload();
        $upload->maxSize   =     3145728 ;
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');
        $upload->rootPath  =     './Uploads/';
        //上传信息
        $info   =   $upload->upload();
        if(!$info) {// 上传错误提示错误信息
            $this->error($upload->getError());
        }else{// 上传成功
            $bg = M('bgi');
            $url['src'] = './Uploads/'.$info['photo']['savepath'].$info['photo']['savename'];
            echo $url['src'];
            $result = $bg->where('ID=1')->save($url);
            if($result){
                $this->success('上传成功！','/exhibition/index.php/Admin/');
            }


        }
    }
    //登录页面

    public function login(){
        $this->display();
    }


    public function checkIn() {
        $name = 'admin';
        $pwd = md5('admin');
        $username = I('post.username');
        $password = md5(I('post.password'));
        if($username == $name && $password == $pwd){
            session('admin','true');
            $this->success('success','/exhibition/index.php/Admin/');
        }else{
            echo '<font color="red" text-align="center">输入错误</font>';
        }

    }

    public function logOut(){
        $checkout = I('get.checkout');
        if($checkout == 'true'){
            session('admin',null);
        }

    }
}