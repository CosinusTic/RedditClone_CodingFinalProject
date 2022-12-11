<template>

    <nav class="navbar navbar-expand-lg" style="background-color: #a6a6a6">
        <a class="navbar-brand0" href="#">
            <img src="../assets/Images/logo_front.PNG" alt="" width="45" height="40">
        </a>
        <a class="navbar-brand" href="#">Rebbit</a>

         
            <button class="btn custom1" type="submit">Profile</button>
            <button class="btn custom1" type="submit">Log out</button>
        
    </nav>

   

        <div class="middleside57">

            <div class="card6">
                <div class="card-body">
                    <div class="card-head9">
                        <img v-bind:src="author.profile_pic_url" class="card-img-hi" alt="">
                        <h5 class="card-user">@{{author.username}}</h5>
                        <button class="btn custom2" type="submit">#{{postCategory}}</button>
                    </div>
                    <p class="card-text">{{thisPost.description}}</p>
                </div>
                <img v-bind:src="thisPost.image_url" class="card-img-bot" alt="">
                <div class="comments">
                    <img src="../assets/Images/comments-front.png" class="comments-img" alt="">
                    <p class="comments-text">Comments: {{postComments.length}}</p>
                </div>
            </div>
            <div class="commentgroup" v-for="comment in postComments">
                <Comment :comment="comment"/>
                <div class="croix" v-if="(comment.author_id == userId)">
                    <button class="croixred" v-on:click="testDelete(comment.id);">X</button>
                </div>
            </div>
            <div class="input-group input-group-sm mb-3">
                <input type="text" class="comment-input" placeholder=" Leave a comment ..." aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" v-model="content">
                <button class="btn custom99" type="submit" v-on:click="postComment();">Post</button>
                <p>{{content}}</p>
            </div>
                
        </div>
    
   
</template>

<script>
import Comment from "../components/Comment.vue";
export default{
    components: {
        Comment
    },
    data()
    {
        return{
            thisPost: [], 
            authorId: [],
            author: [], 
            postComments: [], 
            postCategory: [], 
            postId: this.$router.currentRoute.value.params["id"], 
            userId: this.$router.currentRoute.value.params["userId"], 
            content: ""
        }
    }, 
    methods: 
    {
        async computeThisPost()
        {
            const response = await fetch("http://localhost:8000/api/posts/" + this.postId)
                .then(response => response.json());
            this.thisPost = response;
        }, 
        async computeAuthorIdFromPost()
        {
            const response = await fetch("http://localhost:8000/api/GetPostAuthor/" + this.thisPost.id)
                .then(response => response.json());
            this.authorId = response[0].id;
        }, 
        async computeAuthor()
        {
            const response = await fetch("http://localhost:8000/api/users/" + this.$router.currentRoute.value.params["userId"])
                .then(response => response.json());
            this.author = response;
        }, 
        async ComputePostComments()
        {
            const response = await fetch("http://localhost:8000/api/posts/" + this.thisPost.id + "/comments/")
                .then(response => response.json());
            this.postComments = response;
        }, 
        async computePostCategory()
        {
            const response = await fetch("http://localhost:8000/api/categories/" + this.thisPost.category_id)
                .then(response => response.json());
            this.postCategory = response.title;
        }, 
        async postComment()
        {
            const requestOptions = {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ 
                post_id: this.postId, 
                content: this.content,
                author_id: this.userId
            })
            };
          await fetch("http://localhost:8000/api/post/" + this.postId + "/addComment/" + this.userId, requestOptions)
            .then((response) => console.log(response));
            this.$toast.show("Comment added!");
        }, 
        async testDelete(id)
        {
            console.log(id);
            // comments/{id}/deleteAdmin
            const requestOptions = {
            method: "DELETE",
            headers: { "Content-Type": "application/json" }
            };
          await fetch("http://localhost:8000/api/comments/" + id + "/deleteAdmin", requestOptions)
            .then((response) => console.log(response));
            this.$toast.show("Deletion successful!");
        }
    }, 
    async mounted()
    {
        await this.computeThisPost();
        await this.computeAuthorIdFromPost();
        await this.computeAuthor();
        await this.ComputePostComments();
        await this.computePostCategory();
        console.log(this.author);
        console.log(this.$router.currentRoute.value.params["userId"]);
    }
}
</script>
<style>
* {
    padding: 0;
}
.custom5:hover {
    background-color: #ffee00;
    opacity: 80%;
}

.btn.custom99 {
  
    margin-left: 2%;
    background-color: #ffee00;
    border-radius: 20%!important;
    width: 4%;
    height:100%;
}
.input-group{
    height:70%!important;
}
.comment-input {
    width: 90%;
    border-radius: 0.5em;
    border-color: #ffff;
    margin-top: 1%;
    margin:0!important;
height:100%!important;

}

.commentgroup {
    display: flex;
justify-content: center;

    border-radius: 1em;
    width:65%;
    height:30%;
    margin-top: 2%;
}

.comment-head {
    display: flex;
    margin-left:3%;
    
}
.croix{
    margin-top: 2%;
width:2%;
}
.croixred{
background-color: red;
    border-radius: 45%;
    width: 100%;
}
.commentbox {
    display: flex;
    margin-top: 2%;
    flex-direction: column;
    background-color: #ffffff;
    border-radius: 1em;
    width: 50%;
    height: 100%;
}

.comment-img {
    width: 2em;
    height: 2em;
    margin-right: 1em;
    border-radius: 5em;
}

.category-img {
    width: 10%;
    height: 10%;
    padding: 1.2%;
    border-radius: 30%;
}
.input-group{
    display: flex;
    flex-direction: row;
    justify-content: center;
margin-top:3%;

height:20%;
}
.comment-input{
width:30%;
height:50%;
margin-right:2%;
}
.leftside {
    display: flex;
    margin-top: 3%;
    width: 20vh;
    height: 10vh;
    margin-right: 20%;

}

.middleside57 {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: start;
    width: 100%;
    height: 100%;
    border-radius: 1em;
}

.rightside {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    align-content: center;
    width: 20vh;
    height: 10vh;
    margin-top: 5%;
}

.custom2:hover {
    background-color: #a6a6a6;
    opacity: 80%;
}

.custom2 {
    background-color: #a6a6a6;
    margin-left: 16em;
    border-radius: 1em;
    width: 6em;
    height: 2em;
    padding: 0;
}

.comments {
    display: flex;
}
.comments-text{
    margin:0!important;
}
.comments-img {
    width: 1.5em;
    height: 1.5em;
}

.header {
    display: flex;
    margin-top: 5%;
}

.card-head9 {
    display: flex;
    margin-bottom: 0.8em;
    margin-top:3%;
}

.cardgroup {
    display: flex;
    justify-content: center;
    align-items: center;
}

.card6 {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: start;
    margin-top:5%;
    width: 30%;
    height: 50%;
    border-radius: 1em;
    background-color: #ffffff;


}

.card-img-hi {
    width: 2em;
    height: 2em;
    margin-right: 1em;
    border-radius: 5em;
}

.card-img-bot {
    width: 60%;
    height: 60%;
    margin-bottom: 1em;
    border-radius: 1em;
}

.custom1 {
    background-color: #ffee00;
    margin-right: 2em;
    border-radius: 1em;
    width: 5.5em;
}

.navbar-brand0 {
    margin-left: 1em;
}

.navbar-brand {
    margin-right: 70%!important;
}

.list-group {
    border-radius: 1em;
    margin-left: 7em;
    width: 20em;
}

.form-control {
    border-radius: 1em;
    width: 40em;
}

.me-2 {
    margin-right: 8em !important;
}

.custom1:hover {
    background-color: #ffee00;
    opacity: 80%;
}

.list-group-item:hover {
    color: black;
    text-decoration: underline;
}

.list-group-item {
    margin: 0;
    background-color: rgb(255, 255, 255);
    --bs-list-group-active-bg: #ffee00;
    --bs-list-group-active-border-color: #ffee00;
    --bs-list-group-active-color:
}

.col-4 {
    padding: 0;
    margin: 0;

}

body {
    display: grid;
    grid-template-columns: (1,100%);
    padding: 0;
    margin:0;
    flex-direction: row;
    background-color: lightgray;
    justify-content: center;
    align-items: center;
    align-content: center;
}

.profile-img {
    width: 5em;
    height: 3em;
    border-radius: 5em;
}

.nav {
    display: flex;
    width: 100%;
    justify-content: flex-start;
    text-align: center;
    align-items: flex-start;
    margin: 0;
    padding: 10px;
}
</style>