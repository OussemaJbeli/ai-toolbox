<template>
    <Head title="Subscribers" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight page_title">
                <i class="fa-solid fa-newspaper"></i>
                /Blogs</h2>
        </template>
        <div class="contain_admin">
            <!-- blogs -->
            <div class="historique_statistique frame_original pt-10 pb-4 ">
                <div class="w-100 mt-2 mb-4 flex flex-row items-center justify-between">
                    <span class="h3">List Blogs</span>
                    <Link class="button button_acount" :href="`/Blogs_admin/show_to_create`">
                        <i class="fa-solid fa-user-plus"></i>Create Blog
                    </Link>
                </div>
                <div class="table_frame">
                    <DataTable class="table_edit DataTable3">
                        <thead>
                            <tr class="text-center font-bold">
                                <th class="pb-4 pt-6 px-6 text-start">title</th>
                                <th class="pb-4 pt-6 px-6 text-start">creator</th>
                                <th class="pb-4 pt-6 px-6 text-start">date</th>
                                <th class="pb-4 pt-6 px-6 text-start">edit</th>
                                <th class="pb-4 pt-6 px-6 text-start">delete</th>
                            </tr>
                        </thead>
                        <tbody class="text-right">
                            <tr v-for="blog in blogs">
                                <td class="pb-4 pt-6 px-6 border-t text-start">
                                    {{ blog.title }}
                                </td>
                                <td class="pb-4 pt-6 px-6 border-t text-start">
                                    {{ blog.name }}
                                </td>
                                <td class="pb-4 pt-6 px-6 border-t text-start ">
                                    {{ blog.date }}
                                </td>
                                <td class="pb-4 pt-6 px-6 border-t text-start">
                                    <Link :href="`/Blogs_admin/${blog.id}/show_to_edit`">
                                        <i class="fa-solid fa-pen-to-square text-green-500"></i>edit
                                    </Link>
                                </td>
                                <td class="pb-4 pt-6 px-6 border-t text-start">
                                    <Link :href="`/Blogs_admin/${blog.id}/destroy`">
                                        <i class="fa-solid fa-trash text-red-500"></i>delete
                                    </Link>
                                </td>
                            </tr>
                        </tbody>
                    </DataTable>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link} from '@inertiajs/vue3';
import FileInput from "@/Components/FileInput.vue";
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
        FileInput,
    },
    props: {
        blogs: Object,
    },

    data() {
        return {

        }
    },
    mounted() {

    },
    methods: {
        
    },
}
</script>
<style>
@import 'datatables.net-dt';
</style>