<template>

	<div class="container">

		<h1 class="text-center">
			<button class="btn btn-primary" @click.prevent="createParish()">Create New Parish</button>
		</h1>

<!-- https://mdbootstrap.com/content/tables/ -->

		<!-- <div class=""> -->
			<!-- <ul class="list-group d-flex"> -->
			<table class="table table-hover table-bordered table-condensed"> <!-- table-sm -->
				<!-- <caption>Categories</caption> -->
				<thead class="thead-inverse"><tr><th width="10%">Parish code</th><th width="35%">Name</th><th width="35%">Diocese</th><th>District</th><th width="20%">Edit/Delete</th></tr></thead>
				<tbody class="tbody">
					<!-- <li class="list-group-item d-flex justify-content-between" v-for="parish, key in parishes"> -->

					<tr v-for="parish, key in parishes">
						<!-- <p> -->
						<td>{{ parish.code }}</td>
						<td>{{ parish.name }}</td>
						<td>{{ parish.diocese }}</td>
						<td>{{ parish.district }}</td>
						<td>
							<button class="btn btn-warning btn-sm" @click.prevent="editParish(parish)">Edit</button>
							<button class="btn btn-danger btn-sm" @click.prevent="deleteParish(parish.id, key)">Delete</button>							
						<!-- </p> -->
						</td>
					<!-- </li> -->
					</tr>
				</tbody>
			<!-- </ul>-->
			</table>

			<create-parish></create-parish>

		<!-- </div> -->
	</div>

</template>

<script>

	import Vue from 'vue'
	import axios from 'axios'
	import VueAxios from 'vue-axios'

	Vue.use (VueAxios, axios)

	export default {

		props: ['default_parishes'],

		mounted() {
			console.log('Parent component mounted.');

			this.$on('parish_created', (parish) => {

				// alert('on parish_created inside parent -> parish: ' + JSON.stringify(parish))

				window.noty({

					message: 'Parish created successfully',
					type: 'success'
				})

				this.parishes.push(parish)
			})

			this.$on('parish_updated', (parish) => {

				// alert('on parish_updated inside parent -> parish: ' + JSON.stringify(parish))

				let parishIndex = this.parishes.findIndex(l => {

					return parish.id == l.id
				})

				this.parishes.splice(parishIndex, 1, parish)

				window.noty({

					message: 'Parish id ' + parish.id + ' updated successfully',
					type: 'success'
				})				
			})

			this.$on('parish_deleted', (id) => {

				// alert('on deleted inside parent -> id: ' + id)
				
				window.noty({

					message: 'Parish id ' + id + ' deleted successfully',
					type: 'success'
				})
			})			
		},

		components: {

			'create-parish': require('./children/Parish.vue')
		},

		data() {

			let self = this

			return {

				parishes: JSON.parse(self.default_parishes),
			}
		},

		computed: {

		},

		methods: {

			createParish() {

				// alert('createParish')

				this.$emit('create_parish')

				// alert('create_parish event emitted')
			},

			deleteParish(id, key) {

				let self = this

				if(confirm('Are you sure you want delete parish id ' + id + ', key ' + key + ' ?')) {

					this.axios.delete(`parishes/${id}`).then((resp) => {

						console.log(resp)

						self.parishes.splice(key, 1)

						self.$emit('parish_deleted', id)

					}).catch((e) => {

						console.log(e)

						window.handleError(e)
					})
				}
			},

			editParish(parish) {

				// alert('editParish parish ' + JSON.stringify(parish))

				// let parishId = this.parish.id

				this.$emit('edit_parish', { parish })

				// alert('editParish emitted')
			}
		}
	}
</script>