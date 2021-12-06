<template>
    <div>
        <i :style="`font-size: ${size}px;
                margin-right: 1rem;
                cursor: pointer;`"
           class="far fa-image"
           @click="openFileOption"></i>
        <input type="file" id="image" style="display:none">
    </div>
</template>

<script>
export default {
    name: "ImageFileBrowseIcon",
    methods: {
        openFileOption() {
            document.getElementById("image").click();
        }
    },
    props: {
        size: {
            type: String,
            required: false,
            default: '20'
        }
    }
}
</script>

<style scoped>

</style>
