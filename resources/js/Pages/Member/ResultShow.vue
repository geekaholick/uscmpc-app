<template>
    <div>
        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
            <div class="mt-8 text-2xl">
                List
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

<!--        <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-1"-->
<!--             v-if="$page.props.user.can_vote && !$page.props.user.vote_status && $page.props.user.election_status==1 && $page.props.user.uscmpc_id!=null">-->
<!--            <div>-->
<!--                <candidate-list/>-->
<!--            </div>-->
<!--        </div>-->
    </div>
</template>

<script>
import JetApplicationLogo from '@/Jetstream/ApplicationLogo'
import CandidateList from "../Result/CandidateList";
import DangerButton from "../../Jetstream/DangerButton";

export default {
    components: {
        DangerButton,
        JetApplicationLogo,
        CandidateList
    },
}
</script>
