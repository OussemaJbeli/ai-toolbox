<template>

    <div class="popup_favorit_add" v-if="$page.props.flash.favorit_title && show">
        <div class="notificationCard">
            <i class="fa-solid fa-circle-check"></i>
            <p class="notificationHeading text-center">{{ $page.props.flash.favorit_title }}</p>
            <p class="notificationPara">{{$page.props.flash.favorit_description}}</p>
            <div class="buttonContainer">
                <button class="AllowBtn" @click="show = false">OK</button>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            show: true,
        };
    },
    watch: {
    "$page.props.flash": {
        handler() {
            this.show = true;
        },
        deep: true,
        },
    },
};
</script>
