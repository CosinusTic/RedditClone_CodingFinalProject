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
            <p>Modifying user No. {{user.id}} (Username: {{user.username}})</p>
         </div>
         <div class="centre">
           <div>
             <input type="text" class="btn btn-outline-primary" placeholder="New Username" v-model="username"/>
           </div>
           <div>
             <input type="email" class="btn btn-outline-primary" placeholder="New Email" v-model="email"/>
           </div>
           <div>
             <input type="password" class="btn btn-outline-primary" placeholder="New Password" v-model="password"/>
           </div>
           <div>
             <input type="password" class="btn btn-outline-primary" placeholder="Confirm new password"/>
           </div>
           <div>
             <input type="url" class="btn btn-outline-primary" placeholder="update your profile picture (url)" v-model="profile_url"/>
           </div>
           <label for="age">New Date of birth</label>
             <select id="age" name="age" v-model="birthyear">
               <option value="1980">1980</option>
               <option value="1990">1990</option>
               <option value="2000">2000</option>
               <option value="2010">2010</option>
               <option value="2020">2020</option>
             </select>
            <label for="admin_status">Admin rights</label>
             <select id="admin_status" name="admin_status" v-model="admin_status">
               <option value="1">1</option>
               <option value="0">0</option>
             </select>
         </div>
         
         <div class="centre">
           <button class="btn btn-outline-primary btn-login" v-on:click="updateProfile();">Update</button>
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
            user: [], 
            username: "", 
            email: "", 
            password: "",
            profile_url: "",
            birthyear: "", 
            admin_status: "",
            currentYear: new Date().getFullYear(),
            age: ""
        }
    }, 
    methods: 
    {
        async computeUser()
        {
            const userId = this.$router.currentRoute.value.params["id"];
            const response = await fetch("http://localhost:8000/api/users/" + userId)
                .then(response => response.json());
            this.user = response;
        }, 
        testUpdate()
        {
            if(this.birthyear)
            {
                this.age = this.currentYear - this.birthyear;
                console.log(
                    "username: ", this.username, 
                    ", email: ", this.username, 
                    ", password: ", this.password, 
                    ", profile_url: ", this.profile_url, 
                    ", age: ", this.age
                );
            }
        }, 
        async updateProfile()
        {
            this.age = this.currentYear - this.birthyear;
            const prompt = confirm("Are you sure that you wish to update your profile to these new credentials: username: " 
            + this.username + ", email: " + this.email + ", profile_pic_url: " + this.profile_url + ", new password: " + this.password + ", new age: " + this.age +" ?");
            if(prompt)
            {
                const userId = this.$router.currentRoute.value.params["id"];
                const requestOptions = {
                method: "PUT",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ 
                    username: this.username, 
                    email: this.email,
                    password: this.password,
                    profile_pic_url: this.profile_url, 
                    age: this.age,
                    admin_status: this.admin_status
                })
                };
                await fetch("http://localhost:8000/api/User/" + userId + "/Modify", requestOptions)
                .then((response) => console.log(response));
                this.$toast.show("Modification successful!");
            }
        }
    }, 
    async mounted()
    {
        await this.computeUser();
        console.log(this.user);
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