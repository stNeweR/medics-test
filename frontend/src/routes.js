import PeopleView from "@/pages/PeopleView.vue";
import OrganizationView from "@/pages/OrganizationView.vue";
import PersonView from "@/pages/PersonView.vue";

const routes = [{
    path: '/',
    component: PeopleView,
    name: 'people'
}, {
    path: '/peoples/:id',
    component: PersonView,
    name: 'person',
    props: true,
}, {
    path: '/organizations',
    component: OrganizationView,
    name: 'organizations'
}]

export default routes;