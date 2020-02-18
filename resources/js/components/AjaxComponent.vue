<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <button v-if="loaded" class="btn">
                   Loading ...
                </button>
                <button @click="getData" v-else class="btn">
                    Update {{count}}
                </button>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Url</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="url in urldata">
                            <td>{{url.title}}</td>
                            <td>{{url.url}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    export default {
        mounted() {
            this.getData();
        },
        data: function () {
            return {
                urldata: [],
                loaded : false,
                count: 0
            }
        },
        methods: {
            getData: function () {
                this.loaded = true;
                axios.post('/getJson')
                    .then((res) => {
                        console.log(res);
                        this.urldata = res.data;
                        this.loaded = false;
                        this.count++
                    });
            }
        }
    }
</script>
