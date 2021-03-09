<template>
    <div class="p-4 bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-1" :set="voter=$page.props.user.id">
        Current Count Done: {{ countStatistics.voted }}<br/>
        Current Total Voters: {{ countStatistics.voters }}
    </div>
    <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-4">
        <div v-for="(candidate, index) in candidates">
            <div class="p-6 border-gray-900" align="center" justify="center">

                <div class="text-lg text-gray-600 font-bold">
                    {{ candidate.last_name }}, {{ candidate.first_name }}
                </div>

                <div class="m-4" v-if="candidate.profile_photo_path != null">
                    <img :src="candidate.profile_photo_path" :alt="candidate.first_name"
                         class="rounded-full h-24 w-24 object-cover">
                </div>
                <div class="m-4" v-else>
                    <img class="rounded-full h-24 w-24 object-cover">
                </div>
                <div class="text-lg">
                    {{ results[index] }} Vote(s)
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import JetButton from '@/Jetstream/Button'
import JetDialogModal from '@/Jetstream/DialogModal'
import axios from "axios";

export default {
    components: {
        JetButton,
        JetDialogModal
    },
    data() {
        return {
            candidates: [],
            countStatistics: [],
            results: [],
        }
    },
    created() {
        this.list();
        this.getCount();
        this.getResult();
        setInterval(this.getCount, 60000);
        setInterval(this.getResult, 60000);
    },
    methods: {
        list() {
            let BaseApi = axios.create({
                baseURL: "http://localhost:8000/api"
            });
            BaseApi.get("candidate-list").then((response) => {
                console.log(response.data);
                this.candidates = response.data;
            })
                .catch((error) => {
                    console.log("error")
                })

        },
        getCount() {
            let BaseApi = axios.create({
                baseURL: "http://localhost:8000/api"
            });
            BaseApi.get("count").then((response) => {
                console.log(response.data);
                this.countStatistics = response.data;
            })
                .catch((error) => {
                    console.log("error")
                })

        },
        getResult() {
            let BaseApi = axios.create({
                baseURL: "http://localhost:8000/api"
            });
            BaseApi.get("result").then((response) => {
                console.log(response.data);
                this.results = response.data;
            })
                .catch((error) => {
                    console.log("error")
                })

        },
    }
}
</script>

<style scoped>
.active {
    color: #00424b;
    background: #ffc31f;
    border: darkgreen;
    border-style: solid;
}
</style>
