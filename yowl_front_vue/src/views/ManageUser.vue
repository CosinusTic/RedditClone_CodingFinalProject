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
                <p> Registered Users</p>
            </div>
        </div>
        <div class="footer" >
            <div class="User" v-for="user in users">
                <User :user="user"/>
            </div> 
        </div>
    </body>
</template>

<script>
import User from "../components/User.vue";
export default{
    components: {
        User
    }, 
    data()
    {
        return{
            users: []
        }
    }, 
    methods:
    {
        async computeUsers()
        {
            const response = await fetch("http://localhost:8000/api/users")
                .then((response) => response.json());
            
            this.users = response;
        }
    },

    async mounted()
    {
        await this.computeUsers();
        console.log(this.users);
    }
}
</script>

<style>
* {
    padding: 0;
    margin: 0;

}
.navbar-brand{
    margin-right:30%!important;
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