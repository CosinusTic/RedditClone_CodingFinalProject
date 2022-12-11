<template>
    <nav class="navbar navbar-expand-lg" style="background-color: #a6a6a6">
        <a class="navbar-brand0" href="#">
            <img src="../assets/Images/logo_front.PNG" alt="" width="45" height="40">
        </a>
        <a class="navbar-brand" href="#">Rabbit</a>



    </nav>

    <body>
        <div class="header">
            <div class="text">
                <h3>Welcome Admin</h3>
                <p>Registered Categories</p>
            </div>
        </div>
        <div class="footer" >
            <div class="User" v-for="category in categories">
                <Category :category="category"/>
                <button class="btn custom7" type="submit"><img src="../assets/Images/modify-icon.png" class="add-img2" alt="" v-on:click="redirectModifyCategory(category.id);"></button> 
                <button class="btn custom7" type="submit"><img src="../assets/Images/trash-icon.png" class="add-img2" alt="" v-on:click="deleteCategory(category.id)"></button>  
            </div> 
        </div>
    </body>
</template>

<script>
import Category from "../components/Category.vue";
export default{
    components: {
        Category
    }, 
    data()
    {
        return{
            categories: []
        }
    }, 
    methods:
    {
        async computeCategories()
        {
            const response = await fetch("http://localhost:8000/api/categories")
                .then((response) => response.json());
            
            this.categories = response;
        }, 
        async deleteCategory(id)
        {
            const confirmation = confirm("Are you sure?");
            const requestOptions = {
                method: "DELETE",
                headers: { "Content-Type": "application/json" }
                };
            if(confirmation)
            {
                await fetch("http://localhost:8000/api/categories/delete/" + id, requestOptions)
            }
            this.$toast.show("Deletion successful!");
            
        }, 
        redirectModifyCategory(id)
        {
            this.$router.push("/ModifyCategory/" + id)
        }
    },

    async mounted()
    {
        await this.computeCategories();
        console.log(this.categories);
    }
}
</script>

<style>
* {
    padding: 0;
    margin: 0;

}

.d-flex{
    width:100%;
}
.custom7{
    justify-content: start center;
    padding:0;
}
.User{
display: flex;
height:14%;
}
.add-img2{
    width:3em;
    height: 3em;
border-radius:1.4em;
margin-left:0.5em;

}
.add-img1 {
    width: 20%;
    height: 70%;
 
}
.custom3 {
    padding: 0;
    background-color: #a6a6a6;
    border-radius: 1em;
    width:10em;
    height:3em ;
    align-items: center;
    justify-content: center;
    text-align: center;
    margin-bottom:30%
    
}
.footer {
    display:grid;
    grid-template-columns: repeat(3, 30%);
    justify-content: center;
    justify-items: center;
    width: 212.9vh;
    height: 50vh;
    margin: 0!important;
}
.text{
    width: 100%;
    margin-top: 3%;
}
.header {
    display: flex;
    width: 212.9vh;
    height: 30vh;
    margin: 0 !important;
    text-align:center ;
}

body {
    display: flex;
    padding: 0;
    flex-direction: column;
    background-color: #d9d9d9;
    justify-content: start;
    width: 212.9vh;
}

.navbar-expand-lg {
    margin: 0 !important;
   
}

.navbar-brand0 {
    margin-left: 3%;
}

nav {
    display: flex;
    justify-content: flex-start;
    text-align: center;
    align-items: flex-start;
    margin: 0;

}
</style>