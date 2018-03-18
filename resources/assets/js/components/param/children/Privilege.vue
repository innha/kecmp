<template>

    <div class="modal fade" id="privilegeModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-uppercase text-center" id="exampleModalLabel" v-if="editing">Edit Privilege</h3>
                    <h3 class="modal-title text-uppercase text-center" id="exampleModalLabel" v-else>New Privilege</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form class="form-horizontal" role="form">
            
                    <div class="modal-body">            
                        <!-- <div class="form-group" :class="{'has-error': errorsName}"> -->
                        <div class="form-group">
                            <div class="col-sm">
                                <input id="name" type="text" class="form-control form-control" name="name" required autofocus v-model="privilege.name">
                        
                                <!--  
                                pattern='[A-Za-z\\s]*'
                                <span v-if="errorsName" class="help-block"><strong>{{ nameError }}</strong></span>
                                -->
                            </div>
                        </div>
                        <!--
                        <div class="form-group">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" @click.prevent="createPrivilege()" :disabled="!isValidPrivilegeForm">
                                    Submit
                                </button>
                            </div>
                        </div>
                        -->
                    </div>
                    
                    <div class="modal-footer">                                            

                        <button type="submit" class="btn btn-primary" @click.prevent="updatePrivilege()" v-if="editing">Update</button>

                        <button type="submit" class="btn btn-primary" @click.prevent="createPrivilege()" v-else>Create</button>

                        <button class="btn btn-secondary close-modal" data-dismiss="modal">Close</button>

                    </div>
                </form>

            </div>
        </div>
    </div>    
</template>

<script>

    class Privilege {

        constructor(privilege) {

            let self = this

            self.name = privilege.name || ''
        }

    }

    export default {

        mounted() {

            let self = this

            console.log('Child component mounted.');

            this.$parent.$on('create_privilege', function () {

                // alert('on create_privilege inside child')

                self.editing = false

                self.privilege = new Privilege({})

                self.name = ''

                $('#privilegeModal').modal()

            })

            this.$parent.$on('edit_privilege', ({ privilege }) => {

                // alert('on edit_privilege inside child -> ' + JSON.stringify(privilege))

                self.editing = true

                self.privilege = new Privilege(privilege)

                self.name = privilege.name

                self.privilegeId = privilege.id

                $('#privilegeModal').modal()

            })
        },

        data() {
            return {

                privilege: {},

                privilegeId: null,

                editing: false
            }
        },
        /*
        computed: {
            
            isValidPrivilegeForm: function() {
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
                
                if (/^[a-zA-Z]*$/.test(self.privilegeDetails.name)) {
                    return true;
                }
                
                return false
                
            },
            */
            createPrivilege() {

                let self = this

                // alert('createPrivilege -> privilege:' + JSON.stringify(self.privilege))

                this.axios.post('/admin/privileges/store', self.privilege).then(function (resp) {

                    // console.log(resp)
                    // alert('resp')

                    // alert('privilege posted')

                    // alert(JSON.stringify(resp))
                    // alert(resp.data.status)                                                                                              
                    
                    $('.close-modal').click()

                    self.$parent.$emit('privilege_created', self.privilege)

                    // alert('privilege_created emitted inside child')

                }).catch(function (error) {
                    
                    console.log(error)
                    // alert(JSON.stringify(error))

                    window.handleError(error)
                })
                // alert('after axios')
            },

            updatePrivilege() {

                let self = this

                // console.log('updatePrivilege -> privilege: ' + JSON.stringify(self.privilege))

                // alert('updatePrivilege -> privilege: ' + JSON.stringify(self.privilege))

                this.axios.put(`/admin/privileges/${self.privilegeId}`, self.privilege).then(resp => {

                    // console.log(JSON.stringify(resp))

                    // alert(JSON.stringify(resp))

                    $('.close-modal').click()

                    self.$parent.$emit('privilege_updated', resp.data)

                    // alert('privilege_updated emitted')

                }).catch(e => {

                    console.log(e)

                    window.handleError(e)
                })
            }
        }
    }

</script>
