<template>

	<div class="container">

		<h1 class="text-center">
			<button class="btn btn-primary" @click.prevent="createType()">Create New Type</button>
		</h1>

<!-- https://mdbootstrap.com/content/tables/ -->

		<!-- <div class=""> -->
			<!-- <ul class="list-group d-flex"> -->
			<table class="table table-hover table-bordered table-condensed"> <!-- table-sm -->
				<!-- <caption>Categories</caption> -->
				<thead class="thead-inverse"><tr><th width="80%">Type Name</th><th width="20%">Edit/Delete</th></tr></thead>
				<tbody class="tbody">
					<!-- <li class="list-group-item d-flex justify-content-between" v-for="type, key in types"> -->
					<tr v-for="type, key in types">
						<!-- <p> -->
						<td>{{ type.name }}</td>
						<td>
							<button class="btn btn-warning btn-sm" @click.prevent="editType(type)">Edit</button>
							<button class="btn btn-danger btn-sm" @click.prevent="deleteType(type.id, key)">Delete</button>							
						<!-- </p> -->
						</td>
					<!-- </li> -->
					</tr>
				</tbody>
			<!-- </ul>-->
			</table>

			<create-type></create-type>

		<!-- </div> -->
	</div>

</template>

<script>

	import Vue from 'vue'
	import axios from 'axios'
	import VueAxios from 'vue-axios'

	Vue.use (VueAxios, axios)

	export default {

		props: ['default_types'],

		mounted() {
			console.log('Parent component mounted.');

			this.$on('type_created', (type) => {

				// alert('on inside parent -> type: ' + JSON.stringify(type))

				window.noty({

					message: 'Type created successfully',
					type: 'success'
				})

				this.types.push(type)
			})

			this.$on('type_updated', (type) => {

				let typeIndex = this.types.findIndex(l => {

					return type.id == l.id
				})

				this.types.splice(typeIndex, 1, type)

				window.noty({

					message: 'Type id ' + type.id + ' updated successfully',
					type: 'success'
				})				
			})

			this.$on('type_deleted', (id) => {

				// alert('on deleted inside parent -> id: ' + id)
				
				window.noty({

					message: 'Type id ' + id + ' deleted successfully',
					type: 'success'
				})
			})			
		},

		components: {

			'create-type': require('./children/Type.vue')
		},

		data() {

			let self = this

			return {

				types: JSON.parse(self.default_types),
			}
		},

		computed: {

		},

		methods: {

			createType() {

				// alert('createType')

				this.$emit('create_type')

				// alert('create_type event emitted')
			},

			deleteType(id, key) {

				let self = this

				if(confirm('Are you sure you want delete type id ' + id + ', key ' + key + ' ?')) {

					this.axios.delete(`types/${id}`).then((resp) => {

						console.log(resp)

						self.types.splice(key, 1)

						self.$emit('type_deleted', id)

					}).catch((e) => {

						console.log(e)

						window.handleError(e)
					})
				}
			},

			editType(type) {

				// alert('editType type ' + JSON.stringify(type))

				// let typeId = this.type.id

				this.$emit('edit_type', { type })

				// alert('editType emitted')
			}
		}
	}
</script>