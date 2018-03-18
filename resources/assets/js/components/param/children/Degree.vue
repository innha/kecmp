<template>

    <div class="modal fade" id="degreeModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-uppercase text-center" id="exampleModalLabel" v-if="editing">Edit Degree</h3>
                    <h3 class="modal-title text-uppercase text-center" id="exampleModalLabel" v-else>New Degree</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form class="form-horizontal" role="form">
            
                    <div class="modal-body">            
                        <!-- <div class="form-group" :class="{'has-error': errorsName}"> -->
                        <div class="form-group">
                            <div class="col-sm">
                                <input id="name" type="text" class="form-control form-control" name="name" required autofocus v-model="degree.name">
                        
                                <!--  
                                pattern='[A-Za-z\\s]*'
                                <span v-if="errorsName" class="help-block"><strong>{{ nameError }}</strong></span>
                                -->
                            </div>
                        </div>
                        <!--
                        <div class="form-group">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" @click.prevent="createDegree()" :disabled="!isValidDegreeForm">
                                    Submit
                                </button>
                            </div>
                        </div>
                        -->
                    </div>
                    
                    <div class="modal-footer">                                            

                        <button type="submit" class="btn btn-primary" @click.prevent="updateDegree()" v-if="editing">Update</button>

                        <button type="submit" class="btn btn-primary" @click.prevent="createDegree()" v-else>Create</button>

                        <button class="btn btn-secondary close-modal" data-dismiss="modal">Close</button>

                    </div>
                </form>

            </div>
        </div>
    </div>    
</template>

<script>

    class Degree {

        constructor(degree) {

            let self = this

            self.name = degree.name || ''
        }

    }

    export default {

        mounted() {

            let self = this

            console.log('Child component mounted.');

            this.$parent.$on('create_degree', function () {

                // alert('on create_degree inside child')

                self.editing = false

                self.degree = new Degree({})

                self.name = ''

                $('#degreeModal').modal()

            })

            this.$parent.$on('edit_degree', ({ degree }) => {

                // alert('on edit_degree inside child -> ' + JSON.stringify(degree))

                self.editing = true

                self.degree = new Degree(degree)

                self.name = degree.name

                self.degreeId = degree.id

                $('#degreeModal').modal()

            })
        },

        data() {
            return {

                degree: {},

                degreeId: null,

                editing: false
            }
        },
        /*
        computed: {
            
            isValidDegreeForm: function() {
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
                
                if (/^[a-zA-Z]*$/.test(self.degreeDetails.name)) {
                    return true;
                }
                
                return false
                
            },
            */
            createDegree() {

                let self = this

                // alert('createDegree -> degree:' + JSON.stringify(self.degree))

                this.axios.post('/admin/degrees/store', self.degree).then(function (resp) {

                    // console.log(resp)
                    // alert('resp')

                    // alert('degree posted')

                    // alert(JSON.stringify(resp))
                    // alert(resp.data.status)                                                                                              
                    
                    $('.close-modal').click()

                    self.$parent.$emit('degree_created', self.degree)

                    // alert('degree_created emitted inside child')

                }).catch(function (error) {
                    
                    console.log(error)
                    // alert(JSON.stringify(error))

                    window.handleError(error)
                })
                // alert('after axios')
            },

            updateDegree() {

                let self = this

                // console.log('updateDegree -> degree: ' + JSON.stringify(self.degree))

                // alert('updateDegree -> degree: ' + JSON.stringify(self.degree))

                this.axios.put(`/admin/degrees/${self.degreeId}`, self.degree).then(resp => {

                    // console.log(JSON.stringify(resp))

                    // alert(JSON.stringify(resp))

                    $('.close-modal').click()

                    self.$parent.$emit('degree_updated', resp.data)

                    // alert('degree_updated emitted')

                }).catch(e => {

                    console.log(e)

                    window.handleError(e)
                })
            }
        }
    }

</script>
