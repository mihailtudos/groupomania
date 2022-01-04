<template>
    <div class="search-bar">
            <span class="material-icons icon">
                <i class="fas fa-search"></i>
            </span>
        <input type="text" placeholder="Search..." >
    </div>
</template>

<script>
export default {
    name: "SearchBar"
}
</script>

<style scoped lang="scss">
$twitter-color: #50b7f5;
$twitter-background: #e6ecf0;

.search-bar {
    box-sizing: border-box;
    width: 100%;
    display: flex;
    align-items: center;
    background-color: $twitter-background;
    padding: 10px;
    border-radius: 20px;
    margin-top: 10px;
    input {
        border: none;
        background-color: $twitter-background;
        outline: none;
        width: 100%;
    }
    .icon {
        color: gray;
    }
}
</style>
