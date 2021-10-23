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
                <div>
                    Number of total participants: {{ totalparticipants }}
                    <br>
                    Number of regular participants: {{ regularparticipants }}
                    <br>
                    Number of associate participants: {{ associateparticipants }}
                </div>
                
            </div>
        </div>
        <jet-button class="ml-4" @click="startRegistration">
            Open Registration
        </jet-button>
        <jet-button class="ml-4" @click="CloseRegistration">
            Close Registration
        </jet-button>
        <jet-button class="ml-4" @click="ShowCurrentParticipants">
            Show current participants
        </jet-button>

        <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-1"
             v-if="$page.props.user.type==1">
            <div>
                <member-list/>
            </div>
        </div>
    </div>
</template>

<script>
import JetApplicationLogo from '@/Jetstream/ApplicationLogo'
import JetButton from '@/Jetstream/Button'
import axios from "axios";

export default {
    components: {
        JetApplicationLogo,
        JetButton,
    },
    data(){
        return{
            totalparticipants: 0,
            regularparticipants: 0,
            associateparticipants: 0,
        }
    },
    methods: {
        ShowCurrentParticipants() {
            let BaseApi = axios.create({
                baseURL: "http://event.uscmpc.com/api"
            });
            BaseApi.post("show-participants").then((response) => {
                console.log(response.data);
                // alert(response.data);
                this.totalparticipants = response.data.total;
                this.regularparticipants = response.data.regular;
                this.associateparticipants = response.data.associate;
                // window.location.reload();
            })

                .catch((error) => {
                    console.log(error)
                })
        },
        startRegistration() {
            let BaseApi = axios.create({
                baseURL: "http://event.uscmpc.com/api"
            });
            BaseApi.post("start-registration").then((response) => {
                console.log(response.data);
                alert(response.data);
                window.location.reload();
            })

                .catch((error) => {
                    console.log(error)
                })
        },
        endRegistration() {
            let BaseApi = axios.create({
                baseURL: "http://event.uscmpc.com/api"
            });
            BaseApi.post("end-registration", {'id': this.current_member_id}).then((response) => {
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
