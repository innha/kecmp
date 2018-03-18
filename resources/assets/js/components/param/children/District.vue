<template>

    <div class="modal fade" id="districtModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-uppercase text-center" id="exampleModalLabel" v-if="editing">Edit District</h3>
                    <h3 class="modal-title text-uppercase text-center" id="exampleModalLabel" v-else>New District</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form class="form-horizontal" role="form">
            
                    <div class="modal-body">

                        <div class="form-group">
                            <div class="col-sm">
                                <label for="province" v-if="editing">Province</label>
                                <select name="province_id" id="province_id" class="form-control" v-model="district.province_id">
                                    <option value="">Select province</option>
                                    <option v-for="(value, key) in provinces" :value="key">{{ value }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm">
                                <label for="code" v-if="editing">Code</label>
                                <input id="code" type="text" class="form-control" name="code" placeholder="Code" required autofocus v-model="district.code">
                        
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
                                <input id="name" type="text" class="form-control" name="name" placeholder="Name" required autofocus v-model="district.name">
                        
                                <!--  
                                pattern='[A-Za-z\\s]*'
                                <span v-if="errorsName" class="help-block"><strong>{{ nameError }}</strong></span>
                                -->
                            </div>
                        </div>
                        <!--
                        <div class="form-group">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" @click.prevent="createDistrict()" :disabled="!isValidDistrictForm">
                                    Submit
                                </button>
                            </div>
                        </div>
                        -->
                    </div>
                    
                    <div class="modal-footer">                                            

                        <button type="submit" class="btn btn-primary" @click.prevent="updateDistrict()" v-if="editing">Update</button>

                        <button type="submit" class="btn btn-primary" @click.prevent="createDistrict()" v-else>Create</button>

                        <button class="btn btn-secondary close-modal" data-dismiss="modal">Close</button>

                    </div>
                </form>

            </div>
        </div>
    </div>    
</template>

<script>

    class District {

        constructor(district) {

            let self = this

            self.province_id = district.province_id || ''

            self.code = district.code || ''

            self.name = district.name || ''
        }

    }

    export default {

        mounted() {

            let self = this

            console.log('Child component mounted.');

            this.$parent.$on('create_district', () => {

                // alert('on create_district inside child')

                self.editing = false

                self.district = new District({})

                self.province_id = ''

                self.code = ''

                self.name = ''

                $('#districtModal').modal()

            })

            this.$parent.$on('edit_district', ({ district }) => {

                // alert('on edit_district inside child -> ' + JSON.stringify(district))

                self.editing = true

                self.district = new District(district)

                self.province_id = district.province_id

                self.name = district.name

                self.code = district.code

                self.districtId = district.id

                $('#districtModal').modal()

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

        },

        data() {
            return {

                provinces: {},

                district: {},

                districtId: null,

                editing: false
            }
        },
        /*
        computed: {
            
            isValidDistrictForm: function() {
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
                
                if (/^[a-zA-Z]*$/.test(self.districtDetails.name)) {
                    return true;
                }
                
                return false
                
            },
            */
            createDistrict() {

                let self = this

                console.log('createDistrict -> district: ' + self.district)

                // alert('createDistrict -> district:' + JSON.stringify(self.district))

                this.axios.post('/admin/districts/store', self.district).then(function (resp) {

                    // alert('district posted')

                    console.log(resp.data)

                    // alert(JSON.stringify(resp.data))
                    
                    $('.close-modal').click()

                    self.$parent.$emit('district_created', self.district)
                    // self.$parent.$emit('district_created', resp.data)

                    // alert('district_created emitted inside child')

                }).catch(function (error) {
                    
                    console.log(error)
                    // alert(JSON.stringify(error))

                    window.handleError(error)
                })
                // alert('after axios')
            },

            updateDistrict() {

                let self = this

                console.log('updateDistrict -> district: ' + self.district)

                // alert('updateDistrict -> district: ' + JSON.stringify(self.district))

                this.axios.put(`/admin/districts/${self.districtId}`, self.district).then(resp => {

                    console.log(resp.data)

                    // alert(JSON.stringify(resp.data))

                    $('.close-modal').click()

                    self.$parent.$emit('district_updated', self.district)
                    // self.$parent.$emit('district_updated', resp.data)

                    // alert('district_updated emitted')

                }).catch(e => {

                    console.log(e)

                    window.handleError(e)
                })
            }
        }
    }

</script>
