<template>
    <div class="dropdown pr-4">
        <button type="button" class="btn btn-outline-secondary dropdown-toggle px-4" data-toggle="dropdown">
            Category
        </button>
        <div class="dropdown-menu categories">
    <!--        <a class="dropdown-item" href="#">{{ $category->category_name }}</a>-->
            <a class="dropdown-item" v-for="category in categories">
                {{ category.category_name }}
            </a>
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                categories: [],
                questions: []
            }
        },

        mounted() {
            this.loadCategories();
            this.loadQuestions();
        },

        methods: {
            loadCategories: function() {
                axios.get('/api/categories')
                    .then((response) => {
                        this.categories = response.data.data;
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            },

            loadQuestions: function() {

            }
        }
    }
</script>
