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
        cars: {
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
                    label: 'Make',
                    field: 'make',
                    headerAlign: 'left',
                    align: 'left'
                },
                {
                    label: 'Model',
                    field: 'model',
                    headerAlign: 'left',
                    align: 'left'
                },
                {
                    label: 'Year',
                    field: 'year',
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
	        this.$router.push({ name: 'car/view', params: { id: id } })
	    },
	    onEditClick: function (id){
	        this.$router.push({ name: 'car/edit', params: { id: id } })
	    },
	    onDeleteClick: function (id){
	        this.$router.push({ name: 'car/delete', params: { id: id } })
	    },
        showCars: function () {
            axios.get('/car').then(function (res) {
                this.rows = res.data.map(o => ({...o, 'type': 'car'}));
            }.bind(this));
        }
    },
    created: function () {
	    if (this.cars === false) {
        	this.showCars()
	    } else {
	        this.rows = this.cars;
        }
    }
}
</script>
