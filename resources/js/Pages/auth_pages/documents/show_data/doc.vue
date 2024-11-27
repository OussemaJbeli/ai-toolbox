<template>
    <Head title="AI-Tool" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight page_title">
                <i class="fa-solid fa-star"></i>
                /AI-Documents</h2>
        </template>
        <div class="text_tools_data_show">
            <div class="frame">
                <div class="container">
                    <form @submit.prevent="submitForm">
                        <header>
                            <div class="inputs">
                                <input type="text" class="input" required v-model="form.title">
                            </div>
                            <div class="buttons">
                                <button type="submit" class="register_button" title="Register">Save<i class="fa-solid fa-floppy-disk ml-2"></i></button>
                                <p title="As PDF" @click="saveAsPDF" class="register_button">PDF<i class="fa-solid fa-download ml-2"></i></p>
                                <p title="Copy text to clipboard" @click="copyMessage" class="register_button"><i class="fa-solid fa-copy"></i></p>
                            </div>
                        </header>
                        <body>
                            <div class="text_editor_vue" :class="language=='Arabic'? 'invers_direction':''" ref="content">
                                <ckeditor :editor="editor" v-model="form.htmlContent"></ckeditor>
                            </div>
                            <div v-if="isAssistantTyping" class="isAssistantTyping" ref="messagesContainer">
                                <svg xmlns="http://www.w3.org/2000/svg" height="200px" width="200px" viewBox="0 0 200 200" class="pencil">
                                    <defs>
                                        <clipPath id="pencil-eraser">
                                            <rect height="30" width="30" ry="5" rx="5"></rect>
                                        </clipPath>
                                    </defs>
                                    <circle transform="rotate(-113,100,100)" stroke-linecap="round" stroke-dashoffset="439.82" stroke-dasharray="439.82 439.82" stroke-width="2" stroke="currentColor" fill="none" r="70" class="pencil__stroke"></circle>
                                    <g transform="translate(100,100)" class="pencil__rotate">
                                        <g fill="none">
                                            <circle transform="rotate(-90)" stroke-dashoffset="402" stroke-dasharray="402.12 402.12" stroke-width="30" stroke="hsl(223,90%,50%)" r="64" class="pencil__body1"></circle>
                                            <circle transform="rotate(-90)" stroke-dashoffset="465" stroke-dasharray="464.96 464.96" stroke-width="10" stroke="hsl(223,90%,60%)" r="74" class="pencil__body2"></circle>
                                            <circle transform="rotate(-90)" stroke-dashoffset="339" stroke-dasharray="339.29 339.29" stroke-width="10" stroke="hsl(223,90%,40%)" r="54" class="pencil__body3"></circle>
                                        </g>
                                        <g transform="rotate(-90) translate(49,0)" class="pencil__eraser">
                                            <g class="pencil__eraser-skew">
                                                <rect height="30" width="30" ry="5" rx="5" fill="hsl(223,90%,70%)"></rect>
                                                <rect clip-path="url(#pencil-eraser)" height="30" width="5" fill="hsl(223,90%,60%)"></rect>
                                                <rect height="20" width="30" fill="hsl(223,10%,90%)"></rect>
                                                <rect height="20" width="15" fill="hsl(223,10%,70%)"></rect>
                                                <rect height="20" width="5" fill="hsl(223,10%,80%)"></rect>
                                                <rect height="2" width="30" y="6" fill="hsla(223,10%,10%,0.2)"></rect>
                                                <rect height="2" width="30" y="13" fill="hsla(223,10%,10%,0.2)"></rect>
                                            </g>
                                        </g>
                                        <g transform="rotate(-90) translate(49,-30)" class="pencil__point">
                                            <polygon points="15 0,30 30,0 30" fill="hsl(33,90%,70%)"></polygon>
                                            <polygon points="15 0,6 30,0 30" fill="hsl(33,90%,50%)"></polygon>
                                            <polygon points="15 0,20 10,10 10" fill="hsl(223,10%,10%)"></polygon>
                                        </g>
                                    </g>
                                </svg>
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

import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import CKEditor from "@ckeditor/ckeditor5-vue"

import { jsPDF } from "jspdf";


const props = defineProps({
    Documents: Object,
})

</script>

<script>
export default {

    components: {
        Head,
        Link,
        ckeditor: CKEditor.component
    },

    data() {
        return {
            form: this.$inertia.form({
                title: this.Documents[0].title,
                htmlContent:this.Documents[0].htmlContent,
            }),
            editor: ClassicEditor,
        }
    },
    methods: {
        submitForm() {
            this.form.post(`/document_data/${this.Documents[0].id}/textedit`);
        },

        //save pdf
        saveAsPDF() {
            const doc = new jsPDF();
            const longText = this.text_content;
            const pageWidth = doc.internal.pageSize.getWidth();
            const margin = 20; 
            const textWidth = pageWidth - margin * 2;

            const lines = doc.splitTextToSize(longText, textWidth);

            doc.text(lines, margin, 20);

            doc.save("Ai-Toolbox-document.pdf");
        },
        //copy text
        async copyMessage() {
            try {
                await navigator.clipboard.writeText(this.text_content);
                alert('Message copied to clipboard!');
            } catch (err) {
                console.error('Failed to copy: ', err);
            }
        },

    },
    computed: {

    }
}
</script>