<template>
    <div class="widgets">
        <SearchBar />
        <div class="widgets--container">
            <h2>What's happening?</h2>
            <blockquote class="twitter-tweet">
                <p lang="en" dir="ltr">Sunsets don&#39;t get much better than this one over <a
                    href="https://twitter.com/GrandTetonNPS?ref_src=twsrc%5Etfw">@GrandTetonNPS</a>. <a
                    href="https://twitter.com/hashtag/nature?src=hash&amp;ref_src=twsrc%5Etfw">#nature</a> <a
                    href="https://twitter.com/hashtag/sunset?src=hash&amp;ref_src=twsrc%5Etfw">#sunset</a> <a
                    href="http://t.co/YuKy2rcjyU">pic.twitter.com/YuKy2rcjyU</a></p>&mdash; US Department of the Interior
                (@Interior) <a href="https://twitter.com/Interior/status/463440424141459456?ref_src=twsrc%5Etfw">May 5, 2014</a>
            </blockquote>
        </div>
    </div>
</template>

<script>
import SearchBar from "../Shared/SearchBar";
export default {
    name: "Widget",
    components: {SearchBar}
}
</script>

<style scoped lang="scss">
$twitter-color: #50b7f5;
$twitter-background: #e6ecf0;

.widgets {
    flex: 0.2;
    margin-left: 20px;
    &--container {
        margin-top: 15px;
        padding: 20px;
        background-color: #f5f8fa;
        border-radius: 20px;
        h2 {
            font-size: 18px;
            font-weight: 800;
        }
    }
}
@media (max-width: 1000px) {
    .widgets {
        display: none;
    }
}
</style>
