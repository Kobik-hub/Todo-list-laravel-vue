<template>
    <div v-if="user" class="wrapper kk">
        <div class="todo-list">
            <div :key="index" v-for="(todo, index) in todoList">
                <Todo :title="todo.title" :content="todo.content" :id="todo.id" :done="todo.done"
                    :deleted="todo.removed" @refreshTodoList="refreshTodoList" @handleTodoDone="handleTodoDone" />
            </div>
        </div>
    </div>

</template>
<script>
import { mapGetters } from 'vuex';
import Todo from './Todo.vue';
export default {
    beforeRouteEnter(to, from, next) {
        const user = JSON.parse(localStorage.getItem('user'));
        if (user && user.token) {
            next();
        } else {
            next(vm => { return vm.$router.push('/login') });
        }
    },
    methods: {
        handleTodoDone(id) {
            axios.post('/api/todos/done-toggle', { todo_id: id }).then(res => {
                this.todoList = this.todoList.map(todo => {
                    if (todo.id === id) {
                        todo.done = !todo.done;
                    }
                    return todo;
                })
            });
        },
        refreshTodoList() {
            this.fetchTodoList();
        },
        fetchTodoList() {
            axios.post('/api/todos', { deleted: true }).then(res => {
                this.todoList = res.data;
            });
        },
    },
    created() {
        this.fetchTodoList();
    },
    data() {
        return {
            todoList: []
        }
    },
    components: { Todo },
    computed: {
        ...mapGetters(['user'])
    }
}
</script>
<style scoped lang="scss">
.wrapper {
    padding: 20px 30px 0px 30px;
    height: 95vh;
    background-color: #F7ECDE;

    .todo-list {
        display: flex;
        justify-content: start;
        align-items: center;
        flex-wrap: wrap;
        box-sizing: border-box;
        gap: 30px;
    }
}
</style>
