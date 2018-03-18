<template>

	<div class="container">

		<h1 class="text-center">
			<button class="btn btn-primary" @click.prevent="createDistrict()">Create New District</button>
		</h1>

<!-- https://mdbootstrap.com/content/tables/ -->

		<!-- <div class=""> -->
			<!-- <ul class="list-group d-flex"> -->
			<table class="table table-hover table-bordered table-condensed"> <!-- table-sm -->
				<!-- <caption>Categories</caption> -->
				<thead class="thead-inverse"><tr><th width="10%">District code</th><th width="35%">Name</th><th width="35%">Province</th><th width="20%">Edit/Delete</th></tr></thead>
				<tbody class="tbody">
					<!-- <li class="list-group-item d-flex justify-content-between" v-for="district, key in districts"> -->

					<tr v-for="district, key in districts">
						<!-- <p> -->
						<td>{{ district.code }}</td>
						<td>{{ district.name }}</td>
						<td>{{ district.province }}</td>
						<td>
							<button class="btn btn-warning btn-sm" @click.prevent="editDistrict(district)">Edit</button>
							<button class="btn btn-danger btn-sm" @click.prevent="deleteDistrict(district.id, key)">Delete</button>							
						<!-- </p> -->
						</td>
					<!-- </li> -->
					</tr>
				</tbody>
			<!-- </ul>-->
			</table>

			<create-district></create-district>

		<!-- </div> -->
	</div>

</template>

<script>

	import Vue from 'vue'
	import axios from 'axios'
	import VueAxios from 'vue-axios'

	Vue.use (VueAxios, axios)

	export default {

		props: ['default_districts'],

		mounted() {
			console.log('Parent component mounted.');

			this.$on('district_created', (district) => {

				// alert('on district_created inside parent -> district: ' + JSON.stringify(district))

				window.noty({

					message: 'District created successfully',
					type: 'success'
				})

				this.districts.push(district)
			})

			this.$on('district_updated', (district) => {

				// alert('on district_updated inside parent -> district: ' + JSON.stringify(district))

				let districtIndex = this.districts.findIndex(l => {

					return district.id == l.id
				})

				this.districts.splice(districtIndex, 1, district)

				window.noty({

					message: 'District id ' + district.id + ' updated successfully',
					type: 'success'
				})				
			})

			this.$on('district_deleted', (id) => {

				// alert('on deleted inside parent -> id: ' + id)
				
				window.noty({

					message: 'District id ' + id + ' deleted successfully',
					type: 'success'
				})
			})			
		},

		components: {

			'create-district': require('./children/District.vue')
		},

		data() {

			let self = this

			return {

				districts: JSON.parse(self.default_districts),
			}
		},

		computed: {

		},

		methods: {

			createDistrict() {

				// alert('createDistrict')

				this.$emit('create_district')

				// alert('create_district event emitted')
			},

			deleteDistrict(id, key) {

				let self = this

				if(confirm('Are you sure you want delete district id ' + id + ', key ' + key + ' ?')) {

					this.axios.delete(`districts/${id}`).then((resp) => {

						console.log(resp)

						self.districts.splice(key, 1)

						self.$emit('district_deleted', id)

					}).catch((e) => {

						console.log(e)

						window.handleError(e)
					})
				}
			},

			editDistrict(district) {

				// alert('editDistrict district ' + JSON.stringify(district))

				// let districtId = this.district.id

				this.$emit('edit_district', { district })

				// alert('editDistrict emitted')
			}
		}
	}
</script>