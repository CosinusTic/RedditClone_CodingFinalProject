<template>
    <p>Hello {{user.username}}, your email is verified, you may now leave this page</p>
</template>

<script>
export default{
    data()
    {
        return{
            user: []
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
        async VerifyEmail()
        {
            const userId = this.$router.currentRoute.value.params["id"];
            const requestOptions = {
                method: "PUT",
                headers: { "Content-Type": "application/json" }
                };
            await fetch("http://localhost:8000/api/users/" + userId + "/ValidateAccount", requestOptions)
                .then(response=>console.log(response));
        }
    }, 
    async mounted()
    {
        await this.computeUser();
        await this.VerifyEmail(); 
    }
}
</script>