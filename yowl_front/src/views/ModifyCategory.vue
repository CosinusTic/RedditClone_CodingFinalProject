<template>
    <nav class="navbar navbar-expand-lg" style="background-color: #a6a6a6">
       <a class="navbar-brand0" href="#">
         <img src="../assets/Images/logo_front.PNG" alt="" width="45" height="40">
       </a>
       <a class="navbar-brand" href="#">Rebbit</a>
   
     </nav>
        
   
   
       <div class="form">
        
           
         <div class="head">
            <b>Welcome Admin</b>
            <p>Modifying category No. {{category.id}} (title: {{category.title}})</p>
         </div>
         <div class="centre">
           <div>
             <input type="text" class="btn btn-outline-primary" placeholder="New title" v-model="title"/>
           </div>
           <div>
             <input type="url" class="btn btn-outline-primary" placeholder="New url" v-model="url"/>
           </div>
         </div>
         
         <div class="centre">
           <button class="btn btn-outline-primary btn-login" v-on:click="updateCategory();">Update</button>
         </div>
         <div>
          <p>{{admin_status}}</p>
         </div>
         
        
       </div>
   </template>

<script>
export default{
    data()
    {
        return {
          category: [], 
          title: "", 
          url: ""
        }
    }, 
    methods: 
    {
        async computeCategory()
        {
            const categoryId = this.$router.currentRoute.value.params["id"];
            const response = await fetch("http://localhost:8000/api/categories/" + categoryId)
                .then(response => response.json());
            this.category = response;
        }, 
        testUpdate()
        {
          const categoryId = this.$router.currentRoute.value.params["id"]
          console.log("title: ", this.title, ", url: ", this.url, "param: ", categoryId);
        }, 
        async updateCategory()
        {
            const prompt = confirm("Are you sure that you wish to update your category to these new credentials: title: " 
            + this.title + ", url: " +  this.url + " ?");
            if(prompt)
            {
                const categoryId = this.$router.currentRoute.value.params["id"];
                const requestOptions = {
                method: "PUT",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ 
                    title: this.title, 
                    logo_url: this.url
                })
                };
                await fetch("http://localhost:8000/api/categories/modify/" + categoryId, requestOptions)
                // .then((response) => response.json());
                this.$toast.show("Modification successful!");
            }
        }
    }, 
    async mounted()
    {
        await this.computeCategory();
        console.log(this.category);
    }
}
</script>

<style scoped>
.navbar-brand0 {
  margin-left: 1%;
}
label{
    margin-right:2%;
    margin-bottom:1%;
}

.form {
  margin-top: 3%;
}

body {
  display: flex;
  padding: 0;
  flex-direction: row;
  background-color: #d9d9d9;
  justify-content: center;
  width: 212.9vh;
  height: 92vh;

}

.navbar-expand-lg {

  width: 212.9vh;
}

.nav {
  display: flex;
  justify-content: flex-start;
  text-align: center;
  align-items: flex-start;
  margin: 0;
}


.centre {
  text-align: center;
  
}

form div+div {
  margin-top: 1em;
}

.head {
  text-align: center;
}

b {
  font-family: public Sans;
  font-size: 30px;
}

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
  width: 300px;
  height: 40px;
  border: none;
  background-color: #f2f3f7;
  margin: 0 auto;
  padding: 10px;
  font-family: Open Sans;
  padding-left: 20px;
}

input:hover {
  border-color: #f5d505;
  background-color: #e5e5e5;
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
    width:20%;
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
  margin:13px;
}
</style>