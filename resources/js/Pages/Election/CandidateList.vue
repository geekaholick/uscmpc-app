<template>
    <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-4">
        <div v-for="(candidate, index) in candidates">
            <div class="p-6 border-gray-900" align="center" justify="center"
                 v-bind:class="{ active: candidate.isActive }">

                <div class="text-lg text-gray-600 font-bold">
                    {{ candidate.last_name }}, {{ candidate.first_name }}
                </div>

                <div class="m-4" v-if="candidate.profile_photo_path != null">
                    <img :src="candidate.profile_photo_path" :alt="candidate.first_name"
                         class="rounded-full h-36 w-36 object-cover">
                </div>
                <div class="m-4" v-else>
                    <img class="rounded-full h-36 w-36 object-cover">
                </div>

                <jet-button v-if="!candidate.isActive" class="m-4 bg-gray-500" @click.prevent="toggleActive(index)">
                    Select
                </jet-button>
                <jet-button v-else class="m-4 bg-gray-500" @click.prevent="toggleActive(index)">
                    Unselect
                </jet-button>

            </div>
        </div>
    </div>

    <div class="p-6 grid-cols-1 md:grid-cols-3" align="center" justify="center">
        <jet-button class="ml-4">
            CAST VOTE
        </jet-button>
    </div>

</template>

<script>
import JetButton from '@/Jetstream/Button'
import Button from "../../Jetstream/Button";
import axios from "axios";

export default {
    components: {
        Button,
        JetButton
    },
    data() {
        return {
            candidates: [],
            count: 0,
            chosenCandidates: [],
            voter: null,
        }
    },
    created() {
        this.list();
    },
    methods: {
        toggleActive(index) {
            if (this.count < 3 || this.candidates[index].isActive) {
                if (this.candidates[index].isActive) {
                    let x = this.chosenCandidates.indexOf(this.candidates[index].id);
                    if (x > -1) {
                        this.chosenCandidates.splice(x, 1);
                    }
                    this.count--;
                } else {
                    this.chosenCandidates.push(this.candidates[index].id);
                    this.count++;
                }
                this.candidates[index].isActive = !this.candidates[index].isActive;
            }
            console.log(this.chosenCandidates);
        },
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
        submit() {
            let BaseApi = axios.create({
                baseURL: "http://localhost:8000/api"
            });
            BaseApi.post("candidate-list", {'candiates': this.candidates, 'voter': this.voter}).then((response) => {
                console.log(response.data);
                this.form.reset('password', 'password_confirmation');
            })
                .catch((error) => {
                    console.log("error")
                })
            // this.form.post(this.route('register'), {
            //     onFinish: () => this.form.reset('password', 'password_confirmation'),
            // })
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
