<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        请选择您需要的11：
                    </div>
                    <el-select v-model="value" placeholder="请选择">
                        <el-option
                                v-for="item in options"
                                :key="item.value"
                                :label="item.label"
                                :value="item.value">
                        </el-option>
                    </el-select>
                </div>
                <a herf='/login'></a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data() {
            return {
                options: [{
                    value: '选项1',
                    label: '香蕉'
                }, {
                    value: '选项2',
                    label: '橘子'
                }, {
                    value: '选项3',
                    label: '苹果'
                }, {
                    value: '选项4',
                    label: '哈密瓜'
                }, {
                    value: '选项5',
                    label: '葡萄'
                }],
                value: ''
            }
        }
    }
</script>
