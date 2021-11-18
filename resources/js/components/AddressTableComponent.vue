<template>
    <div>
        <bootstrap-4-datatable :columns="columns" :data="rows" :filter="filter" :per-page="perPage" class="table-bordered"></bootstrap-4-datatable>
        <bootstrap-4-datatable-pager v-model="page" type="abbreviated"></bootstrap-4-datatable-pager>
    </div>
</template>

<script>
import TableButtonsComponent from "./TableButtonsComponent";

export default {
    props: {
        addresses: {
            type: Array,
            default: function(){return []},
            required: false
        }
    },
    
    data() {
        return {
            columns: [
                {
                    label: 'ID',
                    field: 'id',
                    align: 'center'
                },
                {
                    label: 'Address',
                    field: 'address',
                    headerAlign: 'left',
                    align: 'left',
                    interpolate: true,
                    representedAs: function (r) {
                        return r.address + '<br>' + r.city + '<br>' + r.country + '<br>' + r.postal_code;
                    }
                },
                {
                    label: 'Actions',
                    headerAlign: 'right',
                    align: 'right',
                    component: TableButtonsComponent
                }
            ],
            rows: [],
            page: 1,
            filter:  '',
            perPage: 20,
            loading: true
        }
    },
    
	mounted() {
	    var self = this
	    EventBus.$on('on-view-click', function(id){
	      self.onViewClick(id)
	    })
	    EventBus.$on('on-edit-click', function(id){
	      self.onEditClick(id)
	    })
	},
	
	beforeDestroy() {
	    // removing eventBus listener
	    EventBus.$off('on-view-click')
	    EventBus.$off('on-edit-click')
	},
	
    methods: {
	    onViewClick: function (id){
	        this.$router.push({ name: 'address/view', params: { id: id } })
	    },
	    onEditClick: function (id){
	        this.$router.push({ name: 'address/edit', params: { id: id } })
	    },
        showAddresses: function () {
            axios.get('/address').then(function (res) {
                this.rows = res.data.map(o => ({...o, 'type': 'address'}));
            }.bind(this));
        }
    },
    created: function () {
	    if (jQuery.isEmptyObject(this.addresses)) {
	    	this.showAddresses()
	    } else {
	        this.rows = this.addresses;
        }
    }
}
</script>
