<template>

	<div class="container">

		<h1 class="text-center">
			<button class="btn btn-primary" @click.prevent="createProvince()">Create New Province</button>
		</h1>

<!-- https://mdbootstrap.com/content/tables/ -->

		<!-- <div class=""> -->
			<!-- <ul class="list-group d-flex"> -->
			<table class="table table-hover table-bordered table-condensed"> <!-- table-sm -->
				<!-- <caption>Categories</caption> -->
				<thead class="thead-inverse"><tr><th width="40%">Province Code</th><th width="40%">Name</th><th width="20%">Edit/Delete</th></tr></thead>
				<tbody class="tbody">
					<!-- <li class="list-group-item d-flex justify-content-between" v-for="province, key in provinces"> -->
					<tr v-for="province, key in provinces">
						<!-- <p> -->
						<td>{{ province.code }}</td>
						<td>{{ province.name }}</td>
						<td>
							<button class="btn btn-warning btn-sm" @click.prevent="editProvince(province)">Edit</button>
							<button class="btn btn-danger btn-sm" @click.prevent="deleteProvince(province.id, key)">Delete</button>							
						<!-- </p> -->
						</td>
					<!-- </li> -->
					</tr>
				</tbody>
			<!-- </ul>-->
			</table>

			<create-province></create-province>

		<!-- </div> -->
	</div>

</template>

<script>

	import Vue from 'vue'
	import axios from 'axios'
	import VueAxios from 'vue-axios'

	Vue.use (VueAxios, axios)

	export default {

		props: ['default_provinces'],

		mounted() {
			console.log('Parent component mounted.');

			this.$on('province_created', (province) => {

				// alert('on inside parent -> province: ' + JSON.stringify(province))

				window.noty({

					message: 'Province created successfully',
					type: 'success'
				})

				this.provinces.push(province)
			})

			this.$on('province_updated', (province) => {

				let provinceIndex = this.provinces.findIndex(l => {

					return province.id == l.id
				})

				this.provinces.splice(provinceIndex, 1, province)

				window.noty({

					message: 'Province id ' + province.id + ' updated successfully',
					type: 'success'
				})				
			})

			this.$on('province_deleted', (id) => {

				// alert('on deleted inside parent -> id: ' + id)
				
				window.noty({

					message: 'Province id ' + id + ' deleted successfully',
					type: 'success'
				})
			})			
		},

		components: {

			'create-province': require('./children/Province.vue')
		},

		data() {

			let self = this

			return {

				provinces: JSON.parse(self.default_provinces),
			}
		},

		computed: {

		},

		methods: {

			createProvince() {

				// alert('createProvince')

				this.$emit('create_province')

				// alert('create_province event emitted')
			},

			deleteProvince(id, key) {

				let self = this

				if(confirm('Are you sure you want delete province id ' + id + ', key ' + key + ' ?')) {

					this.axios.delete(`provinces/${id}`).then((resp) => {

						console.log(resp)

						self.provinces.splice(key, 1)

						self.$emit('province_deleted', id)

					}).catch((e) => {

						console.log(e)

						window.handleError(e)
					})
				}
			},

			editProvince(province) {

				// alert('editProvince province ' + JSON.stringify(province))

				// let provinceId = this.province.id

				this.$emit('edit_province', { province })

				// alert('editProvince emitted')
			}
		}
	}
</script>