<template>
    <Head title="AI-Tool" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight page_title">
                <i class="fa-solid fa-pen-to-square"></i>
                /AI-edit</h2>
        </template>
        <div class="tools_table_frame pt-10 pb-4 ">
            <div class="w-100 mt-2 mb-4 header_tab">
                <span class="h3"><i class="fa-solid fa-table-list mr-2"></i>list custom categories</span>
                <button @click="openCategorie()" class="butt">
                    create categorie
                </button>
            </div>
            <div class="table_frame">
                <DataTable class="table_edit DataTable1">
                    <thead>
                            <tr class="text-center font-bold">
                                <th class="pb-4 pt-6 px-6 text-start">name</th>
                                <th class="pb-4 pt-6 px-6 text-start">description</th>
                                <th class="pb-4 pt-6 px-6 text-start tool_num">tools number</th>
                                <th class="pb-4 pt-6 px-6 text-start">edit</th>
                                <th class="pb-4 pt-6 px-6 text-start w-20">remove</th>
                            </tr>
                    </thead>
                    <tbody class="text-right">
                            <tr v-for="categories in favorit_categories_custom">
                                <td class="pb-4 pt-6 px-6 border-t flex row items-center">
                                    <i class="fa-solid fa-folder-open mr-2"></i>{{ categories.name }}
                                </td>
                                <td class="pb-4 pt-6 px-6 border-t text-start">
                                    {{ categories.description }}
                                </td>
                                <td class="pb-4 pt-6 px-6 border-t text-start">
                                    {{ categories.count_tools }}
                                </td>
                                <td class="pb-4 pt-6 px-6 border-t text-start">
                                    <Link :href="`/ai_tools_edit/${categories.id}/edit`">
                                        <i class="fa-solid fa-pen-to-square text-green-500"></i> edit
                                    </Link>
                                </td>
                                <td class="pb-4 pt-6 px-6 border-t text-start ">
                                    <Link :href="`/ai_categories_list/${categories.id}/remove_from_custom_favorit_cat`">
                                        <i class="fa-solid fa-minus text-red-500"></i> remove 
                                    </Link>
                                </td>
                            </tr>
                    </tbody>
                </DataTable>
            </div>
        </div>
        <div class="tools_table_frame pt-10 pb-4 ">
            <div class="w-100 mt-2 mb-4 header_tab">
                <span class="h3"><i class="fa-solid fa-layer-group mr-2"></i>list categories</span>
                <Link class="butt" :href="route('ai_categories_list')">
                    add categorie
                </Link>
            </div>
            <div class="table_frame">
                <DataTable class="table_edit DataTable2">
                    <thead>
                            <tr class="text-center font-bold">
                                <th class="pb-4 pt-6 px-6 text-start">name</th>
                                <th class="pb-4 pt-6 px-6 text-start">description</th>
                                <th class="pb-4 pt-6 px-6 text-start tool_num">tools number</th>
                                <th class="pb-4 pt-6 px-6 text-start w-20">remove</th>
                            </tr>
                    </thead>
                    <tbody class="text-right">
                            <tr v-for="categories in favorit_categories_original">
                                <td class="pb-4 pt-6 px-6 border-t text-start flex row items-center">
                                    <i class="fa-solid fa-layer-group" ></i>{{ categories.name }}
                                </td>
                                <td class="pb-4 pt-6 px-6 border-t text-start">
                                    {{ categories.description }}
                                </td>
                                <td class="pb-4 pt-6 px-6 border-t text-start">
                                    {{ categories.count_tools }}
                                </td>
                                <td class="pb-4 pt-6 px-6 border-t text-start">
                                    <Link :href="`/ai_categories_list/${categories.id}/remove_from_favorit_cat`">
                                        <i class="fa-solid fa-minus text-red-500"></i> remove 
                                    </Link>
                                </td>
                            </tr>
                            <tr v-for="categories in favorit_sub_categorie">
                                <td class="pb-4 pt-6 px-6 border-t text-start">
                                    <i class="fa-solid fa-layer-group mr-2" ></i>{{ categories.name }}
                                </td>
                                <td class="pb-4 pt-6 px-6 border-t text-start">
                                    {{ categories.description }}
                                </td>
                                <td class="pb-4 pt-6 px-6 border-t text-start">
                                    {{ categories.count_tools }}
                                </td>
                                <td class="pb-4 pt-6 px-6 border-t text-start">
                                    <Link :href="`/ai_categories_list/${categories.id}/remove_from_sub_favorit_cat`">
                                        <i class="fa-solid fa-minus text-red-500"></i> remove 
                                    </Link>
                                </td>
                            </tr>
                    </tbody>
                </DataTable>
            </div>
        </div>
        <div class="tools_table_frame pt-10 pb-4 ">
            <div class="w-100 mt-2 mb-4 header_tab">
                <span class="h3"><i class="fa-solid fa-star mr-2" ></i>list tools</span>
                <Link class="butt" :href="route('ai_tools_list')">
                    add tool
                </Link>
            </div>
            <div class="table_frame">
                <DataTable class="table_edit DataTable2">
                    <thead>
                            <tr class="text-center font-bold">
                                <th class="pb-4 pt-6 px-6 text-start">name</th>
                                <th class="pb-4 pt-6 px-6 text-start">description</th>
                                <th class="pb-4 pt-6 px-6 text-start">token</th>
                                <th class="pb-4 pt-6 px-6 text-start">level</th>
                                <th class="pb-4 pt-6 px-6 text-start w-20">remove</th>
                            </tr>
                    </thead>
                    <tbody class="text-right">
                            <tr v-for="tools in $page.props.auth.favorit_tools[0]">
                                <td class="pb-4 pt-6 px-6 border-t text-start flex row items-center">
                                    <p v-html="tools.logo" class="mr-2" :style="{color: tools.logo_color}"></p> {{ tools.title }}
                                </td>
                                <td class="pb-4 pt-6 px-6 border-t text-start">
                                    {{ tools.description }}
                                </td>
                                <td class="pb-4 pt-6 px-6 border-t text-start">
                                    500
                                </td>
                                <td class="pb-4 pt-6 px-6 border-t text-start">
                                    <p v-if="tools.premium">Premium</p>
                                    <p v-else-if="tools.pro">Pro</p>
                                    <p v-else-if="tools.Free">Free</p>
                                    <p v-else>Standard</p>
                                </td>
                                <td class="pb-4 pt-6 px-6 border-t text-start">
                                    <Link :href="`/ai_tools_list/${tools.id}/remove_from_favorit`">
                                        <i class="fa-solid fa-minus text-red-500"></i> remove 
                                    </Link>
                                </td>
                            </tr>
                    </tbody>
                </DataTable>
            </div>
        </div>

        <!-- popup -->
        <div class="add_tikets_frame" v-if="openCategorie_frame" >
                                <div class="fram_tikets">
                                    <div class="header">
                                        <div class="logo"></div>
                                        <div class="exite" id="exit_popup" @click="openCategorie()"><i class="fa-sharp fa-solid fa-circle-xmark"></i></div>
                                    </div>
                                    <div class="body_fram">
                                        <form @submit.prevent="save_Categorie" class="form1">
                                            <div class="inputs">
                                                <input 
                                                    type="text" 
                                                    id="name" 
                                                    placeholder="Name Of Categorie"
                                                    v-model="Categorie_form.name"
                                                    :error="Categorie_form.errors.name"
                                                    required
                                                >
                                                <input 
                                                    type="text" 
                                                    id="Description" 
                                                    placeholder="Description Of Categorie"
                                                    v-model="Categorie_form.description"
                                                    :error="Categorie_form.errors.description"
                                                    required
                                                >
                                            </div>
                                            <div class="save">
                                                <button type="submit" class="tiket_save" :class="{ 'opacity-25': Categorie_form.processing }" :disabled="Categorie_form.processing">
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
import { Head , Link} from '@inertiajs/vue3';
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net';

DataTable.use(DataTablesCore);
</script>

<script>
export default {
    name: 'App',
    components: {
        Head,
        DataTable,
        Link,
    },
    props: {
        favorit_categories_custom: Object,
        favorit_categories_original: Object,
        favorit_sub_categorie: Object,
    },

    data() {
        return {
            //create cat
            openCategorie_frame : false,
            Categorie_form: this.$inertia.form({
                name: null,
                description: null,
            }),
        }
    },
    mounted() {

    },
    methods: {
        //edit cat
        openCategorie() {
            this.openCategorie_frame?
                this.openCategorie_frame = false:
                this.openCategorie_frame = true;
                
        },
        save_Categorie() {
            this.Categorie_form.get(`/AI_tool_Categorie`, {
                onSuccess: () => {
                this.openCategorie_frame = false;
                this.Categorie_form.reset();
                },
            });
        },
    },
}
</script>
<style>
@import 'datatables.net-dt';
</style>