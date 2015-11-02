/**
 * Created by liuhuizhi on 15/10/18.
 */




$(function(){

    //setInterval(checkData,5000);

    checkData()

    $.ajax({
        type:'get',
        url:'/exhibition/index.php/Home/Index/bg',
        success:function(data){
            $('body').css('background','url('+data[0]['src']+')');
        }
    })
})


function checkData() {
    $.ajax({
        type:'get',
        url:'/exhibition/index.php/Home/Index/data',
        success:function(data){
            console.log(data);
            cloneNode(data)
        },
        error:function(){
            console.log('获取信息出错');
        }
    })
}

var cloneNode = function(data) {

    for(var key in data){
        var $list = $('<div/>').addClass('list');
        var $group = $('<span/>').addClass('group');
        $group.text(key);
        $list.append($group);
        var $arr = data[key];
        $.each($arr,function(index,value){
                var $team = $("<span/>").addClass('team');
                $team.text(value);
                $list.append($team);
        });

        $("body").append($list);

    }
}