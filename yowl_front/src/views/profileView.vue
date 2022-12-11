<template>
   
   <nav class="navbar navbar-expand-lg" style="background-color: #a6a6a6">
      <a class="navbar-brand0" v-on:click="redirectConnectedHome();">
        <img src="../assets/Images/logo_front.PNG" alt="" width="45" height="40">
      </a>
      <a class="navbar-brand" href="#">Rebbit</a>
  
    </nav>
<div class="all4">
    <div class="middleside1">

<div class="card69">
    <h1 class="Myprofil">My profile</h1>
    <div  class="EditProfil">
      <form class="updateUserForm">
        <div class="d1">
          <label for="username">Username</label>
          <input class="InputProfil" type="text" name="username" minlength="2" v-bind:placeholder="'current: ' + user.username" v-model="new_username" />
        </div>
        <div class="d2">
          <label for="email">Email</label>
          <input class="InputProfil" type="email" name="email" minlength="2" required v-bind:placeholder="'current: ' + user.email" v-model="new_email"/>
        </div>
        <div>
        <div class="d3">
          <label for="password">new password</label>
          <input class="InputProfil" type="text" name="password" minlength="2" required v-bind:placeholder="('current: ' + user.password)" v-model="new_profile_url"/>
        </div>
        <div class="d4">
          <label for="url">Profile picture URL</label>
          <input class="InputProfil" type="url" name="url" minlength="2" required v-bind:placeholder="('current: ' + user.profile_pic_url)" v-model="new_password"/>
        </div>
      </div>
        <div class="ageInput">
        <p>Current birth year: {{(currentYear - user.age)}}</p>
        <label for="age">Date of birth </label>
          <select id="age" name="age" v-model="new_age">
            <option value="none" selected disabled hidden>{{(currentYear - user.age)}}</option>
            <option value="1980">1980</option>
            <option value="1990">1990</option>
            <option value="2000" selected>2000</option>
            <option value="2010">2010</option>
            <option value="2020">2020</option>
          </select>
        </div>
        
      </form>
    </div>
  </div>
   
    
</div>
<div class="rightside1">
  <div class="img">
      <img class="profileimg" v-bind:src="user.profile_pic_url" alt="" width="250" height="200">
  </div>
  <button type="submit" class="Button" v-on:click="updateProfile();">UPDATE</button>
</div>

</div>

</template>

<script>
export default{
  data()
  {
    return{
      user: [], 
      new_username: "", 
      new_email: "", 
      new_profile_url: "", 
      new_password: "", 
      new_age: "", 
      currentYear: new Date().getFullYear()
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
    async updateProfile()
    {
      const prompt = confirm("Are you sure that you wish to update your profile to these new credentials: username: " 
      + this.new_username + ", email: " + this.new_email + ", profile_pic_url: " + this.new_profile_url + ", new password: " + this.new_password + ", new age: " + this.new_age +" ?");
      if(prompt)
      {
        const userId = this.$router.currentRoute.value.params["id"];
        const requestOptions = {
        method: "PUT",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ 
          username: this.new_username, 
          email: this.new_email,
          password: this.new_password,
          profile_pic_url: this.new_profile_url, 
          age: (this.currentYear - this.new_age)
          })
        };
        await fetch("http://localhost:8000/api/User/" + userId + "/Modify", requestOptions)
          .then((response) => console.log(response));
        }

        this.$toast.show("Modification successful!");
    }, 
    redirectConnectedHome()
    {
      const userId = this.$router.currentRoute.value.params["id"];
      this.$router.push("/connected/" + userId);
    }
  }, 
  async mounted()
  {
    await this.computeUser();
    console.log(this.user);
  }
}
</script>
 
  
<style>
.all4{
display: flex;
}
.card69{
  justify-content: center;
  text-align: center;
  align-items: center;
  background-color: #ffff;
  border-radius: 7%;
  width:50%;
  height:90%;
  margin-top: 8%;
  margin-left: 15%;
  padding:5%;
  box-shadow: 1px 1px 2px 2px;
}
.rightside1{
width:50%;
height:90%;
margin-top:5%;
}
.EditProfile{
  display:flex;
  align-items: center;
}
.middleside1{
  width:50%;
height:90%;
}
.d1{
display:flex;
flex-direction: column;
margin-bottom:5%;
}
.d2{
  display:flex;
flex-direction: column;
margin-bottom:5%;
}

.d3{
  display:flex;
flex-direction: column;
margin-bottom:5%;
}

.d4{
  display:flex;
flex-direction: column;
margin-bottom:5%;
}
.Button {
  background-color: #ffee00;
  width: 40%;
  margin: 0;
  height: 100%;
  border-radius: 1em;
  border: none;
  font-family: Open Sans;
  margin-left:5%;
  box-shadow: 1px 1px 1.5px 2px;
}

.InputProfil {
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
  box-shadow: 1px 1px 1px 1px;
}
.InputCreatepost {
  border-radius: 1em;
  width: 300px;
  height: 400px;
  border: none;
  background-color: #f2f3f7;
  margin: 0 auto;
  padding: 10px;
  font-family: Open Sans;
}

.profileimg{
  width:50%;
  height:50%;
  border-radius:100%;
  margin-bottom: 3%;
  box-shadow: 1px 1px 2px 2px;
}
.navbar-expand-lg {

width: 100%;
}
.navbar-brand0 {
  margin-left: 1%;
}
.nav {
display: flex;
justify-content: flex-start;
text-align: center;
align-items: flex-start;
margin: 0;
}

@media screen and (max-width: 550px) {

  .all4{
    display: grid;
    grid-template-columns: (1,90%);
  }
  .card69{
    width:100%;
    margin-left:5%;
    padding-bottom: 10%;
  }
  .middleside1{
    width:90%;
    height:100%;
  }
  .rightside1{
    width:90%;
    height:50%;
    margin-left:25%;
  }
}
</style>

