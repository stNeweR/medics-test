import PeopleView from "@/pages/PeopleView.vue";
import OrganizationView from "@/pages/OrganizationView.vue";

const routes = [{
    path: '/',
    component: PeopleView,
    name: 'people'
}, {
    path: '/organizations',
    component: OrganizationView,
    name: 'organizations'
}]

export default routes;