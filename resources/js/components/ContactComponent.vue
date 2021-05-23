<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="float-left">Contact</h3>
                        <i
                            class="bi bi-person-plus-fill btn btn-primary float-right custom-icons"
                            title="Register"
                            @click.prevent="registerContact"
                        ></i>
                    </div>

                    <div class="card-body">
                        <Table
                            v-if="contacts"
                            :labels="labels"
                            :items="contacts"
                            :actions="actions"
                            @updateContact="updateContact"
                            @deleteContact="deleteContact"
                        />
                        <ContactForm
                            v-if="modalShow"
                            :registerForm="registerForm"
                            :dataForm="dataForm"
                            @modalClose="modalClose"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Table from './TableComponent';
    import ContactForm from './ContactFormComponent';
    export default {
        mounted() {
            this.getContacts()
        },

        components: {
            Table,
            ContactForm,
        },

        data: () => ({
            labels: {
                full_names: 'Full names',
                phone: 'Phone',
                email: 'Email',
                birthday: 'Birthday',
            },
            contacts: [],
            actions: {
                title: 'Actions',
                btn: [
                    {
                        title: 'Update',
                        class: 'bi bi-pencil-square btn btn-success custom-icons',
                        action: 'updateContact',
                        text: '',
                    },
                    {
                        title: 'Delete',
                        class: 'bi bi-person-x-fill btn btn-danger custom-icons',
                        action: 'deleteContact',
                        text: '',
                    }
                ],
            },
            modalShow: false,
            registerForm: true,
            dataForm: {}
        }),

        methods: {
            getContacts() {
                axios.get('/contact').then( res => {
                    this.contacts = res.data;
                });
            },
            registerContact() {
                this.modalShow = true;
                this.registerForm = true;
                this.dataForm = {
                    full_names: '',
                    phone: '',
                    email: '',
                    birthday: '',
                };
            },
            updateContact(contact) {
                this.modalShow = true;
                this.registerForm = false;
                this.dataForm = contact;
            },
            deleteContact(contact) {
                axios.delete(`/contact/${contact.id}`).then( res => {
                    if (res) this.getContacts();
                });
            },
            modalClose() {
                this.modalShow = false;
                this.getContacts();
            }
        }
    }
</script>
