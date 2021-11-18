<template>
    <div class="container">
    <div class="view-account">
        <section class="module">
            <div class="module-inner">
                <div class="side-bar">
                    <div class="user-info">
                        <img class="img-profile img-circle img-responsive center-block" src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="">
                        <ul class="meta list list-unstyled">
                            <li class="name">{{ address.owner_name || '' }}
                            </li>
                            <li class="activity">Record Created: {{ created }}</li>
                        </ul>
                    </div>
                    <nav class="side-menu">
                        <ul class="nav">
                            <li :class="{ active: view==1 }"><a href="#" @click="view=1"><span class="fa fa-home"></span> Address Record</a></li>
                            <li :class="{ active: view==2 }"><a href="#" @click="view=2"><span class="fa fa-car"></span> Cars</a></li>
                        </ul>
                    </nav>
                </div>

                <div class="content-panel">
                    <div class="content-header-wrapper">
                        <h2 class="title">Address Record</h2>
                        <div class="actions">
                            <div class="btn-group">
                                <button class="btn btn-default" data-toggle="dropdown" type="button" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></button>
                                <ul class="dropdown-menu">
                                    <li><a href="#"> Delete All</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="content-utilities">
                        <div class="page-nav">
                        </div>
                        <div class="actions">
                        </div>
                    </div>
					
					<div v-if="loading">
					   Loading...
					</div>
					<div v-else-if="view == 0" class="drive-wrapper">
						<address-view :address="address"></address-view>
					</div>
					<div v-else-if="view == 1" class="drive-wrapper">
						<address-edit :address="address"></address-edit>
					</div>
                    <div v-else class="drive-wrapper drive-list-view">
                    	<car-table-component :cars="cars"></car-table-component>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
</template>

<script>
export default {
    props: ['id'],
    data() {
        return {
        	view : 1, // 0 is addresses, 1 profile, 2 cars
        	address: {
        		owner_name : '',
        		owner_id : '',
        		owner_name : '',
        	},
        	cars: []
        }
    },
    computed: {
    	created(){
    		var options = { year: 'numeric', month: 'long', day: 'numeric' };
    		return new Date(this.address.created_at).toLocaleDateString("en-US", options);
    	},
    	loading(){
    		if (jQuery.isEmptyObject(this.cars)){ return true; } else { return false; }
    	}
    },
    methods: {
        showOwner: function (){
            axios.get('/address/json/'+this.id).then(function (res) {
            	this.owners = res.data.owners;
            	this.address = res.data.address;
            	this.cars = res.data.cars;
            }.bind(this));
        }
    },
    created: function () {
    	if (this.$route.name === 'address/edit') {
    		this.view = 1;
    	}
        this.showOwner()
    }
}
</script>
