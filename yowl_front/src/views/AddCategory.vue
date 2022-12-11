<template>
    <nav class="navbar navbar-expand-lg" style="background-color: #a6a6a6">
      <a class="navbar-brand0" v-on:click="redirectConnectedHome();">
        <img src="../assets/Images/logo_front.PNG" alt="" width="45" height="40">
      </a>
      <a class="navbar-brand" href="#">Rebbit</a>
  
    </nav>
<div class="middle3">
    <h3>Add a category</h3>
  <div class="mb-3">
    <label class="form-label">Category title :</label>
    <input type="text" class="form-control3" placeholder=" Title of the category.." aria-describedby="emailHelp" v-model="title">
    </div>
  <div class="mb-3">
    <label class="form-label">URL category :</label>
    <input type="link" class="form-control3" placeholder=" URL of the category" v-model="logo_url">
  </div>
  <button type="submit" class="btn3 btn-primary" v-on:click="addCategory();">Submit</button>
    </div>

</template>

<script>
export default{
    data()
    {
        return{
            title: "",
            logo_url: "",
            user: []
        }
    }, 
    methods: 
    {
        async addCategory()
        {
            const requestOptions = {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ 
                    title: this.title, 
                    logo_url: this.logo_url
            })
            };
            await fetch("http://localhost:8000/api/AddCategory", requestOptions)
                .then(response => console.log(response));
            this.$toast.show("Category added!");

        }, 
        redirectConnectedHome()
        {
            const userId = this.$router.currentRoute.value.params["id"];
            this.$router.push("/connected/" + userId);
        }
    }, 
    async mounted()   
    {

    }
}
</script>

<style>
body{
    width:100vw;
}
.btn3{
    background-color: #ffee00;
    color: black;
    border-color: #ffee00;
    box-shadow:1px 1px 2px 1px;
    border-radius: 1em;
}
.middle3{
    display: grid;
    grid-template-columns: (1,100%);
    justify-content: center;
width: 100%;
height: 100%;
}
.form1{
    display: flex;
    flex-direction: column;
    width: 100%!important;
    height: 100%;
    margin-top:35%;

}
.form-control3{
    width:100%;
    border-radius:1em;
    margin-bottom:5%;

}

h3{
    text-align: center;
}
</style>