<template>

    <div class="modal fade" id="villageModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-uppercase text-center" id="exampleModalLabel" v-if="editing">Edit Village</h3>
                    <h3 class="modal-title text-uppercase text-center" id="exampleModalLabel" v-else>New Village</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form class="form-horizontal" role="form">
            
                    <div class="modal-body">

                        <div class="form-group">
                            <div class="col-sm">
                                <label for="province_id">Province</label>
                                <select name="province_id" id="province_id" class="form-control" v-model="province_id" v-on:change="getDistricts">
                                    <!-- <option value="">Select province</option> -->
                                    <option v-for="(value, key) in provinces" :value="key">{{ value }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm">
                                <label for="district_id">District</label>
                                <select name="district_id" id="district_id" class="form-control" v-model="district_id" v-on:change="getSectors">
                                    <!-- <option value="">Select province</option> -->
                                    <option v-for="(value, key) in districts" :value="key">{{ value }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm">
                                <label for="sector_id">Sectors</label>
                                <select name="sector_id" id="district_id" class="form-control" v-model="sector_id" v-on:change="getCells">
                                    <!-- <option value="">Select province</option> -->
                                    <option v-for="(value, key) in sectors" :value="key">{{ value }}</option>
                                </select>
                            </div>
                        </div>

                        <!-- Selected province id: {{ province_id }} -->

                        <div class="form-group">
                            <div class="col-sm">
                                <label for="cell_id">Cell</label>
                                <select name="cell_id" id="sector_id" class="form-control" v-model="village.cell_id">
                                    <!-- <option value="">Select district</option> -->
                                    <option v-for="(value, key) in cells" :value="key">{{ value }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm">
                                <label for="code" v-if="editing">Code</label>
                                <input id="code" type="text" class="form-control" name="code" placeholder="Code" required autofocus v-model="village.code">
                        
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
                                <input id="name" type="text" class="form-control" name="name" placeholder="Name" required v-model="village.name">
                        
                                <!--  
                                pattern='[A-Za-z\\s]*'
                                <span v-if="errorsName" class="help-block"><strong>{{ nameError }}</strong></span>
                                -->
                            </div>
                        </div>
                        <!--
                        <div class="form-group">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" @click.prevent="createVillage()" :disabled="!isValidVillageForm">
                                    Submit
                                </button>
                            </div>
                        </div>
                        -->
                    </div>
                    
                    <div class="modal-footer">                                            

                        <button type="submit" class="btn btn-primary" @click.prevent="updateVillage()" v-if="editing">Update</button>

                        <button type="submit" class="btn btn-primary" @click.prevent="createVillage()" v-else>Create</button>

                        <button class="btn btn-secondary close-modal" data-dismiss="modal">Close</button>                        

                    </div>
                </form>

            </div>
        </div>
    </div>    
</template>

<script>

    class Village {

        constructor(village) {

            let self = this

            self.cell_id = village.cell_id || ''

            self.code = village.code || ''

            self.name = village.name || ''
        }

    }

    export default {

        mounted() {

            let self = this

            console.log('Child component mounted.');

            this.$parent.$on('create_village', () => {

                // alert('on create_village inside child')

                self.editing = false

                self.village = new Village({})

                self.cell_id = ''

                self.code = ''

                self.name = ''

                $('#villageModal').modal()

            })

            this.$parent.$on('edit_village', ({ village }) => {

                // alert('on edit_village inside child -> ' + JSON.stringify(village))

                self.editing = true

                self.village = new Village(village)

                self.cell_id = village.cell_id

                self.code = village.code

                self.name = village.name

                self.villageId = village.id

                $('#villageModal').modal()

            })

            this.axios.get('/admin/param/provinces').then(resp => {

                // alert('/admin/param/provinces')

                // console.log(JSON.stringify(resp))

                // alert(JSON.stringify(resp))

                self.provinces = resp.data

                // alert('end /admin/param/provinces')

            }).catch(e => {

                console.log(e)

                window.handleError(e)
            })

            this.axios.get('/admin/param/districts').then(resp => {                        

                // alert('/admin/param/districts')

                // console.log(JSON.stringify(resp))

                // alert(JSON.stringify(resp))

                self.districts = resp.data

                // alert('end /admin/param/districts')

            }).catch(e => {

                console.log(e)

                window.handleError(e)
            })

            this.axios.get('/admin/param/sectors').then(resp => {                        

                // alert('/admin/param/sectors')

                // console.log(JSON.stringify(resp))

                // alert(JSON.stringify(resp))

                self.sectors = resp.data

                // alert('end /admin/param/sectors')

            }).catch(e => {

                console.log(e)

                window.handleError(e)
            })

            this.axios.get('/admin/param/cells').then(resp => {                        

                // alert('/admin/param/cells')

                // console.log(JSON.stringify(resp))

                // alert(JSON.stringify(resp))

                self.cells = resp.data

                // alert('end /admin/param/cells')

            }).catch(e => {

                console.log(e)

                window.handleError(e)
            })            

        },

        data() {
            return {

                province_id: 'Select province',

                district_id: 'Select district',

                sector_id: 'Select sector',

                cell_id: 'Select cell',

                provinces: {},

                districts: {},

                sectors: {},

                cells: {},

                village: {},

                villageId: null,

                editing: false
            }
        },
        
        computed: {
            /*    
            isValidVillageForm: function() {
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
                
                if (/^[a-zA-Z]*$/.test(self.villageDetails.name)) {
                    return true;
                }
                
                return false
                
            },
            */

            getDistricts() {

                let self = this

                this.axios.get(`/admin/districts/get/${self.province_id}`).then(resp => {

                    // alert('/admin/param/districts/get/' + self.province_id)

                    // console.log(JSON.stringify(resp))

                    // alert(JSON.stringify(resp))

                    self.districts = resp.data

                    // alert('end /admin/param/districts/get')

                }).catch(e => {

                    console.log(e)

                    window.handleError(e)
                })
            },

            getSectors() {

                let self = this

                this.axios.get(`/admin/sectors/get/${self.district_id}`).then(resp => {

                    // alert('/admin/param/districts/get/' + self.province_id)

                    // console.log(JSON.stringify(resp))

                    // alert(JSON.stringify(resp))

                    self.sectors = resp.data

                    // alert('end /admin/param/districts/get')

                }).catch(e => {

                    console.log(e)

                    window.handleError(e)
                })
            },

            getCells() {

                let self = this

                this.axios.get(`/admin/cells/get/${self.sector_id}`).then(resp => {

                    // alert('/admin/param/cells/get/' + self.sector_id)

                    // console.log(JSON.stringify(resp))

                    // alert(JSON.stringify(resp))

                    self.cells = resp.data

                    // alert('end /admin/param/cells/get')

                }).catch(e => {

                    console.log(e)

                    window.handleError(e)
                })
            },            

            createVillage() {

                let self = this

                console.log('createVillage -> village: ' + self.village)

                // alert('createVillage -> village:' + JSON.stringify(self.village))

                this.axios.post('/admin/villages/store', self.village).then(function (resp) {

                    // alert('village posted')

                    console.log(resp.data)

                    // alert(JSON.stringify(resp.data))
                    
                    $('.close-modal').click()

                    self.$parent.$emit('village_created', self.village)
                    // self.$parent.$emit('village_created', resp.data)

                    // alert('village_created emitted inside child')

                }).catch(function (error) {
                    
                    console.log(error)
                    // alert(JSON.stringify(error))

                    window.handleError(error)
                })
                // alert('after axios')
            },

            updateVillage() {

                let self = this

                console.log('updateVillage -> village: ' + self.village)

                // alert('updateVillage -> village: ' + JSON.stringify(self.village))

                this.axios.put(`/admin/villages/${self.villageId}`, self.village).then(resp => {

                    console.log(resp.data)

                    // alert(JSON.stringify(resp.data))

                    $('.close-modal').click()

                    self.$parent.$emit('village_updated', self.village)
                    // self.$parent.$emit('village_updated', resp.data)

                    // alert('village_updated emitted')

                }).catch(e => {

                    console.log(e)

                    window.handleError(e)
                })
            }
        }
    }

</script>
