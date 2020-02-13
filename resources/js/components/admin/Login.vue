<template>
    <div class="login">
        <!-- 登录容器 -->
        <div class="login-form">
            <!-- 标题 -->
            <h1 class="title">
                <i class="el-icon-menu"></i>
                后台登录
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
</template>
<style>
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }
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
<script>
    export default {
        name: "App",
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
                            name: this.loginForm.username,
                            password: this.loginForm.password
                        };
//                        前端验证通过请求后端
                        axios.post('/api/adminLoginVer',params).then( response=> {
                            var data = {
                                data:response.data,
                                callback:()=>{
                                    //验证失败提示
                                    if (response.data.code == 10000) {
                                        this.commonFun.mistake(response.data.msg);
                                        return;
                                    }
                                    //验证通过登录
                                    if(response.data.code==200){
                                        this.commonFun.successful(response.data.msg);
                                        var api_token = response.data.data.token;
                                        sessionStorage.setItem('api_token',api_token);
                                        setTimeout(()=>{
                                            this.$router.push('/');
                                        },1500);
                                    }
                                }
                            };
                            this.commonFun.codeToMsg(data);
                            // this.commonFun.codeToMsg(response);
                        }).catch( error=> {
                            this.commonFun.mistake('网络异常');
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
    }
</script>
