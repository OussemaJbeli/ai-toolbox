<template>
    <Head title="Users Management" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight page_title">
                <i class="fa-regular fa-file-audio"></i>
                /Voice Data </h2>
        </template>
        <div class="contain_admin contain_data">
            <!-- document -->
            <div class="historique_statistique frame_original pt-10 pb-4 ">
                <div class="w-100 mt-2 mb-4 flex flex-row items-center justify-between">
                    <span class="h3">List Voice</span>
                    <Link class="button button_acount" :href="route('ai_tools_list')">
                        <i class="fa-solid fa-user-plus"></i>Create Voice
                    </Link>
                </div>
                <div class="table_frame">
                    <DataTable class="table_edit DataTable1">
                        <thead>
                            <tr class="text-center font-bold">
                                <th class="pb-4 pt-6 px-6 text-start">date</th>
                                <th class="pb-4 pt-6 px-6 text-start">language</th>
                                <th class="pb-4 pt-6 px-6 text-start">voice</th>
                                <th class="pb-4 pt-6 px-6 text-start">gender</th>
                                <th class="pb-4 pt-6 px-6 text-start"><i class="fa-solid fa-music"></i></th>
                                <th class="pb-4 pt-6 px-6 text-start">format</th>
                                <th class="pb-4 pt-6 px-6 text-start">chars</th>
                                <th class="pb-4 pt-6 px-6 text-start">delete</th>
                            </tr>
                        </thead>
                        <tbody class="text-right">
                            <tr v-for="(voice,index) in voices" :key="index">
                                <td class="pb-4 pt-6 px-6 border-t text-start">
                                    {{ voice.date }}
                                </td>
                                <td class="pb-4 pt-6 px-6 border-t text-start">
                                    {{ voice.language }}
                                </td>
                                <td class="pb-4 pt-6 px-6 border-t text-start">
                                    {{ voice.VoiceName }}
                                </td>
                                <td class="pb-4 pt-6 px-6 border-t text-start">
                                    {{ voice.Gender }}
                                </td>
                                <td class="pb-4 pt-6 px-6 border-t text-start">
                                    <label :for="'audioPlayer' + index" @click="playOrPauseAudio(index)">
                                        <i class="fa-solid fa-play"></i>
                                    </label>
                                    <audio :id="'audioPlayer' + index" :ref="'audio' + index" :src="voice.voice_path"></audio>
                                </td>
                                <td class="pb-4 pt-6 px-6 border-t text-start">
                                    mp3
                                </td>
                                <td class="pb-4 pt-6 px-6 border-t text-start">
                                    {{ voice.chars }}
                                </td>
                                <td class="pb-4 pt-6 px-6 border-t text-start  ">
                                    <Link :href="`voice_data/${voice.id}/destroyVoice`">
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
        voices: Object,
    },

    data() {
        return {

        };
    },
    methods: {
        playOrPauseAudio(index) {
            const audio = this.$refs['audio' + index][0];
            if (audio.paused)
                audio.play();
            else 
                audio.pause();
        },
    },
}
</script>
<style>
@import 'datatables.net-dt';
</style>