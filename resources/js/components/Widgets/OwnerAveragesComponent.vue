<template>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-blue order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Total Owners</h6>
                    <h2 class="text-right"><i class="fa fa-user f-left"></i><span>{{ owners }}</span></h2>
                    <p class="m-b-0"></p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-green order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Average Addresses <small>/owner</small></h6>
                    <h2 class="text-right"><i class="fa fa-home f-left"></i><span>{{ avgaddresses }}</span></h2>
                    <p class="m-b-0">Total Addresses <span class="f-right">{{ ttladdresses }}</span></p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-yellow order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Average Cars <small>/owner</small></h6>
                    <h2 class="text-right"><i class="fa fa-car f-left"></i><span>{{ avgcars }}</span></h2>
                    <p class="m-b-0">Total Cars <span class="f-right">{{ ttlcars }}</span></p>
                </div>
            </div>
        </div>
        
	</div>
</div>
</template>

<script>
export default {

    data() {
        return {
        	owners: 0,
        	avgaddresses: 0,
        	ttladdresses: 0,
        	avgcars: 0,
        	ttlcars: 0
        }
    },
    
    methods: {
        show: function (){
            axios.get('/api/owner/widget/averages/')
	            .then(function (res) {
	            	jQuery.each(res.data,function(k,i){
	            		this[k] = i;
	            	}.bind(this));
	            }.bind(this));
        },
	},
	
    created: function () {
        this.show()
    }
}
</script>

<style scoped>
@import url("https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css");

.order-card {
    color: #fff;
}

.bg-c-blue {
    background: linear-gradient(45deg,#4099ff,#73b4ff);
}

.bg-c-green {
    background: linear-gradient(45deg,#2ed8b6,#59e0c5);
}

.bg-c-yellow {
    background: linear-gradient(45deg,#FFB64D,#ffcb80);
}

.bg-c-pink {
    background: linear-gradient(45deg,#FF5370,#ff869a);
}

.card {
    border-radius: 5px;
    -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
    box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
    border: none;
    margin-bottom: 30px;
    -webkit-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;
}

.card .card-block {
    padding: 25px;
}

.order-card i {
    font-size: 26px;
}

.f-left {
    float: left;
}

.f-right {
    float: right;
}

p {
	margin-bottom:0;
	min-height:23px;
}
</style>