<template>

	<div class="container">

		<h1 class="text-center">
			<button class="btn btn-primary" @click.prevent="createCell()">Create New Cell</button>
		</h1>

<!-- https://mdbootstrap.com/content/tables/ -->

		<!-- <div class=""> -->
			<!-- <ul class="list-group d-flex"> -->
			<table class="table table-hover table-bordered table-condensed"> <!-- table-sm -->
				<!-- <caption>Categories</caption> -->
				<thead class="thead-inverse"><tr><th width="10%">Cell code</th><th width="20%">Name</th><th width="20%">Sector</th><th width="15%">District</th><th width="15%">Province</th><th width="20%">Edit/Delete</th></tr></thead>
				<tbody class="tbody">
					<!-- <li class="list-group-item d-flex justify-content-between" v-for="cell, key in cells"> -->

					<tr v-for="cell, key in cells">
						<!-- <p> -->
						<td>{{ cell.code }}</td>
						<td>{{ cell.name }}</td>
						<td>{{ cell.sector }}</td>
						<td>{{ cell.district }}</td>
						<td>{{ cell.province }}</td>
						<td>
							<button class="btn btn-warning btn-sm" @click.prevent="editCell(cell)">Edit</button>
							<button class="btn btn-danger btn-sm" @click.prevent="deleteCell(cell.id, key)">Delete</button>							
						<!-- </p> -->
						</td>
					<!-- </li> -->
					</tr>
				</tbody>
			<!-- </ul>-->
			</table>

			<create-cell></create-cell>

		<!-- </div> -->
	</div>

</template>

<script>

	import Vue from 'vue'
	import axios from 'axios'
	import VueAxios from 'vue-axios'

	Vue.use (VueAxios, axios)

	export default {

		props: ['default_cells'],

		mounted() {
			console.log('Parent component mounted.');

			this.$on('cell_created', (cell) => {

				// alert('on cell_created inside parent -> cell: ' + JSON.stringify(cell))

				window.noty({

					message: 'Cell created successfully',
					type: 'success'
				})

				this.cells.push(cell)
			})

			this.$on('cell_updated', (cell) => {

				// alert('on cell_updated inside parent -> cell: ' + JSON.stringify(cell))

				let cellIndex = this.cells.findIndex(l => {

					return cell.id == l.id
				})

				this.cells.splice(cellIndex, 1, cell)

				window.noty({

					message: 'Cell id ' + cell.id + ' updated successfully',
					type: 'success'
				})				
			})

			this.$on('cell_deleted', (id) => {

				// alert('on deleted inside parent -> id: ' + id)
				
				window.noty({

					message: 'Cell id ' + id + ' deleted successfully',
					type: 'success'
				})
			})			
		},

		components: {

			'create-cell': require('./children/Cell.vue')
		},

		data() {

			let self = this

			return {

				cells: JSON.parse(self.default_cells),
			}
		},

		computed: {

		},

		methods: {

			createCell() {

				// alert('createCell')

				this.$emit('create_cell')

				// alert('create_cell event emitted')
			},

			deleteCell(id, key) {

				let self = this

				if(confirm('Are you sure you want delete cell id ' + id + ', key ' + key + ' ?')) {

					this.axios.delete(`cells/${id}`).then((resp) => {

						console.log(resp)

						self.cells.splice(key, 1)

						self.$emit('cell_deleted', id)

					}).catch((e) => {

						console.log(e)

						window.handleError(e)
					})
				}
			},

			editCell(cell) {

				// alert('editCell cell ' + JSON.stringify(cell))

				// let cellId = this.cell.id

				this.$emit('edit_cell', { cell })

				// alert('editCell emitted')
			}
		}
	}
</script>