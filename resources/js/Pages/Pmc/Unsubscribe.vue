<template>
    <div class="mb-4">
        <h1>Unsubscribe</h1>
    </div>


    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
        {{ status }}
    </div>


    <p>You have successfully unsubscribed!</p>


        <div class="flex items-center justify-end mt-4">


<!--            <inertia-link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900">-->
<!--                Forgot your password?-->
<!--            </inertia-link>-->

            <breeze-button class="ml-4" @click="closeWindow()">
                Close Window
            </breeze-button>
        </div>
</template>

<script>
    import BreezeButton from '@/Components/Button'
    import PmcLayout from "@/Layouts/Pmc"
    import BreezeInput from '@/Components/Input'

    export default {
        layout: PmcLayout,

        components: {
            BreezeButton,
            BreezeInput,
        },

        props: {
            status: String,
            auth: Object,
            errors: Object,
        },

        methods: {
            closeWindow() {
                window.close();
            }
        }
    }
</script>
