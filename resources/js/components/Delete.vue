<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Are You Sure You Want To Delete This Record?
                    </div>
                    <div class="card-body">
                        
                        <div v-if="loading">
						   Loading...
						</div>
						
						<h2 v-if="!loading">Delete {{ title | capitalize }}</h2>
						<view-value-component
							v-if="!loading"
							v-for="(vvalue, property, index) in fields"
							:vvalue="vvalue"
							:key="index"
							:property="property"></view-value-component>
							
                    </div>
					<div class="card-footer">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
							<div class="text-right">
								<button type="button" id="submit" name="submit" class="btn btn-danger" @click="deleteSubmit">Delete Permanently</button>
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
        	data : {
        		showFillable: {}
        	},
        	hide: ['showRelationships','showFillable'],
        	visibleFields: {}
        }
    },
	
    computed: {
		loading(){
			if (jQuery.isEmptyObject(this.visibleFields)){ return true; } else { return false; }
		},
		title() {
			return this.getView();
		},
		fields() {
			return this.visibleFields;
		},
	},
	filters: {
	  capitalize: function (value) {
	    if (!value) return ''
	    value = value.toString()
	    return value.charAt(0).toUpperCase() + value.slice(1)
	  }
	},
    methods: {
	    deleteSubmit: function(){
            axios.delete('/'+ this.getView() + '/' + this.id).then(function (res) {
            	this.$router.go(-1);
            }.bind(this));
	    },
        show: function (){
            axios.get('/'+ this.getView() + '/' + this.id).then(function (res) {
            	this.data = res.data
            	this.defineVisibleFields()
            }.bind(this));
        },
        defineVisibleFields: function(){
        	this.hide = this.hide.concat(this.data.showRelationships)
        	this.visibleFields = {};
        	
        	jQuery.each(this.data, function(field, index){
        		if (this.hide.indexOf(field)>-1) {
        			return false; 
        		} else {
        			this.visibleFields[field] = this.data[field]
        		}
	        }.bind(this))
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
