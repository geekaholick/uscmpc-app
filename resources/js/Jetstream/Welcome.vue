<template>
    <div>
        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
            <div class="mt-8 text-2xl">
                Hello <span class="font-bold">{{ $page.props.user.title }}
                {{ $page.props.user.first_name }}
                {{ $page.props.user.last_name }}!</span><br/>
                Welcome to your USC Multi-purpose Cooperative election portal!
            </div>
            <div v-if="$page.props.user.uscmpc_id != null">
                <div class="mt-6 text-gray-500">
                    <div v-if="$page.props.user.can_vote">
                        You are <span class="lg:font-bold">ELIGIBLE</span> for voting in the election for the board of directors.
                    </div>

                    <div v-else>
                        Sorry to inform you that you're <span class="lg:font-bold">NOT ELIGIBLE</span> for voting in the election for the board of directors. <br/>
                        If you have questions, please don't hesitate to contact the office.<br/>
                        Contact Email: usc_mpc@yahoo.com <br/>
                        Alternate Email: official.uscmpc@gmail.com<br/>
                        Contact Number: (032)384 0024<br/>
                        Contact Person: Maria Conception Gaviola
                    </div>
                </div>
            </div>
            <div v-else>
                <div class="mt-6 text-gray-500">
                    <div>
                        Please wait as your account is being reviewed. It may take 5 - 15 minutes. We humbly ask your patience as we confirm your account. Don't worry you can still join the 58th General Assembly by clicking on the Zoom link below.
                    </div>
                </div>
            </div>

        </div>

        <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2" v-if="$page.props.user.uscmpc_id != null">
            <div class="p-6">
                <div class="flex items-center">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-400"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    <div class="ml-4 text-lg text-gray-600 leading-7 font-bold"><a v-bind:href="route('election')">Election</a></div>
                </div>

                <div class="ml-12">
                    <div class="mt-2 text-sm text-gray-500">
                        Eligible voting member must be:
                        <div class="list-disc pl-2">
                            <li>a regular member of the USC MPC.</li>
                            <li>registered before 9:30 AM during the General Assembly Day.</li>
                            <li>a member of good standing (MIGS).</li>
                        </div>

                    </div>
                    <div class="mt-2 text-sm text-gray-500">
                        Election Schedule:
                        <div class="list-none pl-7 font-bold">
                            <li>Open around 10:30 AM by the signal of the Election Committee</li>
                            <li>Close around 11:30 AM</li>
                        </div>

                    </div>

                    <a v-bind:href="route('election')">
                        <div class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
                                <div>Cast your vote</div>

                                <div class="ml-1 text-indigo-500">
                                    <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="p-6 border-t border-gray-200 md:border-t-0 md:border-l">
                <div class="flex items-center">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-400"><path d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold"><a v-bind:href="route('poll')">Poll</a></div>
                </div>

                <div class="ml-12">
                    <div class="mt-2 text-sm text-gray-500">
                        Participate in the amendment of a new guideline.
                    </div>

                    <a v-bind:href="route('poll')">
                        <div class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
                                <div>Participate now</div>

                                <div class="ml-1 text-indigo-500">
                                    <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-1">
            <div class="p-6">
                <div class="flex items-center">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-400"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    <div class="ml-4 text-lg text-gray-600 leading-7 font-bold"><a :href="'//' + 'us02web.zoom.us/j/81874405873?pwd=QlBLOWtWeGdFbXNtdThJZC9CS2VGZz09'" target="_blank">General Assembly - Zoom</a></div>
                </div>

                <div class="ml-12">
                    <div class="mt-2 text-sm text-gray-500">
                        The general assembly will be in zoom.<br/>
                        Meeting ID: <span class="font-bold">818 7440 5873</span><br/>
                        Passcode: <span class="font-bold">USCMPC</span>
                    </div>
                    <a :href="'//' + 'us02web.zoom.us/j/81874405873?pwd=QlBLOWtWeGdFbXNtdThJZC9CS2VGZz09'" target="_blank">
                        <div class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
                            <div>Click here to join in the zoom</div>

                            <div class="ml-1 text-indigo-500">
                                <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>
n
<script>
    import JetApplicationLogo from '@/Jetstream/ApplicationLogo'

    export default {
        components: {
            JetApplicationLogo,
        },
    }
</script>
