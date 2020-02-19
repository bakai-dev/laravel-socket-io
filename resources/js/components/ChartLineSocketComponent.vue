<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <chart-line :chart-data="data" :height="100" option="{responsive: true, maintainAspectRation: true}"></chart-line>
                <input type="checkbox" v-model="realtime"> realtime
                <input type="text" placeholder=" имя точки грфафике" v-model="label">
                <input type="text" placeholder="значение точки" v-model="sale">
                <button class="btn btn-primary" @click="sendData">Отравить</button>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    import chartLine from './chartLine';

    export default {
        components: {
            chartLine
        },

        mounted() {
            var socket = io('http://localhost:3000');
            socket.on("news-action:App\\Events\\NewEvent", function (data) {
                this.data = data.result
            }.bind(this));
        },
        data: function () {
            return {
                data: [],
                realtime: false,
                label: "",
                sale: 500
            }
        },
        methods: {

            sendData: function () {
                axios({
                    method: 'post',
                    url: '/socket-chart',
                    data: {
                        label: this.label,
                        sale: this.sale,
                        realtime: this.realtime
                    }
                })
                    .then((res) => {
                        console.log(res);
                        this.data = res.data;
                    });
            },
        }
    }
</script>
