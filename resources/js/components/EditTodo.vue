<template>
    <div class="wrapper">
        <div class="edit-form">
            <h1>Edit Todo note</h1>
            <form action="#" @submit.prevent="handleNewTodo">
                <div class="form-row">
                    <input type="text" name="title" v-model="formData.title" class="form-control" placeholder="title" />
                </div>
                <div class="form-row">
                    <textarea rows="10" type="text" name="content" v-model="formData.content" class="form-control"
                        placeholder="content.." />
                </div>
                <div class="form-row">
                    <button :disabled="disableEdit" type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>

export default {
    mounted() {
        axios.get(`/api/todos/${this.$route.params.id}`, this.formData).then(response => {
            this.formData = response.data;
        })
    },
    data() {
        return {
            formData: {
                title: "",
                content: ""
            }
        };
    },
    methods: {
        handleNewTodo() {
            axios.post('/api/todos/edit', this.formData).then(response => {
                this.$router.push('/');
            })
        },
    },
    computed: {
        disableEdit(){
            return !(this.formData.title.length > 0 && this.formData.content.length > 0)
        }
    }
};
</script>
<style scoped lang="scss">
.wrapper {
    height: 95vh;
    background-color: #F7ECDE;

    .edit-form {
        margin: auto;
        width: 30%;

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            justify-self: center;
            align-items: center;
        }
    }

    .form-row {
        margin-bottom: 8px;
    }
}
</style>
