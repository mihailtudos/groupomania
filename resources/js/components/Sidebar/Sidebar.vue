<template>
    <div class="sidebar">
        <router-link to="/" style="">
            <i class="fas fa-campground "></i>
        </router-link>
        <div class="sidebar-option active">
                <span class="material-icons">
                    <i class="fab fa-accusoft"></i>
                </span>
            <h2>Home</h2>
        </div>
        <div class="sidebar-option">
                <span class="material-icons">
                    <i class="fas fa-search"></i>
                </span>
            <h2>Explore</h2>
        </div>
        <div class="sidebar-option">
                <span class="material-icons">
                    <i class="fas fa-bell"></i>
                </span>
            <h2>Notifications</h2>
        </div>
        <div class="sidebar-option">
                <span class="material-icons">
                    <i class="fas fa-envelope"></i>
                </span>
            <h2>Messages</h2>
        </div>
        <div class="sidebar-option">
                <span class="material-icons">
                    <i class="fas fa-id-badge"></i>
                </span>
            <h2>Profile</h2>
        </div>
        <button class="sidebar__tweet">
            <i class="fas fa-feather-alt"></i> Tweet
        </button>
    </div>
</template>

<script>
export default {
    name: "Sidebar",
    mounted() {
        let arrow = document.querySelectorAll('.arrow');
        arrow.forEach(arrow => {
            arrow.addEventListener('click', (e) => {
                let arrowParent = e.target.parentElement.parentElement;
                arrowParent.classList.toggle('show-menu')
            })
        });

        let sidebar = document.querySelector('.sidebar');
        let menuBtn = document.querySelector('.menu');
        console.log(menuBtn);
        menuBtn.addEventListener('click', () => {
            sidebar.classList.toggle('close');
        })
    }
}
</script>

<style scoped lang="scss">
$twitter-color: #50b7f5;
$twitter-background: #e6ecf0;
.sidebar-option {
    display: flex;
    align-items: center;
    cursor: pointer;
    margin-bottom: 1rem;
}

.sidebar-option .material-icons,
.fa-twitter,
.fa-campground {
    padding: 10px;
}

.sidebar-option h2 {
    font-weight: 800;
    font-size: 20px;
    margin-right: 20px;
}

.sidebar-option:hover {
    background-color: $twitter-background;
    border-radius: 30px;
    color: $twitter-color;
    transition: color 100ms ease-out;
}

.sidebar-option.active {
    color: $twitter-color;
}

.sidebar__tweet {
    background-color: $twitter-color;
    width: 100%;
    border: none;
    color: white;
    font-weight: 900;
    border-radius: 30px;
    height: 50px;
    margin-top: 20px;
    cursor: pointer;
}
.sidebar {
    border-right: 1px solid $twitter-background;
    flex: 0.2;
    min-width: 250px;
    margin-top: 20px;
    padding-left: 20px;
    padding-right: 20px;
}

.fa-campground {
    color: $twitter-color;
    font-size: 30px;
    padding: 20px;
}
</style>
