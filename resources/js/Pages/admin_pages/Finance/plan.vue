<template>
    <Head title="Subscribers" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight page_title">
                <i class="fa-solid fa-credit-card"></i>
                /Subscription Plans</h2>
        </template>
        <div class="contain_admin">
            <!-- plan -->
            <div class="historique_statistique frame_original pt-10 pb-4 ">
                <div class="w-100 mt-2 mb-4 flex flex-row items-center justify-between">
                    <span class="h3">List Plans</span>
                    <p></p>
                </div>
                <div class="table_frame">
                    <DataTable class="table_edit DataTable1">
                        <thead>
                            <tr class="text-center font-bold">
                                <th class="pb-4 pt-6 px-6 text-start">title</th>
                                <th class="pb-4 pt-6 px-6 text-start">price</th>
                                <th class="pb-4 pt-6 px-6 text-start">currency</th>
                                <th class="pb-4 pt-6 px-6 text-start">words</th>
                                <th class="pb-4 pt-6 px-6 text-start">images</th>
                                <th class="pb-4 pt-6 px-6 text-start">minutes</th>
                                <th class="pb-4 pt-6 px-6 text-start">frequency</th>
                                <th class="pb-4 pt-6 px-6 text-start">status</th>
                                <th class="pb-4 pt-6 px-6 text-start">edit</th>
                            </tr>
                        </thead>
                        <tbody class="text-right">
                            <tr v-for="plan in plans">
                                <td class="pb-4 pt-6 px-6 border-t text-start">
                                    {{ plan.title }}
                                </td>
                                <td class="pb-4 pt-6 px-6 border-t text-start">
                                    {{ plan.price }}
                                </td>
                                <td class="pb-4 pt-6 px-6 border-t text-start ">
                                    {{ plan.currency }}
                                </td>
                                <td class="pb-4 pt-6 px-6 border-t text-start  ">
                                    {{ plan.words }}
                                </td>
                                <td class="pb-4 pt-6 px-6 border-t text-start ">
                                    {{ plan.image }}
                                </td>
                                <td class="pb-4 pt-6 px-6 border-t text-start  ">
                                    <p v-if="plan.minute">{{ plan.minute }}</p>
                                    <p v-else>0</p>
                                </td>
                                <td class="pb-4 pt-6 px-6 border-t text-start ">
                                    {{ plan.frequency }}
                                </td>
                                <td class="pb-4 pt-6 px-6 border-t text-start  ">
                                    <span v-if="plan.status == 1" class="text-green-500">active</span>
                                    <span v-else class="text-red-500">desactive</span>
                                </td>
                                <td class="pb-4 pt-6 px-6 border-t text-start">
                                    <button @click="change_plan_frame_fun(plan.id,plan.price,plan.currency,plan.words,plan.image,plan.minute,plan.frequency,plan.status)">
                                        <i class="fa-solid fa-pen-to-square text-green-500"></i>edit
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </DataTable>
                </div>
            </div>
            <!-- edit plan -->
            <div class="limit_frame" v-if="change_plan_frame">
                <div class="limit_panel">
                    <div class="header">
                        <div class="logo"></div>
                        <div class="exite" id="exit_popup" @click="change_plan_frame_fun()"><i class="fa-sharp fa-solid fa-circle-xmark"></i></div>
                    </div>
                    <form @submit.prevent="change_super_plan_db" class="body_fram">
                        <div class="small_panel">
                            <div class="group flex row justify-between">
                                <div class="form-group mr-2">
                                    <label for="name" class="col-form-label mb-2">Price</label>
                                    <input type="text" class="form-control" id="name" v-model="change_plan_vars.price" required :error="change_plan_vars.errors.price">
                                </div>
                                <div class="form-group ml-2">
                                    <label for="name" class="col-form-label mb-2">Currency</label>
                                    <select class="form-control" id="name" v-model="change_plan_vars.currency" required>
                                        <option value="USD">USD</option>
                                        <option value="TND">TND</option>
                                        <option value="EUR">EUR</option>
                                    </select>
                                </div>
                            </div>
                            <div class="group flex row justify-between">
                                <div class="form-group mr-2">
                                    <label for="name" class="col-form-label mb-2">Words Number</label>
                                    <input type="text" class="form-control" id="name" v-model="change_plan_vars.words" required :error="change_plan_vars.errors.words">
                                </div>
                                <div class="form-group ml-2">
                                    <label for="name" class="col-form-label mb-2">Images Number</label>
                                    <input type="text" class="form-control" id="name" v-model="change_plan_vars.image" required :error="change_plan_vars.errors.image">
                                </div>
                            </div>
                            <div class="group">
                                <div class="form-group">
                                    <label for="name" class="col-form-label mb-2">Minutes Number</label>
                                    <input type="text" class="form-control" id="name" v-model="change_plan_vars.minute" required :error="change_plan_vars.errors.minute">
                                </div>
                                <div class="form-group m-4">
                                    <ToggleCheckbox
                                        :id="'ventilation'"
                                        :active_value="'active'"
                                        :inactive_value="'desactive'"
                                        :label="'Status'"
                                        :isChecked="change_plan_vars.status"
                                        @toggle="payment_status_togle"
                                    />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-form-label mb-2">Frequency</label>
                                <select class="form-control" id="name" v-model="change_plan_vars.frequency" required>
                                    <option value="month">monthly</option>
                                    <option value="year">annualy</option>
                                </select>
                            </div>
                        </div>
                        <div class="save">
                            <button type="submit">
                                save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link} from '@inertiajs/vue3';
import ToggleCheckbox from "@/Components/ToggleCheckbox.vue";
import InputError from '@/Components/InputError.vue';
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net';

DataTable.use(DataTablesCore);
</script>

<script>
export default {
    name: 'App',
    components: {
        Head,
        Link,
        DataTable,
        ToggleCheckbox,
    },
    props: {
        plans: Object,
    },

    data() {
        return {
            change_plan_frame:false,
            change_plan_vars: this.$inertia.form({
                id_plan: null,
                price: null,
                currency: null,
                words: null,
                image: null,
                minute: null,
                frequency: null,
                status: false,
            }),
        }
    },
    mounted() {

    },
    methods: {
        payment_status_togle() {
            this.change_plan_vars.status = !this.change_plan_vars.status;
        }, 
        change_plan_frame_fun(id,price,currency,words,image,minute,frequency,status){
            this.change_plan_frame?
                this.change_plan_frame=false:
                [
                    this.change_plan_vars.id_plan = id,
                    this.change_plan_vars.price= price,
                    this.change_plan_vars.currency= currency,
                    this.change_plan_vars.words= words,
                    this.change_plan_vars.image= image,
                    this.change_plan_vars.minute= minute,
                    this.change_plan_vars.frequency= frequency,
                    this.change_plan_vars.status= status,
                    this.change_plan_frame=true,
                ]
        },
        change_super_plan_db() {
            this.change_plan_vars.get(`/Finance_admin/${this.change_plan_vars.id_plan}/edit_plan`, {
                onSuccess: () => {
                this.change_plan_frame = false;
                this.change_plan_vars.reset();
                },
            });
        },
    },
}
</script>
<style>
@import 'datatables.net-dt';
</style>