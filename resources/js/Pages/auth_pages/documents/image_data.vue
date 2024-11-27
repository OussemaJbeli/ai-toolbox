<template>
  <Head title="Image Data" />
  <AuthenticatedLayout>
      <template #header>
          <h2 class="font-semibold text-xl text-gray-800 leading-tight page_title">
              <i class="fa-regular fa-file-image"></i>
              /Image Data</h2>
      </template>
      <div class="image_tools_template_show">
        <div class="historiw">
            <div class="title">Image Historic</div>
            <div class="images_frame" v-if="images[0]">
                <div class="card" v-for="image in images">
                    <img :src="image.image_path" alt="">
                    <div class="title">{{ image.title }}</div>
                        <div class="managment">
                            <i class="fa-solid fa-download" @click="downloadWithAxios(image.image_path, 'AI-Toolbox-image')"></i>
                            <i class="fa-solid fa-eye" @click="openimage_frame(image.image_path,image.title,image.date)"></i>
                            <Link :href="`/image_data/${image.id}/destroy`"><i class="fa-solid fa-trash" ></i></Link>
                        </div>
                </div>
            </div>
            <div class="images_frame" v-else>
                <div class="loader">
                    <div class="loader__bar"></div>
                    <div class="loader__bar"></div>
                    <div class="loader__bar"></div>
                    <div class="loader__bar"></div>
                    <div class="loader__bar"></div>
                    <div class="loader__ball"></div>
                </div>
                <p>There is no data yet ...</p>
            </div>
        </div>
        <div class="show_image_popup" v-if="image_frame">
            <div class="image_frame">
                <div class="exite" @click="openimage_frame()"><i class="fa-sharp fa-solid fa-xmark"></i></div>
                <div class="image_side">
                    <img :src="image_frame_var.path" alt="">
                </div>
                <div class="details_side">
                    <p>Image Details</p>
                    <div class="title">{{ image_frame_var.title }}</div>
                    <div class="date">{{ image_frame_var.date }}</div>
                </div>
            </div>
        </div>
      </div>
  </AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link} from '@inertiajs/vue3';

</script>

<script>
export default {
  name: 'App',
  components: {
      Head,
      Link,
  },
  props: {
    images: Object,
  },

  data() {
      return {
        image_frame: false,
            image_frame_var: this.$inertia.form({
                path: null,
                title: null,
                date: null,
            }),
      }
  },
  mounted() {

  },
  methods: {
    openimage_frame(path,title,date){
            this.image_frame?
                this.image_frame = false:
                [
                    this.image_frame = true,
                    this.image_frame_var.path = path,
                    this.image_frame_var.title = title,
                    this.image_frame_var.date = date,
                ];
        },
  },
}
</script>
