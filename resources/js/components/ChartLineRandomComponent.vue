<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <chart-line :chart-data="data" :height="100" option="{responsive: true, maintainAspectRation: true}"></chart-line>
                <button class="btn btn-primary" @click="getData">Random</button>
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
            this.getData();
        },
        data: function () {
            return {
                data: []
            }
        },
        methods: {
            getData: function () {
                this.loaded = true;
                axios.post('/random-chart')
                    .then((res) => {
                        console.log(res);
                        this.data = res.data;
                    });
            }
        }
    }
</script>
