<template>
<Head title="Subscription" />
<AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight page_title">
                <i class="fa-solid fa-credit-card"></i>
                /Subscription</h2>
        </template>
        <div class="subscription_result">
            <div class="frame">
                <div class="logo">
                    <img src="/icon/payment_success.png" alt="">
                </div>
                <div class="title">your payment is successfull</div>
                <p>thank you for your payment, an automated payment will be sent to your registered account</p>
                <Link :href="route('Subscription')"> back to home </Link>
            </div>
        </div>
</AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head,Link } from '@inertiajs/vue3';
</script>

<script>
export default {
    name: 'App',
    components: {
        Head,
        Link
    },

    data() {
        return {

        }
    },
    mounted() {

    },
    methods: {

    },
}
</script>