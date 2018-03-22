<template>

    <div class="modal fade" id="parishModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-uppercase text-center" id="exampleModalLabel" v-if="editing">Edit Parish</h3>
                    <h3 class="modal-title text-uppercase text-center" id="exampleModalLabel" v-else>New Parish</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form class="form-horizontal" role="form">
            
                    <div class="modal-body">

                        <div class="form-group">
                            <div class="col-sm">
                                <label for="diocese" v-if="editing">Diocese</label>
                                <select name="diocese_id" id="diocese_id" class="form-control" v-model="parish.diocese_id">
                                    <option value="">Select diocese</option>
                                    <option v-for="(value, key) in dioceses" :value="key">{{ value }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm">
                                <label for="district" v-if="editing">District</label>
                                <select name="district_id" id="district_id" class="form-control" v-model="parish.district_id">
                                    <option value="">Select district</option>
                                    <option v-for="(value, key) in districts" :value="key">{{ value }}</option>
                                </select>
                            </div>
                        </div>                        

                        <div class="form-group">
                            <div class="col-sm">
                                <label for="code" v-if="editing">Code</label>
                                <input id="code" type="text" class="form-control" name="code" placeholder="Code" required autofocus v-model="parish.code">
                        
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
                                <input id="name" type="text" class="form-control" name="name" placeholder="Name" required v-model="parish.name">
                        
                                <!--  
                                pattern='[A-Za-z\\s]*'
                                <span v-if="errorsName" class="help-block"><strong>{{ nameError }}</strong></span>
                                -->
                            </div>
                        </div>
                        <!--
                        <div class="form-group">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" @click.prevent="createParish()" :disabled="!isValidParishForm">
                                    Submit
                                </button>
                            </div>
                        </div>
                        -->
                    </div>
                    
                    <div class="modal-footer">                                            

                        <button type="submit" class="btn btn-primary" @click.prevent="updateParish()" v-if="editing">Update</button>

                        <button type="submit" class="btn btn-primary" @click.prevent="createParish()" v-else>Create</button>

                        <button class="btn btn-secondary close-modal" data-dismiss="modal">Close</button>

                    </div>
                </form>

            </div>
        </div>
    </div>    
</template>

<script>

    class Parish {

        constructor(parish) {

            let self = this

            self.diocese_id = parish.diocese_id || ''

            self.district_id = parish.district_id || ''

            self.code = parish.code || ''

            self.name = parish.name || ''
        }

    }

    export default {

        mounted() {

            let self = this

            console.log('Child component mounted.');

            this.$parent.$on('create_parish', () => {

                // alert('on create_parish inside child')

                self.editing = false

                self.parish = new Parish({})

                self.diocese_id = ''

                self.district_id = ''                

                self.code = ''

                self.name = ''

                $('#parishModal').modal()

            })

            this.$parent.$on('edit_parish', ({ parish }) => {

                // alert('on edit_parish inside child -> ' + JSON.stringify(parish))

                self.editing = true

                self.parish = new Parish(parish)

                self.diocese_id = parish.diocese_id

                self.district_id = parish.district_id

                self.code = parish.code

                self.name = parish.name

                self.parishId = parish.id

                $('#parishModal').modal()

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

            this.axios.get('/admin/param/districts').then(resp => {

                // alert('/admin/param/dioceses')

                // console.log(JSON.stringify(resp))

                // alert(JSON.stringify(resp))

                self.districts = resp.data

                // alert('end /admin/param/dioceses')

            }).catch(e => {

                console.log(e)

                window.handleError(e)
            })
        },

        data() {
            return {

                dioceses: {},

                districts: {},

                parish: {},

                parishId: null,

                editing: false
            }
        },
        /*
        computed: {
            
            isValidParishForm: function() {
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
                
                if (/^[a-zA-Z]*$/.test(self.parishDetails.name)) {
                    return true;
                }
                
                return false
                
            },
            */
            createParish() {

                let self = this

                console.log('createParish -> parish: ' + self.parish)

                // alert('createParish -> parish:' + JSON.stringify(self.parish))

                this.axios.post('/admin/parishes/store', self.parish).then(function (resp) {

                    // alert('parish posted')

                    console.log(resp.data)

                    // alert(JSON.stringify(resp.data))
                    
                    $('.close-modal').click()

                    self.$parent.$emit('parish_created', self.parish)
                    // self.$parent.$emit('parish_created', resp.data)

                    // alert('parish_created emitted inside child')

                }).catch(function (error) {
                    
                    console.log(error)
                    // alert(JSON.stringify(error))

                    window.handleError(error)
                })
                // alert('after axios')
            },

            updateParish() {

                let self = this

                console.log('updateParish -> parish: ' + self.parish)

                // alert('updateParish -> parish: ' + JSON.stringify(self.parish))

                this.axios.put(`/admin/parishes/${self.parishId}`, self.parish).then(resp => {

                    console.log(resp.data)

                    // alert(JSON.stringify(resp.data))

                    $('.close-modal').click()

                    self.$parent.$emit('parish_updated', self.parish)
                    // self.$parent.$emit('parish_updated', resp.data)

                    // alert('parish_updated emitted')

                }).catch(e => {

                    console.log(e)

                    window.handleError(e)
                })
            }
        }
    }

</script>
