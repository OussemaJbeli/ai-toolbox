
<template>
    <Head title="Subscribers" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight page_title">
                <i class="fa-solid fa-key"></i>
                /API Settings</h2>
        </template>
        <div class="api_template_frame">
            <div class="frame">
                <div class="title"><span>{{ frame_var.title }}</span> Settings</div>
                <form @submit.prevent="save_Categorie">
                    <div class="inputs">
                        <label for="">
                            Secret key
                            <div class="eye">
                                <i class="fa-solid fa-eye-slash"  @click="showKey_fun" v-if="showKey == 'password'"></i>
                                <i class="fa-solid fa-eye" @click="showKey_fun" v-else></i>
                            </div>
                        </label>
                        <input :type="showKey" v-model="frame_var.key">
                    </div>
                    <div class="save">
                        <button type="submit">save</button>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link} from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';

</script>

<script>
export default {
    name: 'App',
    components: {
        Head,
        Link,
    },
    props: {
        api_info: Object,
    },

    data() {
        return {
            showKey: 'password',

            frame_var: this.$inertia.form({
                key: this.api_info.key,
                title: this.api_info.title,
            }),
        }
    },
    mounted() {

    },
    methods: {
        showKey_fun(){
            if(this.showKey == 'password')
                this.showKey = 'text';
            else
                this.showKey = 'password';
        },
        save_Categorie() {
            this.frame_var.get(`/general_setting_admin/storeAPI`);
        },
    },
}
</script>
