<template>

    <div class="modal fade" id="dutyModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-uppercase text-center" id="exampleModalLabel" v-if="editing">Edit Duty</h3>
                    <h3 class="modal-title text-uppercase text-center" id="exampleModalLabel" v-else>New Duty</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form class="form-horizontal" role="form">
            
                    <div class="modal-body">            
                        <!-- <div class="form-group" :class="{'has-error': errorsName}"> -->
                        <div class="form-group">
                            <div class="col-sm">
                                <input id="name" type="text" class="form-control form-control" name="name" required autofocus v-model="duty.name">
                        
                                <!--  
                                pattern='[A-Za-z\\s]*'
                                <span v-if="errorsName" class="help-block"><strong>{{ nameError }}</strong></span>
                                -->
                            </div>
                        </div>
                        <!--
                        <div class="form-group">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" @click.prevent="createDuty()" :disabled="!isValidDutyForm">
                                    Submit
                                </button>
                            </div>
                        </div>
                        -->
                    </div>
                    
                    <div class="modal-footer">                                            

                        <button type="submit" class="btn btn-primary" @click.prevent="updateDuty()" v-if="editing">Update</button>

                        <button type="submit" class="btn btn-primary" @click.prevent="createDuty()" v-else>Create</button>

                        <button class="btn btn-secondary close-modal" data-dismiss="modal">Close</button>

                    </div>
                </form>

            </div>
        </div>
    </div>    
</template>

<script>

    class Duty {

        constructor(duty) {

            let self = this

            self.name = duty.name || ''
        }

    }

    export default {

        mounted() {

            let self = this

            console.log('Child component mounted.');

            this.$parent.$on('create_duty', function () {

                // alert('on create_duty inside child')

                self.editing = false

                self.duty = new Duty({})

                self.name = ''

                $('#dutyModal').modal()

            })

            this.$parent.$on('edit_duty', ({ duty }) => {

                // alert('on edit_duty inside child -> ' + JSON.stringify(duty))

                self.editing = true

                self.duty = new Duty(duty)

                self.name = duty.name

                self.dutyId = duty.id

                $('#dutyModal').modal()

            })
        },

        data() {
            return {

                duty: {},

                dutyId: null,

                editing: false
            }
        },
        /*
        computed: {
            
            isValidDutyForm: function() {
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
                
                if (/^[a-zA-Z]*$/.test(self.dutyDetails.name)) {
                    return true;
                }
                
                return false
                
            },
            */
            createDuty() {

                let self = this

                // alert('createDuty -> duty:' + JSON.stringify(self.duty))

                this.axios.post('/admin/duties/store', self.duty).then(function (resp) {

                    // console.log(resp)
                    // alert('resp')

                    // alert('duty posted')

                    // alert(JSON.stringify(resp))
                    // alert(resp.data.status)                                                                                              
                    
                    $('.close-modal').click()

                    self.$parent.$emit('duty_created', self.duty)

                    // alert('duty_created emitted inside child')

                }).catch(function (error) {
                    
                    console.log(error)
                    // alert(JSON.stringify(error))

                    window.handleError(error)
                })
                // alert('after axios')
            },

            updateDuty() {

                let self = this

                // console.log('updateDuty -> duty: ' + JSON.stringify(self.duty))

                // alert('updateDuty -> duty: ' + JSON.stringify(self.duty))

                this.axios.put(`/admin/duties/${self.dutyId}`, self.duty).then(resp => {

                    // console.log(JSON.stringify(resp))

                    // alert(JSON.stringify(resp))

                    $('.close-modal').click()

                    self.$parent.$emit('duty_updated', resp.data)

                    // alert('duty_updated emitted')

                }).catch(e => {

                    console.log(e)

                    window.handleError(e)
                })
            }
        }
    }

</script>
