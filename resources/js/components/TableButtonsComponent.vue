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
	    	EventBus.$emit('on-view-click', this.row.id)
	    },
	    onEditClick() {
	    	EventBus.$emit('on-edit-click', this.row.id)
	    }
	}
}
</script>
