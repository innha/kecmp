<template>

    <div class="modal fade" id="categoryModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-uppercase text-center" id="exampleModalLabel" v-if="editing">Edit Category</h3>
                    <h3 class="modal-title text-uppercase text-center" id="exampleModalLabel" v-else>New Category</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form class="form-horizontal" role="form">
            
                    <div class="modal-body">            
                        <!-- <div class="form-group" :class="{'has-error': errorsName}"> -->
                        <div class="form-group">
                            <div class="col-sm">
                                <input id="name" type="text" class="form-control form-control" name="name" required autofocus v-model="category.name">
                        
                                <!--  
                                pattern='[A-Za-z\\s]*'
                                <span v-if="errorsName" class="help-block"><strong>{{ nameError }}</strong></span>
                                -->
                            </div>
                        </div>
                        <!--
                        <div class="form-group">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" @click.prevent="createCategory()" :disabled="!isValidCategoryForm">
                                    Submit
                                </button>
                            </div>
                        </div>
                        -->
                    </div>
                    
                    <div class="modal-footer">                                            

                        <button type="submit" class="btn btn-primary" @click.prevent="updateCategory()" v-if="editing">Update</button>

                        <button type="submit" class="btn btn-primary" @click.prevent="createCategory()" v-else>Create</button>

                        <button class="btn btn-secondary close-modal" data-dismiss="modal">Close</button>

                    </div>
                </form>

            </div>
        </div>
    </div>    
</template>

<script>

    class Category {

        constructor(category) {

            let self = this

            self.name = category.name || ''
        }

    }

    export default {

        mounted() {

            let self = this

            console.log('Child component mounted.');

            this.$parent.$on('create_category', function () {

                // alert('on create_category inside child')

                self.editing = false

                self.category = new Category({})

                self.name = ''

                $('#categoryModal').modal()

            })

            this.$parent.$on('edit_category', ({ category }) => {

                // alert('on edit_category inside child -> ' + JSON.stringify(category))

                self.editing = true

                self.category = new Category(category)

                self.name = category.name

                self.categoryId = category.id

                $('#categoryModal').modal()

            })
        },

        data() {
            return {

                category: {},

                categoryId: null,

                editing: false
            }
        },
        /*
        computed: {
            
            isValidCategoryForm: function() {
                let self = this

                //alert(self.name);
                //return self.name && self.password;
                return self.nameIsValid() && !self.loading;
            },

        },
        */
        methods: {
            /*
            nameIsValid: function () {

                let self = this
            
                //alert(self.name);
                
                if (/^[a-zA-Z]*$/.test(self.categoryDetails.name)) {
                    return true;
                }
                
                return false
                
            },
            */
            createCategory() {

                let self = this

                // alert('createCategory -> category:' + JSON.stringify(self.category))

                this.axios.post('/admin/categories/store', self.category).then(function (resp) {

                    // console.log(resp)
                    // alert('resp')

                    // alert('category posted')

                    // alert(JSON.stringify(resp))
                    // alert(resp.data.status)                                                                                              
                    
                    $('.close-modal').click()

                    self.$parent.$emit('category_created', self.category)

                    // alert('category_created emitted inside child')

                }).catch(function (error) {
                    
                    console.log(error)
                    // alert(JSON.stringify(error))

                    window.handleError(error)
                })
                // alert('after axios')
            },

            updateCategory() {

                let self = this

                // console.log('updateCategory -> category: ' + JSON.stringify(self.category))

                // alert('updateCategory -> category: ' + JSON.stringify(self.category))

                this.axios.put(`/admin/categories/${self.categoryId}`, self.category).then(resp => {

                    // console.log(JSON.stringify(resp))

                    // alert(JSON.stringify(resp))

                    $('.close-modal').click()

                    self.$parent.$emit('category_updated', resp.data)

                    // alert('category_updated emitted')

                }).catch(e => {

                    console.log(e)

                    window.handleError(e)
                })
            }
        }
    }

</script>
