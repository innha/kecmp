<template>

	<div class="container">

		<h1 class="text-center">
			<button class="btn btn-primary" @click.prevent="createRole()">Create New Role</button>
		</h1>

<!-- https://mdbootstrap.com/content/tables/ -->

		<!-- <div class=""> -->
			<!-- <ul class="list-group d-flex"> -->
			<table class="table table-hover table-bordered table-condensed"> <!-- table-sm -->
				<!-- <caption>Categories</caption> -->
				<thead class="thead-inverse"><tr><th width="80%">Role Name</th><th width="20%">Edit/Delete</th></tr></thead>
				<tbody class="tbody">
					<!-- <li class="list-group-item d-flex justify-content-between" v-for="role, key in roles"> -->
					<tr v-for="role, key in roles">
						<!-- <p> -->
						<td>{{ role.name }}</td>
						<td>
							<button class="btn btn-warning btn-sm" @click.prevent="editRole(role)">Edit</button>
							<button class="btn btn-danger btn-sm" @click.prevent="deleteRole(role.id, key)">Delete</button>							
						<!-- </p> -->
						</td>
					<!-- </li> -->
					</tr>
				</tbody>
			<!-- </ul>-->
			</table>

			<create-role></create-role>

		<!-- </div> -->
	</div>

</template>

<script>

	import Vue from 'vue'
	import axios from 'axios'
	import VueAxios from 'vue-axios'

	Vue.use (VueAxios, axios)

	export default {

		props: ['default_roles'],

		mounted() {
			console.log('Parent component mounted.');

			this.$on('role_created', (role) => {

				// alert('on inside parent -> role: ' + JSON.stringify(role))

				window.noty({

					message: 'Role created successfully',
					type: 'success'
				})

				this.roles.push(role)
			})

			this.$on('role_updated', (role) => {

				let roleIndex = this.roles.findIndex(l => {

					return role.id == l.id
				})

				this.roles.splice(roleIndex, 1, role)

				window.noty({

					message: 'Role id ' + role.id + ' updated successfully',
					type: 'success'
				})				
			})

			this.$on('role_deleted', (id) => {

				// alert('on deleted inside parent -> id: ' + id)
				
				window.noty({

					message: 'Role id ' + id + ' deleted successfully',
					type: 'success'
				})
			})			
		},

		components: {

			'create-role': require('./children/Role.vue')
		},

		data() {

			let self = this

			return {

				roles: JSON.parse(self.default_roles),
			}
		},

		computed: {

		},

		methods: {

			createRole() {

				// alert('createRole')

				this.$emit('create_role')

				// alert('create_role event emitted')
			},

			deleteRole(id, key) {

				let self = this

				if(confirm('Are you sure you want delete role id ' + id + ', key ' + key + ' ?')) {

					this.axios.delete(`roles/${id}`).then((resp) => {

						console.log(resp)

						self.roles.splice(key, 1)

						self.$emit('role_deleted', id)

					}).catch((e) => {

						console.log(e)

						window.handleError(e)
					})
				}
			},

			editRole(role) {

				// alert('editRole role ' + JSON.stringify(role))

				// let roleId = this.role.id

				this.$emit('edit_role', { role })

				// alert('editRole emitted')
			}
		}
	}
</script>