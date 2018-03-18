<template>

	<div class="container">

		<h1 class="text-center">
			<button class="btn btn-primary" @click.prevent="createSector()">Create New Sector</button>
		</h1>

<!-- https://mdbootstrap.com/content/tables/ -->

		<!-- <div class=""> -->
			<!-- <ul class="list-group d-flex"> -->
			<table class="table table-hover table-bordered table-condensed"> <!-- table-sm -->
				<!-- <caption>Categories</caption> -->
				<thead class="thead-inverse"><tr><th width="10%">Sector code</th><th width="25%">Name</th><th width="25%">District</th><th width="20%">Province</th><th width="20%">Edit/Delete</th></tr></thead>
				<tbody class="tbody">
					<!-- <li class="list-group-item d-flex justify-content-between" v-for="sector, key in sectors"> -->

					<tr v-for="sector, key in sectors">
						<!-- <p> -->
						<td>{{ sector.code }}</td>
						<td>{{ sector.name }}</td>
						<td>{{ sector.district }}</td>
						<td>{{ sector.province }}</td>
						<td>
							<button class="btn btn-warning btn-sm" @click.prevent="editSector(sector)">Edit</button>
							<button class="btn btn-danger btn-sm" @click.prevent="deleteSector(sector.id, key)">Delete</button>							
						<!-- </p> -->
						</td>
					<!-- </li> -->
					</tr>
				</tbody>
			<!-- </ul>-->
			</table>

			<create-sector></create-sector>

		<!-- </div> -->
	</div>

</template>

<script>

	import Vue from 'vue'
	import axios from 'axios'
	import VueAxios from 'vue-axios'

	Vue.use (VueAxios, axios)

	export default {

		props: ['default_sectors'],

		mounted() {
			console.log('Parent component mounted.');

			this.$on('sector_created', (sector) => {

				// alert('on sector_created inside parent -> sector: ' + JSON.stringify(sector))

				window.noty({

					message: 'Sector created successfully',
					type: 'success'
				})

				this.sectors.push(sector)
			})

			this.$on('sector_updated', (sector) => {

				// alert('on sector_updated inside parent -> sector: ' + JSON.stringify(sector))

				let sectorIndex = this.sectors.findIndex(l => {

					return sector.id == l.id
				})

				this.sectors.splice(sectorIndex, 1, sector)

				window.noty({

					message: 'Sector id ' + sector.id + ' updated successfully',
					type: 'success'
				})				
			})

			this.$on('sector_deleted', (id) => {

				// alert('on deleted inside parent -> id: ' + id)
				
				window.noty({

					message: 'Sector id ' + id + ' deleted successfully',
					type: 'success'
				})
			})			
		},

		components: {

			'create-sector': require('./children/Sector.vue')
		},

		data() {

			let self = this

			return {

				sectors: JSON.parse(self.default_sectors),
			}
		},

		computed: {

		},

		methods: {

			createSector() {

				// alert('createSector')

				this.$emit('create_sector')

				// alert('create_sector event emitted')
			},

			deleteSector(id, key) {

				let self = this

				if(confirm('Are you sure you want delete sector id ' + id + ', key ' + key + ' ?')) {

					this.axios.delete(`sectors/${id}`).then((resp) => {

						console.log(resp)

						self.sectors.splice(key, 1)

						self.$emit('sector_deleted', id)

					}).catch((e) => {

						console.log(e)

						window.handleError(e)
					})
				}
			},

			editSector(sector) {

				// alert('editSector sector ' + JSON.stringify(sector))

				// let sectorId = this.sector.id

				this.$emit('edit_sector', { sector })

				// alert('editSector emitted')
			}
		}
	}
</script>