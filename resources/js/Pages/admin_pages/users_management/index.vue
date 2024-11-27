<template>
    <Head title="Users Management" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight page_title">
                <i class="fa-solid fa-users"></i>
                /Users Management</h2>
        </template>
        <div class="contain_admin">
            <!-- user -->
            <div class="historique_statistique frame_original pt-10 pb-4 ">
                <div class="w-100 mt-2 mb-4 flex flex-row items-center justify-between">
                    <span class="h3">List User</span>
                    <button class="button button_acount"  @click="add_special_user_frame_fun()">
                        <i class="fa-solid fa-user-plus"></i>Create Account
                    </button>
                </div>
                <div class="table_frame">
                    <DataTable class="table_edit DataTable1">
                        <thead>
                            <tr class="text-center font-bold">
                                <th class="pb-4 pt-6 px-6 text-start">state</th>
                                <th class="pb-4 pt-6 px-6 text-start">name</th>
                                <th class="pb-4 pt-6 px-6 text-start">email</th>
                                <th class="pb-4 pt-6 px-6 text-start">subscription</th>
                                <th class="pb-4 pt-6 px-6 text-start">add subscription</th>
                                <th class="pb-4 pt-6 px-6 text-start">remove subscription</th>
                                <th class="pb-4 pt-6 px-6 text-start">edit</th>
                                <th class="pb-4 pt-6 px-6 text-start">delete</th>
                            </tr>
                        </thead>
                        <tbody class="text-right">
                            <tr v-for="user in users">
                                <td class="pb-4 pt-6 px-6 border-t text-start">
                                    <p v-if="user.special_user" class="text-green-500">Special User</p>
                                    <p v-else>Normal User</p>
                                </td>
                                <td class="pb-4 pt-6 px-6 border-t text-start">
                                    {{ user.name }}
                                </td>
                                <td class="pb-4 pt-6 px-6 border-t text-start">
                                    {{ user.email }}
                                </td>
                                <td class="pb-4 pt-6 px-6 border-t text-start">
                                    <span v-if="user.payment" class="text-green-500">have subscription</span>
                                    <span v-else class="text-red-500">don't have subscription</span>
                                </td>
                                <td class="pb-4 pt-6 px-6 border-t text-start ">
                                    <Link :href="`/user_manegement_admin/${user.id}/addsubscribe`">
                                        <i class="fa-solid fa-plus text-green-500"></i>add 
                                    </Link>
                                </td>
                                <td class="pb-4 pt-6 px-6 border-t text-start  ">
                                    <Link :href="`/user_manegement_admin/${user.id}/dessubscribe`">
                                        <i class="fa-solid fa-minus text-red-500"></i>remove 
                                    </Link>
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
            <!-- admin -->
            <div class="historique_statistique frame_original pt-10 pb-4">
                <div class="w-100 mt-2 mb-4 flex flex-row items-center justify-between">
                    <span class="h3">List Admins</span>
                    <button class="button button_acount"  @click="add_super_user_frame_fun()">
                        <i class="fa-solid fa-user-plus"></i>Create Account
                    </button>
                </div>
                <div class="table_frame">
                    <DataTable class="table_edit DataTable1">
                    <thead>
                        <tr class="text-center font-bold">
                            <th class="pb-4 pt-6 px-6 text-start">state</th>
                            <th class="pb-4 pt-6 px-6 text-start">name</th>
                            <th class="pb-4 pt-6 px-6 text-start">email</th>
                            <th class="pb-4 pt-6 px-6 text-start">subscription</th>
                            <th class="pb-4 pt-6 px-6 text-start">add subscription</th>
                            <th class="pb-4 pt-6 px-6 text-start">remove subscription</th>
                            <th class="pb-4 pt-6 px-6 text-start">edit</th>
                            <th class="pb-4 pt-6 px-6 text-start">delete</th>
                        </tr>
                    </thead>
                    <tbody class="text-right">
                        <tr v-for="sub_admin in super_user">
                            <td class="pb-4 pt-6 px-6 border-t text-start">
                                <p v-if="sub_admin.special_user" class="text-green-500">Special Admin</p>
                                <p v-else>Normal Admin</p>
                            </td>
                            <td class="pb-4 pt-6 px-6 border-t text-start ">
                                {{ sub_admin.name }}
                            </td>
                            <td class="pb-4 pt-6 px-6 border-t text-start ">
                                {{ sub_admin.email }}
                            </td>
                            <td class="pb-4 pt-6 px-6 border-t text-start">
                                <span v-if="sub_admin.payment" class="text-green-500">have subscription</span>
                                <span v-else class="text-red-500">don't have subscription</span>
                            </td>
                            <td class="pb-4 pt-6 px-6 border-t text-start ">
                                <Link :href="`/user_manegement_admin/${sub_admin.id}/addsubscribe`">
                                    <i class="fa-solid fa-plus text-green-500"></i>add 
                                </Link>
                            </td>
                            <td class="pb-4 pt-6 px-6 border-t text-start  ">
                                <Link :href="`/user_manegement_admin/${sub_admin.id}/dessubscribe`">
                                    <i class="fa-solid fa-minus text-red-500"></i>remove 
                                </Link>
                            </td>
                            <td class="pb-4 pt-6 px-6 border-t text-start ">
                                <button @click="change_user_frame_fun(sub_admin.id,sub_admin.name,sub_admin.email)">
                                    <i class="fa-solid fa-pen-to-square text-green-500"></i>edit
                                </button>
                            </td>
                            <td class="pb-4 pt-6 px-6 border-t text-start  ">
                                <Link :href="`/user_manegement_admin/${sub_admin.id}/destroy`">
                                    <i class="fa-solid fa-trash text-red-500"></i>delete
                                </Link>
                            </td>
                        </tr>
                    </tbody>
                </DataTable>
                </div>
            </div>
            <!-- add spacial user -->
            <div class="limit_frame" v-if="add_special_user_frame">
                <div class="limit_panel">
                    <div class="header">
                        <div class="logo"></div>
                        <div class="exite" id="exit_popup" @click="add_special_user_frame_fun"><i class="fa-sharp fa-solid fa-circle-xmark"></i></div>
                    </div>
                    <form @submit.prevent="save_special_user_db" class="body_fram">
                        <div class="small_panel">
                            <div class="form-group">
                                <label for="name" class="col-form-label ">Name</label>
                                <input type="text" class="form-control" id="name" v-model="add_special_user_vars.name" required :error="add_special_user_vars.errors.name">
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-form-label ">E-mail</label>
                                <input type="email" class="form-control" id="email" v-model="add_special_user_vars.email" required :error="add_special_user_vars.errors.email">
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-form-label ">Password</label>
                                <input type="password" class="form-control" id="password" v-model="add_special_user_vars.password" required :error="add_special_user_vars.errors.password">
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
            <!-- add admin -->
            <div class="limit_frame" v-if="add_admin_frame">
                <div class="limit_panel">
                    <div class="header">
                        <div class="logo"></div>
                        <div class="exite" id="exit_popup" @click="add_super_user_frame_fun"><i class="fa-sharp fa-solid fa-circle-xmark"></i></div>
                    </div>
                    <form @submit.prevent="save_admin_db" class="body_fram">
                        <div class="small_panel">
                            <div class="form-group">
                                <label for="name" class="col-form-label ">Name</label>
                                <input type="text" class="form-control" id="name" v-model="add_admin_vars.name" required>
                                <InputError class="mt-2" :message="add_admin_vars.errors.name" />
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-form-label ">E-mail</label>
                                <input type="email" class="form-control" id="name" v-model="add_admin_vars.email" required>
                                <InputError class="mt-2" :message="add_admin_vars.errors.email" />
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-form-label ">Password</label>
                                <input type="password" class="form-control" id="name" v-model="add_admin_vars.password" required>
                                <InputError class="mt-2" :message="add_admin_vars.errors.password" />
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
        super_user: Object,
    },

    data() {
        return {
            add_special_user_frame:false,
            add_special_user_vars: this.$inertia.form({
                name: null,
                email: null,
                password: null,
            }),

            add_admin_frame:false,
            add_admin_vars: this.$inertia.form({
                name: null,
                email: null,
                password: null,
            }),
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
        add_special_user_frame_fun(){
            this.add_special_user_frame?
                this.add_special_user_frame=false:
                this.add_special_user_frame=true
        },
        add_super_user_frame_fun(){
            this.add_admin_frame?
                this.add_admin_frame=false:
                this.add_admin_frame=true
        },

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

        save_special_user_db() {
            this.add_special_user_vars.get(`/user_manegement_admin/add_special_user`, {
                onSuccess: () => {
                this.add_special_user_frame = false;
                this.add_special_user_vars.reset();
                },
            });
        },

        save_admin_db() {
            this.add_admin_vars.get(`/user_manegement_admin/add_admin`, {
                onSuccess: () => {
                this.add_admin_frame = false;
                this.add_admin_vars.reset();
                },
            });
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