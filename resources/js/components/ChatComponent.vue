<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="form-group">
                    <textarea rows="6" class="form-control" readonly>{{data.join('\n')}}</textarea>
                </div>

                <div class="input-group mb-3">
                    <input type="text"  class="form-control" v-model="message" placeholder="Сообщение">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" @click="sendMessage" @submit="sendMessage">Отравить</button>
                    </div>

                </div>


            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'


    export default {


        mounted() {
            var socket = io('http://localhost:3000');
            socket.on("news-action:App\\Events\\SendMessage", function (data) {
                this.data.push(data.message)
            }.bind(this));
        },
        data: function () {
            return {
                data: [],
                message: ''
            }
        },
        methods: {

            sendMessage: function () {
                axios({
                    method: 'post',
                    url: '/chat',
                    data: {
                        message: this.message,
                    }
                })
                    .then((res) => {
                        this.message = '';
                        //console.log(res);
                        //this.data = res.data;
                    });
            },
        }
    }
</script>
