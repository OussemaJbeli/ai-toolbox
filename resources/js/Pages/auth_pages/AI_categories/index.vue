<template>
    <Head title="AI-Categorie" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight page_title">
                <i class="fa-solid fa-table-list"></i>
                /AI-Categorie</h2>
        </template>
        <div class="AI_Categorie_frame">
            <div class="frame_ai">
                <div v-for="categories in $page.props.auth.categories[0]">
                    <p class="header_categorie">
                        <span class="title">{{ categories.name }}</span>
                        <span class="description">{{ categories.description }}</span>
                    </p>
                    <div class="cards" v-if="categories.name == 'Text Generator'">
                        <div class="card" v-for="sub_cat in $page.props.auth.AiText.navbar[0]">
                            <div class="card_header">
                                <p v-html="sub_cat.logo" class="mb-4" :style="{backgroundColor: sub_cat.theme , color: sub_cat.color}"></p>
                                <div class="star">
                                    <label class="container">
                                        <input type="checkbox"  @click="add_sub_Favorit_categorie(sub_cat.id)" :checked="sub_cat.id == sub_cat.id_categorie">
                                        <svg height="24px" id="Layer_1" version="1.2" viewBox="0 0 24 24" width="24px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><g><path d="M9.362,9.158c0,0-3.16,0.35-5.268,0.584c-0.19,0.023-0.358,0.15-0.421,0.343s0,0.394,0.14,0.521    c1.566,1.429,3.919,3.569,3.919,3.569c-0.002,0-0.646,3.113-1.074,5.19c-0.036,0.188,0.032,0.387,0.196,0.506    c0.163,0.119,0.373,0.121,0.538,0.028c1.844-1.048,4.606-2.624,4.606-2.624s2.763,1.576,4.604,2.625    c0.168,0.092,0.378,0.09,0.541-0.029c0.164-0.119,0.232-0.318,0.195-0.505c-0.428-2.078-1.071-5.191-1.071-5.191    s2.353-2.14,3.919-3.566c0.14-0.131,0.202-0.332,0.14-0.524s-0.23-0.319-0.42-0.341c-2.108-0.236-5.269-0.586-5.269-0.586    s-1.31-2.898-2.183-4.83c-0.082-0.173-0.254-0.294-0.456-0.294s-0.375,0.122-0.453,0.294C10.671,6.26,9.362,9.158,9.362,9.158z"></path></g></g></svg>
                                    </label>
                                </div>
                            </div>
                            <p class="title">{{ sub_cat.name }}</p>
                            <p class="description">{{sub_cat.description}}</p>
                        </div>
                    </div>
                    <div class="cards" v-else>
                        <div class="card">
                            <div class="card_header">
                                <p v-html="categories.logo" class="mb-4" :style="{backgroundColor: categories.theme , color: categories.color}"></p>
                                <div class="star">
                                    <label class="container">
                                        <input type="checkbox"  @click="add_Favorit_categorie(categories.id)" :checked="categories.id == categories.id_categorie">
                                        <svg height="24px" id="Layer_1" version="1.2" viewBox="0 0 24 24" width="24px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><g><path d="M9.362,9.158c0,0-3.16,0.35-5.268,0.584c-0.19,0.023-0.358,0.15-0.421,0.343s0,0.394,0.14,0.521    c1.566,1.429,3.919,3.569,3.919,3.569c-0.002,0-0.646,3.113-1.074,5.19c-0.036,0.188,0.032,0.387,0.196,0.506    c0.163,0.119,0.373,0.121,0.538,0.028c1.844-1.048,4.606-2.624,4.606-2.624s2.763,1.576,4.604,2.625    c0.168,0.092,0.378,0.09,0.541-0.029c0.164-0.119,0.232-0.318,0.195-0.505c-0.428-2.078-1.071-5.191-1.071-5.191    s2.353-2.14,3.919-3.566c0.14-0.131,0.202-0.332,0.14-0.524s-0.23-0.319-0.42-0.341c-2.108-0.236-5.269-0.586-5.269-0.586    s-1.31-2.898-2.183-4.83c-0.082-0.173-0.254-0.294-0.456-0.294s-0.375,0.122-0.453,0.294C10.671,6.26,9.362,9.158,9.362,9.158z"></path></g></g></svg>
                                    </label>
                                </div>
                            </div>
                            <p class="title">{{ categories.name }}</p>
                            <p class="description">{{categories.description}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<script>
export default {
    name: 'App',
    components: {
        Head,
    },
    props: {

    },

    data() {
        return {
            favorit_popup:false,
            popup_title: null,
            popup_description: null,
        }
    },
    mounted() {

    },
    methods: {
        add_sub_Favorit_categorie(cat_id) {
            this.$inertia.post(`ai_categories_list/${cat_id}/add_sub_favorit`)
        },
        add_Favorit_categorie(cat_id) {
            this.$inertia.post(`ai_categories_list/${cat_id}/add_favorit`)
        },
    },
}
</script>