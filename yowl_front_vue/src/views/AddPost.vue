<template>
  <nav class="navbar navbar-expand-lg" style="background-color: #a6a6a6">
      <a class="navbar-brand0" href="#">
        <img src="../assets/Images/logo_front.PNG" alt="" width="45" height="40">
      </a>
      <a class="navbar-brand" href="#">Rebbit</a>
  
    </nav>
 <body>
   <div class="form">
     <div class="head">
       <b>YOUR POST</b>
       <h3> Please enter the informations of your post</h3>
     </div>
     <div class="centre">
       <div>
         <p class="category">Category</p>
         <!-- <input type="text" class="btn btn-outline-primary" placeholder="category" v-model="category"/> -->
        
         <select id="category" name="category" v-model="category"  v-on:change="getCategoryFromInput(category)">
             <option v-for="categoryToken in categories" v-bind:value="categoryToken.title" >{{categoryToken.title}}</option>
         </select>
         <!-- <div v-for="category in categories">
           <p>{{category.title}}</p>
           <input type="radio" v-bind:value="category.title"/>
         </div> -->
       </div>
       <div>
         <p class="media">Media</p>
         <input type="url" class="btn btn-outline-primary" placeholder="photo url" v-model="photo_url"/>
       </div>
         <p class="description">Description</p>
         <input type="text" class="btn " placeholder="Enter your text here" v-model="description"/>
       </div>
     <div class="centre">
       <button v-on:click="AddPost();" class="btn btn-outline-primary btn-Addpost">
        <strong>POST</strong> 
       </button>
     </div>
     
   </div>
 </body>
 </template>
 
<script>
export default{
data()
{
 return{
   description: "",
   photo_url: "",
   category: "", 
   categoryMatched: "", 
   categoryIdToAdd: "",
   categories: "", 
   categoryIds:""
 }
}, 
methods: 
{
 async getAllCategories()
 {
   const response = await fetch("http://localhost:8000/api/categories")
     .then((response) => response.json());
   this.categories = response;
 },
 async getAllCategoryIdsOfPosts()
 {
   const response = await fetch("http://localhost:8000/api/GetPostCategories")
     .then((response) => response.json());
   this.CategoryIds = response;
 },
 async testAdd()
 {
   const authorId = this.$router.currentRoute.value.params["id"];

   console.log("author_id: ", authorId);
   console.log("description:", this.description);
   console.log("image URL", this.photo_url);
   console.log("category_id: ", await this.categoryMatched.id);
 },
 async AddPost()
 {
   const authorId = this.$router.currentRoute.value.params["id"];

   const requestOptions = {
   method: "POST",
   headers: { "Content-Type": "application/json" },
   body: JSON.stringify({ 
       author_id: authorId, 
       description: this.description,
       image_url: this.photo_url,
       category_id: await this.categoryMatched.id
     })
   };
   
   await fetch("http://localhost:8000/api/CreatePost", requestOptions)
     .then((response) => console.log(response));
     this.$toast.show("Posted!");
 }, 
 async getCategoryFromInput(input)
 {
   const response = await fetch("http://localhost:8000/api/categoryFromTitle/" + input)
     .then((response) => response.json());
       
   for(let i = 0; i < this.categories.length; i++)
   {
     if(response[i])
     {
       this.categoryMatched = response[i];
     }
   }

   console.log(this.categoryMatched.id);
 }, 
 
     
}, 
async mounted()
{
 await this.getAllCategories();
 await this.getAllCategoryIdsOfPosts();
}
}
</script>
 
<style scoped>
.category{
text-align: left;
margin:0;
}

select{
 width:100%;
 border-radius: 1em;;
 text-align: left;
 height: 35px;
}
.media{
 text-align: left;
 margin:0;
}
.description{
 text-align: left;
 margin:0;
}

body {
 display: flex;
 padding: 0;
 flex-direction: row;
 background-color: #d9d9d9;
 justify-content: center;
 width: 100vw;
 height: 90vh;

}
 
 .container-fluid{
 padding: 0px;
 width: 100%;
 height: 50%;
 background-color: #a6a6a6;
 }
 
 .centre {
   text-align: center;
   padding: 10%;
 }
 form div + div {
   margin-top: 1%;
 }
 .head {
   text-align: center;
  margin-top:10%;
  margin-bottom: 5%;
 }
 b {
   font-family: public Sans;
   font-size: 30px;
 }
 h3 {
   color: black;
   font-weight: 100;
   font-family: public Sans;
   font-size: 17px;}
   h3 {
   color: black;
   font-weight: 100;
   font-family: public Sans;
   font-size: 17px;
 
 }
 input,
 textarea {
   font: 1em open sans;
   border-radius: 1em;
   width: 100%;
   height: 10%;
   border: none;
   background-color: #f2f3f7;
   margin: 0 auto;
   
   font-family: Open Sans;
   
 }

 .btn-outline-third {
   font: open sans;
   border-radius: 1em;
   width: 100%;
   height: 10%;
   border: none;
   background-color: #f2f3f7;
   margin: 0 auto;
   font-family: Open Sans;
   
 text-align: start;
 }

 

 input:hover {
   border-color: #f5d505;
   background-color: #a6a6a6;
 }
 .forgotdiv {
   text-align: right;
   padding-right: 50px;
 }
 button {
   margin-left: 0.5em;
   background-color: #ffee00;
   width: 70%;
   margin: 0 auto;
   height: 60px;
   border-radius: 1em;
   border: none;
   font-family: Open Sans;
 }
 .btn-login {
   color: black;
   font-weight: 600;
   font-size: 15px;
 }
 
 
 footer {
   text-align: center;
   font-family: Open Sans;
   margin-top: 20px;
   color: black;
 }
 
 .btn-outline-primary {
     --bs-btn-color: #000000; 
     --bs-btn-border-color: #4400ff; 
     --bs-btn-hover-color: #000000; 
     --bs-btn-hover-bg: #e5e5e5; 
     --bs-btn-hover-border-color: #00ff0d; 
     --bs-btn-focus-shadow-rgb: #00fbff; 
     --bs-btn-active-color: #0000; 
     --bs-btn-active-bg: #e5e5e5; 
     --bs-btn-active-border-color: #ff0000; 
     --bs-btn-active-shadow: inset 0 3px 5pxrgba(0, 0, 0, 0.125); 
     --bs-btn-disabled-color: #0000; 
     --bs-btn-disabled-bg: transparent; 
     --bs-btn-disabled-border-color: #e100ff; 
     --bs-gradient: none;
 }
</style>