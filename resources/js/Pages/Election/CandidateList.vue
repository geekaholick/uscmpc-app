<template>
    <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-4" :set="voter=$page.props.user.id">
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
        <jet-button class="ml-4" @click="confirmUserVote">
            CAST VOTE
        </jet-button>
    </div>

    <jet-dialog-modal :show="confirmingUserVote" @close="closeModal">
        <template #title>
            Confirm vote.
        </template>

        <template #content>
            Are you sure you want to cast your vote? Once your casted you will not be able to vote again.<br/>
            <span v-if="count>0">
                You have selected the following:
                <div class="list-disc pl-2" v-for="name in chosenCandidatesName">
                    <li>{{ name }}</li>
                </div>
            </span>
            <span v-else>
                You have not selected any of the candidates.
            </span>

        </template>

        <template #footer>
            <jet-button @click="closeModal">
                Cancel
            </jet-button>

            <jet-button class="ml-2" @click="castVote">
                Confirm
            </jet-button>
        </template>
    </jet-dialog-modal>

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
            count: 0,
            chosenCandidates: [],
            chosenCandidatesName: [],
            voter: null,
            confirmingUserVote: false,
            form: null
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
                    let y = this.chosenCandidatesName.indexOf(this.candidates[index].first_name + " " + this.candidates[index].last_name);
                    if (x > -1) {
                        this.chosenCandidates.splice(x, 1);
                        this.chosenCandidatesName.splice(y, 1);
                    }
                    this.count--;
                } else {
                    this.chosenCandidates.push(this.candidates[index].id);
                    this.chosenCandidatesName.push(this.candidates[index].first_name + " " + this.candidates[index].last_name);
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
            BaseApi.post("cast-vote", {'candidates': this.chosenCandidates, 'voter': this.voter}).then((response) => {
                console.log(response.data);
                window.location.reload();
            })
                .catch((error) => {
                    console.log("error")
                })
        },
        confirmUserVote() {
            this.confirmingUserVote = true;
        },
        closeModal() {
            this.confirmingUserVote = false;
        },
        castVote() {
            this.submit();
            this.closeModal();
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
