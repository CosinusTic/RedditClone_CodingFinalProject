<template>
    <div class="commentbox">
        <div class="comment-body">
            <div class="comment-head">
                <img v-bind:src="author.profile_pic_url" class="comment-img" alt="">
                <h5 class="comment-user">@{{author.username}}</h5>
            </div>
            <p class="card-text">{{comment.content}}</p>
        </div>
            
    </div>
</template>

<script>
export default{
    props: ["comment"],

    data()
    {
        return{
            authorId: "",
            author: ""
        }
    }, 
    methods: 
    {
        async computeCommentAuthorId()
        {
            const response = await fetch("http://localhost:8000/api/comments/" + this.comment.id)
                .then(response => response.json());
            this.authorId = response.author_id;
        }, 
        async computeCommentAuthor()
        {
            const response = await fetch("http://localhost:8000/api/users/" + this.authorId)
                .then(response => response.json());
            this.author = response;
        }
    }, 
    async mounted()
    {
        await this.computeCommentAuthorId();
        await this.computeCommentAuthor();
    }

}

</script>