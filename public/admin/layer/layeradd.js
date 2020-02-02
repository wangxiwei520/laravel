
/*在layer.js 后引入此文件就能全局 增 删 改 功能中使用提示层 以及数据回显和数据自动绑定
*验证规则自行在前端或者后端添加
*后端添加的规则能在提示层输出
*/

$(function () {
    /*添加开始  需要定义按钮为add的class类名*/
    $('#source').on('click','.add',function () {
        put($(this),'sth');
    });
    /*修改开始 需要定义按钮为mind的class类名*/
    $('#source').on('click','.mind',function () {
        put($(this),'alter');
    });
    /*删除 删除也可以写一个id为fake的空表单在模板中写入即可 方便优化代码*/
    $('#source').on('click','.del',function () {
        $("#fake_id").val( $(this).attr('url_id'));
        put($(this),'fake');
    });
    //列表
    // $(".index").click(function () {
    //     put($(this),'index');
    // });
  //回显数据的获取以及赋值
    $('#source').on('click','.edit',function () {
        $.post('getEdit',{'id':$(this).attr('id')},function (data) {

            $.each(data.data,function (i,value) {
                $('#'+i).val(value);
                if (i == 'status') {
                  $(".status").each(function () {
                      if ($(this).val() == value) {
                          $(this).attr('checked','checked');

                      }

                  })
                }


            })
        });
    });
});


/**
 *
 * @param my  当前对象
 * @param path  from表单id 名
 */
function put(my,path) {

    if (path == 'fake') {
        layer.confirm('您确定删除么？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.post(my.attr('url'),$("#"+path).serialize(),function (data) {
                // alert(data.code);
                if(data.code){
                    layer.msg(data.msg, {icon: 1});
                    /*三秒后跳转到相应路径 此处路径为后台跳转路径*/
                    if(data.url!=null){
                        setTimeout(function () {
                            location.href=data.url;
                        }, 1500);
                    }
                }else {
                    //错误打印错误信息
                    layer.msg(data.msg, {icon: 5});
                }
            });

        }, function(){
          layer.closeAll()
        });

    }else {
        $.post(my.attr('url'),$("#"+path).serialize(),function (data) {
            // alert(data.code);
            if(data.code){
                layer.msg(data.msg, {icon: 1});
                /*三秒后跳转到相应路径 此处路径为后台跳转路径*/
                if(data.url!=null){
                    setTimeout(function () {
                        location.href=data.url;
                    }, 1500);
                }
            }else {
                //错误打印错误信息
                layer.msg(data.msg, {icon: 5});

            }

        });
    }

}