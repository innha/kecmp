<template>

    <div class="modal fade" id="cellModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-uppercase text-center" id="exampleModalLabel" v-if="editing">Edit Cell</h3>
                    <h3 class="modal-title text-uppercase text-center" id="exampleModalLabel" v-else>New Cell</h3>
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

                        <!-- Selected province id: {{ province_id }} -->

                        <div class="form-group">
                            <div class="col-sm">
                                <label for="sector_id">Sector</label>
                                <select name="sector_id" id="sector_id" class="form-control" v-model="cell.sector_id">
                                    <!-- <option value="">Select district</option> -->
                                    <option v-for="(value, key) in sectors" :value="key">{{ value }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm">
                                <label for="code" v-if="editing">Code</label>
                                <input id="code" type="text" class="form-control" name="code" placeholder="Code" required autofocus v-model="cell.code">
                        
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
                                <input id="name" type="text" class="form-control" name="name" placeholder="Name" required v-model="cell.name">
                        
                                <!--  
                                pattern='[A-Za-z\\s]*'
                                <span v-if="errorsName" class="help-block"><strong>{{ nameError }}</strong></span>
                                -->
                            </div>
                        </div>
                        <!--
                        <div class="form-group">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" @click.prevent="createCell()" :disabled="!isValidCellForm">
                                    Submit
                                </button>
                            </div>
                        </div>
                        -->
                    </div>
                    
                    <div class="modal-footer">                                            

                        <button type="submit" class="btn btn-primary" @click.prevent="updateCell()" v-if="editing">Update</button>

                        <button type="submit" class="btn btn-primary" @click.prevent="createCell()" v-else>Create</button>

                        <button class="btn btn-secondary close-modal" data-dismiss="modal">Close</button>                        

                    </div>
                </form>

            </div>
        </div>
    </div>    
</template>

<script>

    class Cell {

        constructor(cell) {

            let self = this

            self.sector_id = cell.sector_id || ''

            self.code = cell.code || ''

            self.name = cell.name || ''
        }

    }

    export default {

        mounted() {

            let self = this

            console.log('Child component mounted.');

            this.$parent.$on('create_cell', () => {

                // alert('on create_cell inside child')

                self.editing = false

                self.cell = new Cell({})

                self.sector_id = ''

                self.code = ''

                self.name = ''

                $('#cellModal').modal()

            })

            this.$parent.$on('edit_cell', ({ cell }) => {

                // alert('on edit_cell inside child -> ' + JSON.stringify(cell))

                self.editing = true

                self.cell = new Cell(cell)

                self.sector_id = cell.sector_id

                self.code = cell.code

                self.name = cell.name

                self.cellId = cell.id

                $('#cellModal').modal()

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

        },

        data() {
            return {

                province_id: 'Select province',

                district_id: 'Select district',

                provinces: {},

                districts: {},

                sectors: {},

                cell: {},

                cellId: null,

                editing: false
            }
        },
        
        computed: {
            /*    
            isValidCellForm: function() {
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
                
                if (/^[a-zA-Z]*$/.test(self.cellDetails.name)) {
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

            createCell() {

                let self = this

                console.log('createCell -> cell: ' + self.cell)

                // alert('createCell -> cell:' + JSON.stringify(self.cell))

                this.axios.post('/admin/cells/store', self.cell).then(function (resp) {

                    // alert('cell posted')

                    console.log(resp.data)

                    // alert(JSON.stringify(resp.data))
                    
                    $('.close-modal').click()

                    self.$parent.$emit('cell_created', self.cell)
                    // self.$parent.$emit('cell_created', resp.data)

                    // alert('cell_created emitted inside child')

                }).catch(function (error) {
                    
                    console.log(error)
                    // alert(JSON.stringify(error))

                    window.handleError(error)
                })
                // alert('after axios')
            },

            updateCell() {

                let self = this

                console.log('updateCell -> cell: ' + self.cell)

                // alert('updateCell -> cell: ' + JSON.stringify(self.cell))

                this.axios.put(`/admin/cells/${self.cellId}`, self.cell).then(resp => {

                    console.log(resp.data)

                    // alert(JSON.stringify(resp.data))

                    $('.close-modal').click()

                    self.$parent.$emit('cell_updated', self.cell)
                    // self.$parent.$emit('cell_updated', resp.data)

                    // alert('cell_updated emitted')

                }).catch(e => {

                    console.log(e)

                    window.handleError(e)
                })
            }
        }
    }

</script>
