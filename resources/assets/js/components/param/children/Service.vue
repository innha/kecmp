<template>

    <div class="modal fade" id="serviceModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-uppercase text-center" id="exampleModalLabel" v-if="editing">Edit Service</h3>
                    <h3 class="modal-title text-uppercase text-center" id="exampleModalLabel" v-else>New Service</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form class="form-horizontal" role="form">
            
                    <div class="modal-body">            
                        <!-- <div class="form-group" :class="{'has-error': errorsName}"> -->
                        <div class="form-group">
                            <div class="col-sm">
                                <input id="name" type="text" class="form-control form-control" name="name" required autofocus v-model="service.name">
                        
                                <!--  
                                pattern='[A-Za-z\\s]*'
                                <span v-if="errorsName" class="help-block"><strong>{{ nameError }}</strong></span>
                                -->
                            </div>
                        </div>
                        <!--
                        <div class="form-group">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" @click.prevent="createService()" :disabled="!isValidServiceForm">
                                    Submit
                                </button>
                            </div>
                        </div>
                        -->
                    </div>
                    
                    <div class="modal-footer">                                            

                        <button type="submit" class="btn btn-primary" @click.prevent="updateService()" v-if="editing">Update</button>

                        <button type="submit" class="btn btn-primary" @click.prevent="createService()" v-else>Create</button>

                        <button class="btn btn-secondary close-modal" data-dismiss="modal">Close</button>

                    </div>
                </form>

            </div>
        </div>
    </div>    
</template>

<script>

    class Service {

        constructor(service) {

            let self = this

            self.name = service.name || ''
        }

    }

    export default {

        mounted() {

            let self = this

            console.log('Child component mounted.');

            this.$parent.$on('create_service', function () {

                // alert('on create_service inside child')

                self.editing = false

                self.service = new Service({})

                self.name = ''

                $('#serviceModal').modal()

            })

            this.$parent.$on('edit_service', ({ service }) => {

                // alert('on edit_service inside child -> ' + JSON.stringify(service))

                self.editing = true

                self.service = new Service(service)

                self.name = service.name

                self.serviceId = service.id

                $('#serviceModal').modal()

            })
        },

        data() {
            return {

                service: {},

                serviceId: null,

                editing: false
            }
        },
        /*
        computed: {
            
            isValidServiceForm: function() {
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
                
                if (/^[a-zA-Z]*$/.test(self.serviceDetails.name)) {
                    return true;
                }
                
                return false
                
            },
            */
            createService() {

                let self = this

                // alert('createService -> service:' + JSON.stringify(self.service))

                this.axios.post('/admin/services/store', self.service).then(function (resp) {

                    // console.log(resp)
                    // alert('resp')

                    // alert('service posted')

                    // alert(JSON.stringify(resp))
                    // alert(resp.data.status)                                                                                              
                    
                    $('.close-modal').click()

                    self.$parent.$emit('service_created', self.service)

                    // alert('service_created emitted inside child')

                }).catch(function (error) {
                    
                    console.log(error)
                    // alert(JSON.stringify(error))

                    window.handleError(error)
                })
                // alert('after axios')
            },

            updateService() {

                let self = this

                // console.log('updateService -> service: ' + JSON.stringify(self.service))

                // alert('updateService -> service: ' + JSON.stringify(self.service))

                this.axios.put(`/admin/services/${self.serviceId}`, self.service).then(resp => {

                    // console.log(JSON.stringify(resp))

                    // alert(JSON.stringify(resp))

                    $('.close-modal').click()

                    self.$parent.$emit('service_updated', resp.data)

                    // alert('service_updated emitted')

                }).catch(e => {

                    console.log(e)

                    window.handleError(e)
                })
            }
        }
    }

</script>
