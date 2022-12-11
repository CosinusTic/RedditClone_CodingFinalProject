<template>
    <a v-on:click="" class="list-group-item" id="list-home-list" data-bs-toggle="list" href="#list-home" role="tab" aria-controls="list-home">
        <img class="category_img" v-bind:src="category.logo_url"/>
        {{category.title}} </a>
</template>


<script>

export default{
    props: ["category", "url"],
}
</script>

<style>
.category_img{
    width: 30px;
    height: 30px;
}
</style>