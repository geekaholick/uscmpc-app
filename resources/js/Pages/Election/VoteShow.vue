<template>
    <div>
        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
            <div class="mt-8 text-2xl">
                Board of Directors USC MPC Election 2021!
            </div>

            <div v-if="$page.props.user.uscmpc_id==null">
                <div class="mt-6 text-lg text-gray-500">
                    Sorry we could not validate your account.
                </div>
                <div>
                    ---<br/>
                    If you have questions, please don't hesitate to contact the office.<br/>
                    Email: official.uscmpc@gmail.com<br/>
                    Contact Number: (032)233 4341<br/>
                    Contact Person: USC MPC Registration Team
                </div>
            </div>

            <div v-else>
                <div class="mt-6 text-lg text-gray-500" v-if="$page.props.user.election_status==0">
                    <div v-if="$page.props.user.can_vote">
                        You are advised to follow your assigned schedule.<br/>
                        Election Schedule:
                        <div class="list-none pl-7 font-bold">
                            <li>As sent thru your email.</li>
                        </div>
                    </div>
                    <div v-else>
                        Sorry to inform you that you're <span class="lg:font-bold underline italic">NOT ELIGIBLE</span> for
                        voting in the election for the board of directors.<br/>
                        ---<br/>
                        If you have questions, please don't hesitate to contact the office.<br/>
                        Contact Email: usc_mpc@yahoo.com <br/>
                        Alternate Email: official.uscmpc@gmail.com<br/>
                        Contact Number: (032)384 0024<br/>
                        Contact Person: Maria Conception Gaviola
                    </div>
                </div>

                <div class="mt-6 text-lg text-gray-500" v-else-if="$page.props.user.election_status==1">
                    <div v-if="$page.props.user.can_vote && !$page.props.user.vote_status">
                        You are <span class="lg:font-bold underline italic">ELIGIBLE</span> for voting in the election for
                        the board of directors.
                        Please select a maximum of <span class="lg:font-bold">3</span> members in the candidates listed.
                    </div>

                    <div v-else-if="$page.props.user.can_vote && $page.props.user.vote_status">
                        Thank you for exercising your right to vote.<br/>
                        <div v-if="!$page.props.user.poll_status">
                            <jet-nav-link :href="route('poll')" :active="route().current('poll')" class="text-sm text-green-400 text-xl xl:leading-8 font-bold">
                                Click here to participate the poll.
                            </jet-nav-link>
                        </div>
                    </div>

                    <div v-else>

                        Sorry to inform you that you're <span class="lg:font-bold underline italic">NOT ELIGIBLE</span> for
                        voting in the election for the board of directors.<br/>
                        ---<br/>
                        If you have questions, please don't hesitate to contact the office.<br/>
                        Email: official.uscmpc@gmail.com<br/>
                        Contact Number: (032)384 0024<br/>
                        Contact Person: Maria Conception Gaviola
                    </div>
                </div>
                <div class="mt-6 text-lg text-gray-500" v-else-if="$page.props.user.election_status==2">
                    <div>
                        The election CLOSED.<br/>
                        <div v-if="!$page.props.user.poll_status">
                            <jet-nav-link :href="route('poll')" :active="route().current('poll')" class="text-sm text-green-400 text-xl xl:leading-8 font-bold">
                                Click here to participate the poll.
                            </jet-nav-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-1"
             v-if="$page.props.user.can_vote && !$page.props.user.vote_status && $page.props.user.election_status==1 && $page.props.user.uscmpc_id!=null">
            <div>
                <candidate-list/>
            </div>
        </div>
    </div>
</template>

<script>
import JetApplicationLogo from '@/Jetstream/ApplicationLogo'
import CandidateList from "./CandidateList";
import DangerButton from "../../Jetstream/DangerButton";
import JetNavLink from '@/Jetstream/NavLink';

export default {
    components: {
        DangerButton,
        JetApplicationLogo,
        CandidateList,
        JetNavLink
    },
}
</script>
