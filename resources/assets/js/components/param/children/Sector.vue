<template>

    <div class="modal fade" id="sectorModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-uppercase text-center" id="exampleModalLabel" v-if="editing">Edit Sector</h3>
                    <h3 class="modal-title text-uppercase text-center" id="exampleModalLabel" v-else>New Sector</h3>
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

                        <!-- Selected province id: {{ province_id }} -->

                        <div class="form-group">
                            <div class="col-sm">
                                <label for="district_id">District</label>
                                <select name="district_id" id="district_id" class="form-control" v-model="sector.district_id">
                                    <!-- <option value="">Select district</option> -->
                                    <option v-for="(value, key) in districts" :value="key">{{ value }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm">
                                <label for="code" v-if="editing">Code</label>
                                <input id="code" type="text" class="form-control" name="code" placeholder="Code" required autofocus v-model="sector.code">
                        
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
                                <input id="name" type="text" class="form-control" name="name" placeholder="Name" required v-model="sector.name">
                        
                                <!--  
                                pattern='[A-Za-z\\s]*'
                                <span v-if="errorsName" class="help-block"><strong>{{ nameError }}</strong></span>
                                -->
                            </div>
                        </div>
                        <!--
                        <div class="form-group">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" @click.prevent="createSector()" :disabled="!isValidSectorForm">
                                    Submit
                                </button>
                            </div>
                        </div>
                        -->
                    </div>
                    
                    <div class="modal-footer">                                            

                        <button type="submit" class="btn btn-primary" @click.prevent="updateSector()" v-if="editing">Update</button>

                        <button type="submit" class="btn btn-primary" @click.prevent="createSector()" v-else>Create</button>

                        <button class="btn btn-secondary close-modal" data-dismiss="modal">Close</button>                        

                    </div>
                </form>

            </div>
        </div>
    </div>    
</template>

<script>

    class Sector {

        constructor(sector) {

            let self = this

            self.district_id = sector.district_id || ''

            self.code = sector.code || ''

            self.name = sector.name || ''
        }

    }

    export default {

        mounted() {

            let self = this

            console.log('Child component mounted.');

            this.$parent.$on('create_sector', () => {

                // alert('on create_sector inside child')

                self.editing = false

                self.sector = new Sector({})

                self.district_id = ''

                self.code = ''

                self.name = ''

                $('#sectorModal').modal()

            })

            this.$parent.$on('edit_sector', ({ sector }) => {

                // alert('on edit_sector inside child -> ' + JSON.stringify(sector))

                self.editing = true

                self.sector = new Sector(sector)

                self.district_id = sector.district_id

                self.code = sector.code

                self.name = sector.name

                self.sectorId = sector.id

                $('#sectorModal').modal()

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

        },

        data() {
            return {

                province_id: 'Select province',

                provinces: {},

                districts: {},

                sector: {},

                sectorId: null,

                editing: false
            }
        },
        
        computed: {
            /*    
            isValidSectorForm: function() {
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
                
                if (/^[a-zA-Z]*$/.test(self.sectorDetails.name)) {
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

            createSector() {

                let self = this

                console.log('createSector -> sector: ' + self.sector)

                // alert('createSector -> sector:' + JSON.stringify(self.sector))

                this.axios.post('/admin/sectors/store', self.sector).then(function (resp) {

                    // alert('sector posted')

                    console.log(resp.data)

                    // alert(JSON.stringify(resp.data))
                    
                    $('.close-modal').click()

                    self.$parent.$emit('sector_created', self.sector)
                    // self.$parent.$emit('sector_created', resp.data)

                    // alert('sector_created emitted inside child')

                }).catch(function (error) {
                    
                    console.log(error)
                    // alert(JSON.stringify(error))

                    window.handleError(error)
                })
                // alert('after axios')
            },

            updateSector() {

                let self = this

                console.log('updateSector -> sector: ' + self.sector)

                // alert('updateSector -> sector: ' + JSON.stringify(self.sector))

                this.axios.put(`/admin/sectors/${self.sectorId}`, self.sector).then(resp => {

                    console.log(resp.data)

                    // alert(JSON.stringify(resp.data))

                    $('.close-modal').click()

                    self.$parent.$emit('sector_updated', self.sector)
                    // self.$parent.$emit('sector_updated', resp.data)

                    // alert('sector_updated emitted')

                }).catch(e => {

                    console.log(e)

                    window.handleError(e)
                })
            }
        }
    }

</script>
