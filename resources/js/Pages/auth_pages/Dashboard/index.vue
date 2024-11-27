<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight page_title">
                <i class="fa-solid fa-chart-line"></i>
                /Dashboard</h2>
        </template>
        <div class="dashbard_panel_auth" v-if="$page.props.auth.user.payment">
            <div class="big_card">
                <div id="particles-js">
                    <div class="cards">
                        <div class="card">
                            <div class="go-corner">
                                <i class="fa-solid fa-marker go-arrow"></i>
                            </div>
                            <div class="title">Words Generated</div>
                            <div class="value">
                                <span v-if="tokens[0]" class="curront_token">{{ tokens[0].current_words }}</span><span class="curront_token" v-else>0</span>/
                                <span v-if="$page.props.auth.user.special_user">Unlimited</span><span v-else-if="tokens_totla[0]">{{ tokens[0].max_word }}</span><span v-else>0</span> words
                            </div>
                        </div>
                        <div class="card">
                            <div class="go-corner">
                                <i class="fa-solid fa-image go-arrow"></i>
                            </div>
                            <div class="title">Images Created</div>
                            <div class="value">
                                <span v-if="tokens[0]" class="curront_token">{{ tokens[0].current_images }}</span><span class="curront_token" v-else>0</span>/
                                <span v-if="$page.props.auth.user.special_user">Unlimited</span><span v-else-if="tokens_totla[0]">{{ tokens[0].max_image }}</span><span v-else>0</span> image
                            </div>
                        </div>
                        <div class="card">
                            <div class="go-corner">
                                <i class="fa-solid fa-microphone go-arrow"></i>
                            </div>
                            <div class="title">Voiceover Tasks</div>
                            <div class="value">
                                <span v-if="tokens[0]" class="curront_token">{{ tokens[0].current_minuts }}</span><span class="curront_token" v-else>0</span>/
                                <span v-if="$page.props.auth.user.special_user">Unlimited</span><span v-else-if="tokens_totla[0]">{{ tokens[0].max_minute }}</span><span v-else>0</span> voice
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="chart_stat">
                <div class="shart1">
                    <div class="title">Token Usage</div>
                    <div class="chart">
                        <VueApexCharts v-if="words[0] || images[0] || voice[0]" type="area" height="100%" :options="chartOptions1" :series="series1" :Labels="dataLabels"></VueApexCharts>
                        <div class="no_data_yet" v-else>
                        <div class="loader">
                            <div class="loader__bar"></div>
                            <div class="loader__bar"></div>
                            <div class="loader__bar"></div>
                            <div class="loader__bar"></div>
                            <div class="loader__bar"></div>
                            <div class="loader__ball"></div>
                        </div>
                        <p>There is no data yet ...</p>
                    </div>
                    </div>
                </div>
                <div class="shart2">
                    <div class="title">Top Token Usage</div>    
                    <div class="chart">
                        <VueApexCharts  v-if="tools_tokens[0]" type="bar" height="100%" :options="chartOptions2" :series="series2" ></VueApexCharts>
                        <div class="no_data_yet" v-else>
                            <div class="loader">
                                <div class="loader__bar"></div>
                                <div class="loader__bar"></div>
                                <div class="loader__bar"></div>
                                <div class="loader__bar"></div>
                                <div class="loader__bar"></div>
                                <div class="loader__ball"></div>
                            </div>
                            <p>There is no data yet ...</p>
                        </div>
                    </div>    
                </div>
            </div>
            <div class="body_stat">
                <div class="favorit_tools">
                    <div class="title">favorit tools</div>
                    <div class="cards" v-if="favorit_tools[0]">
                        <div class="card" :class="{'freemCard': tool.Free, 'proCard': tool.pro, 'premiumCard': tool.premium}" v-for="(tool,index) in favorit_tools">
                            <div class="card_header">
                                <p v-html="tool.logo" class="mb-4" :style="{backgroundColor: tool.color , color: tool.logo_color}"></p>
                                <div class="star">
                                    <label class="container">
                                        <input type="checkbox"  @click="addFavorit_text(tool.id)" :checked="tool.id === tool.id_tool">
                                        <svg height="24px" id="Layer_1" version="1.2" viewBox="0 0 24 24" width="24px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><g><path d="M9.362,9.158c0,0-3.16,0.35-5.268,0.584c-0.19,0.023-0.358,0.15-0.421,0.343s0,0.394,0.14,0.521    c1.566,1.429,3.919,3.569,3.919,3.569c-0.002,0-0.646,3.113-1.074,5.19c-0.036,0.188,0.032,0.387,0.196,0.506    c0.163,0.119,0.373,0.121,0.538,0.028c1.844-1.048,4.606-2.624,4.606-2.624s2.763,1.576,4.604,2.625    c0.168,0.092,0.378,0.09,0.541-0.029c0.164-0.119,0.232-0.318,0.195-0.505c-0.428-2.078-1.071-5.191-1.071-5.191    s2.353-2.14,3.919-3.566c0.14-0.131,0.202-0.332,0.14-0.524s-0.23-0.319-0.42-0.341c-2.108-0.236-5.269-0.586-5.269-0.586    s-1.31-2.898-2.183-4.83c-0.082-0.173-0.254-0.294-0.456-0.294s-0.375,0.122-0.453,0.294C10.671,6.26,9.362,9.158,9.362,9.158z"></path></g></g></svg>
                                    </label>
                                </div>
                            </div>
                            <div v-if="$page.props.auth.user.payment" class="desc_card">
                                <div v-if="$page.props.auth.user.special_user || (tool.premium && $page.props.auth.user_plan[0].title == 'Premium')">
                                    <Link class="title" :href="`ai_tools_template/${tool.id}`">{{ tool.title }}</Link>
                                    <Link class="description" :href="`ai_tools_template/${tool.id}`">{{ tool.description }}</Link>
                                </div>
                                <div v-else-if="$page.props.auth.user.special_user || (tool.pro && ($page.props.auth.user_plan[0].title == 'Pro' || $page.props.auth.user_plan[0].title == 'Premium'))">
                                    <Link class="title" :href="`ai_tools_template/${tool.id}`">{{ tool.title }}</Link>
                                    <Link class="description" :href="`ai_tools_template/${tool.id}`">{{ tool.description }}</Link>
                                </div>
                                <div v-else-if="$page.props.auth.user.special_user || (tool.Standard && ($page.props.auth.user_plan[0].title == 'Standard' || $page.props.auth.user_plan[0].title == 'Pro' || $page.props.auth.user_plan[0].title == 'Premium'))">
                                    <Link class="title" :href="`ai_tools_template/${tool.id}`">{{ tool.title }}</Link>
                                    <Link class="description" :href="`ai_tools_template/${tool.id}`">{{ tool.description }}</Link>
                                </div>
                                <div v-else-if="$page.props.auth.user.special_user || (tool.Free && ($page.props.auth.user_plan[0].title == 'Standard' || $page.props.auth.user_plan[0].title == 'Pro' || $page.props.auth.user_plan[0].title == 'Premium'))">
                                    <Link class="title" :href="`ai_tools_template/${tool.id}`">{{ tool.title }}</Link>
                                    <Link class="description" :href="`ai_tools_template/${tool.id}`">{{ tool.description }}</Link>
                                </div>
                                <div v-else>
                                    <p class="title" @click="need_subscription_popup_fun(tool.premium,tool.pro,tool.Free)">{{ tool.title }}</p>
                                    <p class="description" @click="need_subscription_popup_fun(tool.premium,tool.pro,tool.Free)">{{ tool.description }}</p>
                                </div>
                            </div>
                            <div v-else-if="tool.Free" class="desc_card">
                                <div>
                                    <Link class="title" :href="`ai_tools_template/${tool.id}`">{{ tool.title }}</Link>
                                    <Link class="description" :href="`ai_tools_template/${tool.id}`">{{ tool.description }}</Link>
                                </div>
                            </div>
                            <div v-else>
                                <p class="title" @click="need_subscription_popup_fun(tool.premium,tool.pro,tool.Free)">{{ tool.title }}</p>
                                <p class="description" @click="need_subscription_popup_fun(tool.premium,tool.pro,tool.Free)">{{ tool.description }}</p>
                            </div>
                            <div class="plan_level">
                                <p v-if="tool.premium" class="Premium"><i class="fa-solid fa-gem"></i>Premium</p>
                                <p v-else-if="tool.pro" class="Pro"><i class="fa-solid fa-crown"></i>Pro</p>
                                <p v-else-if="tool.Free" class="Free"><i class="fa-solid fa-gift"></i>Free</p>
                            </div>
                        </div>
                    </div>
                    <div class="no_data_yet" v-else>
                        <div class="loader">
                            <div class="loader__bar"></div>
                            <div class="loader__bar"></div>
                            <div class="loader__bar"></div>
                            <div class="loader__bar"></div>
                            <div class="loader__bar"></div>
                            <div class="loader__ball"></div>
                        </div>
                        <p>There is no data yet ...</p>
                    </div>
                </div>
                <div class="last_data_save">
                    <div class="title">last saved data</div>
                    <div class="cards" v-if="last_data[0]">
                        <div class="card" v-for="(tool,index) in last_data">
                            <div class="card_header">
                                <p v-html="tool.logo" :style="{backgroundColor: tool.color , color: tool.logo_color}"></p>
                            </div>
                            <div class="desc_card">
                                <p class="text">{{ tool.title }}</p>
                                <p class="type">{{ tool.type_data }}</p>
                            </div>
                            <Link v-if="tool.type_data == 'text'" :href=" route('document_data')"><i class="fa-solid fa-chevron-right"></i></Link>
                            <Link v-if="tool.type_data == 'image'" :href=" route('image_data')"><i class="fa-solid fa-chevron-right"></i></Link>
                            <Link v-if="tool.type_data == 'voice'" :href=" route('voice_data')"><i class="fa-solid fa-chevron-right"></i></Link>
                            <Link v-if="tool.type_data == 'code'" :href=" route('code_data')"><i class="fa-solid fa-chevron-right"></i></Link>
                        </div>
                    </div>
                    <div class="no_data_yet" v-else>
                        <div class="loader">
                            <div class="loader__bar"></div>
                            <div class="loader__bar"></div>
                            <div class="loader__bar"></div>
                            <div class="loader__bar"></div>
                            <div class="loader__bar"></div>
                            <div class="loader__ball"></div>
                        </div>
                        <p>There is no data yet ...</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="dashbard_panel" v-else>
            <div class="big_card">
                <div id="particles-js">
                    <div class="detills">
                        <h2 class="head-title"><span>AI</span>-Toolbox</h2>
                        <div class="sub_title">
                            <h2 ref="typingElement" class="multitext"></h2>
                        </div>
                        <p>One platform to generate all AI contents & AI Voiceovers</p>
                        <div class="header-button">
                            <Link :href="route('Subscription')" class="Purchase">Purchase Now</Link>
                            <Link :href="route('ai_tools_list')" class="Discover">Discover Tools</Link>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card__img"><svg xmlns="http://www.w3.org/2000/svg" width="100%"><rect fill="#ffffff" width="540" height="450"></rect><defs><linearGradient id="a" gradientUnits="userSpaceOnUse" x1="0" x2="0" y1="0" y2="100%" gradientTransform="rotate(222,648,379)"><stop offset="0" stop-color="#ffffff"></stop><stop offset="1" stop-color="#FC726E"></stop></linearGradient><pattern patternUnits="userSpaceOnUse" id="b" width="300" height="250" x="0" y="0" viewBox="0 0 1080 900"><g fill-opacity="0.5"><polygon fill="#444" points="90 150 0 300 180 300"></polygon><polygon points="90 150 180 0 0 0"></polygon><polygon fill="#AAA" points="270 150 360 0 180 0"></polygon><polygon fill="#DDD" points="450 150 360 300 540 300"></polygon><polygon fill="#999" points="450 150 540 0 360 0"></polygon><polygon points="630 150 540 300 720 300"></polygon><polygon fill="#DDD" points="630 150 720 0 540 0"></polygon><polygon fill="#444" points="810 150 720 300 900 300"></polygon><polygon fill="#FFF" points="810 150 900 0 720 0"></polygon><polygon fill="#DDD" points="990 150 900 300 1080 300"></polygon><polygon fill="#444" points="990 150 1080 0 900 0"></polygon><polygon fill="#DDD" points="90 450 0 600 180 600"></polygon><polygon points="90 450 180 300 0 300"></polygon><polygon fill="#666" points="270 450 180 600 360 600"></polygon><polygon fill="#AAA" points="270 450 360 300 180 300"></polygon><polygon fill="#DDD" points="450 450 360 600 540 600"></polygon><polygon fill="#999" points="450 450 540 300 360 300"></polygon><polygon fill="#999" points="630 450 540 600 720 600"></polygon><polygon fill="#FFF" points="630 450 720 300 540 300"></polygon><polygon points="810 450 720 600 900 600"></polygon><polygon fill="#DDD" points="810 450 900 300 720 300"></polygon><polygon fill="#AAA" points="990 450 900 600 1080 600"></polygon><polygon fill="#444" points="990 450 1080 300 900 300"></polygon><polygon fill="#222" points="90 750 0 900 180 900"></polygon><polygon points="270 750 180 900 360 900"></polygon><polygon fill="#DDD" points="270 750 360 600 180 600"></polygon><polygon points="450 750 540 600 360 600"></polygon><polygon points="630 750 540 900 720 900"></polygon><polygon fill="#444" points="630 750 720 600 540 600"></polygon><polygon fill="#AAA" points="810 750 720 900 900 900"></polygon><polygon fill="#666" points="810 750 900 600 720 600"></polygon><polygon fill="#999" points="990 750 900 900 1080 900"></polygon><polygon fill="#999" points="180 0 90 150 270 150"></polygon><polygon fill="#444" points="360 0 270 150 450 150"></polygon><polygon fill="#FFF" points="540 0 450 150 630 150"></polygon><polygon points="900 0 810 150 990 150"></polygon><polygon fill="#222" points="0 300 -90 450 90 450"></polygon><polygon fill="#FFF" points="0 300 90 150 -90 150"></polygon><polygon fill="#FFF" points="180 300 90 450 270 450"></polygon><polygon fill="#666" points="180 300 270 150 90 150"></polygon><polygon fill="#222" points="360 300 270 450 450 450"></polygon><polygon fill="#FFF" points="360 300 450 150 270 150"></polygon><polygon fill="#444" points="540 300 450 450 630 450"></polygon><polygon fill="#222" points="540 300 630 150 450 150"></polygon><polygon fill="#AAA" points="720 300 630 450 810 450"></polygon><polygon fill="#666" points="720 300 810 150 630 150"></polygon><polygon fill="#FFF" points="900 300 810 450 990 450"></polygon><polygon fill="#999" points="900 300 990 150 810 150"></polygon><polygon points="0 600 -90 750 90 750"></polygon><polygon fill="#666" points="0 600 90 450 -90 450"></polygon><polygon fill="#AAA" points="180 600 90 750 270 750"></polygon><polygon fill="#444" points="180 600 270 450 90 450"></polygon><polygon fill="#444" points="360 600 270 750 450 750"></polygon><polygon fill="#999" points="360 600 450 450 270 450"></polygon><polygon fill="#666" points="540 600 630 450 450 450"></polygon><polygon fill="#222" points="720 600 630 750 810 750"></polygon><polygon fill="#FFF" points="900 600 810 750 990 750"></polygon><polygon fill="#222" points="900 600 990 450 810 450"></polygon><polygon fill="#DDD" points="0 900 90 750 -90 750"></polygon><polygon fill="#444" points="180 900 270 750 90 750"></polygon><polygon fill="#FFF" points="360 900 450 750 270 750"></polygon><polygon fill="#AAA" points="540 900 630 750 450 750"></polygon><polygon fill="#FFF" points="720 900 810 750 630 750"></polygon><polygon fill="#222" points="900 900 990 750 810 750"></polygon><polygon fill="#222" points="1080 300 990 450 1170 450"></polygon><polygon fill="#FFF" points="1080 300 1170 150 990 150"></polygon><polygon points="1080 600 990 750 1170 750"></polygon><polygon fill="#666" points="1080 600 1170 450 990 450"></polygon><polygon fill="#DDD" points="1080 900 1170 750 990 750"></polygon></g></pattern></defs><rect class="bg_rect"  x="0" y="0" fill="url(#a)" width="100%" height="100%"></rect><rect x="0" y="0" fill="url(#b)" width="100%" height="100%"></rect></svg></div>
                    <img class="card__avatar" :src="'/'+$page.props.auth.user.avatar ">
                    <div class="card__title">{{$page.props.auth.user.name}}</div>
                    <div class="card__wrapper">
                        <Link :href="route('Subscription')" class="card__btn">Upgrade</Link>
                    </div>
                </div>
            </div>
            <div class="hot_tools">
                <div class="title">Hot Tools</div>
                <div id="cards" ref="cardsContainer">
                    <div class="card" :class="{'freemCard': tool.Free, 'proCard': tool.pro, 'premiumCard': tool.premium}" v-for="(tool,index) in rendom_tools">
                        <div class="card-content">
                            <div class="card_header">
                                <p v-html="tool.logo" class="mb-4" :style="{backgroundColor: tool.color , color: tool.logo_color}"></p>
                            </div>
                            <div class="desc_card">
                                <P class="title">{{ tool.title }}</P>
                                <P class="description">{{ tool.description }}</P>
                            </div>
                            <div class="plan_level">
                                <p v-if="tool.premium" class="Premium"><i class="fa-solid fa-gem"></i>Premium</p>
                                <p v-else-if="tool.pro" class="Pro"><i class="fa-solid fa-crown"></i>Pro</p>
                                <p v-else-if="tool.Free" class="Free"><i class="fa-solid fa-gift"></i>Free</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head , Link} from '@inertiajs/vue3';
import Typed from 'typed.js';
import VueApexCharts from "vue3-apexcharts";
</script>
<script>
export default {
    components: {
        Head,
        Link,
        VueApexCharts
    },
    props: {
        tokens: Object,
        rendom_tools : Object,
        tokens_totla : Object,
        favorit_tools : Object,
        last_data : Object,
        words : Object,
        images : Object,
        voice : Object,
        date : Object,
        tools_title : Object,
        tools_tokens : Object,

    },
    mounted() {
        this.loadAndInitParticles();
        if(!this.$page.props.auth.user.payment){
            this.initTypingEffect();
            this.$refs.cardsContainer.onmousemove = this.handleMouseMove;
        }
    },
    data() {
    return {
            //chat
            series1: [{
                    name: 'words',
                    data: this.words,
                }, 
                { 
                    name: 'images',
                    data: this.images,
                },
                { 
                    name: 'voice',
                    data: this.voice,
                }],
            chartOptions1: {
                theme: {
                    mode: this.darkmode(),
                },
                chart: {
                    type: 'area'
                },
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    curve: 'smooth'
                },
                xaxis: {
                    type: 'datetime',
                    categories: this.date,
                },
                tooltip: {
                    x: {
                        format: 'dd/MM/yy',
                    },
                },
                colors: ['#51ff00' , '#00f7ff' , '#bf00ff'],
            },
            //barchart
            series2: [{
                data: this.tools_tokens
            }],
            chartOptions2: {
                    theme: {
                        mode: this.darkmode(),
                    },
                    chart: {
                    type: 'bar',
                    },
                    plotOptions: {
                    bar: {
                        barHeight: '100%',
                        distributed: true,
                        horizontal: true,
                        dataLabels: {
                        position: 'bottom'
                        },
                    }
                    },
                    colors: ['#33b2df', '#d4526e', '#13d8aa', '#f9a3a4', '#f48024', '#69d2e7'
                    ],
                    dataLabels: {
                    enabled: true,
                    textAnchor: 'start',
                    style: {
                        colors: ['#fff']
                    },
                    formatter: function (val, opt) {
                        return opt.w.globals.labels[opt.dataPointIndex] + ":  " + val;
                    },
                    offsetX: 0,
                    dropShadow: {
                        enabled: true
                    }
                    },
                    stroke: {
                    width: 1,
                    colors: ['#fff']
                    },
                    xaxis: {
                    categories: this.tools_title,
                    },
                    yaxis: {
                    labels: {
                        show: false
                    }
                    },
                    tooltip: {
                    x: {
                        show: false
                    },
                    y: {
                        title: {
                        formatter: function () {
                            return '';
                        }
                        }
                    }
                    }
            }
        }
    },
    methods: {
        darkmode(){
            if(this.$page.props.auth.user.darkMode)
                return 'dark';
            else
                return 'light';
        },
        handleMouseMove(e) {
            for (const card of this.$refs.cardsContainer.getElementsByClassName("card")) {
                const rect = card.getBoundingClientRect(),
                    x = e.clientX - rect.left,
                    y = e.clientY - rect.top;
                card.style.setProperty("--mouse-x", `${x}px`);
                card.style.setProperty("--mouse-y", `${y}px`);
            }
        },
        initTypingEffect() {
            // Use this.$refs to access the DOM element
            new Typed(this.$refs.typingElement, {
                strings: [
                "Article Generator",
                "Content Improver",
                "Blog Contents",
                "Ad Creations",
                "Text to Speech",
                "And Many More!"
                ],
                loop: true,
                typeSpeed: 100,
                backSpeed: 80,
                backDelay: 1500
            });
        },
        loadScript(src) {
            return new Promise((resolve, reject) => {
            if (document.querySelector(`script[src="${src}"]`)) {
                resolve();
                return;
            }
            const script = document.createElement('script');
            script.src = src;
            script.onload = resolve;
            script.onerror = reject;
            document.head.appendChild(script);
            });
        },
        loadAndInitParticles() {
            const lineColor = getComputedStyle(document.documentElement)
                                .getPropertyValue('--title1').trim();

            this.loadScript('/js/particles/particles.min.js')
                .then(() => {
                this.initParticles(lineColor); // Pass the color to your init method
                })
                .catch(error => console.error('Error loading particles.js:', error));
            },
        initParticles(lineColor) {
            if (typeof particlesJS === 'function') {
            particlesJS('particles-js', 
            {
                "particles": {
                "number": {
                    "value": 80,
                    "density": {
                    "enable": true,
                    "value_area": 800
                    }
                },
                "color": {
                    "value": this.$page.props.auth.user.filter
                },
                "shape": {
                    "type": "circle",
                    "stroke": {
                    "width": 0,
                    "color": "#000000"
                    },
                    "polygon": {
                    "nb_sides": 5
                    },
                    "image": {
                    "src": "img/github.svg",
                    "width": 100,
                    "height": 100
                    }
                },
                "opacity": {
                    "value": 0.5,
                    "random": false,
                    "anim": {
                    "enable": false,
                    "speed": 1,
                    "opacity_min": 0.1,
                    "sync": false
                    }
                },
                "size": {
                    "value": 5,
                    "random": true,
                    "anim": {
                    "enable": false,
                    "speed": 40,
                    "size_min": 0.1,
                    "sync": false
                    }
                },
                "line_linked": {
                    "enable": true,
                    "distance": 150,
                    "color": lineColor,
                    "opacity": 0.4,
                    "width": 1
                },
                "move": {
                    "enable": true,
                    "speed": 8,
                    "direction": "none",
                    "random": false,
                    "straight": false,
                    "out_mode": "out",
                    "attract": {
                    "enable": false,
                    "rotateX": 600,
                    "rotateY": 1200
                    }
                }
                },
                "interactivity": {
                "detect_on": "canvas",
                "events": {
                    "onhover": {
                    "enable": true,
                    "mode": "repulse"
                    },
                    "onclick": {
                    "enable": true,
                    "mode": "push"
                    },
                    "resize": true
                },
                "modes": {
                    "grab": {
                    "distance": 400,
                    "line_linked": {
                        "opacity": 1
                    }
                    },
                    "bubble": {
                    "distance": 400,
                    "size": 40,
                    "duration": 2,
                    "opacity": 8,
                    "speed": 3
                    },
                    "repulse": {
                    "distance": 200
                    },
                    "push": {
                    "particles_nb": 4
                    },
                    "remove": {
                    "particles_nb": 2
                    }
                }
                },
                "retina_detect": true,
                "config_demo": {
                "hide_card": false,
                "background_color": "#b61924",
                "background_image": "",
                "background_position": "50% 50%",
                "background_repeat": "no-repeat",
                "background_size": "cover"
                }
            }
            );
            } else {
            console.error('particlesJS is not defined.');
            }
        },
        addFavorit_text(tool_id) {
            this.$inertia.post(`ai_tools_list/${tool_id}/add_favorit`);
        },
    }
}
</script>

  