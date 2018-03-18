<template>

    <div class="modal fade" id="statusModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-uppercase text-center" id="exampleModalLabel" v-if="editing">Edit Status</h3>
                    <h3 class="modal-title text-uppercase text-center" id="exampleModalLabel" v-else>New Status</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form class="form-horizontal" role="form">
            
                    <div class="modal-body">            
                        <!-- <div class="form-group" :class="{'has-error': errorsName}"> -->
                        <div class="form-group">
                            <div class="col-sm">
                                <input id="name" type="text" class="form-control form-control" name="name" required autofocus v-model="status.name">
                        
                                <!--  
                                pattern='[A-Za-z\\s]*'
                                <span v-if="errorsName" class="help-block"><strong>{{ nameError }}</strong></span>
                                -->
                            </div>
                        </div>
                        <!--
                        <div class="form-group">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" @click.prevent="createStatus()" :disabled="!isValidStatusForm">
                                    Submit
                                </button>
                            </div>
                        </div>
                        -->
                    </div>
                    
                    <div class="modal-footer">                                            

                        <button type="submit" class="btn btn-primary" @click.prevent="updateStatus()" v-if="editing">Update</button>

                        <button type="submit" class="btn btn-primary" @click.prevent="createStatus()" v-else>Create</button>

                        <button class="btn btn-secondary close-modal" data-dismiss="modal">Close</button>

                    </div>
                </form>

            </div>
        </div>
    </div>    
</template>

<script>

    class Status {

        constructor(status) {

            let self = this

            self.name = status.name || ''
        }

    }

    export default {

        mounted() {

            let self = this

            console.log('Child component mounted.');

            this.$parent.$on('create_status', function () {

                // alert('on create_status inside child')

                self.editing = false

                self.status = new Status({})

                self.name = ''

                $('#statusModal').modal()

            })

            this.$parent.$on('edit_status', ({ status }) => {

                // alert('on edit_status inside child -> ' + JSON.stringify(status))

                self.editing = true

                self.status = new Status(status)

                self.name = status.name

                self.statusId = status.id

                $('#statusModal').modal()

            })
        },

        data() {
            return {

                status: {},

                statusId: null,

                editing: false
            }
        },
        /*
        computed: {
            
            isValidStatusForm: function() {
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
                
                if (/^[a-zA-Z]*$/.test(self.statusDetails.name)) {
                    return true;
                }
                
                return false
                
            },
            */
            createStatus() {

                let self = this

                // alert('createStatus -> status:' + JSON.stringify(self.status))

                this.axios.post('/admin/statuses/store', self.status).then(function (resp) {

                    // console.log(resp)
                    // alert('resp')

                    // alert('status posted')

                    // alert(JSON.stringify(resp))
                    // alert(resp.data.status)                                                                                              
                    
                    $('.close-modal').click()

                    self.$parent.$emit('status_created', self.status)

                    // alert('status_created emitted inside child')

                }).catch(function (error) {
                    
                    console.log(error)
                    // alert(JSON.stringify(error))

                    window.handleError(error)
                })
                // alert('after axios')
            },

            updateStatus() {

                let self = this

                // console.log('updateStatus -> status: ' + JSON.stringify(self.status))

                // alert('updateStatus -> status: ' + JSON.stringify(self.status))

                this.axios.put(`/admin/statuses/${self.statusId}`, self.status).then(resp => {

                    // console.log(JSON.stringify(resp))

                    // alert(JSON.stringify(resp))

                    $('.close-modal').click()

                    self.$parent.$emit('status_updated', resp.data)

                    // alert('status_updated emitted')

                }).catch(e => {

                    console.log(e)

                    window.handleError(e)
                })
            }
        }
    }

</script>
