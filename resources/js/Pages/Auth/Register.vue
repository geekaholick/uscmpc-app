<template>
    <jet-authentication-card>
        <template #logo>
            <jet-authentication-card-logo />
        </template>

        <jet-validation-errors class="mb-4" />

        <form @submit.prevent="submit">
            <div class="mt-4">
                <jet-label for="title" value="Title" />
                <!-- <jet-input id="title" type="text" class="mt-1 block w-full" v-model="form.title" autofocus autocomplete="title" /> -->
                <select id="title" class="mt-1 block w-full" v-model="form.title" required autofocus autocomplete="title" style="border-radius: 5px; border: 1px solid #e2e4e7;">
                    <option value="Mr">Mr</option>
                    <option value="Ms">Ms</option>
                </select>

            </div>

            <div class="mt-4">
                <jet-label for="first_name" value="First Name" />
                <jet-input id="first_name" type="text" class="mt-1 block w-full" v-model="form.first_name" required autofocus autocomplete="first_name" />
            </div>

            <div class="mt-4">
                <jet-label for="middle_name" value="Middle Name" />
                <jet-input id="middle_name" type="text" class="mt-1 block w-full" v-model="form.middle_name"  autofocus autocomplete="middle_name" />
            </div>

            <div class="mt-4">
                <jet-label for="last_name" value="Last Name" />
                <jet-input id="last_name" type="text" class="mt-1 block w-full" v-model="form.last_name" required autofocus autocomplete="last_name" />
            </div>

            <div class="mt-4">
                <jet-label for="email" value="Email" />
                <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" required />
            </div>

            <div class="mt-4">
                <jet-label for="password" value="Password" />
                <jet-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <jet-label for="password_confirmation" value="Confirm Password" />
                <jet-input id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="mt-4" v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature">
                <jet-label for="terms">
                    <div class="flex items-center">
                        <jet-checkbox name="terms" id="terms" v-model:checked="form.terms" />

                        <div class="ml-2">
                            I agree to the <a target="_blank" :href="route('terms.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Terms of Service</a> and <a target="_blank" :href="route('policy.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Privacy Policy</a>
                        </div>
                    </div>
                </jet-label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <inertia-link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900">
                    Already registered?
                </inertia-link>

                <jet-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </jet-button>
            </div>
        </form>
    </jet-authentication-card>
</template>

<script>
    import JetAuthenticationCard from '@/Jetstream/AuthenticationCard';
    import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo';
    import JetButton from '@/Jetstream/Button';
    import JetInput from '@/Jetstream/Input';
    import JetCheckbox from "@/Jetstream/Checkbox";
    import JetLabel from '@/Jetstream/Label';
    import JetValidationErrors from '@/Jetstream/ValidationErrors';
    import JetDropdown from '@/Jetstream/Dropdown';

    export default {
        components: {
            JetAuthenticationCard,
            JetAuthenticationCardLogo,
            JetButton,
            JetInput,
            JetCheckbox,
            JetLabel,
            JetValidationErrors,
            JetDropdown
        },

        data() {
            return {
                selected: null,
        options: [
          { value: null, text: 'Please select an option' },
          { value: 'a', text: 'This is First option' },
          { value: 'b', text: 'Selected Option' },
          { value: { C: '3PO' }, text: 'This is an option with object value' },
          { value: 'd', text: 'This one is disabled', disabled: true }
        ],
                
                
                form: this.$inertia.form({
                    title: '',
                    first_name: '',
                    middle_name: '',
                    last_name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                    terms: false,
                }),
                titles:[
                    {
                        options:[
                            {value:'Mr', text:'Mr'},
                            {value:'Ms', text:'Ms'}
                        ],
                        selectedOption: ""
                    }
                ]


            }
        },

        methods: {
            submit() {
                this.form.post(this.route('register'), {
                    onFinish: () => this.form.reset('password', 'password_confirmation'),
                })
            }
        }
    }
</script>
