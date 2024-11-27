<template>
    <Head title="AI-Tool" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight page_title">
                <i class="fa-solid fa-newspaper"></i>
                /Create Blogs</h2>
        </template>
        <div class="text_tools_data_show">
            <div class="frame">
                <div class="container">
                    <form @submit.prevent="submitForm">
                        <header>
                            <div class="inputs">
                                <input type="text" class="input" required v-model="form.title">
                            </div>
                            <div class="inputs">
                                <label for="">Upload Image</label>
                                <file-input
                                    required
                                    v-model="form.image_path"
                                    :error="form.errors.image_path"
                                    class="file_shoser"
                                    type="file"
                                    accept="image/*"
                                />
                            </div>
                            <div class="buttons">
                                <button type="submit" class="register_button" title="Register">Save<i class="fa-solid fa-floppy-disk ml-2"></i></button>
                            </div>
                        </header>
                        <body>
                            <div class="text_editor_vue" ref="content">
                                <ckeditor :editor="editor" v-model="form.htmlContent"></ckeditor>
                            </div>
                        </body>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3'
import FileInput from "@/Components/FileInput.vue";
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import CKEditor from "@ckeditor/ckeditor5-vue"

</script>

<script>
export default {

    components: {
        Head,
        Link,
        ckeditor: CKEditor.component,
        FileInput
    },

    data() {
        return {
            form: this.$inertia.form({
                title: 'new blog',
                htmlContent: null,
                image_path: null,
            }),
            editor: ClassicEditor,
        }
    },
    methods: {
        submitForm() {
            this.form.post(`/Blogs_admin/store`);
        },
    },
    computed: {

    }
}
</script>