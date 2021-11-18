<template>
    <div class="container">
    <div class="view-account">
        <section class="module">
            <div class="module-inner">
                <div class="side-bar">
                    <div class="user-info">
                        <img class="img-profile img-circle img-responsive center-block" src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="">
                        <ul class="meta list list-unstyled">
                            <li class="name">{{ owner.first_name || '' }} {{ owner.last_name || '' }}
                            </li>
                            <li class="activity">Record Created: {{ created }}</li>
                        </ul>
                    </div>
                    <nav class="side-menu">
                        <ul class="nav">
                            <li :class="{ active: view==1 }"><a href="#" @click="view=1"><span class="fa fa-user"></span> Profile</a></li>
                            <li :class="{ active: view==0 }"><a href="#" @click="view=0"><span class="fa fa-home"></span> Addresses</a></li>
                            <li :class="{ active: view==2 }"><a href="#" @click="view=2"><span class="fa fa-car"></span> Cars</a></li>
                        </ul>
                    </nav>
                </div>

                <div class="content-panel">
                    <div class="content-header-wrapper">
                        <h2 class="title">Owner Profile</h2>
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
                    <div v-else-if="view == 0" class="drive-wrapper drive-list-view">
                    	<address-table-component :addresses="addresses"></address-table-component>
                    </div>
					<div v-else-if="view == 1" class="drive-wrapper">
						<owner-profile-edit :owner="owner"></owner-profile-edit>
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
        	view : 0, // 0 is addresses, 1 profile, 2 cars
        	owner: {
        		first_name : '',
        		last_name : '',
        		created_at : ''
        	},
        	addresses: [],
        	cars: []
        }
    },
    computed: {
    	created(){
    		var options = { year: 'numeric', month: 'long', day: 'numeric' };
    		
    		return new Date(this.owner.created_at).toLocaleDateString("en-US", options);
    	},
    	loading(){
    		if (jQuery.isEmptyObject(this.addresses)){ return true; } else { return false; }
    	}
    },
    methods: {
        showOwner: function (){
            axios.get('/owner/json/'+this.id).then(function (res) {
            	this.owner = res.data.owner;
            	this.addresses = res.data.addresses;
            	this.cars = res.data.cars;
            }.bind(this));
        }
    },
    created: function () {
    	if (this.$route.name === 'owner/edit') {
    		this.view = 1;
    	}
        this.showOwner()
    }
}
</script>
