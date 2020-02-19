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
                            <textarea rows="6" class="form-control" readonly>{{messages.join('\n')}}</textarea>
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input type="text"  class="form-control" v-model="textMessage" placeholder="Сообщение">
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
            window.Echo.channel('chat')
                .listen('Message', ({message}) => {
                    this.messages.push(message)
                });
        },
        data: function () {
            return {
                messages: [],
                textMessage: '',
                usersSelect: [],
            }
        },
        methods: {

            sendMessage: function () {
                axios({
                    method: 'post',
                    url: '/echo-chat',
                    data: {
                        body: this.textMessage,
                    }
                })
                    .then((res) => {
                        this.messages.push( this.textMessage);
                        this.textMessage = '';
                        //console.log(res);
                        //this.data = res.data;
                    });
            },
        }
    }
</script>
