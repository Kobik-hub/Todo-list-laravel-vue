<template>
    <div class="todo-wrapper">
        <i @click="handleDeleteToggle" v-if="deleted" class="bi bi-plus-circle icon trash-icon fa-15"></i>
        <i @click="handleDeleteToggle" v-else class="bi bi-trash icon restore-icon fa-15"></i>
        <i @click="handleEdit" class="bi bi-pen icon edit-icon"></i>
        <input @click="handleDone" type="checkbox" id="checkbox" class="checkbox done-checkbox" v-model="done" />
        <h3 class="title">
            {{ title }}
        </h3>
        <div class="content">
            {{ content }}
        </div>
    </div>
</template>
<script>
export default {
    props: {
        id: {
            type: Number,
            required: true
        },
        title: {
            type: String,
            required: true
        },
        content: {
            type: String,
            required: true
        },
        done: {
            Boolean,
            required: true
        },
        deleted: {
            Boolean,
            required: true
        }
    },
    data() {
        return {

        }
    },
    methods: {
        handleDeleteToggle() {
            axios.post('/api/todos/remove-toggle', { todo_id: this.id });
            this.$emit('refreshTodoList');
        },
        handleEdit() {
            this.$router.push(`/edit/${this.id}`)
        },
        handleDone() {
            this.$emit('handleTodoDone', this.id);
        }

    },
}
</script>
<style scoped lang="scss">
.todo-wrapper {
    height: 30vh;
    width: 28vw;
    border: 1px solid black;
    border-radius: 25px;
    gap: 10px;
    position: relative;
    background-color: #E9DAC1;
    .title {
        margin-top: 5px;
        text-align: center;
    }

    .content {
        padding: 0px 5px 0px 5px;
    }

    .icon,
    .checkbox {
        position: absolute;
        font-size: 1.5rem;
        cursor: pointer
    }

    .trash-icon,
    .restore-icon {
        right: 9px;
        bottom: 0px;
    }

    .done-checkbox {
        right: 85px;
        bottom: 10px;
        height: 25px;
        width: 25px;
    }

    .edit-icon {
        right: 45px;
        bottom: 0px;
    }
}
</style>
