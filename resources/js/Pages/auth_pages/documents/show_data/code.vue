<template>
    <Head title="AI-Tool" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight page_title">
                <i class="fa-solid fa-star"></i>
                /AI-Code</h2>
        </template>
        <div class="code_tools_template_show">
            <div class="frame">
                <div class="container">
                    <form @submit.prevent="saveContent">
                        <header>
                            <div class="inputs">
                                <input type="text" class="input" required v-model="form.title">
                            </div>
                            <div class="button">
                            </div>
                        </header>
                        <body ref="content" contenteditable="true" v-html="form.htmlContent">
                        </body>
                    </form>
                </div>
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
        Link,
    },
    props: {
        Documents: Object,
    },

    data() {
        return {
            form: this.$inertia.form({
                htmlContent: this.Documents[0].htmlContent ,
                title: this.Documents[0].title ,
            }),
        }
    },
    mounted() {

    },
    methods: {
        //copy text
        async copyMessage(text) {
            try {
                await navigator.clipboard.writeText(text);
                alert('Message copied to clipboard!');
            } catch (err) {
                console.error('Failed to copy: ', err);
            }
        },
    },
    mounted() {

    },
}
</script>