<template>

    <nav class="navbar navbar-expand-lg1" style="background-color: #a6a6a6">
        <a class="navbar-brand0" href="#">
            <img src="../assets/Images/logo_front.PNG" alt="" width="45" height="40">
        </a>
        <a class="rabbit2" href="#">Rebbit</a>
        <p class="hello">Hello {{connectedUser.username}}</p>

        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" v-model="search"/>

    <button class="btn btn-secondary" v-on:click="searchPost();" type="submit">Search</button>

        <button class="btn custom1" type="submit" v-on:click="logOut();">Log Out</button>
        <button class="btn custom1" type="submit" v-on:click="redirectProfile();">Profile</button>
        <img src="../assets/Images/logo_front.PNG" class="profile-img">


    </nav>

    <div class="all">
        <div class="leftside">
            <div class="col-7">
                <div class="list-group" id="list-tab" role="tablist">
                    <h3 class="list-group-item not-underligned">Categories</h3>
                    <div class="categories" v-for="category in categories">
                      <a v-on:click="filterByCategory(category)"><Category :category="category"/></a>
                  </div>
                  <a v-on:click="redirectAddCategory();"><h3 class="list-group not-underligned"> + </h3></a>
                </div>
            </div>
        </div>
        <div class="middleside">
            <div class="posts" v-for="post in posts">
                <Post :post="post"/>
                <button class="comments-text1" v-on:click="redirectComments(post.id);"> Add comment</button>
            </div>
        </div>

        <div class="rightside">
            <div class="addpost">
                <button class="btn custom92" type="submit"><img src="../assets/Images/icon-add.png" class="add-img" alt="" v-on:click="redirectAddPost();">Post</button>
                <button class="btn custom4" type="submit" v-on:click="redirectAdmin();" v-if="(connectedUser.admin_status == 1)">Admin</button>
            </div>
        </div>
      </div>
</template>


<script>
import Post from "../components/Post.vue";
import Category from "../components/Category.vue";

export default{
  components: {
    Post, 
    Category
  }, 
  
  data(){
    return{
      users: [],
      connectedUser: [],
      comments: [],
      posts: [],
      categories: [], 
      postAuthors: [], 
      postCategories: [],
      AuthorIds: [], 
      CategoryIds: [],
      Comments: [],
      search: ""
    }
  }, 

  methods:{
    async GetAllAuthorIdsOfPosts()
    {
      const response = await fetch("http://localhost:8000/api/GetPostsAuthors")
        .then((response) => response.json());
      this.AuthorIds = response;
    }, 
    async getAllCategoryIdsOfPosts()
    {
      const response = await fetch("http://localhost:8000/api/GetPostCategories")
        .then((response) => response.json());
      this.CategoryIds = response;
    },
    async MatchAuthorIdWithUserTable() // match author id from posts table with actual data from other tables
    {
      for(let i = 0; i < this.AuthorIds.length; i++) //fetching all user ids
      {
        await this.computePostAuthor(this.AuthorIds[i].author_id);
      }

      for(let i = 0; i < this.postAuthors.length; i++) // syncing with all usernames
      {
        this.posts[i]["author_username"] = (this.postAuthors[i].username);
      }
      for(let i = 0; i < this.postAuthors.length; i++) // syncing with all user profile pics
      {
        this.posts[i]["author_profile_pic_url"] = (this.postAuthors[i].profile_pic_url);
      }
    },
    async MatchCategoryIdWithCategoriesTable()
    {
      //Handling categories
      for(let i = 0; i < this.CategoryIds.length; i++)
      {
        await this.computePostCategories(this.CategoryIds[i].category_id);
      }

      for(let i = 0; i < this.postCategories.length; i++) // syncing with all usernames
      {
        this.posts[i]["category"] = (this.postCategories[i].title);
      }
    },
    async computeUsers()
    {
      const response = await fetch("http://localhost:8000/api/users")
          .then((response) => response.json())
      this.users = response;
    }, 
    async computePosts()
    {
      const response = await fetch("http://localhost:8000/api/posts")
        .then((response) => response.json());
      this.posts = response;
    }, 
    async computeCategories()
    {
      const response = await fetch("http://localhost:8000/api/categories")
        .then((response) => response.json());
      this.categories = response;
    }, 
    async computePostAuthor(post_author_id)
    {
      const response = await fetch("http://localhost:8000/api/users/" + post_author_id)
        .then((response) => response.json());
      this.postAuthors.push(response);
    }, 
    async computePostCategories(post_category_id)
    {
      const response = await fetch("http://localhost:8000/api/categories/" + post_category_id)
        .then((response) => response.json());
      this.postCategories.push(response);
    },
    async getConnectedUser()
    {
      const userId = this.$router.currentRoute.value.params["id"];
      const response = await fetch("http://localhost:8000/api/users/" + userId)
        .then((response) => response.json());
      this.connectedUser = response; 
    }, 
    logOut()
    {
      this.$router.push("/");
      this.$toast.show("Bye!");
    }, 
    redirectAddPost()
    {
      const connectedUserId = this.$router.currentRoute.value.params["id"];
      this.$router.push("/addPost/" + connectedUserId);
    }, 
    redirectAdmin()
    {
      if(this.connectedUser.admin_status == "1")
      {
        this.$router.push("/admin/" + this.connectedUser.id);
      }
      else
      {
        alert(this.connectedUser.username + " is not connected with admin rights, this page is not accessible");
      }
    }, 
    redirectProfile()
    {
      const userInput = prompt("please enter the password for " + this.connectedUser.username + " to access your profile");
      if(userInput == this.connectedUser.password)
      {
        this.$router.push("/profile/" + this.connectedUser.id);
      }
      else
      {
        alert("wrong password");
      }
     }, 
     redirectAddCategory()
     {
      this.$router.push("/AddCategory/" + this.connectedUser.id);
     }, 
     async searchPost()
     {
      console.log(this.search);
      const response = await fetch("http://localhost:8000/api/posts/search/" + this.search)
        .then(response=>response.json());
      this.posts = response;
     }, 
     redirectComments(id)
    {
        const connectedUserId = this.$router.currentRoute.value.params["id"];
        this.$router.push("/posts/" + id + "/comments/" + connectedUserId);
    }, 
    async filterByCategory(category)
    {
      const response = await fetch("http://localhost:8000/api/FilterByCategoryTitle/" + category.title)
        .then(response => response.json());
        this.posts = response;
    }
  },

  async mounted()
  {
    await this.getConnectedUser();
    await this.GetAllAuthorIdsOfPosts();
    await this.getAllCategoryIdsOfPosts();
    this.MatchAuthorIdWithUserTable();
    this.MatchCategoryIdWithCategoriesTable();
    await this.computeUsers();
    await this.computePosts();
    await this.computeCategories();
    console.log("connected with",this.connectedUser);
    this.posts.filter(element => element.author_id != null && element.author_id); //delete posts that do not have authors (handle case when users get deleted) 
  }
}

</script>
  
<style>
.comments-text1{
margin-left: 28%;
margin-bottom:5%;
}

.hello{
  width:10%;
  margin-right: 15%;
}
* {
    padding: 0;
}
.category-img{
    width: 10%;
    height:10%;
    padding:1.2%;
    border-radius:30%;
}
.leftside {
    display: grid;
    
    margin-top: 7%;
    width: 10vw;
    height: 100vh;
    margin-right: 15%;
    margin-left: 3%;

}
.all{
display: flex;
}

.card{
  width:100%!important;
}
.posts{
width:30vw;
}
.btn-secondary{
  margin-right: 5%;
}
.middleside {
display:grid;
grid-template-columns: (1,90%);
    justify-content: center;
    align-items: center;
    text-align: start;
    width: 50%;
    height: 100%;
    border-radius: 1em;
    margin-top: 7%;

}

.rightside {
    display: flex;
    flex-direction: column;
    width: 10vw;
    height: 100vh;
    
}

.add-img {
    width: 40%;
    height: 80%;
    margin-right: 5%;
}

.custom92{
    padding: 0;
    background-color: #a6a6a6;
    border-radius: 1em;
    width: 6em;
    height: 3em;
    align-items: center;
    justify-content: center;
    text-align: center;
    margin-bottom:30%;
    box-shadow:1px 1px 2px 1px;
    
}

.custom4 {
    padding: 0;
    background-color: #a6a6a6;
    border-radius: 1em;
    width: 6em;
    height: 3em;
    align-items: center;
    justify-content: center;
    text-align: center;
    box-shadow:1px 1px 2px 1px;
}

.profile-img {
    width: 4em;
    height: 3em;
    border-radius: 5em;
}

.custom2 {
    background-color: #a6a6a6;
    margin-left: 16em;
    border-radius: 1em;
    width: 6em;
    height: 2em;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 0;
    
}

.custom2:hover {
    background-color: #a6a6a6;
    opacity: 80%;
}

.comments {
    display: flex;
}

.comments-img {
    width: 1.5em;
    height: 1.5em;
}



.card-head {
    display: flex;
    margin-bottom: 0.8em;
}


.card-img-hi {
    width: 2em;
    height: 2em;
    margin-right: 1em;
    border-radius: 5em;
}

.card-img-bot {
    width: 50%;

    margin-bottom: 1em;
    border-radius: 1em;
}

.custom1 {
    background-color: #ffee00;
    margin-right: 2em;
    border-radius: 1em;
    width: 5.5em;
    box-shadow:1px 1px 2px 1px;
}

.navbar-brand0 {
    margin-left: 1em;
}

.rabbit2{
    margin-right: 1%;
    color: black;
    text-decoration: none;
}
.col-7{
  width:200%;
}
.list-group {
   
    border-bottom-left-radius: 1em;
    margin-left: 5em;
    background-color: #ffff;
  border-radius:1em!important;
 text-align: center;
  margin-left:10%;
  width:80%!important;
  
}


.form-control{
    border-radius: 1em;
    width: 35%;
    margin-right:0!important;
}

.custom1:hover {
    background-color: #ffee00;
    opacity: 80%;
}
.not-underligned:hover{
    text-decoration: none;
}
.list-group-item {
    margin:0;
    background-color: rgb(255, 255, 255);
    --bs-list-group-active-bg: #ffee00;
    --bs-list-group-active-border-color: #ffee00;
    --bs-list-group-active-color:
    display:grid;
    grid-template-columns: repeat(1, 90%);
}
.list-group-item1 {
    margin:0;
    background-color: rgb(255, 255, 255);
    --bs-list-group-active-bg: #ffee00;
    --bs-list-group-active-border-color: #ffee00;
    --bs-list-group-active-color:
}
.col-4 {
    padding: 0;
    margin: 0;
    width: 100%;
    height: 100%;
    margin-left:5%;
}

.navbar {
    display: flex;
    width: 100%;
    
    text-align: center;
   
}
@media screen and (max-width: 550px) {
 .all{
  display: grid;
  grid-template-columns:(1,90%);
 margin-right:0!important;
  width:90%;
 }
.col-7{
  width:100%;
}
.rightside{
  width:80%;
  height: 100%;
}
.leftside{
  width:100%;
  height:30%;
  margin-left:5%;
}
.middleside{
  width:80vw!important;
}
.navbar-expand-lg1{
width:95%;
margin-right:0;
}
.posts{
  width:80vw!important;
}
.card{
  width:100%;
}
.rabbit1{
  margin-right:0%;
}
.custom1{
  margin-left:1%;
  margin-right: 1%;
}
.hello{
margin-right:0%;
}
.list-group{
  margin:0;
}
}
</style>