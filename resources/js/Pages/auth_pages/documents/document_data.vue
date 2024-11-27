<template>
    <Head title="Users Management" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight page_title">
                <i class="fa-regular fa-file-lines"></i>
                /Document Data </h2>
        </template>
        <div class="contain_admin contain_data">
            <!-- document -->
            <div class="historique_statistique frame_original pt-10 pb-4 ">
                <div class="w-100 mt-2 mb-4 flex flex-row items-center justify-between">
                    <span class="h3">List Documents</span>
                    <Link class="button button_acount" :href="route('ai_tools_list')">
                        <i class="fa-solid fa-user-plus"></i>Create Documents
                    </Link>
                </div>
                <div class="table_frame">
                    <DataTable class="table_edit DataTable1">
                        <thead>
                            <tr class="text-center font-bold">
                                <th class="pb-4 pt-6 px-6 text-start">date</th>
                                <th class="pb-4 pt-6 px-6 text-start">Title</th>
                                <th class="pb-4 pt-6 px-6 text-start content_text">Content</th>
                                <th class="pb-4 pt-6 px-6 text-start">Tool</th>
                                <th class="pb-4 pt-6 px-6 text-start">Language</th>
                                <th class="pb-4 pt-6 px-6 text-start">edit</th>
                                <th class="pb-4 pt-6 px-6 text-start">delete</th>
                            </tr>
                        </thead>
                        <tbody class="text-right">
                            <tr v-for="Document in Documents">
                                <td class="pb-4 pt-6 px-6 border-t text-start">
                                    {{ Document.date }}
                                </td>
                                <td class="pb-4 pt-6 px-6 border-t text-start">
                                    {{ Document.title }}
                                </td>
                                <td class="pb-4 pt-6 px-6 border-t text-start content_text">
                                    {{ Document.text_content }}
                                </td>
                                <td class="pb-4 pt-6 px-6 border-t text-start">
                                    {{ Document.Tool }}
                                </td>
                                <td class="pb-4 pt-6 px-6 border-t text-start">
                                    {{ Document.language }}
                                </td>
                                <td class="pb-4 pt-6 px-6 border-t text-start">
                                    <Link :href="`/document_data/${Document.id}/document_edit`">
                                        <i class="fa-solid fa-pen-to-square text-green-500 mr-2"></i>edit
                                    </Link>
                                </td>
                                <td class="pb-4 pt-6 px-6 border-t text-start  ">
                                    <Link :href="`/document_data/${Document.id}/document_delete`">
                                        <i class="fa-solid fa-trash text-red-500 mr-2"></i>delete
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
    },
    props: {
        Documents: Object,
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