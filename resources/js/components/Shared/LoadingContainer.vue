<template>
    <div id="loading-container">
        <Spinner />
    </div>
</template>

<script>
import Spinner from "./Spinner";
export default {
    name: "LoadingContainer",
    components: {Spinner}
}
</script>

<style scoped lang="scss">
    #loading-container {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
