<template>
    <div>
        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
            <div class="mt-8 text-2xl">
                Poll for Approval of the Amendments!
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
                <div class="mt-6 text-gray-500">
                    <div v-if="$page.props.user.can_vote && !$page.props.user.poll_status">
                        You are <span class="lg:font-bold underline italic">ELIGIBLE</span> for participating the poll.
                    </div>

                    <div v-else-if="$page.props.user.can_vote && $page.props.user.poll_status">
                        Thank you for participating in the poll. <br/>
                    </div>

                    <div v-else>
                        Sorry to inform you that you're <span class="lg:font-bold underline italic">NOT ELIGIBLE</span> for
                        the poll.<br/><br/>
                        If you have questions, please don't hesitate to contact the office.<br/>
                        Email: official.uscmpc@gmail.com<br/>
                        Contact Number: (032)384 0024<br/>
                        Contact Person: Maria Conception Gaviola
                    </div>
                </div>
            </div>

        </div>
        <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-1"
             v-if="$page.props.user.can_vote && !$page.props.user.poll_status && $page.props.user.uscmpc_id!=null">
            <div>
                <question-list/>
            </div>
        </div>
    </div>
</template>

<script>
import JetApplicationLogo from '@/Jetstream/ApplicationLogo'
import QuestionList from "./QuestionList";
import DangerButton from "../../Jetstream/DangerButton";

export default {
    components: {
        DangerButton,
        JetApplicationLogo,
        QuestionList
    },
}
</script>
