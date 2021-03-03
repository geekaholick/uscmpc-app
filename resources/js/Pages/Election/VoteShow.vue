<template>
    <div>
        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
<!--            <div>-->
<!--                <jet-application-logo class="block h-12 w-auto" />-->
<!--            </div>-->

            <div class="mt-8 text-2xl">
                Board of Directors USC MPC Election 2021!
            </div>

            <div class="mt-6 text-gray-500">
                <div v-if="$page.props.user.can_vote && !$page.props.user.vote_status">
                    You are <span class="lg:font-bold underline italic">ELIGIBLE</span> for voting in the election for the board of directors.
                    Please select a maximum of <span class="lg:font-bold">3</span> members in the candidates listed.
                </div>

                <div v-else-if="$page.props.user.can_vote && $page.props.user.vote_status">
                    Thank you for exercising your right to vote. The election committee will announce the winner before the end of the General Assembly.
                </div>

                <div v-else>
                    Sorry to inform you that you're <span class="lg:font-bold underline italic">NOT ELIGIBLE</span> for voting in the election for the board of directors.
                </div>
            </div>
        </div>
        <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-1" v-if="$page.props.user.can_vote && !$page.props.user.vote_status">
            <div>
                <candidate-list/>
            </div>
        </div>

    </div>
</template>

<script>
    import JetApplicationLogo from '@/Jetstream/ApplicationLogo'
    import CandidateList from "./CandidateList";

    export default {
        components: {
            JetApplicationLogo,
            CandidateList
        },
    }
</script>
