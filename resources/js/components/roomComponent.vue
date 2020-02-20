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
                            <span v-if="isActive">{{isActive.name}} набирает сообщение</span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        Online
                        <ul>
                            <li v-for="user in activeUsers">
                                {{user}}
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input type="text" @keydown="actionUser"  class="form-control" v-model="textMessage" placeholder="Сообщение">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" @keyup.enter="sendMessage" @click="sendMessage" >Отравить</button>

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
            'user',
            'room'
        ],
        mounted() {
            this.channel
            // для отслеживания всех участников
                .here((users) => {
                    this.activeUsers = users;
                })
                .joining((user) => {
                    this.activeUsers.push(user);
                })
                .leaving((user) => {
                    this.activeUsers.slice(this.activeUsers.indexOf(user), 1);
                })

                .listen('PrivateMessage', ({data}) => {
                    this.messages.push(data.body)
                    this.isActive = false;
                })
                .listenForWhisper('typing', (e) => {
                    this.isActive = e;
                    if (this.typingTimer) clearTimeout(this.typingTimer);
                    this.clearTimeout = setTimeout(() => {
                        this.isActive = false;
                    }, 2000);
                });

        },
        computed: {
            channel() {
                return window.Echo.join('room.' + this.room.id);
            }
        },
        data: function () {
            return {
                messages: [],
                textMessage: '',
                usersSelect: [],
                isActive: false,
                typingTimer: false,
                activeUsers: []
            }
        },
        methods: {

            sendMessage: function () {
                axios({
                    method: 'post',
                    url: '/room',
                    data: {
                        body: this.textMessage,
                        room_id: this.room.id
                    }
                })
                    .then((res) => {
                        this.messages.push( this.textMessage);
                        this.textMessage = '';
                        //console.log(res);
                        //this.data = res.data;
                    });
            },

            actionUser () {
                // транцляция события в канал - whisper() // пользователь набирает сообшение
                this.channel.whisper('typing', {
                    name: this.user.name
                })
            }
        }
    }
</script>
