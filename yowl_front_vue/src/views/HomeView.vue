<template>

  <nav class="navbar navbar-expand-lg" style="background-color: #a6a6a6">
      <a class="navbar-brand0" href="#">
          <img src="../assets/Images/logo_front.PNG" alt="" width="45" height="40">
      </a>
      <a class="rabbit1" href="#">Rebbit</a>

          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" v-model="search"/>
          <button class="btn btn-secondary" v-on:click="searchPost();" type="submit">Search</button>
          <button class="btn custom1" v-on:click="redirectLogin();">Log in</button>
          <button class="btn custom1" v-on:click="redirectRegister();">Register</button>


  </nav>

 <div class="all1">
  <div class="leftside17">
          <div class="col-6">
              <div class="list-group1" id="list-tab" role="tablist">
                  <h3 class="list-group-item not-underligned">Categories</h3>
                  <div class="categories" v-for="category in categories">
                    <a v-on:click="filterByCategory(category)"><Category :category="category"/></a>
                  </div>
                  <a v-on:click="redirectAddCategories();"><h3 class="list-group not-underligned"> + </h3></a>
              </div>
          </div>
      </div>
      <div class="middleside">
        <div class="posts" v-for="post in posts">
          
          <Post :post="post"/>
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
    redirectLogin()
    {
      this.$router.push("/login");
    }, 
    redirectRegister()
    {
      this.$router.push("/register");
    }, 
    redirectAddCategories()
    {
      const prompt = confirm("You need to sign in to access user comments, do you want to redirect to login page?");
      if(prompt)
      {
        this.$router.push("/login");
      }
    }, 
    async searchPost()
     {
      console.log(this.search);
      const response = await fetch("http://localhost:8000/api/posts/search/" + this.search)
        .then(response=>response.json());
      this.posts = response;
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
    await this.GetAllAuthorIdsOfPosts();
    await this.getAllCategoryIdsOfPosts();
    this.MatchAuthorIdWithUserTable();
    this.MatchCategoryIdWithCategoriesTable();
    await this.computeUsers();
    await this.computePosts();
    await this.computeCategories();
    console.log(this.posts);
  }
}

</script>


<style>
*{
  padding:0;

}
.col-6{
  width:100%;
}
.all1{
display: flex;
}
.category-img{
    width: 10%;
    height:10%;
    padding:1.2%;
    border-radius:30%;
}
.leftside17 {
    display: flex;
    margin-top: 10%;
    margin-right: 10%;
    margin-left:10%;
    width: 15%;
    height: 100%;
    
}

.middleside {
    display: grid;
    grid-template-columns: repeat(1, 90%);
    justify-content: center;
    align-items: center;
    text-align: start;
    width: 50%;
    height: 100%;
    border-radius: 1em;
    margin-top: 3%;
    margin-left:0%!important;

}


.rightside {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    align-content: center;
    width: 20%;
    height: 10%;
    margin-top: 5%;
}
.custom2:hover {
    background-color: #a6a6a6;
    opacity: 80%;
}
.custom2{
background-color: #a6a6a6;
margin-left: 45%!important;
border-radius:1em;
width:6%;
height: 2%;
padding: 0;

}
.comments{
  display: flex;
}
.comments-img{
  width:1.5%;
  height: 1.5%;
}
.header{
display: flex;
margin-top:4%;
}
.card-body{
width:90%;
height:30%;
}
.card-head{
  display: flex;
  margin-bottom: 0.8%;
}
.cardgroup{
  display: flex;
  justify-content: center;
  align-items: center;
}
.card{
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: start;
  width: 70%!important;
  height: 30%!important;
  border-radius: 1em;
  margin-bottom:5%!important;
  margin:0;
  box-shadow: 2px 2px 6px 2px;
}
.card-img-hi{
  width: 2%;
  height: 2%;
  margin-right: 1%;
  border-radius:5em;
}
.card-img-bot{
  width: 80%;
  height: 80%;
  margin-bottom: 1%;
  border-radius:1em;
}
.custom1{
background-color: #ffee00;
margin-right: 2%;
border-radius:1em;
width:5.5%;
}
.navbar-brand0{
 margin-left:1%;
}
.btn-secondary{
  margin-right: 5%;
}
.rabbit1{
  color: black;
  text-decoration: none;
  margin-right:25%;
}
.list-group1{
  background-color: #ffff;
  border-radius:1em!important;
 text-align: center;
  width:100%!important;
}

.form-control{
  border-radius:1em;
  width: 60%;

}
.me-2{
  margin-right:8em!important;
}
.custom1:hover{
  background-color: #ffee00;
  opacity: 80%;
}

.list-group-item:hover{
color: black;
text-decoration: underline;
}

.list-group-item{
  text-align: center;
  margin:0;
  background-color: rgb(255, 255, 255);
  --bs-list-group-active-bg: #ffee00;
    --bs-list-group-active-border-color: #ffee00;
    --bs-list-group-active-color:
}
body {
    display: flex;
    padding: 0;
    flex-direction: row;
    background-color: lightgray;
    justify-content: start;
    width: 100vw;
}

.profile-img {
  width: 5%;
  height: 3%;
  border-radius: 5em;
}
.nav{
  display: flex;
  width: 100%!important;
  justify-content: flex-start;
  text-align: center;
  align-items: flex-start;
  margin:0;
  padding:10%;
}
@media screen and (max-width: 550px) {
 .all1{
  display: grid;
  grid-template-columns:(1,90%);
  justify-content: center;
  width:100%;
 }
.col-6{
  width:100%;
}
.leftside17{
  width:100%;
  margin-left:0%;
}
.middleside{
  width:80vw!important;
}
.navbar-expand-lg{
width:100%;
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
  margin-left:15%;
}
}
</style>  