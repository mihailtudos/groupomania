<template>
    <div class="sidebar">
        <div class="logo-details">
            <span class="material-icons">group_work</span>
            <div class="logo_name">Groupomania</div>
        </div>
        <ul class="nav-links">
            <li>
                <a href="">
                    <span class="material-icons">apps</span>
                    <span class="link_name">Dashboard</span>
                </a>
                <ul class="sub-menu blank">
                    <li class="link_name">
                        <a href="">Category</a>
                    </li>
                </ul>
            </li>
            <li>
                <div class="icon_link">
                    <a href="#">
                        <span class="material-icons">style</span>
                        <span class="link_name">Category</span>
                    </a>
                    <span class="material-icons arrow">expand_more</span>
                </div>
                <ul class="sub-menu">
                    <li class="link_name">
                        <a href="">Category</a>
                    </li>
                    <li>
                        <a href="">HTML & CSS</a>
                    </li>
                    <li>
                        <a href="">JavaSCript</a>
                    </li>
                    <li>
                        <a href="">PHP & MySQL</a>
                    </li>
                </ul>
            </li>
            <li>
                <div class="icon_link">
                    <a href="#">
                        <span class="material-icons">library_books</span>
                        <span class="link_name">Posts</span>
                    </a>
                    <span class="material-icons arrow">expand_more</span>
                </div>
                <ul class="sub-menu">
                    <li class="link_name">
                        <a href="">Posts</a>
                    </li>
                    <li>
                        <a href="">Web Design</a>
                    </li>
                    <li>
                        <a href="">Login Form</a>
                    </li>
                    <li>
                        <a href="">Card Design</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="">
                    <span class="material-icons">pie_chart</span>
                    <span class="link_name">Analytics</span>
                </a>
                <ul class="sub-menu blank">
                    <li class="link_name">
                        <a href="">Analytics</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="">
                    <span class="material-icons">show_chart</span>
                    <span class="link_name">Chart</span>
                </a>
                <ul class="sub-menu blank">
                    <li class="link_name">
                        <a href="">Chart</a>
                    </li>
                </ul>
            </li>
            <li>
                <div class="icon_link">
                    <a href="#">
                        <span class="material-icons">electrical_services</span>
                        <span class="link_name">Plugins</span>
                    </a>
                    <span class="material-icons arrow">expand_more</span>
                </div>
                <ul class="sub-menu">
                    <li class="link_name">
                        <a href="">Plugins</a>
                    </li>
                    <li>
                        <a href="">UI Face</a>
                    </li>
                    <li>
                        <a href="">Pigments</a>
                    </li>
                    <li>
                        <a href="">jQuery</a>
                    </li>
                </ul>
            </li>
            <li>
                <div class="profile-details">
                    <div class="profile-content">
                        <img src="/images/avatar.png" alt="">
                    </div>
                    <div class="name-job">
                        <div class="profile_name">Prem Shiha</div>
                        <div class="job">Web Design</div>
                    </div>
                    <span class="material-icons logout">logout</span>
                </div>
            </li>
        </ul>
    </div>
<!--    <section class="home-section">-->
<!--        <div class="home-content">-->
<!--            <span class="material-icons menu">menu</span>-->
<!--            <span class="text">Drop Down Sidebar</span>-->
<!--        </div>-->
<!--    </section>-->
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

<style scoped>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Open Sans", sans-serif;
    font-size: 16px;
}

.sidebar {
    position: fixed;
    top: 0;
    left: 0;
    background: #11101d;
    height: 100%;
    width: 260px;
    transition: all 0.3s ease;
    z-index: 100;
}

.sidebar.close ~ .home-section {
    left: 78px;
    width: calc(100% - 78px);
}

.sidebar.close {
    width: 78px;
}

.sidebar.close .logo-details .logo_name {
    opacity: 0;
    pointer-events: none;
    transition-delay: 0s;
}

.sidebar .logo-details {
    height: 60px;
    width: 100%;
    display: flex;
    align-items: center;
}

.sidebar .logo-details span {
    font-size: 30px;
    color: white;
    height: 50px;
    min-width: 78px;
    text-align: center;
    line-height: 50px;
}

.sidebar .logo-details .logo_name {
    font-size: 22px;
    color: white;
    font-weight: 600px;
    transition: 0.3s ease;
    transition-delay: 0.1s;
}

.sidebar .nav-links {
    height: 100%;
    padding: 30px 0 150px 0;
    overflow: auto;
}

.sidebar.close .nav-links {
    overflow: visible;
}

.sidebar .nav-links::-webkit-scrollbar {
    display: none;
}

.sidebar .nav-links li {
    position: relative;
    list-style: none;
    transition: all 0.4s ease;
    cursor: pointer;
}

.sidebar .nav-links li:hover {
    background: #1d1b31;
    cursor: pointer;
}

.sidebar .nav-links li .icon_link {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.sidebar.close .nav-links li .icon_link {
    display: block;
}

.sidebar .nav-links li .sub-menu {
    padding: 6px 6px 14px 80px;
    margin-top: -10px;
    background-color: #1d1b31;
    display: none;
}

.sidebar .nav-links li.show-menu .sub-menu {
    display: block;
}
.sidebar .nav-links li .sub-menu .link_name {
    display: none;
}

.sidebar.close .nav-links li .sub-menu .link_name {
    font-size: 18px;
    opacity: 1;
    display: block;
}

.sidebar.close .nav-links li .sub-menu {
    position: absolute;
    left: 100%;
    top: -10px;
    margin-top: 0;
    padding: 10px 20px;
    border-radius: 0 10px 10px 0;
    opacity: 0;
    pointer-events: none;
    display: block;
    transition: 0s;
}

.sidebar.close .nav-links li:hover .sub-menu {
    top: 0;
    opacity: 1;
    pointer-events: auto;
    transition: all 0.4s ease;
}

.sidebar .nav-links li .sub-menu a {
    color: white;
    font-size: 15px;
    padding: 5px 0;
    white-space: nowrap;
    opacity: 0.6;
    transition: all 0.3s ease;
}

.sidebar .nav-links li .sub-menu a:hover {
    opacity: 1;
}

.sidebar .nav-links li span {
    height: 50px;
    min-width: 78px;
    text-align: center;
    line-height: 50px;
    color: white;
    font-size: 20px;
    transition: all 0.3s ease;
}

.sidebar .nav-links li.show-menu span.arrow {
    transform: rotate(-180deg);
}

.sidebar.close .nav-links span.arrow {
    display: none;
}

.sidebar .nav-links li a {
    text-decoration: none;
    display: flex;
    align-items: center;
}

.sidebar .nav-links li a .link_name {
    font-size: 18px;
    font-weight: 400;
    color: #fff;
}

.sidebar.close .nav-links li a .link_name {
    opacity: 0;
    pointer-events: none;
}

.sidebar .nav-links li .sub-menu.blank {
    opacity: 1;
    pointer-events: auto;
    padding: 3px 20px 6px 16px;
    opacity: 0;
    pointer-events: none;
}

.sidebar .nav-links li .sub-menu .link_name {
    display: none;
}

.sidebar .nav-links li:hover .sub-menu.blank {
    top: 50%;
    transform: translateY(-50%);
}

.sidebar .profile-details {
    position: fixed;
    bottom: 0;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: #fff;
    padding: 6px 0;
    border-radius: 10px;
    width: 260px;
    transition: all 0.4s ease;
}

.sidebar.close .profile-details {
    background: none;
}

.sidebar.close .profile-details {
    width: 78px;
}

.sidebar .profile-details .profile-content {
    display: flex;
    align-items: center;
}

.sidebar .profile-details img {
    height: 52px;
    width: 52px;
    object-fit: cover;
    border-radius: 16px;
    margin: 0 14px 0 12px;
    background: #1d1b31;
    padding: 10px;
    transition: all 0.5s ease;
}

.sidebar.close .profile-details img {
    padding: 10px;
}

.sidebar .profile-details .profile_name,
.sidebar .profile-details .job {
    color: #000;
    font-size: 18px;
    font-weight: 500;
    white-space: nowrap;
}

.sidebar.close .profile-details .profile_name,
.sidebar.close .profile-details .job,
.sidebar.close .profile-details span {
    display: none;
}

.sidebar .profile-details .logout {
    font-size: 20px;
    color: black;
    font-weight: 900;
}

.sidebar .profile-details .job {
    font-size: 12px;
}

.home-section {
    position: relative;
    background: #e4e9fe;
    left: 260px;
    width: calc(100% - 260px);
    height: 100vh;
    transition: all 0.3s ease;
}

.home-section .home-content {
    height: 60px;
    display: flex;
    align-items: center;
}

.home-section .home-content .menu,
.home-section .home-content .text {
    color: #000;
    font-size: 35px;
}

.home-section .home-content .menu {
    margin: 0 15px;
    cursor: pointer;
}

.home-section .home-content .text {
    font-size: 26px;
    font-weight: 600;
}

</style>
