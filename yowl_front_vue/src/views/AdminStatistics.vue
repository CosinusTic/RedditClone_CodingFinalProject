<template>


<nav class="navbar navbar-expand-lg" style="background-color: #a6a6a6">
    <a class="navbar-brand0" href="#">
        <img src="../assets/Images/logo_front.PNG" alt="" width="45" height="40">
    </a>
    <a class="navbar-brand" href="#">Rabbit</a>

  


</nav>
<div class="middle85">
    <div class="count">
   <button class="usercount"> <p>Users count: {{users.length}}</p></button>
   <button class="postcount"> <p>Posts count: {{posts.length}}</p></button>
</div>
    <div class="pieChart" style="width: 80%;">
        <h3>Posts per categories</h3>
        <canvas id="categories"></canvas>
    </div>
    <div class="barChart" style="width: 500px">
        <h3>Biggest authors</h3>
        <canvas id="authors"></canvas>
    </div>
    <div class="barChart2" style="width: 500px">
        <h3>Biggest posts (authors)</h3>
        <canvas id="comments"></canvas>
    </div>
</div>

    <!-- <script type="module" src="dimensions.js"></script> -->
</template>

<script>
import { Chart }from 'chart.js/auto';
export default{
    data()
    {
        return{
            users : [], 
            posts: [],
            postCountForEachCategory : [], 
            categories: [], 
            secondData: [], 
            topAuthorsIds: [], 
            topAuthorsUsernames: [], 
            counts: [],
            topPostCommentCounts: [],

            // comments
            topCommentedPostAuthorIds: [],
            topCommentedPostsCommentCount: [], 
            topCommentedPostAuthorUsernames: []
        }
    },
    methods: {
        async computeUsers()
        {
            const response = await fetch("http://localhost:8000/api/users")
                .then((response) => response.json());
            
            this.users = response;
        }, 
        async computePosts()
        {
            const response = await fetch("http://localhost:8000/api/posts")
                .then((response) => response.json());
            
            this.posts = response;
            this.postCount = this.posts.length;
        }, 
        async postCountPerCategoryId(id)
        {
            const response = await fetch("http://localhost:8000/api/PostsPerCategory/" + id)
                .then((response) => response.json());
            this.postCountForEachCategory[id - 1] = response[0]["count(id)"];
        }, 
        async fetchCategories()
        {
            const response = await fetch("http://localhost:8000/api/categories")
                .then(response => response.json());
            this.categories = response;
        }, 
        async createPieChart() 
        {
            const data = [];
            for(let i = 0; i < this.categories.length; i++)
            {
                data.push({category: this.categories[i].title, count: this.postCountForEachCategory[i]});
            }
            new Chart(
                document.getElementById('categories'),
                {
                type: 'pie',
                data: {
                    labels: data.map(row => row.category),
                    datasets: [
                    {
                        label: 'Posts per category',
                        data: data.map(row => row.count)
                    }
                    ]
            }});
        }, 
        async createBarChart()
        {
            const data = [];
            for(let i = 0; i < this.topAuthorsUsernames.length; i++)
            {
                data.push({author: this.topAuthorsUsernames[i], count: this.counts[i]});
            }
            // console.log(data);
            new Chart(
                document.getElementById('authors'),
                {
                type: 'bar',
                data: {
                    labels: data.map(row => row.author),
                    datasets: [{
                        label: 'Posts per author',
                        data: data.map(row => row.count)
                    }]
            }});
        },
        async createBarChartForComments()
        {
            const data = [];
            for(let i = 0; i < this.topCommentedPostAuthorUsernames.length; i++)
            {
                data.push({author: this.topCommentedPostAuthorUsernames[i], count: this.topCommentedPostsCommentCount[i]});
            }
            console.log(data);
            new Chart(
                document.getElementById('comments'),
                {
                type: 'bar',
                data: {
                    labels: data.map(row => row.author),
                    datasets: [{
                        label: 'Comments per post author',
                        data: data.map(row => row.count)
                    }]
            }});
        },
        async getTopThreeAuthors()
        {
            const response = await fetch("http://localhost:8000/api/getTop3PostAuthorId")
                .then(response => response.json());
            for(let i = 0; i < response.length; i++)
            {
                await this.getAuthorUsername(response[i].author_id);
                this.counts[i] = response[i]["count(id)"];
            }
            // console.log("response", response);
        }, 
        async getTopThreeTopCommentedPostsAuthorIdAndCount()
        {
            const response = await fetch("http://localhost:8000/api/GetTopComments")
                .then(response => response.json());
            // console.log("response", response);
            for(let i = 0; i < response.length; i++)
            {
                this.topCommentedPostAuthorIds[i] = response[i].author_id;
                await this.getAuthorUsernameForComments(response[i].author_id);
                this.topCommentedPostsCommentCount[i] = response[i]["count(id)"];
            }

        },
        async getAuthorUsername(id)
        {
            const response = await fetch("http://localhost:8000/api/users/" + id)
                .then(response => response.json());
            this.topAuthorsUsernames.push(response.username);
        },
        async getAuthorUsernameForComments(id)
        {
            const response = await fetch("http://localhost:8000/api/users/" + id)
                .then(response => response.json());
            this.topCommentedPostAuthorUsernames.push(response.username);
        }

    }, 
    async mounted()
    {
        await this.computeUsers();
        await this.computePosts();
        await this.fetchCategories();
        await this.getTopThreeAuthors();
        for(let i = 1; i <= this.categories.length; i++)
        {
            await this.postCountPerCategoryId(i);
        }
        await this.createPieChart();
        await this.createBarChart();
        await this.getTopThreeTopCommentedPostsAuthorIdAndCount();
        // console.log("comment post authors", this.topCommentedPostAuthorUsernames);
        console.log("author Id", this.topCommentedPostAuthorIds);
        console.log("corresponding count", this.topCommentedPostsCommentCount);
        console.log("corresponding usernames: ", this.topCommentedPostAuthorUsernames);
            
        await this.createBarChartForComments();
        // console.log("most posts author ids", this.topAuthorsIds);
        // console.log("post counts: ", this.counts);
    }
    /*
    fetch posts per category:
    for i as long as categories
        fetch count of posts that have category[i].id  
    */
}
</script>

<style>
.count{
    
    margin-top: 10%;
    margin-bottom: 5%;
    margin-left: 15%;
   
}
.postcount{
    width:30%;
    border-radius: 1em;
    background-color: #a6a6a6;
    margin-left:3%;
    height:80%;
    box-shadow: 1px 1px 4px 0.5px;
}
.usercount{
    width:30%;
    border-radius: 1em;
    background-color: #a6a6a6;
    height:80%;
     box-shadow: 1px 1px 4px 0.5px;
}
.middle85{
    display: grid;
    grid-template-columns: (1,90%);
    justify-content: center;
}
.pieChart{
    width: 400px;
    height: 400px;
    margin-bottom: 30%;
}

.barChart{
margin-bottom: 30%;

}
.barChart2{
margin-bottom: 30%;
}


#canvas#categories{
    margin-right:0!important;
}
    @media screen and (max-width: 550px) {
        .pieChart{
            margin-left:10%;  
        }
        .barChart{
            padding:15%;
        }
        .barChart2{
            padding:15%;
        }
    }
</style>