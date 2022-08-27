import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);


import Login from '../components/Auth/Login.vue'
import Register from '../components/Auth/Register.vue'
import TodoList from '../components/TodoList.vue'
import NewTodo from '../components/NewTodo.vue'
import EditTodo from '../components/EditTodo.vue'
import DeletedTodoList from '../components/DeletedTodoList.vue'
const routes = [
    {
        path:"/login",
        component: Login
    },
    {
        path:"/register",
        component: Register
    },
    {
        path:"/",
        component: TodoList
    },
    {
        path: '/create',
        component: NewTodo
    },
    {
        path: '/edit/:id',
        component: EditTodo
    },
    {
        path: '/deleted',
        component: DeletedTodoList
    }


]

const router = new VueRouter({
    routes,
    mode: "history"
  });

export default router;
