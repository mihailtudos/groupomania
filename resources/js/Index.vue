<template>
    <div>
        <nav class="navbar">
            <router-link :to="{ name: 'home'}">Groupomania</router-link>
            <div>
                <router-link :to="{ name: 'home'}">Home</router-link>
                <router-link :to="{ name: 'post', params: {id: 1}}">Post</router-link>
            </div>
        </nav>
        <router-view></router-view>
    </div>
</template>

<script>
export default {
    name: "Index"
}
</script>

<style scoped>

</style>
