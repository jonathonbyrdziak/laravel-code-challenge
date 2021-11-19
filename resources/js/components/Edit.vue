<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ title | capitalize }} Edit</div>
                    <div class="card-body">
                        
                        <div v-if="loading">
						   Loading...
						</div>
						<edit-input-component
							v-else
							v-for="(vvalue, property, index) in data"
							:vvalue="vvalue"
							:key="index"
							:property="property"
							:showFillable="data.showFillable"
							></edit-input-component>
                        
                    </div>
					<div class="card-footer">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
							<div class="text-right">
								<button v-if="updating" class="btn btn-primary" type="button" disabled>
								  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
								  Updating...
								</button>
								<button v-else type="button" id="submit" name="submit" class="btn btn-primary" @click="submit">Update</button>
							</div>
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {

    props: ['id'],
    data() {
        return {
        	data : {},
			updating: false,
			showFillable: []
        }
    },
    
    backup: {},
	view : null,
	
    computed: {
		loading(){
			if (jQuery.isEmptyObject(this.data)){ return true; } else { return false; }
		},
		title() {
			return this.getView();
		}
	},
	filters: {
	  capitalize: function (value) {
	    if (!value) return ''
	    value = value.toString()
	    return value.charAt(0).toUpperCase() + value.slice(1)
	  }
	},
	
    methods: {
    	update: function(e){
    		this.data[e.property] = e.value;
    	},
    	submit: function(){
    		this.updating = true;
    		var self = this;
    		
	    	const formData = this.data;
	        axios.put('/'+ this.getView() + '/' + this.id, formData)
	        	.then(function( response ){
                    setTimeout(function(){self.updating = false;},500);
    				this.$router.push({ name: this.getView() + '/view', params: { id: this.data.id } })
                }.bind(this));
    	},
        show: function (){
            axios.get('/'+ this.getView() + '/' + this.id).then(function (res) {
            	this.data = res.data;
            }.bind(this));
        },
        getView: function(){
        	this.view = this.$route.name.split('/').shift();
	    	return this.view;
        }
    },
    created: function () {
        this.show()
    }
}
</script>
