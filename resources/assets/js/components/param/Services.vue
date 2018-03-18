<template>

	<div class="container">

		<h1 class="text-center">
			<button class="btn btn-primary" @click.prevent="createService()">Create New Service</button>
		</h1>

<!-- https://mdbootstrap.com/content/tables/ -->

		<!-- <div class=""> -->
			<!-- <ul class="list-group d-flex"> -->
			<table class="table table-hover table-bordered table-condensed"> <!-- table-sm -->
				<!-- <caption>Categories</caption> -->
				<thead class="thead-inverse"><tr><th width="80%">Service Name</th><th width="20%">Edit/Delete</th></tr></thead>
				<tbody class="tbody">
					<!-- <li class="list-group-item d-flex justify-content-between" v-for="service, key in services"> -->
					<tr v-for="service, key in services">
						<!-- <p> -->
						<td>{{ service.name }}</td>
						<td>
							<button class="btn btn-warning btn-sm" @click.prevent="editService(service)">Edit</button>
							<button class="btn btn-danger btn-sm" @click.prevent="deleteService(service.id, key)">Delete</button>							
						<!-- </p> -->
						</td>
					<!-- </li> -->
					</tr>
				</tbody>
			<!-- </ul>-->
			</table>

			<create-service></create-service>

		<!-- </div> -->
	</div>

</template>

<script>

	import Vue from 'vue'
	import axios from 'axios'
	import VueAxios from 'vue-axios'

	Vue.use (VueAxios, axios)

	export default {

		props: ['default_services'],

		mounted() {
			console.log('Parent component mounted.');

			this.$on('service_created', (service) => {

				// alert('on inside parent -> service: ' + JSON.stringify(service))

				window.noty({

					message: 'Service created successfully',
					type: 'success'
				})

				this.services.push(service)
			})

			this.$on('service_updated', (service) => {

				let serviceIndex = this.services.findIndex(l => {

					return service.id == l.id
				})

				this.services.splice(serviceIndex, 1, service)

				window.noty({

					message: 'Service id ' + service.id + ' updated successfully',
					type: 'success'
				})				
			})

			this.$on('service_deleted', (id) => {

				// alert('on deleted inside parent -> id: ' + id)
				
				window.noty({

					message: 'Service id ' + id + ' deleted successfully',
					type: 'success'
				})
			})			
		},

		components: {

			'create-service': require('./children/Service.vue')
		},

		data() {

			let self = this

			return {

				services: JSON.parse(self.default_services),
			}
		},

		computed: {

		},

		methods: {

			createService() {

				// alert('createService')

				this.$emit('create_service')

				// alert('create_service event emitted')
			},

			deleteService(id, key) {

				let self = this

				if(confirm('Are you sure you want delete service id ' + id + ', key ' + key + ' ?')) {

					this.axios.delete(`services/${id}`).then((resp) => {

						console.log(resp)

						self.services.splice(key, 1)

						self.$emit('service_deleted', id)

					}).catch((e) => {

						console.log(e)

						window.handleError(e)
					})
				}
			},

			editService(service) {

				// alert('editService service ' + JSON.stringify(service))

				// let serviceId = this.service.id

				this.$emit('edit_service', { service })

				// alert('editService emitted')
			}
		}
	}
</script>