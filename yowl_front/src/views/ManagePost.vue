<template>
    <nav class="navbar navbar-expand-lg" style="background-color: #a6a6a6">
        <a class="navbar-brand0" href="#">
            <img src="../assets/Images/logo_front.PNG" alt="" width="45" height="40">
        </a>
        <a class="rabbit3" href="#">Rabbit</a>

      


    </nav>

    <body>
        <div class="header">
            <div class="text">
                <h3>Welcome Admin</h3>
                <p> Website Posts</p>
            </div>
        </div>
        <div class="title1">
                <p class="id">Post ID</p><p class="author">Author</p><p class="content">Content</p>
            </div>
        <div class="footer" >
            <div class="Post" v-for="post in posts">
                <button class="btn custom47" type="submit" :post="post">Id:{{post.id}}</button>   
                <button class="btn custom48" type="submit">@{{post.author_id}}</button>
                <button class="btn custom49" type="submit">{{post.description}}</button> 
                <button class="btn custom7" type="submit" v-on:click="deletePost(post.id);"><img src="../assets/Images/trash-icon.png" class="add-img2" alt=""></button>
            </div>    
        </div>
            
    </body>
</template>

<script>
export default{
    data()
    {
        return{
            posts: [], 
            users: []
        }
    }, 
    methods:
    {
        async computePosts()
        {
            const response = await fetch("http://localhost:8000/api/posts")
                .then((response) => response.json());
            this.posts = response;
        }, 
        async computeUsers()
        {
            const response = await fetch("http://localhost:8000/api/users")
                .then((response) => response.json());
            this.users = response;
        }, 
        async deletePost(id)
        {
            const confirmation = confirm("Are you sure?");
            const requestOptions = {
                method: "DELETE",
                headers: { "Content-Type": "application/json" }
                };
            if(confirmation)
            {
                await fetch("http://localhost:8000/api/posts/delete/" + id, requestOptions)
            }
            this.$toast.show("Deletion successful!");
        }
    }, 
    async mounted()
    {
        await this.computePosts();
        await this.computeUsers();
        console.log(this.posts);
        console.log(this.users);

    }
}
</script>

<style>
.d-flex{
    width:30%;
}
.form-control{
    width:100%;
}
* {
    padding: 0;
    margin: 0;

}
.id{
margin-left:5%;
height:5%;
}

.author{
margin-left:7%;
height:5%;
}

.content{
    margin-left:7%;
    height:15%;
}

.Post{
    display: flex;
    height:100%;
    width:100%;
    align-items: center;
    margin-bottom: 5%;
}
.title1{
    display: flex;
    flex-direction: row;
    height:20%;
  margin-left: 2%;
}
.custom47 {
    padding: 0;
    background-color: #ffffff;
    border-radius: 1em;
    width:5%;
    height:50%;
    margin-bottom:0!important;
    margin-left:5%!important;
}
.custom48 {
    padding: 0;
    
    background-color: #ffffff;
    border-radius: 1em;
    width:5%;
    height:50%;
    margin-left:5%!important;
    margin-bottom:0!important;
}
.custom49 {
    text-align:start;
    
    padding: 0;
    background-color: #ffffff;
    border-radius: 1em;
    width:60%;
    height:80% ;
    margin-left:5%;
    margin-bottom:0!important;
}
.custom7{
    height:90%;
}
.add-img2{
    width:3em;
    height: 3em;
border-radius:1.4em;
}
.footer{
    display: grid;
    grid-template-columns: repeat(1, 95%);
    width:100%;
    height: 100%;
    margin: 0!important;
}
.text{
    width: 100%;
    margin-top: 3%;
}
.header {
    display: flex;
    width: 100vw;
    height: 30vh;
    margin: 0 !important;
    text-align:center ;
}

body {
    display: grid;
    grid-template-columns: repeat(1,100%);
    padding: 0;
    flex-direction: row;
    background-color: #d9d9d9;
    width: 100vw;
    height:100vh;
    margin-right:0!important;
}

.navbar-expand-lg {
    margin: 0!important;
    width: 100%;
}

.navbar-brand0 {
    margin-left: 3%;
}
.rabbit3{
  color: black;
  text-decoration: none;
  margin-right:25%!important;
}

nav {
    display: flex;
    justify-content: flex-start;
    text-align: center;
    align-items: flex-start;
    margin: 0;

}
</style>