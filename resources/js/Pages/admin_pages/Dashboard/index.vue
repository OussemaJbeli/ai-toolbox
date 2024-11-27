<template>
    <Head title="Admin Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight page_title">
                <i class="fa-solid fa-chart-line"></i>
                /Admin Dashboard</h2>
        </template>
        <div class="dashboard_admin">
            <div class="cards header_cards"ref="cardsContainer">
                <div class="card">
                    <div class="card-content">
                        <div class="title">
                            <i class="fa-solid fa-users"></i>
                            <p>Total New Users <span>(Current Month)</span></p>
                        </div>
                        <div class="value">{{currentMonth_users}} User</div>
                        <div class="discription">
                            <p>
                                <span>last month</span>
                                <div class="value">{{lastMonthD_users}} User</div>
                            </p>
                            <p>
                                <span>this year</span>
                                <div class="value">{{currentYear_users}} User</div>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="title">
                            <i class="fa-solid fa-address-card"></i>
                            <p>Total New Subscribers <span>(Current Month)</span></p>
                        </div>
                        <div class="value">{{currentMonth_subscriber}} Subscriber</div>
                        <div class="discription">
                            <p>
                                <span>last month</span>
                                <div class="value">{{lastMonthD_subscriber}} Subscriber</div>
                            </p>
                            <p>
                                <span>this year</span>
                                <div class="value">{{currentYear_subscriber}} Subscriber</div>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="title"><i class="fa-solid fa-money-bill-trend-up"></i>
                            <p>Total Income <span>(Current Month)</span></p>
                        </div>
                        <div class="value">{{currentMonth_subscriptions.price}} USD</div>
                        <div class="discription">
                            <p>
                                <span>last month</span>
                                <div class="value">{{lastMonthD_subscriptions.price}} USD</div>
                            </p>
                            <p>
                                <span>this year</span>
                                <div class="value">{{currentYear_subscriptions.price}} USD</div>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="title"><i class="fa-solid fa-file-pen"></i>
                            <p>Total Words Generated <span>(Current Month)</span></p>
                        </div>
                        <div class="value">{{words.this_month}} Token</div>
                        <div class="discription">
                            <p>
                                <span>last month</span>
                                <div class="value">{{words.last_month}} Token</div>
                            </p>
                            <p>
                                <span>this year</span>
                                <div class="value">{{words.this_year}} Token</div>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="title"><i class="fa-solid fa-images"></i>
                            <p>Total Images Generated <span>(Current Month)</span></p>
                        </div>
                        <div class="value">{{images.this_month}} Token</div>
                        <div class="discription">
                            <p>
                                <span>last month</span>
                                <div class="value">{{images.last_month}} Token</div>
                            </p>
                            <p>
                                <span>this year</span>
                                <div class="value">{{images.this_year}} Token</div>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="title"><i class="fa-solid fa-microphone"></i>
                            <p>Total Voice Generated <span>(Current Month)</span></p>
                        </div>
                        <div class="value">{{voice.this_month}} Token</div>
                        <div class="discription">
                            <p>
                                <span>last month</span>
                                <div class="value">{{voice.last_month}} Token</div>
                            </p>
                            <p>
                                <span>this year</span>
                                <div class="value">{{voice.this_year}} Token</div>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="body_cards">
                <div class="chart">
                    <div class="title">Token Usage <span>(this week)</span></div>
                    <div class="content">
                        <VueApexCharts type="area" height="100%" :options="chartOptions1" :series="series1"></VueApexCharts>
                    </div>
                </div>
                <div class="chart">
                    <div class="title">New Users <span>(this year)</span></div>
                    <div class="content">
                        <VueApexCharts type="bar" height="100%" :options="chartOptions2" :series="series2"></VueApexCharts>
                    </div>
                </div>
            </div>
            <div class="footer_cards">
                <div class="bigchart">
                    <div class="title">New Registered Users <span>(this month)</span></div>
                    <div class="content">
                        <VueApexCharts type="bar" height="100%" :options="chartOptions3" :series="series3"></VueApexCharts>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import VueApexCharts from "vue3-apexcharts";
</script>

<script>
export default {
    name: 'App',
    components: {
        Head,
        VueApexCharts
    },
    props: {
        words : Object,
        images : Object,
        voice : Object,

        currentMonth_users : Object,
        currentYear_users : Object,
        lastMonthD_users : Object,

        currentMonth_subscriber : Object,
        currentYear_subscriber : Object,
        lastMonthD_subscriber : Object,

        currentMonth_subscriptions : Object,
        currentYear_subscriptions : Object,
        lastMonthD_subscriptions : Object,

        words_chart : Object,
        images_chart : Object,
        voice_chart : Object,
        date_chart : Object,

        currentMonthRegisters : Object,
        currentMonthdate : Object,

        monthNames : Object,
        currentYearRegisters : Object,

    },

    data() {
        return {
            //chart token 
            series1: [{
                    name: 'words',
                    data: this.words_chart,
                }, 
                { 
                    name: 'images',
                    data: this.images_chart,
                },
                { 
                    name: 'voice',
                    data: this.voice_chart,
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
                    categories: this.date_chart,
                },
                tooltip: {
                    x: {
                        format: 'dd/MM/yy',
                    },
                },
                colors: ['#51ff00' , '#00f7ff' , '#bf00ff'],
            },
            //users
            series2: [{
                name: 'Inflation',
                data: this.currentYearRegisters,
            }],
            chartOptions2: {
                theme: {
                    mode: this.darkmode(),
                },
                chart: {
                    height: 350,
                    type: 'bar',
                },
                plotOptions: {
                    bar: {
                        borderRadius: 10,
                        dataLabels: {
                        position: 'top', // top, center, bottom
                        },
                    }
                },
                dataLabels: {
                    enabled: true,
                    formatter: function (val) {
                        return val;
                    },
                    offsetY: -20,
                    style: {
                        fontSize: '12px',
                        colors: [this.title_color()]
                    }
                },
                
                xaxis: {
                    categories: this.monthNames,
                    position: 'bottom',
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    },
                    crosshairs: {
                        fill: {
                        type: 'gradient',
                        gradient: {
                            colorFrom: this.title_color(),
                            colorTo: this.action_color(),
                            stops: [0, 100],
                            opacityFrom: 0.4,
                            opacityTo: 0.5,
                        }
                        }
                    },
                    tooltip: {
                        enabled: true,
                    }
                },
                yaxis: {
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false,
                    },
                    labels: {
                        show: false,
                        formatter: function (val) {
                        return val + "%";
                        }
                    }
                
                },
            },
            //register
            series3: [{
                name: 'Inflation',
                data: this.currentMonthRegisters,
            }],
            chartOptions3: {
                theme: {
                    mode: this.darkmode(),
                },
                chart: {
                    height: 100,
                    type: 'bar',
                },
                plotOptions: {
                    bar: {
                        borderRadius: 10,
                        dataLabels: {
                            position: 'top',
                        },
                    }
                },
                dataLabels: {
                    enabled: true,
                    formatter: function (val) {
                        return val;
                    },
                    offsetY: -20,
                    style: {
                        fontSize: '12px',
                        colors: [this.title_color()]
                    }
                },
                
                xaxis: {
                    categories: this.currentMonthdate,
                    position: 'bottom',
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    },
                    crosshairs: {
                        fill: {
                        type: 'gradient',
                        gradient: {
                            colorFrom: this.title_color(),
                            colorTo: this.action_color(),
                            stops: [0, 100],
                            opacityFrom: 0.4,
                            opacityTo: 0.5,
                        }
                        }
                    },
                    tooltip: {
                        enabled: true,
                    }
                },
                yaxis: {
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false,
                    },
                    labels: {
                        show: false,
                        formatter: function (val) {
                        return val;
                        }
                    }
                
                },
            },
          
        }
    },
    mounted() {
        this.$refs.cardsContainer.onmousemove = this.handleMouseMove;
    },
    methods: {
        title_color(){
            return getComputedStyle(document.documentElement).getPropertyValue('--title1');
        },
        action_color(){
            return getComputedStyle(document.documentElement).getPropertyValue('--action_color');
        },
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
    },
}
</script>