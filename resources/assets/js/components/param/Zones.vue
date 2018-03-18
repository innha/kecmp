<template>

	<div class="container">

		<h1 class="text-center">
			<button class="btn btn-primary" @click.prevent="createZone()">Create New Zone</button>
		</h1>

<!-- https://mdbootstrap.com/content/tables/ -->

		<!-- <div class=""> -->
			<!-- <ul class="list-group d-flex"> -->
			<table class="table table-hover table-bordered table-condensed"> <!-- table-sm -->
				<!-- <caption>Categories</caption> -->
				<thead class="thead-inverse"><tr><th width="10%">Zone code</th><th width="20%">Name</th><th width="20%">Chapelle</th><th width="15%">Parish</th><th width="15%">Diocese</th><th width="20%">Edit/Delete</th></tr></thead>
				<tbody class="tbody">
					<!-- <li class="list-group-item d-flex justify-content-between" v-for="zone, key in zones"> -->

					<tr v-for="zone, key in zones">
						<!-- <p> -->
						<td>{{ zone.code }}</td>
						<td>{{ zone.name }}</td>
						<td>{{ zone.chapelle }}</td>
						<td>{{ zone.parish }}</td>
						<td>{{ zone.diocese }}</td>
						<td>
							<button class="btn btn-warning btn-sm" @click.prevent="editZone(zone)">Edit</button>
							<button class="btn btn-danger btn-sm" @click.prevent="deleteZone(zone.id, key)">Delete</button>							
						<!-- </p> -->
						</td>
					<!-- </li> -->
					</tr>
				</tbody>
			<!-- </ul>-->
			</table>

			<create-zone></create-zone>

		<!-- </div> -->
	</div>

</template>

<script>

	import Vue from 'vue'
	import axios from 'axios'
	import VueAxios from 'vue-axios'

	Vue.use (VueAxios, axios)

	export default {

		props: ['default_zones'],

		mounted() {
			console.log('Parent component mounted.');

			this.$on('zone_created', (zone) => {

				// alert('on zone_created inside parent -> zone: ' + JSON.stringify(zone))

				window.noty({

					message: 'Zone created successfully',
					type: 'success'
				})

				this.zones.push(zone)
			})

			this.$on('zone_updated', (zone) => {

				// alert('on zone_updated inside parent -> zone: ' + JSON.stringify(zone))

				let zoneIndex = this.zones.findIndex(l => {

					return zone.id == l.id
				})

				this.zones.splice(zoneIndex, 1, zone)

				window.noty({

					message: 'Zone id ' + zone.id + ' updated successfully',
					type: 'success'
				})				
			})

			this.$on('zone_deleted', (id) => {

				// alert('on deleted inside parent -> id: ' + id)
				
				window.noty({

					message: 'Zone id ' + id + ' deleted successfully',
					type: 'success'
				})
			})			
		},

		components: {

			'create-zone': require('./children/Zone.vue')
		},

		data() {

			let self = this

			return {

				zones: JSON.parse(self.default_zones),
			}
		},

		computed: {

		},

		methods: {

			createZone() {

				// alert('createZone')

				this.$emit('create_zone')

				// alert('create_zone event emitted')
			},

			deleteZone(id, key) {

				let self = this

				if(confirm('Are you sure you want delete zone id ' + id + ', key ' + key + ' ?')) {

					this.axios.delete(`zones/${id}`).then((resp) => {

						console.log(resp)

						self.zones.splice(key, 1)

						self.$emit('zone_deleted', id)

					}).catch((e) => {

						console.log(e)

						window.handleError(e)
					})
				}
			},

			editZone(zone) {

				// alert('editZone zone ' + JSON.stringify(zone))

				// let zoneId = this.zone.id

				this.$emit('edit_zone', { zone })

				// alert('editZone emitted')
			}
		}
	}
</script>