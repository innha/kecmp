<template>

	<div class="container">

		<h1 class="text-center">
			<button class="btn btn-primary" @click.prevent="createChapelle()">Create New Chapelle</button>
		</h1>

<!-- https://mdbootstrap.com/content/tables/ -->

		<!-- <div class=""> -->
			<!-- <ul class="list-group d-flex"> -->
			<table class="table table-hover table-bordered table-condensed"> <!-- table-sm -->
				<!-- <caption>Categories</caption> -->
				<thead class="thead-inverse"><tr><th width="10%">Chapelle code</th><th width="25%">Name</th><th width="25%">Parish</th><th width="20%">Diocese</th><th width="20%">Edit/Delete</th></tr></thead>
				<tbody class="tbody">
					<!-- <li class="list-group-item d-flex justify-content-between" v-for="chapelle, key in chapelles"> -->

					<tr v-for="chapelle, key in chapelles">
						<!-- <p> -->
						<td>{{ chapelle.code }}</td>
						<td>{{ chapelle.name }}</td>
						<td>{{ chapelle.parish }}</td>
						<td>{{ chapelle.diocese }}</td>
						<td>
							<button class="btn btn-warning btn-sm" @click.prevent="editChapelle(chapelle)">Edit</button>
							<button class="btn btn-danger btn-sm" @click.prevent="deleteChapelle(chapelle.id, key)">Delete</button>							
						<!-- </p> -->
						</td>
					<!-- </li> -->
					</tr>
				</tbody>
			<!-- </ul>-->
			</table>

			<create-chapelle></create-chapelle>

		<!-- </div> -->
	</div>

</template>

<script>

	import Vue from 'vue'
	import axios from 'axios'
	import VueAxios from 'vue-axios'

	Vue.use (VueAxios, axios)

	export default {

		props: ['default_chapelles'],

		mounted() {
			console.log('Parent component mounted.');

			this.$on('chapelle_created', (chapelle) => {

				// alert('on chapelle_created inside parent -> chapelle: ' + JSON.stringify(chapelle))

				window.noty({

					message: 'Chapelle created successfully',
					type: 'success'
				})

				this.chapelles.push(chapelle)
			})

			this.$on('chapelle_updated', (chapelle) => {

				// alert('on chapelle_updated inside parent -> chapelle: ' + JSON.stringify(chapelle))

				let chapelleIndex = this.chapelles.findIndex(l => {

					return chapelle.id == l.id
				})

				this.chapelles.splice(chapelleIndex, 1, chapelle)

				window.noty({

					message: 'Chapelle id ' + chapelle.id + ' updated successfully',
					type: 'success'
				})				
			})

			this.$on('chapelle_deleted', (id) => {

				// alert('on deleted inside parent -> id: ' + id)
				
				window.noty({

					message: 'Chapelle id ' + id + ' deleted successfully',
					type: 'success'
				})
			})			
		},

		components: {

			'create-chapelle': require('./children/Chapelle.vue')
		},

		data() {

			let self = this

			return {

				chapelles: JSON.parse(self.default_chapelles),
			}
		},

		computed: {

		},

		methods: {

			createChapelle() {

				// alert('createChapelle')

				this.$emit('create_chapelle')

				// alert('create_chapelle event emitted')
			},

			deleteChapelle(id, key) {

				let self = this

				if(confirm('Are you sure you want delete chapelle id ' + id + ', key ' + key + ' ?')) {

					this.axios.delete(`chapelles/${id}`).then((resp) => {

						console.log(resp)

						self.chapelles.splice(key, 1)

						self.$emit('chapelle_deleted', id)

					}).catch((e) => {

						console.log(e)

						window.handleError(e)
					})
				}
			},

			editChapelle(chapelle) {

				// alert('editChapelle chapelle ' + JSON.stringify(chapelle))

				// let chapelleId = this.chapelle.id

				this.$emit('edit_chapelle', { chapelle })

				// alert('editChapelle emitted')
			}
		}
	}
</script>