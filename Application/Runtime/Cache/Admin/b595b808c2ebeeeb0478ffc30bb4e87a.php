<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>后台管理界面</title>
    <link rel="stylesheet" href="/exhibition/Public/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="/exhibition/Public/css/mystyle.css"/>
</head>
<body>
<div class="container">
    <div class="page-header">
        <h1 style="display:inline-block">Management</h1>
        <a id="logout" style="float:right;line-height:77px">退出登录</a>
    </div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>小组名</th>
            <th>球队名</th>
            <th>修改</th>
            <th>删除</th>
        </tr>
        </thead>

        <tbody>

        <?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
                <th scope="row"><?php echo ($vo["num"]); ?></th>
                <td><?php echo ($vo["belongs"]); ?></td>
                <td><?php echo ($vo["team"]); ?></td>
                <td>
                    <span class="glyphicon glyphicon-pencil update" aria-hidden="true"></span>
                </td>
                <td>
                    <span class="glyphicon glyphicon-remove delete" aria-hidden="true"></span>
                </td>

            </tr><?php endforeach; endif; ?>

        </tbody>
    </table>


    <form class="form-inline" style="display: inline-block" action="/exhibition/index.php/Admin/index/groupAdd" method="post">
        <div class="form-group">
            <label>小组名</label>
            <input type="text" class="form-control" name="group" placeholder="小组名">
        </div>
        <button type="submit" class="btn btn-default">添加</button>
    </form>

    <form class="form-inline" style="display: inline-block" action="/exhibition/index.php/Admin/index/groupDelete" method="post">
        <div class="form-group">
            <input type="text" class="form-control" name="group" placeholder="小组名">
        </div>
        <button type="submit" class="btn btn-default">删除</button>
    </form>



    <form class="form-inline" style="padding:20px 0;border-bottom: 1px solid #eee;" method="post" action="/exhibition//index.php/Admin/index/teamAdd">
        <label for="team">球队名</label>
        <div class="form-group">
            <label class="sr-only" for="exampleInputPassword3">Password</label>
            <input type="text" class="form-control" id="exampleInputPassword3" name="team" placeholder="球队名">
        </div>

        <label for="group">小组名</label>
        <select name="group" class="form-control">
            <?php if(is_array($group)): foreach($group as $key=>$vo): ?><option ><?php echo ($vo["group"]); ?></option><?php endforeach; endif; ?>
        </select>
        <button type="submit" class="btn btn-default">添加</button>
    </form>

    <form action="/exhibition/index.php/Admin/index/upload" style="padding:20px 0" enctype="multipart/form-data" method="post" >
        <label>背景图片</label>
        <input type="file" name="photo" />
        <button type="submit" style="margin-top:20px" class="btn btn-default">添加</button>
    </form>



</div>
<div class="shade">
    <span class="glyphicon glyphicon-remove close" aria-hidden="true"></span>
    <div class="form_wrapper">
        <div class="form-group">
            <label for="exampleInputEmail1">小组名</label>
            <input type="text" class="form-control" id="updateGroup" placeholder="小组名">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">球队名</label>
            <input type="text" class="form-control" id="updateTeam" placeholder="球队名">
        </div>
        <button type="submit" class="btn btn-default" id="update">Submit</button>
    </div>
</div>
<script src="/exhibition/Public/js/jquery.js"></script>
<script src="/exhibition/Public/js/bootstrap.min.js"></script>
<script src="/exhibition/Public/js/admin.js"></script>
</body>
</html>