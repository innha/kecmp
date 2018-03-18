<template>

    <div class="modal fade" id="roleModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-uppercase text-center" id="exampleModalLabel" v-if="editing">Edit Role</h3>
                    <h3 class="modal-title text-uppercase text-center" id="exampleModalLabel" v-else>New Role</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form class="form-horizontal" role="form">
            
                    <div class="modal-body">            
                        <!-- <div class="form-group" :class="{'has-error': errorsName}"> -->
                        <div class="form-group">
                            <div class="col-sm">
                                <input id="name" type="text" class="form-control form-control" name="name" required autofocus v-model="role.name">
                        
                                <!--  
                                pattern='[A-Za-z\\s]*'
                                <span v-if="errorsName" class="help-block"><strong>{{ nameError }}</strong></span>
                                -->
                            </div>
                        </div>
                        <!--
                        <div class="form-group">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" @click.prevent="createRole()" :disabled="!isValidRoleForm">
                                    Submit
                                </button>
                            </div>
                        </div>
                        -->
                    </div>
                    
                    <div class="modal-footer">                                            

                        <button type="submit" class="btn btn-primary" @click.prevent="updateRole()" v-if="editing">Update</button>

                        <button type="submit" class="btn btn-primary" @click.prevent="createRole()" v-else>Create</button>

                        <button class="btn btn-secondary close-modal" data-dismiss="modal">Close</button>

                    </div>
                </form>

            </div>
        </div>
    </div>    
</template>

<script>

    class Role {

        constructor(role) {

            let self = this

            self.name = role.name || ''
        }

    }

    export default {

        mounted() {

            let self = this

            console.log('Child component mounted.');

            this.$parent.$on('create_role', function () {

                // alert('on create_role inside child')

                self.editing = false

                self.role = new Role({})

                self.name = ''

                $('#roleModal').modal()

            })

            this.$parent.$on('edit_role', ({ role }) => {

                // alert('on edit_role inside child -> ' + JSON.stringify(role))

                self.editing = true

                self.role = new Role(role)

                self.name = role.name

                self.roleId = role.id

                $('#roleModal').modal()

            })
        },

        data() {
            return {

                role: {},

                roleId: null,

                editing: false
            }
        },
        /*
        computed: {
            
            isValidRoleForm: function() {
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
                
                if (/^[a-zA-Z]*$/.test(self.roleDetails.name)) {
                    return true;
                }
                
                return false
                
            },
            */
            createRole() {

                let self = this

                // alert('createRole -> role:' + JSON.stringify(self.role))

                this.axios.post('/admin/roles/store', self.role).then(function (resp) {

                    // console.log(resp)
                    // alert('resp')

                    // alert('role posted')

                    // alert(JSON.stringify(resp))
                    // alert(resp.data.status)                                                                                              
                    
                    $('.close-modal').click()

                    self.$parent.$emit('role_created', self.role)

                    // alert('role_created emitted inside child')

                }).catch(function (error) {
                    
                    console.log(error)
                    // alert(JSON.stringify(error))

                    window.handleError(error)
                })
                // alert('after axios')
            },

            updateRole() {

                let self = this

                // console.log('updateRole -> role: ' + JSON.stringify(self.role))

                // alert('updateRole -> role: ' + JSON.stringify(self.role))

                this.axios.put(`/admin/roles/${self.roleId}`, self.role).then(resp => {

                    // console.log(JSON.stringify(resp))

                    // alert(JSON.stringify(resp))

                    $('.close-modal').click()

                    self.$parent.$emit('role_updated', resp.data)

                    // alert('role_updated emitted')

                }).catch(e => {

                    console.log(e)

                    window.handleError(e)
                })
            }
        }
    }

</script>
