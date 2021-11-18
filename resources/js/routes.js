import Owners from './components/Owners.vue';
import OwnerApp from './components/Owner/App.vue';

import Addresses from './components/Addresses.vue';
import AddressApp from './components/Address/App.vue';

import Cars from './components/Cars.vue';

export const routes = [
    {
        name: 'owners',
        path: '/owners',
        component: Owners
    },
	/*
	 * The expected route would be /owner/ but that was taken by laravel routes and
	 * produced a conflict of results based on how you accessed the route.
	 * 
	 */
    {
        name: 'owner/view',
        path: '/owner/view/:id',
        component: OwnerApp,
		props: true
    },
    {
        name: 'owner/edit',
        path: '/owner/edit/:id',
        component: OwnerApp,
		props: true
    },

    {
        name: 'addresses',
        path: '/addresses',
        component: Addresses
    },
    {
        name: 'address/view',
        path: '/address/view/:id',
        component: AddressApp,
		props: true
    },
    {
        name: 'address/edit',
        path: '/address/edit/:id',
        component: AddressApp,
		props: true
    },

    {
        name: 'cars',
        path: '/cars',
        component: Cars
    }
];
