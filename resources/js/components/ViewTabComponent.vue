<template>
	<li class="nav-item">
	    <a href="#" :class="BindClasses()" :id="title" @click="clickTab(title)">{{ title | capitalize }}</a>
	</li>
</template>

<script>
export default {
    props: {
      title: {
        type: String,
        default: 'Tab'
      },
      property : false
    },
    
    data () {
      return {
        isActive: false
      }
    },
    methods: {
    	BindClasses: function(){
    		return (this.isActive) ?'active jtabs nav-link':'jtabs nav-link';
    	},
    	clickTab: function(el){
    		this.$parent.clickTab(el);
    		this.isActive = true;
    		jQuery( '.jtabs' ).removeClass('active');
    		jQuery( this.$el ).find('a').addClass('active');
    	}
    },
    
	filters: {
	  capitalize: function (value) {
	    if (!value) return ''
	    value = value.toString()
	    return value.charAt(0).toUpperCase() + value.slice(1)
	  }
	},
    created: function () {
		if (this.property==0) {
			this.isActive = true;
			jQuery( this.$el ).find('a').addClass('active');
		}
    }
}
</script>
