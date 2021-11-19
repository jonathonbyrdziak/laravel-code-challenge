<template>
    <div class="row">
		<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
			<div class="form-group">
				<label for="fullName">{{ propertyFormatted }}</label>
			</div>
		</div>
		<div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12">
			<div class="form-group">
				{{ vvalue }}
			</div>
		</div>
    </div>
</template>

<script>
export default {
    props: {
        vvalue: '',
        index: 0,
        property : null
    },
    data() {
        return {
			data: {
				
			}
        }
    },
	computed: {
		propertyFormatted(){
			return this.capitalize(this.replace( this.property ))
		}
	},
    methods: {
		loading(){
			if (jQuery.isEmptyObject(this.data)){ return true; } else { return false; }
		},
		capitalize(value) {
		    if (!value) return ''
		    value = value.toString()
		    return value.charAt(0).toUpperCase() + value.slice(1)
		},
		replace(str){
			return str.replace(/_/g, " ");
		}
	},
    created: function () {
    
    }
}
</script>
