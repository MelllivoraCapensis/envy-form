var formVue = new Vue({
	el: 'form',
	data: {
		errors: {
			nameError: false,
			phoneError: false,
			messageError: false,
		},
		alert: false,
		success: false,
		fail: false,
	},
	methods: {
		submit(e) {
			e.preventDefault();
			axios.post('', new FormData(this.$el))
				.then((response) => {
					if(response.status == 200) {
						var errors = response.data.errors;
						this.alert = 'Errors!!! Post was not sent!';
						for (var key in errors) {
							this.errors[`${key}Error`] = errors[key];
						}
						this.fail = true;
						return;
					}
					if(response.status == 201) {
						this.alert = response.data.message;
						this.success = true;
						this.$el.reset();
						return;
					}		
					this.alert = 'Error!!! Select type of storage!';
					this.fail = true;
				})
				.catch((error) => {
					this.alert = 'Something is wrong, try later!!!';
					this.fail = true;
					this.$el.reset();
				})
		},
		resetInfo() {
			var errors = this.errors;
			for (var key in errors) {
				errors[key] = false;
			}
			this.alert = false;
			this.success = false;
			this.fail = false;
		}
	}
});