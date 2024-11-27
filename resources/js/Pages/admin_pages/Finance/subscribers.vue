<template>
    <Head title="Subscribers" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight page_title">
                <i class="fa-solid fa-id-card"></i>
                /Subscribers</h2>
        </template>
        <div class="contain_admin">
            <!-- user -->
            <div class="historique_statistique frame_original pt-10 pb-4 ">
                <div class="w-100 mt-2 mb-4 flex flex-row items-center justify-between">
                    <span class="h3">List User</span>
                    <p></p>
                </div>
                <div class="table_frame">
                    <DataTable class="table_edit DataTable1">
                        <thead>
                            <tr class="text-center font-bold">
                                <th class="pb-4 pt-6 px-6 text-start">name</th>
                                <th class="pb-4 pt-6 px-6 text-start">email</th>
                                <th class="pb-4 pt-6 px-6 text-start">words usage</th>
                                <th class="pb-4 pt-6 px-6 text-start">images usage</th>
                                <th class="pb-4 pt-6 px-6 text-start">minutes usage</th>
                                <th class="pb-4 pt-6 px-6 text-start">edit</th>
                                <th class="pb-4 pt-6 px-6 text-start">delete</th>
                            </tr>
                        </thead>
                        <tbody class="text-right">
                            <tr v-for="user in users">
                                <td class="pb-4 pt-6 px-6 border-t text-start">
                                    {{ user.name }}
                                </td>
                                <td class="pb-4 pt-6 px-6 border-t text-start">
                                    {{ user.email }}
                                </td>
                                <td class="pb-4 pt-6 px-6 border-t text-start  ">
                                    {{ user.usage_word }}/{{ user.words }}
                                </td>
                                <td class="pb-4 pt-6 px-6 border-t text-start ">
                                    {{ user.usage_image }}/{{ user.image }}
                                </td>
                                <td class="pb-4 pt-6 px-6 border-t text-start  ">
                                    {{ user.usage_minute }}/<span v-if="user.minute">{{ user.usage_minute }}</span><span v-else>0</span>
                                </td>
                                <td class="pb-4 pt-6 px-6 border-t text-start">
                                    <button @click="change_user_frame_fun(user.id,user.name,user.email)">
                                        <i class="fa-solid fa-pen-to-square text-green-500"></i>edit
                                    </button>
                                </td>
                                <td class="pb-4 pt-6 px-6 border-t text-start  ">
                                    <Link :href="`/user_manegement_admin/${user.id}/destroy`">
                                        <i class="fa-solid fa-trash text-red-500"></i>delete
                                    </Link>
                                </td>
                            </tr>
                        </tbody>
                    </DataTable>
                </div>
            </div>
            <!-- edit user -->
            <div class="limit_frame" v-if="change_user_frame">
                <div class="limit_panel">
                    <div class="header">
                        <div class="logo"></div>
                        <div class="exite" id="exit_popup" @click="change_user_frame_fun()"><i class="fa-sharp fa-solid fa-circle-xmark"></i></div>
                    </div>
                    <form @submit.prevent="change_super_user_db" class="body_fram">
                        <div class="small_panel">
                            <div class="form-group">
                                <label for="name" class="col-form-label ">Name</label>
                                <input type="text" class="form-control" id="name" v-model="change_user_vars.name" required :error="change_user_vars.errors.name">
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-form-label ">E-mail</label>
                                <input type="email" class="form-control" id="name" v-model="change_user_vars.email" required>
                                <InputError class="mt-2 text-red-500" :message="change_user_vars.errors.email" />
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-form-label ">Password</label>
                                <input type="password" class="form-control" id="name" v-model="change_user_vars.password" :error="change_user_vars.errors.password">
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
        users: Object,
    },

    data() {
        return {
            change_user_frame:false,
            change_user_vars: this.$inertia.form({
                id_user: null,
                name: null,
                email: null,
                password: null,
            }),
        }
    },
    mounted() {

    },
    methods: {
        change_user_frame_fun(id_user,name,email){
            this.change_user_frame?
                this.change_user_frame=false:
                [
                    this.change_user_frame=true,
                    this.change_user_vars.id_user=id_user,
                    this.change_user_vars.name=name,
                    this.change_user_vars.email=email,  
                ]
        },
        change_super_user_db() {
            this.change_user_vars.get(`/user_manegement_admin/${this.change_user_vars.id_user}/edit_user`, {
                onSuccess: () => {
                this.change_user_frame = false;
                this.change_user_vars.reset();
                },
            });
        },
    },
}
</script>
<style>
@import 'datatables.net-dt';
</style>