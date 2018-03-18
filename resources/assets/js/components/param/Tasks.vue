<template>

	<div class="container">

		<h1 class="text-center">
			<button class="btn btn-primary" @click.prevent="createTask()">Create New Task</button>
		</h1>

<!-- https://mdbootstrap.com/content/tables/ -->

		<!-- <div class=""> -->
			<!-- <ul class="list-group d-flex"> -->
			<table class="table table-hover table-bordered table-condensed"> <!-- table-sm -->
				<!-- <caption>Categories</caption> -->
				<thead class="thead-inverse"><tr><th width="80%">Task Name</th><th width="20%">Edit/Delete</th></tr></thead>
				<tbody class="tbody">
					<!-- <li class="list-group-item d-flex justify-content-between" v-for="task, key in tasks"> -->
					<tr v-for="task, key in tasks">
						<!-- <p> -->
						<td>{{ task.name }}</td>
						<td>
							<button class="btn btn-warning btn-sm" @click.prevent="editTask(task)">Edit</button>
							<button class="btn btn-danger btn-sm" @click.prevent="deleteTask(task.id, key)">Delete</button>							
						<!-- </p> -->
						</td>
					<!-- </li> -->
					</tr>
				</tbody>
			<!-- </ul>-->
			</table>

			<create-task></create-task>

		<!-- </div> -->
	</div>

</template>

<script>

	import Vue from 'vue'
	import axios from 'axios'
	import VueAxios from 'vue-axios'

	Vue.use (VueAxios, axios)

	export default {

		props: ['default_tasks'],

		mounted() {
			console.log('Parent component mounted.');

			this.$on('task_created', (task) => {

				// alert('on inside parent -> task: ' + JSON.stringify(task))

				window.noty({

					message: 'Task created successfully',
					type: 'success'
				})

				this.tasks.push(task)
			})

			this.$on('task_updated', (task) => {

				let taskIndex = this.tasks.findIndex(l => {

					return task.id == l.id
				})

				this.tasks.splice(taskIndex, 1, task)

				window.noty({

					message: 'Task id ' + task.id + ' updated successfully',
					type: 'success'
				})				
			})

			this.$on('task_deleted', (id) => {

				// alert('on deleted inside parent -> id: ' + id)
				
				window.noty({

					message: 'Task id ' + id + ' deleted successfully',
					type: 'success'
				})
			})			
		},

		components: {

			'create-task': require('./children/Task.vue')
		},

		data() {

			let self = this

			return {

				tasks: JSON.parse(self.default_tasks),
			}
		},

		computed: {

		},

		methods: {

			createTask() {

				// alert('createTask')

				this.$emit('create_task')

				// alert('create_task event emitted')
			},

			deleteTask(id, key) {

				let self = this

				if(confirm('Are you sure you want delete task id ' + id + ', key ' + key + ' ?')) {

					this.axios.delete(`tasks/${id}`).then((resp) => {

						console.log(resp)

						self.tasks.splice(key, 1)

						self.$emit('task_deleted', id)

					}).catch((e) => {

						console.log(e)

						window.handleError(e)
					})
				}
			},

			editTask(task) {

				// alert('editTask task ' + JSON.stringify(task))

				// let taskId = this.task.id

				this.$emit('edit_task', { task })

				// alert('editTask emitted')
			}
		}
	}
</script>