import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";
import AddPost from "../views/AddPost.vue";
import PostComments from "../views/PostComments.vue";
import ModifyUser from "../views/ModifyUser.vue";
import AdminStatistics from "../views/AdminStatistics.vue";
import Profile from "../views/profileView.vue";
import Login from "../views/LoginView.vue";
import ConnectedView from "../views/ConnectedView.vue";
import VerifyEmail from "../views/VerifyEmail.vue";
import AddCategory from "../views/AddCategory.vue";
import ManageCategories from "../views/ManageCategories.vue";
import ModifyCategory from "../views/ModifyCategory.vue";


const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "home",
      component: HomeView,
    },
    {
      path: "/connected/:id",
      name: "connected",
      component: ConnectedView
    },
    {
      path: "/managepost",
      name: "managepost",
      component: () => import("../views/ManagePost.vue"),
    },
    {
      path: "/manageUser",
      name: "manageuser",
      component: () => import("../views/ManageUser.vue"),
    },
    {
      path: "/manageCategories", 
      name: "manageCategories", 
      component: ManageCategories
    },
    {
      path: "/addcategory/:id",
      name: "addcategory",
      component: () => import("../views/AddCategory.vue"),
    },
    {
      path: "/admin/:id",
      name: "admin",
      component: () => import("../views/AdminView.vue"),
    },
    {
      path: "/login",
      name: "login",
      component: Login
    },
    {
      path: "/register",
      name: "register",
      component: () => import("../views/Register.vue"),
    }, 
    {
      path:"/addPost/:id",
      name:"addPost",
      component: AddPost
    },
    {
      path:"/posts/:id/comments/:userId",
      name:"PostComments",
      component: PostComments
    }, 
    {
      path: "/modifyUser/:id", 
      name:"ModifyUser", 
      component: ModifyUser
    }, 
    {
      path: "/ModifyCategory/:id", 
      name: "ModifyCategory", 
      component: ModifyCategory
    },
    {
      path: "/AdminStatistics", 
      name: "AdminStatistics", 
      component: AdminStatistics
    }, 
    {
      path:"/profile/:id", 
      name:"profileView", 
      component: Profile
    }, 
    {
      path:"/VerifyEmail/:id", 
      name:"VerifyEmail", 
      component: VerifyEmail
    }, 
    {
      path:"/AddCategory/:id",
      name:"AddCategory", 
      component: AddCategory
    }
  
  ],
});

export default router;
