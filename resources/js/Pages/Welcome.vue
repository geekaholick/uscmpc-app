<template>
    <div
        class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
        <div v-if="canLogin" class="fixed top-0 right-0 px-6 py-4 sm:block">
            <inertia-link v-if="$page.props.user" href="/dashboard" class="text-sm text-gray-700 underline">
                <span class="text-l">Dashboard</span>
            </inertia-link>

            <template v-else>
                <inertia-link :href="route('login')" class="text-sm text-gray-700 underline">
                    <span class="text-l">Log in</span>
                </inertia-link>

<!--                <inertia-link v-if="canRegister" :href="route('register')" class="ml-4 text-sm text-gray-700 underline">-->
<!--                    <span class="text-l">Register</span>-->
<!--                </inertia-link>-->
            </template>
        </div>

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                <div>
                    <img src="/images/uscmpc-logo.png" alt="Logo" width="200"/>
                </div>
            </div>


            <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-1">
                    <div class="p-6">
                        <div class="flex items-center">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                 stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500">
                                <path
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                            <div class="ml-4 ">
                                <span class="text-2xl 2xl:leading-8 font-bold">University of San Carlos Multi-Purpose Cooperative</span>
                                <br/>
                                <span class="text-xl xl:leading-8 font-bold">Election</span><br/>
                                <div v-if="canLogin">
                                    <inertia-link v-if="$page.props.user" href="/dashboard"
                                                  class="text-sm text-gray-700 underline">
                                        <span class="text-sm text-green-400 text-2xl 2xl:leading-8 font-bold">Proceed to Dashboard</span>
                                    </inertia-link>

                                    <template v-else>
                                        <inertia-link :href="route('login')" class="text-sm text-gray-700 underline">
                                            <span class="text-sm text-green-400 text-2xl 2xl:leading-8 font-bold">Proceed to Log in</span>
                                        </inertia-link>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-1">
                    <div class="p-6">
                        <div class="items-center">
                            <div class="text-center text-lg text-gray-500 sm:text-right sm:ml-0">
                                Candidates for the USC MPC Board of Directors (BOD)
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-4 md:grid-cols-7" align="center" justify="center">
                    <!--                    <div class="m-4" v-for="x in 7">-->
                    <!--                        <img :src="'/images/ {{ x }} .jpg'" class="rounded-full h-36 w-36 object-cover">-->
                    <!--                    </div>-->

                    <div class="p-6">
                        <img src="/images/1.jpg" alt="Logo" class="rounded-full h-36 w-36 object-cover"/>
                    </div>

                    <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l">
                        <img src="/images/2.jpg" alt="Logo" class="rounded-full h-36 w-36 object-cover"/>
                    </div>

                    <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l">
                        <img src="/images/3.jpg" alt="Logo" class="rounded-full h-36 w-36 object-cover"/>
                    </div>

                    <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l">
                        <img src="/images/4.jpg" alt="Logo" class="rounded-full h-36 w-36 object-cover"/>
                    </div>

                    <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l">
                        <img src="/images/5.jpg" alt="Logo" class="rounded-full h-36 w-36 object-cover"/>
                    </div>

                    <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l">
                        <img src="/images/6.jpg" alt="Logo" class="rounded-full h-36 w-36 object-cover"/>
                    </div>

                    <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l">
                        <img src="/images/7.jpg" alt="Logo" class="rounded-full h-36 w-36 object-cover"/>
                    </div>
                </div>
            </div>

            <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
                <div class="text-center text-sm text-gray-500 sm:text-left">
                    <div class="flex items-center">
                        <div v-if="canLogin" class="ml-4 text-center text-sm text-gray-500 sm:left sm:ml-0">
                            <inertia-link v-if="$page.props.user" href="/dashboard" class="text-sm text-gray-700">
                                Dashboard
                            </inertia-link>

                            <template v-else>
                                <inertia-link :href="route('login')" class="text-sm text-gray-700">
                                    Log in
                                </inertia-link>

<!--                                <inertia-link v-if="canRegister" :href="route('register')"-->
<!--                                              class="ml-4 text-sm text-gray-700">-->
<!--                                    Register-->
<!--                                </inertia-link>-->
                            </template>
                        </div>
                        <!--                        <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"-->
                        <!--                             viewBox="0 0 24 24" stroke="currentColor" class="-mt-px w-5 h-5 text-gray-400">-->
                        <!--                            <path-->
                        <!--                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>-->
                        <!--                        </svg>-->

                        <!--                        <a href="https://laravel.bigcartel.com" class="ml-1 underline">-->
                        <!--                            Shop-->
                        <!--                        </a>-->

                        <!--                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"-->
                        <!--                             stroke-width="2" viewBox="0 0 24 24" class="ml-4 -mt-px w-5 h-5 text-gray-400">-->
                        <!--                            <path-->
                        <!--                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>-->
                        <!--                        </svg>-->

                        <!--                        <a href="https://github.com/sponsors/taylorotwell" class="ml-1 underline">-->
                        <!--                            Sponsor-->
                        <!--                        </a>-->
                    </div>
                </div>

                <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                    Powered by USC MPC TT
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.bg-gray-100 {
    background-color: #f7fafc;
    background-color: rgba(247, 250, 252, var(--tw-bg-opacity));
}

.border-gray-200 {
    border-color: #edf2f7;
    border-color: rgba(237, 242, 247, var(--tw-border-opacity));
}

.text-gray-400 {
    color: #cbd5e0;
    color: rgba(203, 213, 224, var(--tw-text-opacity));
}

.text-gray-500 {
    color: #a0aec0;
    color: rgba(160, 174, 192, var(--tw-text-opacity));
}

.text-gray-600 {
    color: #718096;
    color: rgba(113, 128, 150, var(--tw-text-opacity));
}

.text-gray-700 {
    color: #4a5568;
    color: rgba(74, 85, 104, var(--tw-text-opacity));
}

.text-gray-900 {
    color: #1a202c;
    color: rgba(26, 32, 44, var(--tw-text-opacity));
}

@media (prefers-color-scheme: dark) {
    .dark\:bg-gray-800 {
        background-color: #2d3748;
        background-color: rgba(45, 55, 72, var(--tw-bg-opacity));
    }

    .dark\:bg-gray-900 {
        background-color: #1a202c;
        background-color: rgba(26, 32, 44, var(--tw-bg-opacity));
    }

    .dark\:border-gray-700 {
        border-color: #4a5568;
        border-color: rgba(74, 85, 104, var(--tw-border-opacity));
    }

    .dark\:text-white {
        color: #fff;
        color: rgba(255, 255, 255, var(--tw-text-opacity));
    }

    .dark\:text-gray-400 {
        color: #cbd5e0;
        color: rgba(203, 213, 224, var(--tw-text-opacity));
    }
}
</style>

<script>
import DialogModal from "../Jetstream/DialogModal";

export default {
    components: {DialogModal},
    props: {
        canLogin: Boolean,
        canRegister: Boolean,
        laravelVersion: String,
        phpVersion: String,
    }
}
</script>
