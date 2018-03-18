<template>

    <div class="modal fade" id="dioceseModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-uppercase text-center" id="exampleModalLabel" v-if="editing">Edit Diocese</h3>
                    <h3 class="modal-title text-uppercase text-center" id="exampleModalLabel" v-else>New Diocese</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form class="form-horizontal" role="form">
            
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="col-sm">
                                <input id="code" type="text" class="form-control" name="code" placeholder="Code" required autofocus v-model="diocese.code">
                        
                                <!--  
                                pattern='[A-Za-z\\s]*'
                                <span v-if="errorsName" class="help-block"><strong>{{ nameError }}</strong></span>
                                -->
                            </div>
                        </div>         

                        <!-- <div class="form-group" :class="{'has-error': errorsName}"> -->
                        <div class="form-group">
                            <div class="col-sm">
                                <input id="name" type="text" class="form-control" name="name" placeholder="Name" required autofocus v-model="diocese.name">
                        
                                <!--  
                                pattern='[A-Za-z\\s]*'
                                <span v-if="errorsName" class="help-block"><strong>{{ nameError }}</strong></span>
                                -->
                            </div>
                        </div>
                        <!--
                        <div class="form-group">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" @click.prevent="createDiocese()" :disabled="!isValidDioceseForm">
                                    Submit
                                </button>
                            </div>
                        </div>
                        -->
                    </div>
                    
                    <div class="modal-footer">                                            

                        <button type="submit" class="btn btn-primary" @click.prevent="updateDiocese()" v-if="editing">Update</button>

                        <button type="submit" class="btn btn-primary" @click.prevent="createDiocese()" v-else>Create</button>

                        <button class="btn btn-secondary close-modal" data-dismiss="modal">Close</button>

                    </div>
                </form>

            </div>
        </div>
    </div>    
</template>

<script>

    class Diocese {

        constructor(diocese) {

            let self = this

            self.code = diocese.code || ''

            self.name = diocese.name || ''
        }

    }

    export default {

        mounted() {

            let self = this

            console.log('Child component mounted.');

            this.$parent.$on('create_diocese', function () {

                // alert('on create_diocese inside child')

                self.editing = false

                self.diocese = new Diocese({})

                self.code = ''

                self.name = ''

                $('#dioceseModal').modal()

            })

            this.$parent.$on('edit_diocese', ({ diocese }) => {

                // alert('on edit_diocese inside child -> ' + JSON.stringify(diocese))

                self.editing = true

                self.diocese = new Diocese(diocese)

                self.name = diocese.name

                self.code = diocese.code

                self.dioceseId = diocese.id

                $('#dioceseModal').modal()

            })
        },

        data() {
            return {

                diocese: {},

                dioceseId: null,

                editing: false
            }
        },
        /*
        computed: {
            
            isValidDioceseForm: function() {
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
                
                if (/^[a-zA-Z]*$/.test(self.dioceseDetails.name)) {
                    return true;
                }
                
                return false
                
            },
            */
            createDiocese() {

                let self = this

                // alert('createDiocese -> diocese:' + JSON.stringify(self.diocese))

                this.axios.post('/admin/dioceses/store', self.diocese).then(function (resp) {

                    // console.log(resp)
                    // alert('resp')

                    // alert('diocese posted')

                    // alert(JSON.stringify(resp))
                    // alert(resp.data.status)                                                                                              
                    
                    $('.close-modal').click()

                    self.$parent.$emit('diocese_created', self.diocese)

                    // alert('diocese_created emitted inside child')

                }).catch(function (error) {
                    
                    console.log(error)
                    // alert(JSON.stringify(error))

                    window.handleError(error)
                })
                // alert('after axios')
            },

            updateDiocese() {

                let self = this

                // console.log('updateDiocese -> diocese: ' + JSON.stringify(self.diocese))

                // alert('updateDiocese -> diocese: ' + JSON.stringify(self.diocese))

                this.axios.put(`/admin/dioceses/${self.dioceseId}`, self.diocese).then(resp => {

                    // console.log(JSON.stringify(resp))

                    // alert(JSON.stringify(resp))

                    $('.close-modal').click()

                    self.$parent.$emit('diocese_updated', resp.data)

                    // alert('diocese_updated emitted')

                }).catch(e => {

                    console.log(e)

                    window.handleError(e)
                })
            }
        }
    }

</script>
