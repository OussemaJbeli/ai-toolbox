<template>
    <Head title="AI-Tool" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight page_title">
                <i class="fa-solid fa-star"></i>
                /AI-Tool</h2>
        </template>
        <div class="header_search_tools">
            <p>List Tools</p>
            <label :style="{ width: search_run? '50%' : '20%' }" class="label_for_search">
                <i class="fa-solid fa-circle-xmark" v-if="search_run" @click="start_searsh()" ></i>
                <i class="fa-solid fa-magnifying-glass" v-else @click="start_searsh()" ></i>
                <input 
                    class="search ml-2" type="search" 
                    v-model="searchQuery" 
                    placeholder="search ..." 
                    :style="{ display: search_run? 'flex' : 'none' }"
                />
            </label>
        </div>
        <div class="AI_Tool_frame" v-if="!search_run">
            <div class="nav_bar_ai">
                <div class="radio-inputs" v-for="(categories,index) in $page.props.auth.categories[0]">
                        <label @click="pagination(index)">
                            <input class="radio-input" type="radio" name="engine" :checked="index === 0">
                            <span class="radio-tile">
                                <span class="radio-icon" v-html="categories.logo"></span>
                                <span class="radio-label">{{categories.name}}</span>
                            </span>
                        </label>
                </div>
            </div>
            <div class="frame_ai">
                <div v-if="page1">
                    <TextFrame/>
                </div>
                <div v-if="page2">
                    <ImageFrame/>
                </div>
                <div v-if="page3">
                    <CodeFrame/>
                </div>
                <div v-if="page4">
                    <ChatFrame/>
                </div>
                <div v-if="page5">
                    <VoiceFrame/>
                </div>
            </div>
        </div>
        <div class="AI_search_frame" v-else>
            <div class="cards">
                <div class="card" :class="{'freemCard': sub_cat.Free, 'proCard': sub_cat.pro, 'premiumCard': sub_cat.premium}" v-for="sub_cat in filtereditms">
                            <div class="card_header">
                                <p v-html="sub_cat.logo" class="mb-4" :style="{backgroundColor: sub_cat.color , color: sub_cat.logo_color}"></p>
                                <div class="star">
                                    <label class="container">
                                        <input type="checkbox">
                                        <svg height="24px" id="Layer_1" version="1.2" viewBox="0 0 24 24" width="24px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><g><path d="M9.362,9.158c0,0-3.16,0.35-5.268,0.584c-0.19,0.023-0.358,0.15-0.421,0.343s0,0.394,0.14,0.521    c1.566,1.429,3.919,3.569,3.919,3.569c-0.002,0-0.646,3.113-1.074,5.19c-0.036,0.188,0.032,0.387,0.196,0.506    c0.163,0.119,0.373,0.121,0.538,0.028c1.844-1.048,4.606-2.624,4.606-2.624s2.763,1.576,4.604,2.625    c0.168,0.092,0.378,0.09,0.541-0.029c0.164-0.119,0.232-0.318,0.195-0.505c-0.428-2.078-1.071-5.191-1.071-5.191    s2.353-2.14,3.919-3.566c0.14-0.131,0.202-0.332,0.14-0.524s-0.23-0.319-0.42-0.341c-2.108-0.236-5.269-0.586-5.269-0.586    s-1.31-2.898-2.183-4.83c-0.082-0.173-0.254-0.294-0.456-0.294s-0.375,0.122-0.453,0.294C10.671,6.26,9.362,9.158,9.362,9.158z"></path></g></g></svg>
                                    </label>
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
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ChatFrame from './ai-pages/ai-chat.vue';
import CodeFrame from './ai-pages/ai-code.vue';
import ImageFrame from './ai-pages/ai-image.vue';
import TextFrame from './ai-pages/ai-text.vue';
import VoiceFrame from './ai-pages/ai-voice.vue';
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

    },

    data() {
        return {
            page1:true,
            page2:false,
            page3:false,
            page4:false,
            page5:false,

            searchQuery: '',
            search_run: false,

            need_subscription_popup:false,
            subs_level: null,
        }
    },
    mounted() {

    },
    methods: {
        pagination(index){
            switch (index) {
                case 0:this.page1=true;this.page2=false;this.page3=false;this.page4=false;this.page5=false;break;
                case 1:this.page1=false;this.page2=true;this.page3=false;this.page4=false;this.page5=false;break;
                case 2:this.page1=false;this.page2=false;this.page3=true;this.page4=false;this.page5=false;break;
                case 3:this.page1=false;this.page2=false;this.page3=false;this.page4=true;this.page5=false;break;
                case 4:this.page1=false;this.page2=false;this.page3=false;this.page4=false;this.page5=true;break;

            }
        },
        start_searsh(){
            this.search_run?
                [
                    this.search_run=false,
                    this.searchQuery='',
                ]:
                this.search_run=true;
        },

        addFavorit(tool_id) {
            this.$inertia.post(`ai_tools_list/${tool_id}/add_favorit`);
        },
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
    computed: {
        filtereditms() {
            const query = this.searchQuery.toLowerCase();
            return this.$page.props.auth.tools[0].filter(tool => tool.title.toLowerCase().includes(query));
        }
    }
}
</script>