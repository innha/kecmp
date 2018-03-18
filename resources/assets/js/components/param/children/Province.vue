<template>

    <div class="modal fade" id="provinceModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-uppercase text-center" id="exampleModalLabel" v-if="editing">Edit Province</h3>
                    <h3 class="modal-title text-uppercase text-center" id="exampleModalLabel" v-else>New Province</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form class="form-horizontal" role="form">
            
                    <div class="modal-body"> 
                        <div class="form-group">
                            <div class="col-sm">
                                <input id="code" type="text" class="form-control" name="code" placeholder="Code" required autofocus v-model="province.code">
                        
                                <!--  
                                pattern='[A-Za-z\\s]*'
                                <span v-if="errorsName" class="help-block"><strong>{{ nameError }}</strong></span>
                                -->
                            </div>
                        </div>

                        <!-- <div class="form-group" :class="{'has-error': errorsName}"> -->
                        <div class="form-group">
                            <div class="col-sm">
                                <input id="name" type="text" class="form-control form-control" name="name" required autofocus v-model="province.name">
                        
                                <!--  
                                pattern='[A-Za-z\\s]*'
                                <span v-if="errorsName" class="help-block"><strong>{{ nameError }}</strong></span>
                                -->
                            </div>
                        </div>
                        <!--
                        <div class="form-group">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" @click.prevent="createProvince()" :disabled="!isValidProvinceForm">
                                    Submit
                                </button>
                            </div>
                        </div>
                        -->
                    </div>
                    
                    <div class="modal-footer">                                            

                        <button type="submit" class="btn btn-primary" @click.prevent="updateProvince()" v-if="editing">Update</button>

                        <button type="submit" class="btn btn-primary" @click.prevent="createProvince()" v-else>Create</button>

                        <button class="btn btn-secondary close-modal" data-dismiss="modal">Close</button>

                    </div>
                </form>

            </div>
        </div>
    </div>    
</template>

<script>

    class Province {

        constructor(province) {

            let self = this

            self.code = province.code || ''

            self.name = province.name || ''
        }

    }

    export default {

        mounted() {

            let self = this

            console.log('Child component mounted.');

            this.$parent.$on('create_province', function () {

                // alert('on create_province inside child')

                self.editing = false

                self.province = new Province({})

                self.code = ''

                self.name = ''

                $('#provinceModal').modal()

            })

            this.$parent.$on('edit_province', ({ province }) => {

                // alert('on edit_province inside child -> ' + JSON.stringify(province))

                self.editing = true

                self.province = new Province(province)

                self.name = province.name

                self.code = province.code

                self.provinceId = province.id

                $('#provinceModal').modal()

            })
        },

        data() {
            return {

                province: {},

                provinceId: null,

                editing: false
            }
        },
        /*
        computed: {
            
            isValidProvinceForm: function() {
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
                
                if (/^[a-zA-Z]*$/.test(self.provinceDetails.name)) {
                    return true;
                }
                
                return false
                
            },
            */
            createProvince() {

                let self = this

                // alert('createProvince -> province:' + JSON.stringify(self.province))

                this.axios.post('/admin/provinces/store', self.province).then(function (resp) {

                    // console.log(resp)
                    // alert('resp')

                    // alert('province posted')

                    // alert(JSON.stringify(resp))
                    // alert(resp.data.status)                                                                                              
                    
                    $('.close-modal').click()

                    self.$parent.$emit('province_created', self.province)

                    // alert('province_created emitted inside child')

                }).catch(function (error) {
                    
                    console.log(error)
                    // alert(JSON.stringify(error))

                    window.handleError(error)
                })
                // alert('after axios')
            },

            updateProvince() {

                let self = this

                // console.log('updateProvince -> province: ' + JSON.stringify(self.province))

                // alert('updateProvince -> province: ' + JSON.stringify(self.province))

                this.axios.put(`/admin/provinces/${self.provinceId}`, self.province).then(resp => {

                    // console.log(JSON.stringify(resp))

                    // alert(JSON.stringify(resp))

                    $('.close-modal').click()

                    self.$parent.$emit('province_updated', resp.data)

                    // alert('province_updated emitted')

                }).catch(e => {

                    console.log(e)

                    window.handleError(e)
                })
            }
        }
    }

</script>
