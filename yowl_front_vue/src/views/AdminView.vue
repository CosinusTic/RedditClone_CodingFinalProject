<template>

    <nav class="navbar navbar-expand-lg" style="background-color: #a6a6a6">
        <a class="navbar-brand0" href="#">
            <img src="../assets/Images/logo_front.PNG" alt="" width="45" height="40">
        </a>
        <a class="navbar-brand" href="#">Rabbit</a>
    </nav>
    
    <body>
        
<div class="footer">
    <div class="bloc1">
        <button v-on:click="redirectManagePosts();">Manage Posts</button>
    </div>
    <div class="bloc2">
        <button v-on:click="redirectManageUsers();">Manage Users </button>   
    </div>
    <div class="bloc4">
        <button v-on:click="redirectManageCategories();">Manage categories</button>
    </div>
    <div class="bloc3">
        <button v-on:click="redirectConsultStatistics();">Consult statistics</button>
    </div>
</div>
    </body>
</template>

<script>
export default{
    methods:
    {
        redirectManagePosts()
        {
            this.$router.push("/managepost");
        }, 
        redirectConsultStatistics()
        {
            this.$router.push("/AdminStatistics");
        }, 
        redirectManageUsers()
        {
            this.$router.push("/manageUser");
        }, 
        redirectManageCategories()
        {
            this.$router.push("/manageCategories");
        }
    }
}
</script>
<style>
.bloc1{
display: flex;
background-color: #ffff;
width: 20%;
height: 60%;
border-radius:1em;
text-align: center;
justify-content: center;
align-items: center;
margin-top: 5%;
margin-right: 3%;
}
.bloc2{
    display: flex;
    background-color: #d9d9d9;
    width: 20%;
height: 60%;
border-radius:1em;
text-align: center;
justify-content: center;
align-items: center;
margin-top: 5%;
margin-right: 3%;
}
.bloc3{
    display: flex;
    background-color: #a6a6a6;
    width: 20%;
height: 60%;
border-radius:1em;
text-align: center;
justify-content: center;
align-items: center;
margin-top: 5%;
}
.bloc4{
    display: flex;
    background-color: #c4bfbf;
    width: 20%;
height: 60%;
border-radius:1em;
text-align: center;
justify-content: center;
align-items: center;
margin-top: 5%;
margin-right: 3%;
}
.text{
    width: 100%;
    margin-top: 10%;
}
.header {
    display: flex;
    width: 100%;
    height: 30vh;
    margin: 0 !important;
    text-align:center ;
}

.footer {
    display:flex;
    
    justify-content: center;
    width: 100%;
    height: 50vh;
    margin: 0 !important;
}

* {
    padding: 0;
    margin: 0;

}

.navbar-brand0 {
    margin-left: 1%;
}


body {
    display: flex;
    padding: 0;
    flex-direction: row;
    background-color: #ffee00;
    justify-content: start;
    width: 100vw;
}

.navbar-expand-lg {
    width: 100%;
}

.nav {
    display: flex;
    justify-content: flex-start;
    text-align: center;
    align-items: flex-start;
    margin: 0;
}
</style>
   