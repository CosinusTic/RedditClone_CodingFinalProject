# Welcome!
Welcome "Yowl", a Reddit clone named Rebbit. 

## Recommended IDE Setup

[VSCode](https://code.visualstudio.com/) + [Volar](https://marketplace.visualstudio.com/items?itemName=Vue.volar) (and disable Vetur) + [TypeScript Vue Plugin (Volar)](https://marketplace.visualstudio.com/items?itemName=Vue.vscode-typescript-vue-plugin).

## Customize configuration

See [Vite Configuration Reference](https://vitejs.dev/config/).

## Project Setup

```sh
npm install
```

### Compile and Hot-Reload for Development

```sh
npm run dev
```

### Compile and Minify for Production

```sh
npm run build
```

### Lint with [ESLint](https://eslint.org/)

```sh
npm run lint
```

### Required extensions: 
- Chart Js: "npm install chart.js"
- Toaster: "npm install @meforma/vue-toaster"

### Routes
path: "/": The home view
path: "/connected/:id": the home view for users that are connected, replace ":id" with the actual ID of the user that you wish to connect with.
path: "/managepost": Admin page: displays all the posts of the website and enables to modify or delete each one of them
path: "/manageUser": Admin page: displays all the users of the website and enables to modify or delete each one of them
path: "/manageCategories": Admin page: displays all the categories of the website and enables to modify or delete each one of them
path: "/addcategory/:id": Page where a connected user can add a category
path: "/admin/:id": the admin page, a dashboard that can redirect to manage users, posts, and categories
path: "/login": the login page that redirect to the connected home pages
path: "/register": the register view that enables a user to create an account, it prompts the user to verify its email otherwise he won't be able to connect
path:"/addPost/:id": Enables to add post from a user that has an account and that is connected
path:"/posts/:id/comments/:userId": Enables a user to access the comments of a post with a certain ":id" and and to post as a user with a certain ":userId"
path: "/modifyUser/:id": Redirection page when the admin clicks on a certain user modification button
path: "/ModifyCategory/:id": Redirection page when the admin clicks on a certain category modification button
path: "/AdminStatistics": Dashboard page that dislays cetain KPIs of the website for the admin
path:"/profile/:id": The profile view of a user
path:"/VerifyEmail/:id": The view that triggers the verification method to verify the email of the user (launched when clicking on "verify email" on the verification email link)
path:"/AddCategory/:id" : Form that enables a user to add a category to the website 