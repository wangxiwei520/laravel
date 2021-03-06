<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>集运后台登录</title>
    <!-- import CSS -->
    <link rel="stylesheet" href="/element/lib/theme-chalk/index.css">
    <link rel="stylesheet" href="/admin/css/admin.css">
</head>
<style>

    .login {
        background-color: #2d3a4b;
        height: 100%;
    }
    .login  .login-form {
        width: 500px;
        height: 300px;
        background-color: rgba(0, 0, 0, 0.5);
        border-radius: 7px;
        padding-right: 34px;
        position: fixed;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        margin: auto;
    }

    .login  .title {
        text-align: center;
        color: #ffffff;
        font-size: 24px;
        margin-bottom: 30px;
    }
    .el-form .el-form-item .el-form-item__label {
        color: #ffffff;
    }
</style>
<body>
<div id="app">
    <div class="login">
        <!-- 登录容器 -->
        <div class="login-form">
            <!-- 标题 -->
            <h1 class="title">
                <i class="el-icon-menu"></i>
                速购集运
            </h1>
            <!-- 登录表单 -->
            <el-form :model="loginForm" status-icon :rules="loginRules" ref="loginForm" label-width="100px" class="demo-ruleForm">

                <el-form-item label="账号" prop="username">
                    <el-input type="text" v-model="loginForm.username" autocomplete="off"></el-input>
                </el-form-item>

                <el-form-item label="密码" prop="password">
                    <el-input type="password" v-model="loginForm.password" autocomplete="off" @keyup.enter.native="submitForm('loginForm')"></el-input>
                </el-form-item>



                <el-form-item>
                    <el-button type="primary" @click="submitForm('loginForm')">登录</el-button>
                    <el-button @click="resetForm('loginForm')">重置</el-button>
                </el-form-item>

            </el-form>
        </div>
    </div>

</div>
</body>
<!-- import Vue before Element -->
<script src="/element/js/vue.js"></script>
<!-- import JavaScript -->
<script src="/element/lib/index.js"></script>
<script src="/admin/jquery/jQuery-2.1.4.min.js"></script>
<script src="/admin/layer/layer.js"></script>


<script>

    new Vue({
        el: '#app',
        data: function() {

            return {
                // 登录表单数据对象
                loginForm: {
                    username: "",
                    password: "",
                },
                // 验证的字段
                loginRules: {
                    // 验证用户名
                    username: [
                        { required: true, message: "账号不能为空", trigger: "blur" } // 非空验证
                    ],
                    // 验证密码
                    password: [
                        { required: true, message: "密码不能为空", trigger: "blur" }, // 非空验证
                    ]

                }
            };
        },
        methods: {
            // 表单提交触发的函数
            submitForm(formName) {

                this.$refs[formName].validate(valid => {

                    if (valid) {
                        let params = {
                            username: this.loginForm.username,
                            password: this.loginForm.password
                        }
//                        前端验证通过请求后端
                        $(function () {

                            $.ajax({
                                type: "POST",
                                url: "{:url('admin/admin_admin/login')}",
                                data:params,
                                dataType: "json",
                                success: function(data){

                                    if (data.code == 200) {
                                        layer.msg(data.msg,{icon: 1});
                                        localStorage.setItem("authMenu",data.data['menus']);
                                        localStorage.setItem("user",data.data['user']);
                                        setTimeout(function () {
                                            location.href=data.url;
                                        }, 1000);
                                    }else {
                                        layer.msg(data.msg,{icon: 5});
                                    }

                                },
                                error:function (e) {
                                    layer.msg('网络不好请稍后再试',{icon: 5});
                                }
                            });
                        });

                    } else {

                        return false;
                    }
                });
            },
            resetForm(formName) {
                this.$refs[formName].resetFields();
            }
        }
    });




</script>

</html>