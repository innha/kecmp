<template>

	<div class="container">

		<h1 class="text-center">
			<button class="btn btn-primary" @click.prevent="createDegree()">Create New Degree</button>
		</h1>

<!-- https://mdbootstrap.com/content/tables/ -->

		<!-- <div class=""> -->
			<!-- <ul class="list-group d-flex"> -->
			<table class="table table-hover table-bordered table-condensed"> <!-- table-sm -->
				<!-- <caption>Categories</caption> -->
				<thead class="thead-inverse"><tr><th width="80%">Degree Name</th><th width="20%">Edit/Delete</th></tr></thead>
				<tbody class="tbody">
					<!-- <li class="list-group-item d-flex justify-content-between" v-for="degree, key in degrees"> -->
					<tr v-for="degree, key in degrees">
						<!-- <p> -->
						<td>{{ degree.name }}</td>
						<td>
							<button class="btn btn-warning btn-sm" @click.prevent="editDegree(degree)">Edit</button>
							<button class="btn btn-danger btn-sm" @click.prevent="deleteDegree(degree.id, key)">Delete</button>							
						<!-- </p> -->
						</td>
					<!-- </li> -->
					</tr>
				</tbody>
			<!-- </ul>-->
			</table>

			<create-degree></create-degree>

		<!-- </div> -->
	</div>

</template>

<script>

	import Vue from 'vue'
	import axios from 'axios'
	import VueAxios from 'vue-axios'

	Vue.use (VueAxios, axios)

	export default {

		props: ['default_degrees'],

		mounted() {
			console.log('Parent component mounted.');

			this.$on('degree_created', (degree) => {

				// alert('on inside parent -> degree: ' + JSON.stringify(degree))

				window.noty({

					message: 'Degree created successfully',
					type: 'success'
				})

				this.degrees.push(degree)
			})

			this.$on('degree_updated', (degree) => {

				let degreeIndex = this.degrees.findIndex(l => {

					return degree.id == l.id
				})

				this.degrees.splice(degreeIndex, 1, degree)

				window.noty({

					message: 'Degree id ' + degree.id + ' updated successfully',
					type: 'success'
				})				
			})

			this.$on('degree_deleted', (id) => {

				// alert('on deleted inside parent -> id: ' + id)
				
				window.noty({

					message: 'Degree id ' + id + ' deleted successfully',
					type: 'success'
				})
			})			
		},

		components: {

			'create-degree': require('./children/Degree.vue')
		},

		data() {

			let self = this

			return {

				degrees: JSON.parse(self.default_degrees),
			}
		},

		computed: {

		},

		methods: {

			createDegree() {

				// alert('createDegree')

				this.$emit('create_degree')

				// alert('create_degree event emitted')
			},

			deleteDegree(id, key) {

				let self = this

				if(confirm('Are you sure you want delete degree id ' + id + ', key ' + key + ' ?')) {

					this.axios.delete(`degrees/${id}`).then((resp) => {

						console.log(resp)

						self.degrees.splice(key, 1)

						self.$emit('degree_deleted', id)

					}).catch((e) => {

						console.log(e)

						window.handleError(e)
					})
				}
			},

			editDegree(degree) {

				// alert('editDegree degree ' + JSON.stringify(degree))

				// let degreeId = this.degree.id

				this.$emit('edit_degree', { degree })

				// alert('editDegree emitted')
			}
		}
	}
</script>