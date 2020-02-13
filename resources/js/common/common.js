import { Message } from 'element-ui';
export default {
    // 方法1
    mistake(msg){
        Message({
            type: 'info',
            message: msg
        });
    },
    //成功提示
    successful(msg){
        Message({
            type: 'success',
            message:msg
        });
    },

    /**
     * 接口回调处理
     * @param data
     * @param callback
     */
    codeToMsg(data){
        //公共响应
        switch (data.code){
            //未认证
            case 10001:
                this.identity();
                break;
            default:
                //正常业务逻辑
                data.callback();
        }
    },
    //会员未认证
    identity(){

    }
}