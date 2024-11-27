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
                        <img src="/icon/payment_error.png" alt="">
                    </div>
                    <div class="title">payment failed</div>
                    <p>please check your internet connection</p>
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