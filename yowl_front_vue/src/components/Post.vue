<template>
    <div class="card">
        <div class="card-body">
            <div class="card-head">
                <img v-bind:src="post.author_profile_pic_url" class="card-img-hi" alt="">
                <h5 class="card-user">@{{post.author_username}}</h5>
                <button class="btn custom2" type="submit">#{{post.category}}</button>
            </div>
                <p class="card-text">{{post.description}}</p>
            </div>
            <img v-bind:src="post.image_url" class="card-img-bot" alt="">
            <div class="comments">
                <img src="../assets/Images/comments-front.png" class="comments-img" alt="">
                <p>Comments: {{postComments.length}}</p>
            </div> 
    </div>
</template>

<script>

export default{
    props: ["post"], 

    data()
    {
        return{
            postComments: [], 

        }
    }, 

    methods:
    {
        async getPostComments()
        {
            const response = await fetch("http://localhost:8000/api/posts/" + this.post.id + "/comments/")
                .then((response) => response.json());
            this.postComments = response;
        }
    },

    async mounted()
    {
        
        await this.getPostComments();
    }
    
}
</script>

<style>


</style>