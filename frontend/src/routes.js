import PeopleView from "@/pages/PeopleView.vue";
import OrganizationView from "@/pages/OrganizationView.vue";
import PersonView from "@/pages/PersonView.vue";
import PersonEditView from "@/pages/PersonEditView.vue";

const routes = [{
    path: '/',
    component: PeopleView,
    name: 'people'
}, {
    path: '/peoples/:id',
    component: PersonView,
    name: 'person',
    props: true,
},{
    path: '/person/edit/:id',
    component: PersonEditView,
    name: 'personEdit',
    props: true,
}, {
    path: '/organizations',
    component: OrganizationView,
    name: 'organizations'
}]

export default routes;