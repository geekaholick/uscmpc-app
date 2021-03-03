<template>
    <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-3">
        <div v-for="(candidate, index) in candidates">
            <div class="p-6 border-gray-900">
                <div class="flex items-center">
                    <div class="text-lg text-gray-600 font-bold" v-bind:class="{ active: candidate.isActive }">
                        {{ candidate.last_name }}, {{ candidate.first_name }}
                    </div>
                </div>

                <div class="ml-12">
                    <div class="mt-2 text-sm text-gray-500">
                        Eligible voting member must be:
                    </div>

                    <jet-button class="ml-4 bg-gray-500" @click.prevent="toggleActive(index)">
                        Select
                    </jet-button>
                    <a href="#">
                        <div class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
                            <div>Cast your vote</div>
                            <div class="ml-1 text-indigo-500">
                                <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                    <path fill-rule="evenodd"
                                          d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                          clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="grid-cols-1 md:grid-cols-3" align="center" justify="center">
        <jet-button class="ml-4">
            CAST VOTE
        </jet-button>
    </div>

</template>

<script>
import JetButton from '@/Jetstream/Button'
import Button from "../../Jetstream/Button";

export default {
    components: {
        Button,
        JetButton
    },
    data() {
        return {
            candidates: [
                {
                    id: 1,
                    first_name: "Gran",
                    last_name: "Sabandal",
                    isActive: false,
                    error: null
                },
                {
                    id: 2,
                    first_name: "Edrian",
                    last_name: "Guanzon",
                    isActive: false,
                    error: null
                },
                {
                    id: 3,
                    first_name: "John Rex",
                    last_name: "Pana",
                    isActive: false,
                    error: null
                }, {
                    id: 4,
                    first_name: "Godwin",
                    last_name: "Monserate",
                    isActive: false,
                    error: null
                },
                {
                    id: 5,
                    first_name: "Allan",
                    last_name: "Cayetano",
                    isActive: false,
                    error: null
                },
                {
                    id: 6,
                    first_name: "Chin",
                    last_name: "Chong",
                    isActive: false,
                    error: null
                },
                {
                    id: 7,
                    first_name: "Teh",
                    last_name: "Gulang",
                    isActive: false,
                    error: null
                }
            ],
            count: 0
        }
    },
    methods: {
        toggleActive(index) {
            if(this.count<3 || this.candidates[index].isActive){
                if(this.candidates[index].isActive) {
                    this.count--;
                } else {
                    this.count++;
                }
                this.candidates[index].isActive = !this.candidates[index].isActive;
            }
        }
        // submit() {
        //     this.form.post(this.route('register'), {
        //         onFinish: () => this.form.reset('password', 'password_confirmation'),
        //     })
        // }
    }
}
</script>

<style scoped>
.active {
    color: #0eaf67;
    background: yellow;
}
</style>
