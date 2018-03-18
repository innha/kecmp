<template>
	
	<div class="alert alert-noty" :class="type" v-show="notification">
		
		<p class="text-center">{{ notification.message }}</p>

	</div>

</template>

<script>
	
	export default {

		created() {

			window.events.$on('notification', (payload) => {

				this.notification = payload

				setTimeout(() => {

					this.notification = ''

					// location.reload(true)

				}, 5000)
			})
		},

		data() {

			return {
				notification: ''
			}
		},

		computed: {

			type() {

				return `alert-${this.notification.type}`
			}
		}
	}

</script>

<style scoped>
	
	.alert-noty {

		position: fixed;

  		top: 30px;

  		left: 0;

  		width: 100%;

  		height: 40px;

		z-index: 1;
	}

</style>