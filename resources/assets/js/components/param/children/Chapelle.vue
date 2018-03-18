<template>

    <div class="modal fade" id="chapelleModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-uppercase text-center" id="exampleModalLabel" v-if="editing">Edit Chapelle</h3>
                    <h3 class="modal-title text-uppercase text-center" id="exampleModalLabel" v-else>New Chapelle</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form class="form-horizontal" role="form">
            
                    <div class="modal-body">

                        <div class="form-group">
                            <div class="col-sm">
                                <label for="diocese_id">Diocese</label>
                                <select name="diocese_id" id="diocese_id" class="form-control" v-model="diocese_id" v-on:change="getParishs">
                                    <!-- <option value="">Select diocese</option> -->
                                    <option v-for="(value, key) in dioceses" :value="key">{{ value }}</option>
                                </select>
                            </div>
                        </div>

                        <!-- Selected diocese id: {{ diocese_id }} -->

                        <div class="form-group">
                            <div class="col-sm">
                                <label for="parish_id">Parish</label>
                                <select name="parish_id" id="parish_id" class="form-control" v-model="chapelle.parish_id">
                                    <!-- <option value="">Select parish</option> -->
                                    <option v-for="(value, key) in parishes" :value="key">{{ value }}</option>
                                </select>
                            </div>
                        </div>             

                        <div class="form-group">
                            <div class="col-sm">
                                <label for="code" v-if="editing">Code</label>
                                <input id="code" type="text" class="form-control" name="code" placeholder="Code" required autofocus v-model="chapelle.code">
                        
                                <!--  
                                pattern='[A-Za-z\\s]*'
                                <span v-if="errorsName" class="help-block"><strong>{{ nameError }}</strong></span>
                                -->
                            </div>
                        </div>                        

                        <!-- <div class="form-group" :class="{'has-error': errorsName}"> -->
                        <div class="form-group">
                            <div class="col-sm">
                                <label for="name" v-if="editing">Name</label>
                                <input id="name" type="text" class="form-control" name="name" placeholder="Name" required v-model="chapelle.name">
                        
                                <!--  
                                pattern='[A-Za-z\\s]*'
                                <span v-if="errorsName" class="help-block"><strong>{{ nameError }}</strong></span>
                                -->
                            </div>
                        </div>
                        <!--
                        <div class="form-group">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" @click.prevent="createChapelle()" :disabled="!isValidChapelleForm">
                                    Submit
                                </button>
                            </div>
                        </div>
                        -->
                    </div>
                    
                    <div class="modal-footer">                                            

                        <button type="submit" class="btn btn-primary" @click.prevent="updateChapelle()" v-if="editing">Update</button>

                        <button type="submit" class="btn btn-primary" @click.prevent="createChapelle()" v-else>Create</button>

                        <button class="btn btn-secondary close-modal" data-dismiss="modal">Close</button>                        

                    </div>
                </form>

            </div>
        </div>
    </div>    
</template>

<script>

    class Chapelle {

        constructor(chapelle) {

            let self = this

            self.parish_id = chapelle.parish_id || ''

            self.code = chapelle.code || ''

            self.name = chapelle.name || ''
        }

    }

    export default {

        mounted() {

            let self = this

            console.log('Child component mounted.');

            this.$parent.$on('create_chapelle', () => {

                // alert('on create_chapelle inside child')

                self.editing = false

                self.chapelle = new Chapelle({})

                self.parish_id = ''

                self.code = ''

                self.name = ''

                $('#chapelleModal').modal()

            })

            this.$parent.$on('edit_chapelle', ({ chapelle }) => {

                // alert('on edit_chapelle inside child -> ' + JSON.stringify(chapelle))

                self.editing = true

                self.chapelle = new Chapelle(chapelle)

                self.parish_id = chapelle.parish_id

                self.code = chapelle.code

                self.name = chapelle.name

                self.chapelleId = chapelle.id

                $('#chapelleModal').modal()

            })

            this.axios.get('/admin/param/dioceses').then(resp => {

                // alert('/admin/param/dioceses')

                // console.log(JSON.stringify(resp))

                // alert(JSON.stringify(resp))

                self.dioceses = resp.data

                // alert('end /admin/param/dioceses')

            }).catch(e => {

                console.log(e)

                window.handleError(e)
            })

            this.axios.get('/admin/param/parishes').then(resp => {                        

                // alert('/admin/param/parishes')

                // console.log(JSON.stringify(resp))

                // alert(JSON.stringify(resp))

                self.parishes = resp.data

                // alert('end /admin/param/parishes')

            }).catch(e => {

                console.log(e)

                window.handleError(e)
            })          

        },

        data() {
            return {

                diocese_id: 'Select diocese',

                dioceses: {},

                parishes: {},

                chapelle: {},

                chapelleId: null,

                editing: false
            }
        },
        
        computed: {
            /*    
            isValidChapelleForm: function() {
                let self = this

                //alert(self.name);
                //return self.name && self.password;
                return self.nameIsValid() && !self.loading;
            },
            */
        },
        
        methods: {
            /*
            nameIsValid: function () {

                let self = this
            
                //alert(self.name);
                
                if (/^[a-zA-Z]*$/.test(self.chapelleDetails.name)) {
                    return true;
                }
                
                return false
                
            },
            */

            getParishs() {

                let self = this

                this.axios.get(`/admin/parishes/get/${self.diocese_id}`).then(resp => {

                    // alert('/admin/param/parishes/get/' + self.diocese_id)

                    // console.log(JSON.stringify(resp))

                    // alert(JSON.stringify(resp))

                    self.parishes = resp.data

                    // alert('end /admin/param/parishes/get')

                }).catch(e => {

                    console.log(e)

                    window.handleError(e)
                })
            },

            createChapelle() {

                let self = this

                console.log('createChapelle -> chapelle: ' + self.chapelle)

                // alert('createChapelle -> chapelle:' + JSON.stringify(self.chapelle))

                this.axios.post('/admin/chapelles/store', self.chapelle).then(function (resp) {

                    // alert('chapelle posted')

                    console.log(resp.data)

                    // alert(JSON.stringify(resp.data))
                    
                    $('.close-modal').click()

                    self.$parent.$emit('chapelle_created', self.chapelle)
                    // self.$parent.$emit('chapelle_created', resp.data)

                    // alert('chapelle_created emitted inside child')

                }).catch(function (error) {
                    
                    console.log(error)
                    // alert(JSON.stringify(error))

                    window.handleError(error)
                })
                // alert('after axios')
            },

            updateChapelle() {

                let self = this

                console.log('updateChapelle -> chapelle: ' + self.chapelle)

                // alert('updateChapelle -> chapelle: ' + JSON.stringify(self.chapelle))

                this.axios.put(`/admin/chapelles/${self.chapelleId}`, self.chapelle).then(resp => {

                    console.log(resp.data)

                    // alert(JSON.stringify(resp.data))

                    $('.close-modal').click()

                    self.$parent.$emit('chapelle_updated', self.chapelle)
                    // self.$parent.$emit('chapelle_updated', resp.data)

                    // alert('chapelle_updated emitted')

                }).catch(e => {

                    console.log(e)

                    window.handleError(e)
                })
            }
        }
    }

</script>
