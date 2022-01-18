<template>
    <div>
        <i :style="`font-size: ${size}px;
                margin-right: 1rem;
                cursor: pointer;`"
           class="far fa-image"
           @click="openFileOption"></i>
        <input @change="onFileChange" type="file" id="image" style="display:none">
        <img :src="imagePreviewURL" alt="">
    </div>
</template>

<script>
export default {
    name: "ImageFileBrowseIcon",
    data() {
      return {
          imagePreviewURL: null
      }
    },
    methods: {
        openFileOption() {
            document.getElementById("image").click();
        },
        onFileChange(event) {
           if (this.isImage(event.target.files[0])) {
               this.$emit('imageUploaded', event.target.files[0]);
               return 1;
           }
           throw new Error('Incorrect data format');
        }
    },
    props: {
        size: {
            type: String,
            required: false,
            default: '20'
        }
    },
}
</script>

<style scoped>

</style>
