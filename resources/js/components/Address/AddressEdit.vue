<template>
	<div> 
		<div class="row gutters">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<h6 class="mb-2 text-primary">Personal Details</h6>
			</div>
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
				<div class="form-group">
					<label for="fullName">Street</label>
					<input type="text" class="form-control" id="address" name="address" v-model="address.address" placeholder="Enter first name">
				</div>
			</div>
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
				<div class="form-group">
					<label for="eMail">City</label>
					<input type="email" class="form-control" id="city" name="city" v-model="address.city" placeholder="Enter last name">
				</div>
			</div>
		</div>
		<div class="row gutters">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="text-right">
					<button type="button" id="submit" name="submit" class="btn btn-secondary" @click="reset">Cancel</button>
					<button type="button" id="submit" name="submit" class="btn btn-primary" @click="submit">Update</button>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
    props: {
        address: {
            type: Object
        }
    },
    
    data() {
        return {
			
        }
    },
    
    backup: {},

    methods: {
        submit() {
	    	const formData = this.owner;

	        axios.put('/address/' + this.address.id, formData)
	        	.then(function( response ){
                    console.log(response);
                }.bind(this));
        },
        reset() {
        	Object.assign(this.address, this.backup);
        },
        backup() {
        	Object.assign(this.backup, this.address)
        }	
    },
    created: function () {
        this.backup()
    }
}
</script>
