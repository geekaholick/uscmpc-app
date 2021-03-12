<template>
    <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-1" :set="voter=$page.props.user.id">
        <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-1">
            <div class="px-2">
                <table class="sm:table-auto  w-full">
                    <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="px-4 py-2 w-10"></th>
                        <th class="px-4 py-2">Member's Name</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(member, index) in members" :key="index">
                        <td class="px-4 py-2">
                            {{ index + 1 }}
                        </td>
                        <td class="px-4 py-2">
                            <div>
                                {{ member.first_name }} {{ member.middle_name }} {{ member.last_name }}
                            </div>
                        </td>
                        <td class="px-4 py-2">
                            <div>
                                <jet-button class="ml-4" @click="validateMember1(member.id)">
                                    Can VOTE
                                </jet-button>
                                <jet-button class="ml-4" @click="validateMember2(member.id)">
                                    Cannot VOTE
                                </jet-button>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <jet-dialog-modal :show="confirmingUserVote1" @close="closeModal">
        <template #title>
            Confirm vote.
        </template>

        <template #content>
            Are you sure you want to validate member?<br/>
        </template>

        <template #footer>
            <jet-button @click="closeModal">
                Cancel
            </jet-button>

            <jet-button class="ml-2" @click="canVote">
                Confirm
            </jet-button>
        </template>
    </jet-dialog-modal>

    <jet-dialog-modal :show="confirmingUserVote2" @close="closeModal">
        <template #title>
            Confirm vote.
        </template>

        <template #content>
            Are you sure you want to validate member?<br/>
        </template>

        <template #footer>
            <jet-button @click="closeModal">
                Cancel
            </jet-button>

            <jet-button class="ml-2" @click="cannotVote">
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
            members: [],
            confirmingUserVote1: false,
            confirmingUserVote2: false,
            current_member_id: 0,
        }
    },
    created() {
        this.list();
    },
    methods: {
        list() {
            let BaseApi = axios.create({
                baseURL: "http://event.uscmpc.com/api"
            });
            BaseApi.get("member-list").then((response) => {
                console.log(response.data);
                this.members = response.data;
            })
                .catch((error) => {
                    console.log("error")
                })

        },
        validateMember1(id) {
            this.current_member_id = id;
            this.confirmingUserVote1 = true;
        },
        validateMember2(id) {
            this.current_member_id = id;
            this.confirmingUserVote2 = true;
        },
        closeModal() {
            this.confirmingUserVote1 = false;
            this.confirmingUserVote2 = false;
        },
        canVote() {
            let BaseApi = axios.create({
                baseURL: "http://event.uscmpc.com/api"
            });
            BaseApi.post("can-vote/"+this.current_member_id).then((response) => {
                console.log(response.data);
                window.location.reload();
            })

                .catch((error) => {
                    console.log(error)
                })
        },
        cannotVote() {
            let BaseApi = axios.create({
                baseURL: "http://event.uscmpc.com/api"
            });
            BaseApi.post("cannot-vote/"+this.current_member_id).then((response) => {
                console.log(response.data);
                window.location.reload();
            })

                .catch((error) => {
                    console.log(error)
                })
        }
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
