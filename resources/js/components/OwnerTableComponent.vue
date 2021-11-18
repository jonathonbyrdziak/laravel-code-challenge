<template>
    <div>
        <bootstrap-4-datatable :columns="columns" :data="rows" :filter="filter" :per-page="perPage" class="table-bordered"></bootstrap-4-datatable>
        <bootstrap-4-datatable-pager v-model="page" type="abbreviated"></bootstrap-4-datatable-pager>
    </div>
</template>

<script>
import TableButtonsComponent from "./TableButtonsComponent";

export default {
    data() {
        return {
        	
            columns: [
                {
                    label: 'ID',
                    field: 'id',
                    align: 'center'
                },
                {
                    label: 'First Name',
                    field: 'first_name',
                    headerAlign: 'left',
                    align: 'left'
                },
                {
                    label: 'Last Name',
                    field: 'last_name',
                    headerAlign: 'left',
                    align: 'left'
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
	        this.$router.push({ name: 'owner/view', params: { id: id } })
	    },
	    onEditClick: function (id){
	        this.$router.push({ name: 'owner/edit', params: { id: id } })
	    },
        showOwners: function (){
        
        	// Gets all owners from backend
            axios.get('/owner').then(function (res) {
                this.rows = res.data.map(o => ({...o, 'type': 'owner'}));
            }.bind(this));
        }
    },
    created: function () {
        this.showOwners()
    }
}
</script>
