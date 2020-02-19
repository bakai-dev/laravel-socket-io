<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12">


                <div class="form-group row">
                    <div class="col-sm-4">
                        <select multiple="" class="form-control" v-model="usersSelect">
                            <option v-for="user in users"  :value="'news-action.' + user.id">{{user.email}}</option>
                        </select>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <textarea rows="6" class="form-control" readonly>{{dataMessages.join('\n')}}</textarea>
                        </div>
                    </div>
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
        props: [
            'users',
            'user'
        ],
        mounted() {
            var socket = io('http://localhost:3000');
            socket.on("news-action." + this.user.id + ":App\\Events\\PrivateMessage", function (data) {
                this.dataMessages.push(data.message.user + ': ' + data.message.message)
            }.bind(this));

            socket.on("news-action.:App\\Events\\PrivateMessage", function (data) {
                this.dataMessages.push(data.message.user + ': ' + data.message.message)
            }.bind(this));
        },
        data: function () {
            return {
                dataMessages: [],
                message: '',
                usersSelect: [],
            }
        },
        methods: {

            sendMessage: function () {
                if (!this.usersSelect.length) {
                    this.usersSelect.push('news-action.');
                }
                axios({
                    method: 'post',
                    url: '/private-chat',
                    data: {
                        channels: this.usersSelect,
                        user: this.user.email,
                        message: this.message,
                    }
                })
                    .then((res) => {
                        this.dataMessages.push(this.user.email + ': ' + this.message);
                        this.message = '';
                        //console.log(res);
                        //this.data = res.data;
                    });
            },
        }
    }
</script>
