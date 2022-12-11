<template>
    <button class="btn custom3" type="submit"><img v-bind:src="user.profile_pic_url" class="add-img1" alt="">@{{user.username}}</button>   
                <button class="btn custom7" type="submit"><img src="../assets/Images/modify-icon.png" class="add-img2" alt="" v-on:click="redirectModifyUser();"></button> 
                <button class="btn custom7" type="submit"><img src="../assets/Images/trash-icon.png" class="add-img2" alt="" v-on:click="deleteUser(user.id)"></button>  
</template>

<script>
export default{
props: ["user"], 
    data()
    {
        return{

        }
    }, 
    methods: 
    {
        testDelete()
        {
            console.log(this.user.username);
        }, 
        async deleteUser(id)
        {
            const confirmation = confirm("Are you sure?");
            if(confirmation)
            {
                const requestOptions = {
                method: "DELETE",
                headers: { "Content-Type": "application/json" }
                };
                await fetch("http://localhost:8000/api/DeleteUser/" + id, requestOptions)
                    .then((response) => console.log(response));
            } 
            this.$toast.show("Deletion successful!");

            
        }, 
        async redirectModifyUser()
        {
            this.$router.push("/modifyUser/" + this.user.id);
        }
    }
}
</script>