<template>
    <Head title="AI-Tool" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight page_title">
                <i class="fa-solid fa-pen-to-square"></i>
                /AI-edit</h2>
        </template>
        <div class="tools_table_frame">
            <div class="header_tab">
                <span class="h3">{{ categorie.name }}</span>
                <Link :href="`/ai_tools_edit/${categorie.id}/edit`" class="butt" v-if="!categorie.logo">
                    edit categorie
                </Link>
            </div>       
            <div class="cards">
                        <div class="card" :class="{'freemCard': sub_cat.Free, 'proCard': sub_cat.pro, 'premiumCard': sub_cat.premium}" v-for="sub_cat in list_tools">
                            <div class="card_header">
                                <p v-html="sub_cat.logo" class="mb-4" :style="{backgroundColor: sub_cat.color , color: sub_cat.logo_color}"></p>
                                <div class="star">
                                </div>
                            </div>
                            <div v-if="$page.props.auth.user.payment" class="desc_card">
                                <div v-if="$page.props.auth.user.special_user || (sub_cat.premium && $page.props.auth.user_plan[0].title == 'Premium')">
                                    <Link class="title" :href="`/ai_tools_template/${sub_cat.id}`">{{ sub_cat.title }}</Link>
                                    <Link class="description" :href="`/ai_tools_template/${sub_cat.id}`">{{ sub_cat.description }}</Link>
                                </div>
                                <div v-else-if="$page.props.auth.user.special_user || (sub_cat.pro && ($page.props.auth.user_plan[0].title == 'Pro' || $page.props.auth.user_plan[0].title == 'Premium'))">
                                    <Link class="title" :href="`/ai_tools_template/${sub_cat.id}`">{{ sub_cat.title }}</Link>
                                    <Link class="description" :href="`/ai_tools_template/${sub_cat.id}`">{{ sub_cat.description }}</Link>
                                </div>
                                <div v-else-if="$page.props.auth.user.special_user || (sub_cat.Standard && ($page.props.auth.user_plan[0].title == 'Standard' || $page.props.auth.user_plan[0].title == 'Pro' || $page.props.auth.user_plan[0].title == 'Premium'))">
                                    <Link class="title" :href="`/ai_tools_template/${sub_cat.id}`">{{ sub_cat.title }}</Link>
                                    <Link class="description" :href="`/ai_tools_template/${sub_cat.id}`">{{ sub_cat.description }}</Link>
                                </div>
                                <div v-else-if="$page.props.auth.user.special_user || (sub_cat.Free && ($page.props.auth.user_plan[0].title == 'Standard' || $page.props.auth.user_plan[0].title == 'Pro' || $page.props.auth.user_plan[0].title == 'Premium'))">
                                    <Link class="title" :href="`/ai_tools_template/${sub_cat.id}`">{{ sub_cat.title }}</Link>
                                    <Link class="description" :href="`/ai_tools_template/${sub_cat.id}`">{{ sub_cat.description }}</Link>
                                </div>
                                <div v-else>
                                    <p class="title" @click="need_subscription_popup_fun(sub_cat.premium,sub_cat.pro,sub_cat.Free)">{{ sub_cat.title }}</p>
                                    <p class="description" @click="need_subscription_popup_fun(sub_cat.premium,sub_cat.pro,sub_cat.Free)">{{ sub_cat.description }}</p>
                                </div>
                            </div>
                            <div v-else-if="sub_cat.Free" class="desc_card">
                                <div>
                                    <Link class="title" :href="`/ai_tools_template/${sub_cat.id}`">{{ sub_cat.title }}</Link>
                                    <Link class="description" :href="`/ai_tools_template/${sub_cat.id}`">{{ sub_cat.description }}</Link>
                                </div>
                            </div>
                            <div v-else>
                                <p class="title" @click="need_subscription_popup_fun(sub_cat.premium,sub_cat.pro,sub_cat.Free)">{{ sub_cat.title }}</p>
                                <p class="description" @click="need_subscription_popup_fun(sub_cat.premium,sub_cat.pro,sub_cat.Free)">{{ sub_cat.description }}</p>
                            </div>
                            <div class="plan_level">
                                <p v-if="sub_cat.premium" class="Premium"><i class="fa-solid fa-gem"></i>Premium</p>
                                <p v-else-if="sub_cat.pro" class="Pro"><i class="fa-solid fa-crown"></i>Pro</p>
                                <p v-else-if="sub_cat.Free" class="Free"><i class="fa-solid fa-gift"></i>Free</p>
                            </div>
                        </div>
            </div>
        </div>
        <div class="popup_favorit_add" v-if="need_subscription_popup">
            <div class="notificationCard">
                <i class="fa-solid fa-xmark"></i>
                <p class="notificationHeading">You Need <span>{{ subs_level }}</span> Subscription to open this Tool</p>
                <div class="buttonContainer">
                    <button class="AllowBtn" @click="need_subscription_popup_fun()">OK</button>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head , Link} from '@inertiajs/vue3';

</script>

<script>
export default {
    name: 'App',
    components: {
        Head,
        Link,
    },
    props: {
        list_tools: Object,
        categorie: Object,
    },

    data() {
        return {
            need_subscription_popup:false,
            subs_level: null,
        }
    },
    mounted() {

    },
    methods: {
        need_subscription_popup_fun(prum,pro,free){
            if(this.need_subscription_popup)
                this.need_subscription_popup = false
            else{
                if(prum)
                    this.subs_level = 'Premium';
                else if(pro)
                    this.subs_level = 'Pro';
                else
                    this.subs_level = 'Standard';

               this.need_subscription_popup = true;
            }
        },
    },
}
</script>