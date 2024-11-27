<template>
<div class="frame_ai_image">
    <div class="cards">
        <div class="card" v-for="(tool,index) in $page.props.auth.AiImage[0]">
            <div class="card_header">
                <p v-html="tool.logo" class="mb-4" :style="{backgroundColor: tool.color , color: tool.logo_color}"></p>
                <div class="star">
                    <label class="container">
                        <input type="checkbox"  @click="addFavorit(tool.id)" :checked="tool.id === tool.id_tool">
                        <svg height="24px" id="Layer_1" version="1.2" viewBox="0 0 24 24" width="24px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><g><path d="M9.362,9.158c0,0-3.16,0.35-5.268,0.584c-0.19,0.023-0.358,0.15-0.421,0.343s0,0.394,0.14,0.521    c1.566,1.429,3.919,3.569,3.919,3.569c-0.002,0-0.646,3.113-1.074,5.19c-0.036,0.188,0.032,0.387,0.196,0.506    c0.163,0.119,0.373,0.121,0.538,0.028c1.844-1.048,4.606-2.624,4.606-2.624s2.763,1.576,4.604,2.625    c0.168,0.092,0.378,0.09,0.541-0.029c0.164-0.119,0.232-0.318,0.195-0.505c-0.428-2.078-1.071-5.191-1.071-5.191    s2.353-2.14,3.919-3.566c0.14-0.131,0.202-0.332,0.14-0.524s-0.23-0.319-0.42-0.341c-2.108-0.236-5.269-0.586-5.269-0.586    s-1.31-2.898-2.183-4.83c-0.082-0.173-0.254-0.294-0.456-0.294s-0.375,0.122-0.453,0.294C10.671,6.26,9.362,9.158,9.362,9.158z"></path></g></g></svg>
                    </label>
                </div>
            </div>
            <div class="desc_card" v-if="$page.props.auth.user.payment">
                <div v-if=" $page.props.auth.user.special_user || $page.props.auth.user_plan[0].title == 'Standard' || $page.props.auth.user_plan[0].title == 'Premium'">
                    <Link class="title" :href="`ai_tools_template/${tool.id}`">{{ tool.title }}</Link>
                    <Link class="description" :href="`ai_tools_template/${tool.id}`">{{ tool.description }}</Link>
                </div>
                <div v-else>
                    <p class="title" @click="need_subscription_popup_fun('Standard')">{{ tool.title }}</p>
                    <p class="description" @click="need_subscription_popup_fun('Standard')">{{ tool.description }}</p>
                </div>
            </div>
            <div class="desc_card" v-else>
                <div >
                    <p class="title" @click="need_subscription_popup_fun('Standard')">{{ tool.title }}</p>
                    <p class="description" @click="need_subscription_popup_fun('Standard')">{{ tool.description }}</p>
                </div>
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
</template>
<script setup>
import { Head , Link} from '@inertiajs/vue3';
</script>

<script>
export default {
    name: 'App',
    components: {
        Head,
        Link
    },
    props: {

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
        need_subscription_popup_fun(level){
            this.need_subscription_popup?
                this.need_subscription_popup = false:
                [
                    this.subs_level = level,
                    this.need_subscription_popup = true,
                ];
        },
        addFavorit(tool_id) {
            this.$inertia.post(`ai_tools_list/${tool_id}/add_favorit`);
        },
    },
}
</script>