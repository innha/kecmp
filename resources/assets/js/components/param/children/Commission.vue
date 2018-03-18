<template>

    <div class="modal fade" id="commissionModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-uppercase text-center" id="exampleModalLabel" v-if="editing">Edit Commission</h3>
                    <h3 class="modal-title text-uppercase text-center" id="exampleModalLabel" v-else>New Commission</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form class="form-horizontal" role="form">
            
                    <div class="modal-body">            
                        <!-- <div class="form-group" :class="{'has-error': errorsName}"> -->
                        <div class="form-group">
                            <div class="col-sm">
                                <input id="name" type="text" class="form-control form-control" name="name" required autofocus v-model="commission.name">
                        
                                <!--  
                                pattern='[A-Za-z\\s]*'
                                <span v-if="errorsName" class="help-block"><strong>{{ nameError }}</strong></span>
                                -->
                            </div>
                        </div>
                        <!--
                        <div class="form-group">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" @click.prevent="createCommission()" :disabled="!isValidCommissionForm">
                                    Submit
                                </button>
                            </div>
                        </div>
                        -->
                    </div>
                    
                    <div class="modal-footer">                                            

                        <button type="submit" class="btn btn-primary" @click.prevent="updateCommission()" v-if="editing">Update</button>

                        <button type="submit" class="btn btn-primary" @click.prevent="createCommission()" v-else>Create</button>

                        <button class="btn btn-secondary close-modal" data-dismiss="modal">Close</button>

                    </div>
                </form>

            </div>
        </div>
    </div>    
</template>

<script>

    class Commission {

        constructor(commission) {

            let self = this

            self.name = commission.name || ''
        }

    }

    export default {

        mounted() {

            let self = this

            console.log('Child component mounted.');

            this.$parent.$on('create_commission', function () {

                // alert('on create_commission inside child')

                self.editing = false

                self.commission = new Commission({})

                self.name = ''

                $('#commissionModal').modal()

            })

            this.$parent.$on('edit_commission', ({ commission }) => {

                // alert('on edit_commission inside child -> ' + JSON.stringify(commission))

                self.editing = true

                self.commission = new Commission(commission)

                self.name = commission.name

                self.commissionId = commission.id

                $('#commissionModal').modal()

            })
        },

        data() {
            return {

                commission: {},

                commissionId: null,

                editing: false
            }
        },
        /*
        computed: {
            
            isValidCommissionForm: function() {
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
                
                if (/^[a-zA-Z]*$/.test(self.commissionDetails.name)) {
                    return true;
                }
                
                return false
                
            },
            */
            createCommission() {

                let self = this

                // alert('createCommission -> commission:' + JSON.stringify(self.commission))

                this.axios.post('/admin/commissions/store', self.commission).then(function (resp) {

                    // console.log(resp)
                    // alert('resp')

                    // alert('commission posted')

                    // alert(JSON.stringify(resp))
                    // alert(resp.data.status)                                                                                              
                    
                    $('.close-modal').click()

                    self.$parent.$emit('commission_created', self.commission)

                    // alert('commission_created emitted inside child')

                }).catch(function (error) {
                    
                    console.log(error)
                    // alert(JSON.stringify(error))

                    window.handleError(error)
                })
                // alert('after axios')
            },

            updateCommission() {

                let self = this

                // console.log('updateCommission -> commission: ' + JSON.stringify(self.commission))

                // alert('updateCommission -> commission: ' + JSON.stringify(self.commission))

                this.axios.put(`/admin/commissions/${self.commissionId}`, self.commission).then(resp => {

                    // console.log(JSON.stringify(resp))

                    // alert(JSON.stringify(resp))

                    $('.close-modal').click()

                    self.$parent.$emit('commission_updated', resp.data)

                    // alert('commission_updated emitted')

                }).catch(e => {

                    console.log(e)

                    window.handleError(e)
                })
            }
        }
    }

</script>
