/**
 * Created by liuhuizhi on 15/10/15.
 */



$(function() {

    $('.update').bind('click',function(){
        $(".shade").show();
        $id = $(this).parent().parent().children().eq(0).html();
        self = $(this);

        $('.close').bind('click',function(){
            $(".shade").hide()
        })


        $("#update").bind('click',function(){
            $group = $("#updateGroup").val();
            $team = $("#updateTeam").val();
            $.ajax({
                type:"POST",
                url:'/exhibition/index.php/Admin/index/update',
                data:{id:$id,group:$group,team:$team},
                success:function(data){
                    alert('更新成功');
                    $(".shade").hide()
                },
                error:function(){
                    alert('修改失败');
                }
            })
        })
    });


    $(".delete").bind('click',function(){
        $data = $(this).parent().parent().children().eq(0).html();
        self = $(this);
        $.ajax({
            type: "POST",
            url: "/exhibition/index.php/Admin/index/delete",
            data:{id:$data},
            success: function(data){
                self.parent().parent().remove();
                console.log(data);
            },
            error: function() {
                console.log('删除失败')
            }
        })
    })


    $("#logout").bind('click',function(){
        $.ajax({
            type:'get',
            url:'/exhibition/index.php/Admin/index/logOut',
            data:{checkout:'true'},
            success:function(){
                alert('您已经退出登录')
                location.href = '/exhibition/index.php/Admin/index/login';
            },
            error:function(){
                alert('退出登录失败')
            }
        })
    })




})




