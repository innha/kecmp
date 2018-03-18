<template>

	<div class="container">

		<h1 class="text-center">
			<button class="btn btn-primary" @click.prevent="createDiocese()">Create New Diocese</button>
		</h1>

<!-- https://mdbootstrap.com/content/tables/ -->

		<!-- <div class=""> -->
			<!-- <ul class="list-group d-flex"> -->
			<table class="table table-hover table-bordered table-condensed"> <!-- table-sm -->
				<!-- <caption>Categories</caption> -->
				<thead class="thead-inverse"><tr><th width="40%">Diocese code</th><th width="40%">Name</th><th width="20%">Edit/Delete</th></tr></thead>
				<tbody class="tbody">
					<!-- <li class="list-group-item d-flex justify-content-between" v-for="diocese, key in dioceses"> -->
					<tr v-for="diocese, key in dioceses">
						<!-- <p> -->
						<td>{{ diocese.code }}</td>
						<td>{{ diocese.name }}</td>
						<td>
							<button class="btn btn-warning btn-sm" @click.prevent="editDiocese(diocese)">Edit</button>
							<button class="btn btn-danger btn-sm" @click.prevent="deleteDiocese(diocese.id, key)">Delete</button>							
						<!-- </p> -->
						</td>
					<!-- </li> -->
					</tr>
				</tbody>
			<!-- </ul>-->
			</table>

			<create-diocese></create-diocese>

		<!-- </div> -->
	</div>

</template>

<script>

	import Vue from 'vue'
	import axios from 'axios'
	import VueAxios from 'vue-axios'

	Vue.use (VueAxios, axios)

	export default {

		props: ['default_dioceses'],

		mounted() {
			console.log('Parent component mounted.');

			this.$on('diocese_created', (diocese) => {

				// alert('on inside parent -> diocese: ' + JSON.stringify(diocese))

				window.noty({

					message: 'Diocese created successfully',
					type: 'success'
				})

				this.dioceses.push(diocese)
			})

			this.$on('diocese_updated', (diocese) => {

				let dioceseIndex = this.dioceses.findIndex(l => {

					return diocese.id == l.id
				})

				this.dioceses.splice(dioceseIndex, 1, diocese)

				window.noty({

					message: 'Diocese id ' + diocese.id + ' updated successfully',
					type: 'success'
				})				
			})

			this.$on('diocese_deleted', (id) => {

				// alert('on deleted inside parent -> id: ' + id)
				
				window.noty({

					message: 'Diocese id ' + id + ' deleted successfully',
					type: 'success'
				})
			})			
		},

		components: {

			'create-diocese': require('./children/Diocese.vue')
		},

		data() {

			let self = this

			return {

				dioceses: JSON.parse(self.default_dioceses),
			}
		},

		computed: {

		},

		methods: {

			createDiocese() {

				// alert('createDiocese')

				this.$emit('create_diocese')

				// alert('create_diocese event emitted')
			},

			deleteDiocese(id, key) {

				let self = this

				if(confirm('Are you sure you want delete diocese id ' + id + ', key ' + key + ' ?')) {

					this.axios.delete(`dioceses/${id}`).then((resp) => {

						console.log(resp)

						self.dioceses.splice(key, 1)

						self.$emit('diocese_deleted', id)

					}).catch((e) => {

						console.log(e)

						window.handleError(e)
					})
				}
			},

			editDiocese(diocese) {

				// alert('editDiocese diocese ' + JSON.stringify(diocese))

				// let dioceseId = this.diocese.id

				this.$emit('edit_diocese', { diocese })

				// alert('editDiocese emitted')
			}
		}
	}
</script>