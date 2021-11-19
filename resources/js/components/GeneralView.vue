<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
						<ul class="nav nav-tabs">
						
							<view-tab-component
								v-if="!loading"
								v-for="(title,property,index) in getTabs()"
								:title="title"
								:key="index"
								:property="property"
								></view-tab-component>
						  	
						</ul>
                    </div>
                    <div class="card-body">
                        
                        <div v-if="loading">
						   Loading...
						</div>
						<view-value-component
							v-else-if="viewValue"
							v-for="(vvalue, property, index) in fields"
							:vvalue="vvalue"
							:key="index"
							:property="property"></view-value-component>
							
						<address-table-component 
							v-if="!loading && getView()!=='address'"
							v-show="viewAddress"
							:addresses="data.addresses"></address-table-component>
						
						<car-table-component 
							v-if="!loading && getView()!=='car'"
							v-show="viewCar"
							:cars="data.cars"></car-table-component>
							
						<owner-table-component 
							v-if="!loading && getView()!=='owner'"
							v-show="viewOwner"
							:owner="data.owner"></owner-table-component>
						
                    </div>
					<div class="card-footer">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
							<div class="text-right">
								<button type="button" id="submit" name="submit" class="btn btn-default" @click="edit">Edit</button>
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
   			view : null,
        	data : {
        		showRelationships: {},
        		showFillable: {}
        	},
        	hide: ['showRelationships','showFillable'],
        	selectedIndex: '',
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
		viewValue() {
			return (this.selectedIndex == this.view);
		},
		viewOwner() {
			if (this.view == 'owner') return false;
			return (this.selectedIndex == 'owner');
		},
		viewAddress() {
			if (this.view == 'addresses') return false;
			return (this.selectedIndex == 'addresses');
		},
		viewCar() {
			if (this.view == 'cars') return false;
			return (this.selectedIndex == 'cars');
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
    	clickTab: function(el){
	    	this.selectedIndex = el;
    	},
    	edit: function(){
    		this.$router.push({ name: this.getView() + '/edit', params: { id: this.data.id } })
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
        },
        getTabs: function(){
        	return [this.getView()].concat(this.data.showRelationships);
        },
        forceReload: function(){
   			// not sure why, but the vue component was refusing to reload, so I forced it
        	this.$router.go(0);
        }
    },
    created: function () {
        this.show()
        
        // set the initial tab view
        this.clickTab(this.getView())
    },
    watch: {
    	'$route.path': 'forceReload'
	}
}
</script>
