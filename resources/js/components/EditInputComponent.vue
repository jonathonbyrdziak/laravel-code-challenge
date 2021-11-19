<template>
    <div class="row" v-show="!disabled" >
		<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
			<div class="form-group">
				<label for="fullName">{{ propertyFormatted }}</label>
			</div>
		</div>
		<div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12">
			<div class="form-group">
				<input type="text" class="form-control" id="fullName" v-model="new_value" @keyup="update();">
			</div>
		</div>
    </div>
</template>

<script>
export default {
    props: {
        vvalue: '',
        index: 0,
        property : null,
        showFillable: []
    },
    data() {
        return {
			new_value : ''
        }
    },
	computed: {
		propertyFormatted(){
			return this.capitalize(this.replace( this.property ))
		},
    	disabled(){
    		if (this.showFillable.indexOf(this.property)>-1) { return false; } else { return true; }
    	}
	},
    methods: {
    	update: function(){
    		this.$parent.update({
    			property: this.property,
    			value: this.new_value
    		});
    	},
		loading: function(){
			if (jQuery.isEmptyObject(this.data)){ return true; } else { return false; }
		},
		capitalize: function(value) {
		    if (!value) return ''
		    value = value.toString()
		    return value.charAt(0).toUpperCase() + value.slice(1)
		},
		replace(str){
			return str.replace(/_/g, " ");
		}
	},
    created: function () {
    	this.new_value = this.vvalue;
    }
}
</script>
