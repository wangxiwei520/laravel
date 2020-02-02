/**
 * 表格操作事件
 * @data   {data:"",//修改内容
            url:"",//请求地址
            success:fun,//成功回调
            error:fun,//失败回调
            }
 * @param obj row
 */
function updateData(row){
        let params =row.data;
        let url =   row.url;
        $.ajax({
            type: "POST",
            url:url,
            data:params,
            dataType: "json",
            success: data=>{
                if (data.code == 200) {
                    row.success(data.msg);
                }
            },
            error:e=> {
                row.error('网络不好请稍后再试');
            }
        });
    }

function copyUrl2(text) {
    var Url2 = text;
    var oInput = document.createElement('input');
    oInput.value = Url2;
    document.body.appendChild(oInput);
    oInput.select(); // 选择对象
    document.execCommand("Copy"); // 执行浏览器复制命令
    oInput.className = 'oInput';
    oInput.style.display = 'none';
    alert('复制成功');
}

