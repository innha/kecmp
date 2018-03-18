<template>

	<div class="container">

		<h1 class="text-center">
			<button class="btn btn-primary" @click.prevent="createChoir()">Create New Choir</button>
		</h1>

<!-- https://mdbootstrap.com/content/tables/ -->

		<!-- <div class=""> -->
			<!-- <ul class="list-group d-flex"> -->
			<table class="table table-hover table-bordered table-condensed"> <!-- table-sm -->
				<!-- <caption>Categories</caption> -->
				<thead class="thead-inverse"><tr><th width="40%">Choir Name</th><th width="40%">Equipment</th><th width="20%">Edit/Delete</th></tr></thead>
				<tbody class="tbody">
					<!-- <li class="list-group-item d-flex justify-content-between" v-for="choir, key in choirs"> -->
					<tr v-for="choir, key in choirs">
						<!-- <p> -->
						<td>{{ choir.name }}</td>
						<td>{{ choir.equipment }}</td>
						<td>
							<button class="btn btn-warning btn-sm" @click.prevent="editChoir(choir)">Edit</button>
							<button class="btn btn-danger btn-sm" @click.prevent="deleteChoir(choir.id, key)">Delete</button>							
						<!-- </p> -->
						</td>
					<!-- </li> -->
					</tr>
				</tbody>
			<!-- </ul>-->
			</table>

			<create-choir></create-choir>

		<!-- </div> -->
	</div>

</template>

<script>

	import Vue from 'vue'
	import axios from 'axios'
	import VueAxios from 'vue-axios'

	Vue.use (VueAxios, axios)

	export default {

		props: ['default_choirs'],

		mounted() {
			console.log('Parent component mounted.');

			this.$on('choir_created', (choir) => {

				// alert('on inside parent -> choir: ' + JSON.stringify(choir))

				window.noty({

					message: 'Choir created successfully',
					type: 'success'
				})

				this.choirs.push(choir)
			})

			this.$on('choir_updated', (choir) => {

				let choirIndex = this.choirs.findIndex(l => {

					return choir.id == l.id
				})

				this.choirs.splice(choirIndex, 1, choir)

				window.noty({

					message: 'Choir id ' + choir.id + ' updated successfully',
					type: 'success'
				})				
			})

			this.$on('choir_deleted', (id) => {

				// alert('on deleted inside parent -> id: ' + id)
				
				window.noty({

					message: 'Choir id ' + id + ' deleted successfully',
					type: 'success'
				})
			})			
		},

		components: {

			'create-choir': require('./children/Choir.vue')
		},

		data() {

			let self = this

			return {

				choirs: JSON.parse(self.default_choirs),
			}
		},

		computed: {

		},

		methods: {

			createChoir() {

				// alert('createChoir')

				this.$emit('create_choir')

				// alert('create_choir event emitted')
			},

			deleteChoir(id, key) {

				let self = this

				if(confirm('Are you sure you want delete choir id ' + id + ', key ' + key + ' ?')) {

					this.axios.delete(`choirs/${id}`).then((resp) => {

						console.log(resp)

						self.choirs.splice(key, 1)

						self.$emit('choir_deleted', id)

					}).catch((e) => {

						console.log(e)

						window.handleError(e)
					})
				}
			},

			editChoir(choir) {

				// alert('editChoir choir ' + JSON.stringify(choir))

				// let choirId = this.choir.id

				this.$emit('edit_choir', { choir })

				// alert('editChoir emitted')
			}
		}
	}
</script>