<template>
    <div class="p-4 bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-1" :set="voter=$page.props.user.id">
        Current Casted Votes: {{ countStatistics.voted }}<br/>
        Total Qualified Voters: {{ countStatistics.voters }}
    </div>
    <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-1">
        <div class="px-2">
            <table class="sm:table-auto  w-full">
                <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="px-4 py-2 w-10">Rank</th>
                    <th class="px-4 py-2 w-24"></th>
                    <th class="px-4 py-2">Candidate</th>
                    <th class="px-4 py-2">Votes</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(candidate, index) in candidateResults" :key="index"
                    v-bind:class="{martialgod: candidate.awesome[0], truegod: candidate.awesome[1], halfgod: candidate.awesome[2] }">
                    <td class="px-4 py-2">
                        {{ index + 1 }}
                    </td>
                    <td class="px-4 py-2">
                        <div v-if="candidate.candidate.profile_photo_path != null">
                            <img :src="candidate.candidate.profile_photo_path" :alt="candidate.candidate.first_name"
                                 class="rounded-full h-12 w-12 left">
                        </div>
                        <div v-else>
                            <img class="rounded-full h-12 w-12 object-cover">
                        </div>
                    </td>
                    <td class="px-4 py-2">
                        <div>
                            {{ candidate.candidate.last_name }}, {{ candidate.candidate.first_name }}
                        </div>
                    </td>
                    <td class="px-4 py-2">
                        <div>
                            {{ candidate.votes }}
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

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
            candidates: [],
            countStatistics: [],
            results: [],
            candidateResults: [],
        }
    },
    created() {
        this.list();
        this.getCount();
        this.getResult();
        this.combine();
        setInterval(this.getCount, 6000);
        setInterval(this.getResult, 6000);
        setInterval(this.combine, 6000);
    },
    methods: {
        list() {
            let BaseApi = axios.create({
                baseURL: "http://event.uscmpc.com/api"
            });
            BaseApi.get("candidate-list").then((response) => {
                console.log(response.data);
                this.candidates = response.data;
            })
                .catch((error) => {
                    console.log("error")
                })

        },
        getCount() {
            let BaseApi = axios.create({
                baseURL: "http://event.uscmpc.com/api"
            });
            BaseApi.get("count").then((response) => {
                console.log(response.data);
                this.countStatistics = response.data;
            })
                .catch((error) => {
                    console.log("error")
                })

        },
        getResult() {
            let BaseApi = axios.create({
                baseURL: "http://event.uscmpc.com/api"
            });
            BaseApi.get("result").then((response) => {
                console.log(response.data);
                this.results = response.data;
            })
                .catch((error) => {
                    console.log("error")
                })

        },
        combine() {
            this.candidateResults = [];
            for (let x = 0; x < this.results.length; ++x) {
                this.candidateResults.push({
                    'votes': this.results[x],
                    'candidate': this.candidates[x],
                    'awesome': [],
                });
                let i = this.candidateResults.length - 1;
                let item = this.candidateResults[i];
                while (i > 0 && item.votes > this.candidateResults[i - 1].votes) {
                    this.candidateResults[i] = this.candidateResults[i - 1];
                    i -= 1;
                }
                this.candidateResults[i] = item;
            }

            if (this.candidateResults.length > 0) {
                let levels = ["martialgod", "truegod", "halfgod"];
                let last = -1;
                for (let x = 0, ctr = 0, winner = 0; x < this.results.length; ++x , ++winner) {
                    if (winner < 3) {
                        this.candidateResults[x].awesome = [true, false, false];
                        last = x;
                    } else {
                        this.candidateResults[x].awesome = [false, false, false];
                    }
                }
                if (last != -1) {
                    let curr = this.candidateResults[last].votes;
                    let prev = this.candidateResults[last - 1].votes;
                    let next = this.candidateResults[last + 1].votes;
                    let ctrprev = last - 1;
                    let ctrnext = last + 1;
                    let flag1 = false;
                    let flag2 = false;

                    while (ctrnext < this.results.length && curr == next) {
                        this.candidateResults[ctrnext].awesome = [false, true, false];
                        next = this.candidateResults[ctrnext + 1].votes;
                        flag2 = true;
                        ctrnext++;
                    }
                    if (flag2) {
                        while (ctrprev != -1 && curr == prev) {
                            this.candidateResults[ctrprev].awesome = [false, true, false];
                            prev = this.candidateResults[ctrprev - 1].votes;
                            flag1 = true;
                            ctrprev--;
                        }
                        this.candidateResults[last].awesome = [false, true, false];
                    }
                }

                console.log(this.candidateResults);
            }
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

.martialgod {
    background: #2cf600;
}

.truegod {
    background: #fff608;
}

.halfgod {
    background: #ffa414;
}
</style>
