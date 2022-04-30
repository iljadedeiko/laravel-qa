<template>
    <div class="dropdown pr-4">
        <select class="form-control categories" name="categories" id="categories">
            <option selected @click="selectedAll()">All questions</option>
            <option v-for="category in this.categories" v-bind:value="category.id" @click="selectedCat(category.id)">
                {{ category.category_name }}
            </option>
        </select>
    </div>
</template>

<script>
    export default {
        props: ['categories'],
        data: function (){
            return {
                selectedCategory: '',
            }
        },
        methods: {
            sectedCat: function (id){
                this.selectedCategory = id;
            }
        },
        computed: {
            filteredCategories: function (){
                return this.categories.filter((item) => item.category_id === this.selectedCategory);
            }
        }
    }
</script>
