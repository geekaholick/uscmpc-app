<template>
    <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-1" :set="voter=$page.props.user.id">
        <div v-for="(question, index) in questions" :key="index">
            <div class="p-6 border-gray-900" justify="left"
                 v-bind:class="{ active: question.isActive }">

                <div class="px-6 text-lg text-gray-600 font-bold">
                    <!-- {{ question.question }} -->

                    <span v-if="index==0" >
                        Renaming of USC Multi-Purpose Cooperative to <span class="underline bg-yellow-300">USC AND COMMUNITY</span> Multi-Purpose Cooperative
                    </span>
                    <span v-else>
                        Increasing the members of the Board of Directors from five (5) to SEVEN (7)
                    </span>





                </div>

                <!-- <jet-button v-if="!question.isActive" class="my-4 bg-gray-500" @click.prevent="toggleActive(index)">
                    I Agree
                </jet-button>
                <jet-button v-else class="my-4 bg-gray-500" @click.prevent="toggleActive(index)">
                    I Disagree
                </jet-button> -->

                    <!-- <div class="btn-group btn-group-lg">
                        <jet-button class="my-4" @click="confirmUserVote">Agree</jet-button>
                        <jet-button class="my-4" @click="confirmUserVote">Disagree</jet-button>
                        <jet-button class="my-4" @click="confirmUserVote">Abstain</jet-button>
                    </div> -->


                <div >
                    <table class="ml-6 w-full" >
                        <tr class="text-left font-bold">
                            <td><input :name="'a_' + index" type="radio" value="Agree" v-model="question.selected"/>Agree</td>
                            <td><input :name="'a_' + index" type="radio" value="Disagree" v-model="question.selected"/>Disagree</td>
                            <td><input :name="'a_' + index" type="radio" value="Abstain"  v-model="question.selected"/>Abstain</td>
                        </tr>
                    </table>
                </div>


            </div>
        </div>
    </div>


    <div class="my-6 grid-cols-1 md:grid-cols-3" align="center" justify="center">
        <jet-button class="my-4" @click="confirmUserVote">
            SUBMIT
        </jet-button>
    </div>

    <jet-dialog-modal :show="confirmingUserVote" @close="closeModal">
        <template #title>
            Confirm vote.
        </template>

        <template #content>
            Are you sure you want to submit your vote? Once submited you will not be able to vote again.<br/>


            Summary of Choices:<br/>
            First Amendment  : <span class="lg:font-bold underline "> {{ questions[0].selected }} </span><br/>
            Second Amendment : <span class="lg:font-bold underline "> {{ questions[1].selected }} </span>

            <!-- <span v-if="questions[0].selected=='Agree' && questions[1].isActive==false" >
                You have agreed to the FIRST amendment.
            </span>
            <span v-else-if="questions[0].isActive==false && questions[1].isActive==true">
                You have agreed to the SECOND amendment.
            </span>
            <span v-else-if="questions[0].isActive==true && questions[1].isActive==true">
                You have agreed to BOTH amendments.
            </span>
            <span v-else>
                You have disagreed to BOTH amendments.
            </span> -->

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
            questions: [{ question:"Renaming of USC Multi-Purpose Cooperative to USC AND COMMUNITY MULTI-PURPOSE COOPERATIVE",
                          selected: "Agree"},
                        { question: "Increasing the members of the Board of Directors from five (5) to SEVEN (7)",
                          selected: "Agree"},
                       ],
            count: 0,
            voter: null,
            confirmingUserVote: false,
            form: null
        }
    },

    methods: {
        toggleActive(index) {
            this.questions[index].isActive = !this.questions[index].isActive;
        console.log(this.questions);
        },

        submit() {
            let BaseApi = axios.create({
                baseURL: "http://event.uscmpc.com/api"
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
