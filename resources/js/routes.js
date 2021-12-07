import Owners from './components/Owners.vue';
import Addresses from './components/Addresses.vue';
import Cars from './components/Cars.vue';
import GeneralView from './components/GeneralView.vue';
import Edit from './components/Edit.vue';
import Delete from './components/Delete.vue';

export const routes = [
    {
        name: 'owners',
		alias: '/owner',
        path: '/owners',
        component: Owners
    },
    {
        name: 'owner/view',
        path: '/owner/view/:id',
        component: GeneralView,
		props: true
    },
    {
        name: 'owner/edit',
        path: '/owner/edit/:id',
        component: Edit,
		props: true
    },
    {
        name: 'owner/delete',
        path: '/owner/delete/:id',
        component: Delete,
		props: true
    },
    {
        name: 'addresses',
		alias: '/address',
        path: '/addresses',
        component: Addresses
    },
    {
        name: 'address/view',
        path: '/address/view/:id',
        component: GeneralView,
		props: true
    },
    {
        name: 'address/edit',
        path: '/address/edit/:id',
        component: Edit,
		props: true
    },
    {
        name: 'address/delete',
        path: '/address/delete/:id',
        component: Delete,
		props: true
    },
    {
        name: 'cars',
		alias: '/car',
        path: '/cars',
        component: Cars
    },
    {
        name: 'car/view',
        path: '/car/view/:id',
        component: GeneralView,
		props: true
    },
    {
        name: 'car/edit',
        path: '/car/edit/:id',
        component: Edit,
		props: true
    },
    {
        name: 'car/delete',
        path: '/car/delete/:id',
        component: Delete,
		props: true
    }
];
