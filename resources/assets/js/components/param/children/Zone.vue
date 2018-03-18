<template>

    <div class="modal fade" id="zoneModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-uppercase text-center" id="exampleModalLabel" v-if="editing">Edit Zone</h3>
                    <h3 class="modal-title text-uppercase text-center" id="exampleModalLabel" v-else>New Zone</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form class="form-horizontal" role="form">
            
                    <div class="modal-body">

                        <div class="form-group">
                            <div class="col-sm">
                                <label for="diocese_id">Diocese</label>
                                <select name="diocese_id" id="diocese_id" class="form-control" v-model="diocese_id" v-on:change="getParishes">
                                    <!-- <option value="">Select diocese</option> -->
                                    <option v-for="(value, key) in dioceses" :value="key">{{ value }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm">
                                <label for="parish_id">Parish</label>
                                <select name="parish_id" id="parish_id" class="form-control" v-model="parish_id" v-on:change="getChapelles">
                                    <!-- <option value="">Select diocese</option> -->
                                    <option v-for="(value, key) in parishes" :value="key">{{ value }}</option>
                                </select>
                            </div>
                        </div>                        

                        <!-- Selected diocese id: {{ diocese_id }} -->

                        <div class="form-group">
                            <div class="col-sm">
                                <label for="chapelle_id">Chapelle</label>
                                <select name="chapelle_id" id="chapelle_id" class="form-control" v-model="zone.chapelle_id">
                                    <!-- <option value="">Select parish</option> -->
                                    <option v-for="(value, key) in chapelles" :value="key">{{ value }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm">
                                <label for="code" v-if="editing">Code</label>
                                <input id="code" type="text" class="form-control" name="code" placeholder="Code" required autofocus v-model="zone.code">
                        
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
                                <input id="name" type="text" class="form-control" name="name" placeholder="Name" required v-model="zone.name">
                        
                                <!--  
                                pattern='[A-Za-z\\s]*'
                                <span v-if="errorsName" class="help-block"><strong>{{ nameError }}</strong></span>
                                -->
                            </div>
                        </div>
                        <!--
                        <div class="form-group">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" @click.prevent="createZone()" :disabled="!isValidZoneForm">
                                    Submit
                                </button>
                            </div>
                        </div>
                        -->
                    </div>
                    
                    <div class="modal-footer">                                            

                        <button type="submit" class="btn btn-primary" @click.prevent="updateZone()" v-if="editing">Update</button>

                        <button type="submit" class="btn btn-primary" @click.prevent="createZone()" v-else>Create</button>

                        <button class="btn btn-secondary close-modal" data-dismiss="modal">Close</button>                        

                    </div>
                </form>

            </div>
        </div>
    </div>    
</template>

<script>

    class Zone {

        constructor(zone) {

            let self = this

            self.chapelle_id = zone.chapelle_id || ''

            self.code = zone.code || ''

            self.name = zone.name || ''
        }

    }

    export default {

        mounted() {

            let self = this

            console.log('Child component mounted.');

            this.$parent.$on('create_zone', () => {

                // alert('on create_zone inside child')

                self.editing = false

                self.zone = new Zone({})

                self.chapelle_id = ''

                self.code = ''

                self.name = ''

                $('#zoneModal').modal()

            })

            this.$parent.$on('edit_zone', ({ zone }) => {

                // alert('on edit_zone inside child -> ' + JSON.stringify(zone))

                self.editing = true

                self.zone = new Zone(zone)

                self.chapelle_id = zone.chapelle_id

                self.code = zone.code

                self.name = zone.name

                self.zoneId = zone.id

                $('#zoneModal').modal()

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

            this.axios.get('/admin/param/chapelles').then(resp => {                        

                // alert('/admin/param/chapelles')

                // console.log(JSON.stringify(resp))

                // alert(JSON.stringify(resp))

                self.chapelles = resp.data

                // alert('end /admin/param/chapelles')

            }).catch(e => {

                console.log(e)

                window.handleError(e)
            })            

        },

        data() {
            return {

                diocese_id: 'Select diocese',

                parish_id: 'Select parish',

                dioceses: {},

                parishes: {},

                chapelles: {},

                zone: {},

                zoneId: null,

                editing: false
            }
        },
        
        computed: {
            /*    
            isValidZoneForm: function() {
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
                
                if (/^[a-zA-Z]*$/.test(self.zoneDetails.name)) {
                    return true;
                }
                
                return false
                
            },
            */

            getParishes() {

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

            getChapelles() {

                let self = this

                this.axios.get(`/admin/chapelles/get/${self.parish_id}`).then(resp => {

                    // alert('/admin/param/parishes/get/' + self.diocese_id)

                    // console.log(JSON.stringify(resp))

                    // alert(JSON.stringify(resp))

                    self.chapelles = resp.data

                    // alert('end /admin/param/parishes/get')

                }).catch(e => {

                    console.log(e)

                    window.handleError(e)
                })
            },

            createZone() {

                let self = this

                console.log('createZone -> zone: ' + self.zone)

                // alert('createZone -> zone:' + JSON.stringify(self.zone))

                this.axios.post('/admin/zones/store', self.zone).then(function (resp) {

                    // alert('zone posted')

                    console.log(resp.data)

                    // alert(JSON.stringify(resp.data))
                    
                    $('.close-modal').click()

                    self.$parent.$emit('zone_created', self.zone)
                    // self.$parent.$emit('zone_created', resp.data)

                    // alert('zone_created emitted inside child')

                }).catch(function (error) {
                    
                    console.log(error)
                    // alert(JSON.stringify(error))

                    window.handleError(error)
                })
                // alert('after axios')
            },

            updateZone() {

                let self = this

                console.log('updateZone -> zone: ' + self.zone)

                // alert('updateZone -> zone: ' + JSON.stringify(self.zone))

                this.axios.put(`/admin/zones/${self.zoneId}`, self.zone).then(resp => {

                    console.log(resp.data)

                    // alert(JSON.stringify(resp.data))

                    $('.close-modal').click()

                    self.$parent.$emit('zone_updated', self.zone)
                    // self.$parent.$emit('zone_updated', resp.data)

                    // alert('zone_updated emitted')

                }).catch(e => {

                    console.log(e)

                    window.handleError(e)
                })
            }
        }
    }

</script>
