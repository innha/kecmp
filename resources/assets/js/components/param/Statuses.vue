<template>

	<div class="container">

		<h1 class="text-center">
			<button class="btn btn-primary" @click.prevent="createStatus()">Create New Status</button>
		</h1>

<!-- https://mdbootstrap.com/content/tables/ -->

		<!-- <div class=""> -->
			<!-- <ul class="list-group d-flex"> -->
			<table class="table table-hover table-bordered table-condensed"> <!-- table-sm -->
				<!-- <caption>Categories</caption> -->
				<thead class="thead-inverse"><tr><th width="80%">Status Name</th><th width="20%">Edit/Delete</th></tr></thead>
				<tbody class="tbody">
					<!-- <li class="list-group-item d-flex justify-content-between" v-for="status, key in statuses"> -->
					<tr v-for="status, key in statuses">
						<!-- <p> -->
						<td>{{ status.name }}</td>
						<td>
							<button class="btn btn-warning btn-sm" @click.prevent="editStatus(status)">Edit</button>
							<button class="btn btn-danger btn-sm" @click.prevent="deleteStatus(status.id, key)">Delete</button>							
						<!-- </p> -->
						</td>
					<!-- </li> -->
					</tr>
				</tbody>
			<!-- </ul>-->
			</table>

			<create-status></create-status>

		<!-- </div> -->
	</div>

</template>

<script>

	import Vue from 'vue'
	import axios from 'axios'
	import VueAxios from 'vue-axios'

	Vue.use (VueAxios, axios)

	export default {

		props: ['default_statuses'],

		mounted() {
			console.log('Parent component mounted.');

			this.$on('status_created', (status) => {

				// alert('on inside parent -> status: ' + JSON.stringify(status))

				window.noty({

					message: 'Status created successfully',
					type: 'success'
				})

				this.statuses.push(status)
			})

			this.$on('status_updated', (status) => {

				let statusIndex = this.statuses.findIndex(l => {

					return status.id == l.id
				})

				this.statuses.splice(statusIndex, 1, status)

				window.noty({

					message: 'Status id ' + status.id + ' updated successfully',
					type: 'success'
				})				
			})

			this.$on('status_deleted', (id) => {

				// alert('on deleted inside parent -> id: ' + id)
				
				window.noty({

					message: 'Status id ' + id + ' deleted successfully',
					type: 'success'
				})
			})			
		},

		components: {

			'create-status': require('./children/Status.vue')
		},

		data() {

			let self = this

			return {

				statuses: JSON.parse(self.default_statuses),
			}
		},

		computed: {

		},

		methods: {

			createStatus() {

				// alert('createStatus')

				this.$emit('create_status')

				// alert('create_status event emitted')
			},

			deleteStatus(id, key) {

				let self = this

				if(confirm('Are you sure you want delete status id ' + id + ', key ' + key + ' ?')) {

					this.axios.delete(`statuses/${id}`).then((resp) => {

						console.log(resp)

						self.statuses.splice(key, 1)

						self.$emit('status_deleted', id)

					}).catch((e) => {

						console.log(e)

						window.handleError(e)
					})
				}
			},

			editStatus(status) {

				// alert('editStatus status ' + JSON.stringify(status))

				// let statusId = this.status.id

				this.$emit('edit_status', { status })

				// alert('editStatus emitted')
			}
		}
	}
</script>