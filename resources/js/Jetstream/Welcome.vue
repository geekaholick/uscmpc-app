<template>
  <div :set="(current_user = $page.props.user.id)">
    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
      <div class="mt-8 text-3xl">
        Hello
        <span class="font-bold">
          {{ $page.props.user.title }}
          {{ $page.props.user.first_name }}
          {{ $page.props.user.last_name }}! </span
        ><br />
        Welcome to your USC and Community Multi-Purpose Cooperative portal!
      </div>
      <div v-if="$page.props.user.uscmpc_id != null">
        <div class="mt-6 md:text-2xl text-gray-800">
          <div>
            Special General Assembly Meeting <br />
            October 24, 2021 (Sunday) via
            <a
              href="https://us02web.zoom.us/j/87102886455?pwd=WGI4dUp4ZjFOM3kwbTRyaDZCcWlldz09"
              class="underline text-blue-500"
              >Zoom</a
            >
            <br />
            Meeting ID: 871 0288 6455<br />
            Passcode: USCMPC <br />
            <div class="mt-6 md:text-xl text-gray-800">
              <div v-if="$page.props.user.election_status == 0">
                <span class="mt-6 md:text-2xl font-bold">
                  Event registration will open from
                  <span class="underline text-green-800">7:00 AM</span> until
                  <span class="underline text-green-800">9:00 AM</span>. A
                  <u>"Check-In"</u> button will show here.
                </span>
                <br />
                A meal allowance (Php 200.00) and internet allowance (Php
                300.00) will be credited to your respective PNB Bank accounts at
                least a week after the special General Assembly for a successful
                check-in. Thank you.<br />
              </div>
              <div v-else-if="$page.props.user.election_status == 1">
                Check-in Time: 7:00 AM - 9:00 AM<br />
                <span class="mt-6 md:text-2xl font-bold"
                  >Click the check-in button to Register/Confirm attendance.
                </span>
                <div>
                  <jet-button class="ml-2" @click="checkIn"
                    >Check In</jet-button
                  >
                </div>
              </div>
              <div v-else>
                <span class="font-bold">Attendance Status: </span>
                <span v-if="$page.props.user.election_status == 2">
                  <span class="text-green-800 font-bold">PRESENT</span><br />
                  You have successfully check-in for the event. Please proceed
                  to the event using the
                  <a
                    href="https://us02web.zoom.us/j/87102886455?pwd=WGI4dUp4ZjFOM3kwbTRyaDZCcWlldz09"
                    class="underline text-blue-500"
                    >zoom</a
                  >
                  link provided.
                  <!-- {{ $page.props.user.updated_at }} -->
                </span>
                <span v-else>
                  <span class="text-yellow-500 font-bold">LATE</span><br />
                  You have missed the CHECK-IN time for the event (between 7:00
                  AM to 9:00 AM). You can still proceed to the event using the
                  <a
                    href="https://us02web.zoom.us/j/87102886455?pwd=WGI4dUp4ZjFOM3kwbTRyaDZCcWlldz09"
                    class="underline text-blue-500"
                    >zoom</a
                  >
                  link provided.
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div v-else>
        <div class="mt-6 md:text-lg text-gray-500">
          <div>
            <span class="text-2xl font-bold bg-yellow-300"
              >Your account is being validated. Please wait with in 24 hours. Thank you.</span
            >
          </div>
          <div>
            ---<br />
            If you have questions, please don't hesitate to contact the
            office.<br />
            Email: official.uscmpc@gmail.com<br />
            USCMPC Technical Committee Contact Number: (032)233 4341<br />
            Contact Person: USC MPC Registration Team<br />
            ---<br />
            Contact Number: (032)384 0024<br />
            Contact Person: Maria Conception Gaviola
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
n
<script>
import JetApplicationLogo from "@/Jetstream/ApplicationLogo";
import JetButton from "@/Jetstream/Button";
import axios from "axios";

export default {
  components: {
    JetApplicationLogo,
    JetButton,
  },
  data() {
    return {
      current_user: null,
      time_in: null,
    };
  },
  created() {},
  methods: {
    checkIn() {
      // this.status = 1;
      // window.location.reload();
      let BaseApi = axios.create({
        baseURL: "http://event.uscmpc.com/api",
      });
      BaseApi.post("check-in", {
        current_user: this.current_user,
      })
        .then((response) => {
          console.log(response.data);
          window.location.reload();
        })
        .catch((error) => {
          console.log("error");
        });
    },
    get_time() {
      let BaseApi = axios.create({
        baseURL: "http://event.uscmpc.com/api",
      });
      BaseApi.post("time-in", {
        current_user: this.current_user,
      })
        .then((response) => {
          this.time_in = response.data;
        })
        .catch((error) => {
          console.log("error");
        });
    },
  },
};
</script>
