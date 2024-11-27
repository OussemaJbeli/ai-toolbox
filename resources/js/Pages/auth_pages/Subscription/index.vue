<template>
    <Head title="Subscription" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight page_title">
                <i class="fa-solid fa-credit-card"></i>
                /Subscription</h2>
        </template>
        <div class="subscription_detils_user">
            <div class="details">
                <p>
                    <img class="user_logo" :src="'/'+$page.props.auth.user.avatar "><span>{{ $page.props.auth.user.name }}</span>
                    <div class="plan_level" v-if="$page.props.auth.user_plan[0]">
                        <p v-if="$page.props.auth.user_plan[0].title == 'Premium'" class="Premium"><i class="fa-solid fa-gem"></i>Premium</p>
                        <p v-else-if="$page.props.auth.user_plan[0].title == 'Pro'" class="Pro"><i class="fa-solid fa-crown"></i>Pro</p>
                        <p v-else-if="$page.props.auth.user_plan[0].title == 'Standard'" class="Standard"><i class="fa-solid fa-hand-holding-dollar"></i>Standard</p>
                    </div>
                </p>
                <p>
                    <span class="text-green-500" v-if="$page.props.auth.user.admin">You have unlimited subscription<i class="fa-solid fa-check"></i></span>
                    <span class="text-green-500" v-else-if="$page.props.auth.user.payment">You have subscription <i class="fa-solid fa-check"></i></span>
                    <span class="text-red-500" v-else>You don't have subscription <i class="fa-solid fa-xmark"></i></span>
                </p>
            </div>
            <div v-if="$page.props.auth.user.admin">
                <div class="plane_delailes_usage">
                    <div class="title">Token Usage</div>
                    <div class="usage_details" v-if="tokens[0]">
                        <p class="card"><span class="Sub_detile">Minuts Usage </span><span v-if="tokens[0].usage_words">{{ tokens[0].usage_words }}/unlimited</span><span v-else>0/unlimited</span></p>
                        <p class="card"><span class="Sub_detile">Minuts Usage </span><span v-if="tokens[0].usage_images">{{ tokens[0].usage_images }}/unlimited</span><span v-else>0/unlimited</span></p>
                        <p class="card"><span class="Sub_detile">Minuts Usage </span><span v-if="tokens[0].usage_minuts">{{ tokens[0].usage_minuts }}/unlimited</span><span v-else>0/unlimited</span></p>
                    </div>
                    <div class="usage_details" v-else>
                        <p class="card"><span class="Sub_detile">Words Usage </span><span>0/unlimited</span></p>
                        <p class="card"><span class="Sub_detile">Images Usage </span><span>0/unlimited</span></p>
                        <p class="card"><span class="Sub_detile">Minuts Usage </span><span>0/unlimited</span></p>
                    </div>
                </div>
            </div>
            <div v-else-if="$page.props.auth.user.super_user">
                <div class="plane_delailes_usage">
                    <div class="title">Token Usage</div>
                    <div class="usage_details" v-if="tokens[0]">
                        <p class="card"><span class="Sub_detile">Minuts Usage </span><span v-if="tokens[0].usage_words">{{ tokens[0].usage_words }}/unlimited</span><span v-else>0/unlimited</span></p>
                        <p class="card"><span class="Sub_detile">Minuts Usage </span><span v-if="tokens[0].usage_images">{{ tokens[0].usage_images }}/unlimited</span><span v-else>0/unlimited</span></p>
                        <p class="card"><span class="Sub_detile">Minuts Usage </span><span v-if="tokens[0].usage_minuts">{{ tokens[0].usage_minuts }}/unlimited</span><span v-else>0/unlimited</span></p>
                    </div>
                    <div class="usage_details" v-else>
                        <p class="card"><span class="Sub_detile">Words Usage </span><span>0/unlimited</span></p>
                        <p class="card"><span class="Sub_detile">Images Usage </span><span>0/unlimited</span></p>
                        <p class="card"><span class="Sub_detile">Minuts Usage </span><span>0/unlimited</span></p>
                    </div>
                </div>
            </div>
            <div v-else>
                <div class="plane_details" v-if="$page.props.auth.user.payment">
                    <div class="title">Your Subscriptions</div>
                    <div class="plans_subs">
                        <div v-for="subscription in subscriber" class="card">
                            <p><span class="Sub_detile">Plan Type </span><span>{{ subscription.title }}</span></p>
                            <p><span class="Sub_detile">Price </span><span>{{ subscription.price }}</span><span>{{subscription.currency}}</span></p>
                            <p><span class="Sub_detile">Number of Words </span><span>{{ subscription.max_word }} word</span></p>
                            <p><span class="Sub_detile">Number of Images </span><span>{{ subscription.max_image }} image</span></p>
                            <p><span class="Sub_detile">Number of Voice Minuts </span>{{ subscription.max_minute }} min<span></span></p>
                            <p><span class="Sub_detile">End Date </span><span></span>{{ subscription.date_end }}</p>
                        </div>
                    </div>
                </div>

                <div class="plane_delailes_usage" v-if="$page.props.auth.user.payment">
                    <div class="title">Token Usage</div>
                    <div class="usage_details">
                        <p class="card"><span class="Sub_detile">Words Usage </span><span v-if="tokens[0].usage_words" :style="{color:(tokens[0].usage_words>subscriber_usage[0].max_word)? 'red':''}">{{ tokens[0].usage_words }}/{{ subscriber_usage[0].max_word }}</span><span v-else>0/{{ subscriber_usage[0].max_word }}</span></p>
                        <p class="card"><span class="Sub_detile">Images Usage </span><span v-if="tokens[0].usage_images" :style="{color:(tokens[0].usage_images>subscriber_usage[0].max_image)? 'red':''}">{{ tokens[0].usage_images }}/{{ subscriber_usage[0].max_image }}</span><span v-else>0/{{ subscriber_usage[0].max_image }}</span></p>
                        <p class="card">
                            <span class="Sub_detile">Minuts Usage </span>
                            <span v-if="tokens[0].usage_minuts" :style="{color:(tokens[0].usage_minuts>subscriber_usage[0].max_minute)? 'red':''}">
                                {{ tokens[0].usage_minuts }}/{{ subscriber_usage[0].max_minute }}
                            </span>
                            <span v-else-if="subscriber_usage[0].max_minute">0/{{ subscriber_usage[0].max_minute }}</span>
                            <span v-else>0/0</span>
                        </p>
                    </div>
                </div>
                <div class="plans">
                    <div class="pricing-details" v-if="plan[0].status">
                        <h3>{{plan[0]['title']}}</h3>
                        <h1><span>$</span>{{plan[0]['price']}}</h1>
                        <div class="plan-button">
                            <button @click="initiatePayment(plan[0].id)" class="btn btn-border">Purchase</button>
                        </div>
                        <ul>
                        <li><i class="fa-solid fa-check text-green-500 mr-2"></i>{{plan[0]['words']}} words / month</li>
                        <li><i class="fa-solid fa-check text-green-500 mr-2"></i>{{plan[0]['image']}} images / month</li>
                        <li><i class="fa-solid fa-check text-green-500 mr-2"></i>AI Chats Feature</li>
                        <li><i class="fa-solid fa-check text-green-500 mr-2"></i>AI Code Feature</li>
                        </ul>
                    </div>

                    <div class="pricing-details" v-if="plan[1].status">
                        <h3>{{plan[1]['title']}}</h3>
                        <h1><span>$</span>{{plan[1]['price']}}</h1>
                        <div class="plan-button">
                            <button @click="initiatePayment(plan[1].id)" class="btn btn-border">Purchase</button>
                        </div>
                        <ul>
                        <li><i class="fa-solid fa-check text-green-500 mr-2"></i>{{plan[1]['words']}} words / month</li>
                        <li><i class="fa-solid fa-check text-green-500 mr-2"></i>{{plan[1]['image']}} images / month</li>
                        <li><i class="fa-solid fa-check text-green-500 mr-2"></i>{{plan[1]['minute']}} minutes  / month</li>
                        <li><i class="fa-solid fa-check text-green-500 mr-2"></i>AI Chats Feature</li>
                        <li><i class="fa-solid fa-check text-green-500 mr-2"></i>AI Images Feature</li>
                        <li><i class="fa-solid fa-check text-green-500 mr-2"></i>AI Code Feature</li>
                        <li><i class="fa-solid fa-check text-green-500 mr-2"></i>AI Voiceover Feature</li>
                        <li><i class="fa-solid fa-check text-green-500 mr-2"></i>AI Speech to Text Feature</li>
                        <li><i class="fa-solid fa-check text-green-500 mr-2"></i>AI Code Feature</li>
                        <li><i class="fa-solid fa-check text-green-500 mr-2"></i>Access 69 Templates</li>
                        <li><i class="fa-solid fa-check text-green-500 mr-2"></i>Ai text generator</li>
                        <li><i class="fa-solid fa-check text-green-500 mr-2"></i>Text rewording</li>
                        <li><i class="fa-solid fa-check text-green-500 mr-2"></i>Email Support</li>
                        <li><i class="fa-solid fa-check text-green-500 mr-2"></i>Data export</li>
                        </ul>
                    </div>

                    <div class="pricing-details" v-if="plan[2].status">
                        <h3>{{plan[2]['title']}}</h3>
                        <h1><span>$</span>{{plan[2]['price']}}</h1>
                        <div class="plan-button">
                            <button @click="initiatePayment(plan[2].id)" class="btn btn-border">Purchase</button>
                        </div>
                        <ul>
                        <li><i class="fa-solid fa-check text-green-500 mr-2"></i>{{plan[2]['words']}} words / month</li>
                        <li><i class="fa-solid fa-check text-green-500 mr-2"></i>{{plan[2]['image']}} images / month</li>
                        <li><i class="fa-solid fa-check text-green-500 mr-2"></i>{{plan[2]['minute']}} minutes  / month</li>
                        <li><i class="fa-solid fa-check text-green-500 mr-2"></i>AI Chats Feature</li>
                        <li><i class="fa-solid fa-check text-green-500 mr-2"></i>AI Images Feature</li>
                        <li><i class="fa-solid fa-check text-green-500 mr-2"></i>AI Code Feature</li>
                        <li><i class="fa-solid fa-check text-green-500 mr-2"></i>AI Voiceover Feature</li>
                        <li><i class="fa-solid fa-check text-green-500 mr-2"></i>AI Speech to Text Feature</li>
                        <li><i class="fa-solid fa-check text-green-500 mr-2"></i>AI Code Feature</li>
                        <li><i class="fa-solid fa-check text-green-500 mr-2"></i>Access 69 Templates</li>
                        <li><i class="fa-solid fa-check text-green-500 mr-2"></i>Ai text generator</li>
                        <li><i class="fa-solid fa-check text-green-500 mr-2"></i>Text rewording</li>
                        <li><i class="fa-solid fa-check text-green-500 mr-2"></i>Email Support</li>
                        <li><i class="fa-solid fa-check text-green-500 mr-2"></i>Data export</li>
                        </ul>
                    </div>
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
        Link
    },
    props: {
        secretKey : Object,
        plan: Object,
        subscriber: Object,
        subscriber_usage: Object,
        tokens: Object,
    },

    data() {
        return {
            stripe: null,
            key : this.secretKey.key
        }
    },
    created() {
        this.stripe = Stripe(this.key);
    },
    mounted() {

    },
    methods: {
        initiatePayment(paymentId) {
            axios.post(`/Subscription/${paymentId}/Payment`)
            .then(response => {
                const sessionId = response.data.id;

                this.stripe.redirectToCheckout({ sessionId: sessionId })
                    .then(function (result) {
                        if (result.error) {
                            alert(result.error.message);
                        }
                    });
            })
            .catch(error => {
                console.error("Payment initiation failed:", error.response ? error.response.data : 'Unknown error');
            });
        }
    },
}
</script>