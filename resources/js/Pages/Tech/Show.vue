<template>
    <div>
        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
            <div class="mt-8 text-2xl">
                Board of Directors USC MPC Election 2021!
            </div>

            <div v-if="$page.props.user.uscmpc_id==null">
                <div class="mt-6 text-gray-500">
                    Please wait as your account is being reviewed for authenticity.
                </div>
            </div>

            <div v-else>
                <div class="mt-6 text-gray-500" v-if="$page.props.user.election_status==0">
                    <div>
                        The election has not yet started. <br/>
                        Election Schedule:
                        <div class="list-none pl-7 font-bold">
                            <li>Open -> 10:30 AM</li>
                            <li>Close -> 11:30 AM</li>
                        </div>
                    </div>
                </div>

                <div class="mt-6 text-gray-500" v-else-if="$page.props.user.election_status>=1">
                    Show current result here.
                </div>
            </div>
        </div>
        <jet-button class="ml-4" @click="OpenElection">
            Open Election
        </jet-button>
        <jet-button class="ml-4" @click="CloseElection">
            Close Election
        </jet-button>

        <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-1"
             v-if="$page.props.user.type==1">
            <div>
                <member-list/>
            </div>
        </div>
    </div>

    <jet-dialog-modal :show="confirmingOpenElection" @close="closeModal">
        <template #title>
            Confirm vote.
        </template>

        <template #content>
            Are you sure you want to START the ELECTION?<br/>
        </template>

        <template #footer>
            <jet-button @click="closeModal">
                Cancel
            </jet-button>

            <jet-button class="ml-2" @click="startElection">
                Confirm
            </jet-button>
        </template>
    </jet-dialog-modal>

    <jet-dialog-modal :show="confirmingCloseElection" @close="closeModal">
        <template #title>
            Are you sure you want to END the ELECTION?
        </template>

        <template #footer>
            <jet-button @click="closeModal">
                Cancel
            </jet-button>

            <jet-button class="ml-2" @click="endElection">
                Confirm
            </jet-button>
        </template>
    </jet-dialog-modal>
</template>

<script>
import JetApplicationLogo from '@/Jetstream/ApplicationLogo'
import MemberList from "../Tech/MemberList";
import DangerButton from "../../Jetstream/DangerButton";
import JetButton from '@/Jetstream/Button'
import JetDialogModal from '@/Jetstream/DialogModal'
import axios from "axios";

export default {
    components: {
        DangerButton,
        JetApplicationLogo,
        JetButton,
        JetDialogModal,
        MemberList
    },
    data() {
        return {
            confirmingOpenElection: false,
            confirmingCloseElection: false,
        }
    },
    methods: {
        OpenElection() {
            this.confirmingOpenElection = true;
        },
        CloseElection() {
            this.confirmingCloseElection = true;
        },
        closeModal() {
            this.confirmingOpenElection = false;
            this.confirmingCloseElection = false;
        },
        startElection() {
            let BaseApi = axios.create({
                baseURL: "http://event.uscmpc.com/api"
            });
            BaseApi.post("start-election").then((response) => {
                console.log(response.data);
                alert(response.data);
                window.location.reload();
            })

                .catch((error) => {
                    console.log(error)
                })
        },
        endElection() {
            let BaseApi = axios.create({
                baseURL: "http://event.uscmpc.com/api"
            });
            BaseApi.post("end-election", {'id': this.current_member_id}).then((response) => {
                console.log(response.data);
                alert(response.data);
                window.location.reload();
            })

                .catch((error) => {
                    console.log(error)
                })
        }
    }
}
</script>
