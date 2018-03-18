<template>

    <div class="modal fade" id="taskModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-uppercase text-center" id="exampleModalLabel" v-if="editing">Edit Task</h3>
                    <h3 class="modal-title text-uppercase text-center" id="exampleModalLabel" v-else>New Task</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form class="form-horizontal" role="form">
            
                    <div class="modal-body">            
                        <!-- <div class="form-group" :class="{'has-error': errorsName}"> -->
                        <div class="form-group">
                            <div class="col-sm">
                                <input id="name" type="text" class="form-control form-control" name="name" required autofocus v-model="task.name">
                        
                                <!--  
                                pattern='[A-Za-z\\s]*'
                                <span v-if="errorsName" class="help-block"><strong>{{ nameError }}</strong></span>
                                -->
                            </div>
                        </div>
                        <!--
                        <div class="form-group">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" @click.prevent="createTask()" :disabled="!isValidTaskForm">
                                    Submit
                                </button>
                            </div>
                        </div>
                        -->
                    </div>
                    
                    <div class="modal-footer">                                            

                        <button type="submit" class="btn btn-primary" @click.prevent="updateTask()" v-if="editing">Update</button>

                        <button type="submit" class="btn btn-primary" @click.prevent="createTask()" v-else>Create</button>

                        <button class="btn btn-secondary close-modal" data-dismiss="modal">Close</button>

                    </div>
                </form>

            </div>
        </div>
    </div>    
</template>

<script>

    class Task {

        constructor(task) {

            let self = this

            self.name = task.name || ''
        }

    }

    export default {

        mounted() {

            let self = this

            console.log('Child component mounted.');

            this.$parent.$on('create_task', function () {

                // alert('on create_task inside child')

                self.editing = false

                self.task = new Task({})

                self.name = ''

                $('#taskModal').modal()

            })

            this.$parent.$on('edit_task', ({ task }) => {

                // alert('on edit_task inside child -> ' + JSON.stringify(task))

                self.editing = true

                self.task = new Task(task)

                self.name = task.name

                self.taskId = task.id

                $('#taskModal').modal()

            })
        },

        data() {
            return {

                task: {},

                taskId: null,

                editing: false
            }
        },
        /*
        computed: {
            
            isValidTaskForm: function() {
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
                
                if (/^[a-zA-Z]*$/.test(self.taskDetails.name)) {
                    return true;
                }
                
                return false
                
            },
            */
            createTask() {

                let self = this

                // alert('createTask -> task:' + JSON.stringify(self.task))

                this.axios.post('/admin/tasks/store', self.task).then(function (resp) {

                    // console.log(resp)
                    // alert('resp')

                    // alert('task posted')

                    // alert(JSON.stringify(resp))
                    // alert(resp.data.status)                                                                                              
                    
                    $('.close-modal').click()

                    self.$parent.$emit('task_created', self.task)

                    // alert('task_created emitted inside child')

                }).catch(function (error) {
                    
                    console.log(error)
                    // alert(JSON.stringify(error))

                    window.handleError(error)
                })
                // alert('after axios')
            },

            updateTask() {

                let self = this

                // console.log('updateTask -> task: ' + JSON.stringify(self.task))

                // alert('updateTask -> task: ' + JSON.stringify(self.task))

                this.axios.put(`/admin/tasks/${self.taskId}`, self.task).then(resp => {

                    // console.log(JSON.stringify(resp))

                    // alert(JSON.stringify(resp))

                    $('.close-modal').click()

                    self.$parent.$emit('task_updated', resp.data)

                    // alert('task_updated emitted')

                }).catch(e => {

                    console.log(e)

                    window.handleError(e)
                })
            }
        }
    }

</script>
