<template>

    <div class="modal fade" id="typeModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-uppercase text-center" id="exampleModalLabel" v-if="editing">Edit Type</h3>
                    <h3 class="modal-title text-uppercase text-center" id="exampleModalLabel" v-else>New Type</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form class="form-horizontal" role="form">
            
                    <div class="modal-body">            
                        <!-- <div class="form-group" :class="{'has-error': errorsName}"> -->
                        <div class="form-group">
                            <div class="col-sm">
                                <input id="name" type="text" class="form-control form-control" name="name" required autofocus v-model="type.name">
                        
                                <!--  
                                pattern='[A-Za-z\\s]*'
                                <span v-if="errorsName" class="help-block"><strong>{{ nameError }}</strong></span>
                                -->
                            </div>
                        </div>
                        <!--
                        <div class="form-group">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" @click.prevent="createType()" :disabled="!isValidTypeForm">
                                    Submit
                                </button>
                            </div>
                        </div>
                        -->
                    </div>
                    
                    <div class="modal-footer">                                            

                        <button type="submit" class="btn btn-primary" @click.prevent="updateType()" v-if="editing">Update</button>

                        <button type="submit" class="btn btn-primary" @click.prevent="createType()" v-else>Create</button>

                        <button class="btn btn-secondary close-modal" data-dismiss="modal">Close</button>

                    </div>
                </form>

            </div>
        </div>
    </div>    
</template>

<script>

    class Type {

        constructor(type) {

            let self = this

            self.name = type.name || ''
        }

    }

    export default {

        mounted() {

            let self = this

            console.log('Child component mounted.');

            this.$parent.$on('create_type', function () {

                // alert('on create_type inside child')

                self.editing = false

                self.type = new Type({})

                self.name = ''

                $('#typeModal').modal()

            })

            this.$parent.$on('edit_type', ({ type }) => {

                // alert('on edit_type inside child -> ' + JSON.stringify(type))

                self.editing = true

                self.type = new Type(type)

                self.name = type.name

                self.typeId = type.id

                $('#typeModal').modal()

            })
        },

        data() {
            return {

                type: {},

                typeId: null,

                editing: false
            }
        },
        /*
        computed: {
            
            isValidTypeForm: function() {
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
                
                if (/^[a-zA-Z]*$/.test(self.typeDetails.name)) {
                    return true;
                }
                
                return false
                
            },
            */
            createType() {

                let self = this

                // alert('createType -> type:' + JSON.stringify(self.type))

                this.axios.post('/admin/types/store', self.type).then(function (resp) {

                    // console.log(resp)
                    // alert('resp')

                    // alert('type posted')

                    // alert(JSON.stringify(resp))
                    // alert(resp.data.status)                                                                                              
                    
                    $('.close-modal').click()

                    self.$parent.$emit('type_created', self.type)

                    // alert('type_created emitted inside child')

                }).catch(function (error) {
                    
                    console.log(error)
                    // alert(JSON.stringify(error))

                    window.handleError(error)
                })
                // alert('after axios')
            },

            updateType() {

                let self = this

                // console.log('updateType -> type: ' + JSON.stringify(self.type))

                // alert('updateType -> type: ' + JSON.stringify(self.type))

                this.axios.put(`/admin/types/${self.typeId}`, self.type).then(resp => {

                    // console.log(JSON.stringify(resp))

                    // alert(JSON.stringify(resp))

                    $('.close-modal').click()

                    self.$parent.$emit('type_updated', resp.data)

                    // alert('type_updated emitted')

                }).catch(e => {

                    console.log(e)

                    window.handleError(e)
                })
            }
        }
    }

</script>
