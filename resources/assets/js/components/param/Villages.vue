<template>

	<div class="container">

		<h1 class="text-center">
			<button class="btn btn-primary" @click.prevent="createVillage()">Create New Village</button>
		</h1>

<!-- https://mdbootstrap.com/content/tables/ -->

		<!-- <div class=""> -->
			<!-- <ul class="list-group d-flex"> -->
			<table class="table table-hover table-bordered table-condensed"> <!-- table-sm -->
				<!-- <caption>Categories</caption> -->
				<thead class="thead-inverse"><tr><th width="10%">Village code</th><th width="15%">Name</th><th width="15%">Cell</th><th width="15%">Sector</th><th width="15%">District</th><th width="15%">Province</th><th width="15%">Edit/Delete</th></tr></thead>
				<tbody class="tbody">
					<!-- <li class="list-group-item d-flex justify-content-between" v-for="village, key in villages"> -->

					<tr v-for="village, key in villages">
						<!-- <p> -->
						<td>{{ village.code }}</td>
						<td>{{ village.name }}</td>
						<td>{{ village.cell }}</td>
						<td>{{ village.sector }}</td>
						<td>{{ village.district }}</td>
						<td>{{ village.province }}</td>
						<td>
							<button class="btn btn-warning btn-sm" @click.prevent="editVillage(village)">Edit</button>
							<button class="btn btn-danger btn-sm" @click.prevent="deleteVillage(village.id, key)">Delete</button>							
						<!-- </p> -->
						</td>
					<!-- </li> -->
					</tr>
				</tbody>
			<!-- </ul>-->
			</table>

			<create-village></create-village>

		<!-- </div> -->
	</div>

</template>

<script>

	import Vue from 'vue'
	import axios from 'axios'
	import VueAxios from 'vue-axios'

	Vue.use (VueAxios, axios)

	export default {

		props: ['default_villages'],

		mounted() {
			console.log('Parent component mounted.');

			this.$on('village_created', (village) => {

				// alert('on village_created inside parent -> village: ' + JSON.stringify(village))

				window.noty({

					message: 'Village created successfully',
					type: 'success'
				})

				this.villages.push(village)
			})

			this.$on('village_updated', (village) => {

				// alert('on village_updated inside parent -> village: ' + JSON.stringify(village))

				let villageIndex = this.villages.findIndex(l => {

					return village.id == l.id
				})

				this.villages.splice(villageIndex, 1, village)

				window.noty({

					message: 'Village id ' + village.id + ' updated successfully',
					type: 'success'
				})				
			})

			this.$on('village_deleted', (id) => {

				// alert('on deleted inside parent -> id: ' + id)
				
				window.noty({

					message: 'Village id ' + id + ' deleted successfully',
					type: 'success'
				})
			})			
		},

		components: {

			'create-village': require('./children/Village.vue')
		},

		data() {

			let self = this

			return {

				villages: JSON.parse(self.default_villages),
			}
		},

		computed: {

		},

		methods: {

			createVillage() {

				// alert('createVillage')

				this.$emit('create_village')

				// alert('create_village event emitted')
			},

			deleteVillage(id, key) {

				let self = this

				if(confirm('Are you sure you want delete village id ' + id + ', key ' + key + ' ?')) {

					this.axios.delete(`villages/${id}`).then((resp) => {

						console.log(resp)

						self.villages.splice(key, 1)

						self.$emit('village_deleted', id)

					}).catch((e) => {

						console.log(e)

						window.handleError(e)
					})
				}
			},

			editVillage(village) {

				// alert('editVillage village ' + JSON.stringify(village))

				// let villageId = this.village.id

				this.$emit('edit_village', { village })

				// alert('editVillage emitted')
			}
		}
	}
</script>