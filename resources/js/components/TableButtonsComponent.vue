<template>
    <div>
        <button class="btn btn-primary" @click="onViewClick()">View</button>
        <button class="btn btn-primary" @click="onEditClick()">Edit</button>
        <button class="btn btn-danger" @click="onDeleteClick()">Delete</button>
    </div>
</template>

<script>
export default {
    props: {
        row: {
            type: Object
        }
    },
    methods: {
	    onViewClick() {
	    	// this will only work when used with vuejs-datatable
	    	this.$parent.$parent.$parent.onViewClick( this.row.id );
	    },
	    onEditClick() {
	    	this.$parent.$parent.$parent.onEditClick( this.row.id );
	    }
	}
}
</script>
