<template>

    <div class="modal fade" id="choirModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-uppercase text-center" id="exampleModalLabel" v-if="editing">Edit Choir</h3>
                    <h3 class="modal-title text-uppercase text-center" id="exampleModalLabel" v-else>New Choir</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form class="form-horizontal" role="form">
            
                    <div class="modal-body">            
                        <!-- <div class="form-group" :class="{'has-error': errorsName}"> -->
                        <div class="form-group">
                            <div class="col-sm">
                                <input id="name" type="text" class="form-control form-control" name="name" placeholder="Name" required autofocus v-model="choir.name">
                        
                                <!--  
                                pattern='[A-Za-z\\s]*'
                                <span v-if="errorsName" class="help-block"><strong>{{ nameError }}</strong></span>
                                -->
                            </div>
                        </div>
                        <!--
                        <div class="form-group">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" @click.prevent="createChoir()" :disabled="!isValidChoirForm">
                                    Submit
                                </button>
                            </div>
                        </div>
                        -->                    

                        <div class="form-group">
                            <div class="col-sm">
                                <textarea id="equipment" class="form-control" rows="3" placeholder="Equipment" v-model="choir.equipment">
                                </textarea>
                        
                                <!--  
                                pattern='[A-Za-z\\s]*'
                                <span v-if="errorsName" class="help-block"><strong>{{ nameError }}</strong></span>
                                -->
                            </div>
                        </div>
                        <!--
                        <div class="form-group">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" @click.prevent="createChoir()" :disabled="!isValidChoirForm">
                                    Submit
                                </button>
                            </div>
                        </div>
                        -->
                    </div>                    
                    
                    <div class="modal-footer">                                            

                        <button type="submit" class="btn btn-primary" @click.prevent="updateChoir()" v-if="editing">Update</button>

                        <button type="submit" class="btn btn-primary" @click.prevent="createChoir()" v-else>Create</button>

                        <button class="btn btn-secondary close-modal" data-dismiss="modal">Close</button>

                    </div>
                </form>

            </div>
        </div>
    </div>    
</template>

<script>

    class Choir {

        constructor(choir) {

            let self = this

            self.name = choir.name || ''

            self.equipment = choir.equipment || ''
        }

    }

    export default {

        mounted() {

            let self = this

            console.log('Child component mounted.');

            this.$parent.$on('create_choir', function () {

                // alert('on create_choir inside child')

                self.editing = false

                self.choir = new Choir({})

                self.name = ''

                self.equipment = ''

                $('#choirModal').modal()

            })

            this.$parent.$on('edit_choir', ({ choir }) => {

                // alert('on edit_choir inside child -> ' + JSON.stringify(choir))

                self.editing = true

                self.choir = new Choir(choir)

                self.name = choir.name

                self.equipment = choir.equipment

                self.choirId = choir.id

                $('#choirModal').modal()

            })
        },

        data() {
            return {

                choir: {},

                choirId: null,

                editing: false
            }
        },
        /*
        computed: {
            
            isValidChoirForm: function() {
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
                
                if (/^[a-zA-Z]*$/.test(self.choirDetails.name)) {
                    return true;
                }
                
                return false
                
            },
            */
            createChoir() {

                let self = this

                // alert('createChoir -> choir:' + JSON.stringify(self.choir))

                this.axios.post('/admin/choirs/store', self.choir).then(function (resp) {

                    // console.log(resp)
                    // alert('resp')

                    // alert('choir posted')

                    // alert(JSON.stringify(resp))
                    // alert(resp.data.status)                                                                                              
                    
                    $('.close-modal').click()

                    self.$parent.$emit('choir_created', self.choir)

                    // alert('choir_created emitted inside child')

                }).catch(function (error) {
                    
                    console.log(error)
                    // alert(JSON.stringify(error))

                    window.handleError(error)
                })
                // alert('after axios')
            },

            updateChoir() {

                let self = this

                // console.log('updateChoir -> choir: ' + JSON.stringify(self.choir))

                // alert('updateChoir -> choir: ' + JSON.stringify(self.choir))

                this.axios.put(`/admin/choirs/${self.choirId}`, self.choir).then(resp => {

                    // console.log(JSON.stringify(resp))

                    // alert(JSON.stringify(resp))

                    $('.close-modal').click()

                    self.$parent.$emit('choir_updated', resp.data)

                    // alert('choir_updated emitted')

                }).catch(e => {

                    console.log(e)

                    window.handleError(e)
                })
            }
        }
    }

</script>
