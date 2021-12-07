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
        owner: {
            default: false,
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
    methods: {
	    onViewClick: function (id){
	        this.$router.push({ name: 'owner/view', params: { id: id } })
	    },
	    onEditClick: function (id){
	        this.$router.push({ name: 'owner/edit', params: { id: id } })
	    },
	    onDeleteClick: function (id){
	        this.$router.push({ name: 'owner/delete', params: { id: id } })
	    },
        showOwners: function () {
            axios.get('/owner').then(function (res) {
                this.rows = res.data.map(o => ({...o, 'type': 'owner'}));
            }.bind(this));
        }
    },
    created: function () {
	    if (this.owner === false) {
	    	this.showOwners()
	    } else {
	        this.rows = [this.owner];
        }
    }
}
</script>
