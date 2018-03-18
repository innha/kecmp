<template>

	<div class="container">

		<h1 class="text-center">
			<button class="btn btn-primary" @click.prevent="createPrivilege()">Create New Privilege</button>
		</h1>

<!-- https://mdbootstrap.com/content/tables/ -->

		<!-- <div class=""> -->
			<!-- <ul class="list-group d-flex"> -->
			<table class="table table-hover table-bordered table-condensed"> <!-- table-sm -->
				<!-- <caption>Categories</caption> -->
				<thead class="thead-inverse"><tr><th width="80%">Privilege Name</th><th width="20%">Edit/Delete</th></tr></thead>
				<tbody class="tbody">
					<!-- <li class="list-group-item d-flex justify-content-between" v-for="privilege, key in privileges"> -->
					<tr v-for="privilege, key in privileges">
						<!-- <p> -->
						<td>{{ privilege.name }}</td>
						<td>
							<button class="btn btn-warning btn-sm" @click.prevent="editPrivilege(privilege)">Edit</button>
							<button class="btn btn-danger btn-sm" @click.prevent="deletePrivilege(privilege.id, key)">Delete</button>							
						<!-- </p> -->
						</td>
					<!-- </li> -->
					</tr>
				</tbody>
			<!-- </ul>-->
			</table>

			<create-privilege></create-privilege>

		<!-- </div> -->
	</div>

</template>

<script>

	import Vue from 'vue'
	import axios from 'axios'
	import VueAxios from 'vue-axios'

	Vue.use (VueAxios, axios)

	export default {

		props: ['default_privileges'],

		mounted() {
			console.log('Parent component mounted.');

			this.$on('privilege_created', (privilege) => {

				// alert('on inside parent -> privilege: ' + JSON.stringify(privilege))

				window.noty({

					message: 'Privilege created successfully',
					type: 'success'
				})

				this.privileges.push(privilege)
			})

			this.$on('privilege_updated', (privilege) => {

				let privilegeIndex = this.privileges.findIndex(l => {

					return privilege.id == l.id
				})

				this.privileges.splice(privilegeIndex, 1, privilege)

				window.noty({

					message: 'Privilege id ' + privilege.id + ' updated successfully',
					type: 'success'
				})				
			})

			this.$on('privilege_deleted', (id) => {

				// alert('on deleted inside parent -> id: ' + id)
				
				window.noty({

					message: 'Privilege id ' + id + ' deleted successfully',
					type: 'success'
				})
			})			
		},

		components: {

			'create-privilege': require('./children/Privilege.vue')
		},

		data() {

			let self = this

			return {

				privileges: JSON.parse(self.default_privileges),
			}
		},

		computed: {

		},

		methods: {

			createPrivilege() {

				// alert('createPrivilege')

				this.$emit('create_privilege')

				// alert('create_privilege event emitted')
			},

			deletePrivilege(id, key) {

				let self = this

				if(confirm('Are you sure you want delete privilege id ' + id + ', key ' + key + ' ?')) {

					this.axios.delete(`privileges/${id}`).then((resp) => {

						console.log(resp)

						self.privileges.splice(key, 1)

						self.$emit('privilege_deleted', id)

					}).catch((e) => {

						console.log(e)

						window.handleError(e)
					})
				}
			},

			editPrivilege(privilege) {

				// alert('editPrivilege privilege ' + JSON.stringify(privilege))

				// let privilegeId = this.privilege.id

				this.$emit('edit_privilege', { privilege })

				// alert('editPrivilege emitted')
			}
		}
	}
</script>