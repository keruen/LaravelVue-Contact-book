<template>
    <div class="contact-form">
        <div class="modal contact-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        {{ registerForm ?
                            'Register Contact'
                            : 'Update Contact'
                        }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="full_names" class="col-form-label">Full names:</label>
                        <input
                            type="text" class="form-control" id="full_names"
                            v-model="dataForm.full_names"
                        >
                    </div>
                    <div class="form-group">
                        <label for="phone" class="col-form-label">Phone:</label>
                        <input
                            type="tel" class="form-control" id="phone"
                            v-model="dataForm.phone"
                        >
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-form-label">Email:</label>
                        <input
                            type="email" class="form-control" id="email"
                            v-model="dataForm.email"
                        >
                    </div>
                    <div class="form-group">
                        <label for="birthday" class="col-form-label">Birthday:</label>
                        <input
                            type="date" class="form-control" id="birthday"
                            v-model="dataForm.birthday"
                        >
                    </div>
                </div>
                <div class="modal-footer">
                    <button
                        type="button" class="btn btn-primary"
                        @click.prevent="saveForm"
                    >
                        Save
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.openModal();
        },

        props: {
            registerForm: {
                type: Boolean,
                default: true,
            },
            dataForm: {
                type: Object,
                default: () => ({
                    full_names: '',
                    phone: '',
                    email: '',
                    birthday: '',
                }),
            }
        },

        methods: {
            openModal() {
                this.$nextTick(() => {
                    this.modal = $('.contact-modal');
                    this.modal.modal('show');
                    this.modal.on('hidden.bs.modal', () => {
                        this.$emit('modalClose');
                    });
                });
            },
            saveForm() {
                if (this.registerForm) {
                    axios.post(`/contact`, this.dataForm).then( res => {
                        if (res) this.modal.modal('hide');
                    });
                } else {
                    axios.put(`/contact/${this.dataForm.id}`, this.dataForm).then( res => {
                        if (res) this.modal.modal('hide');
                    });
                }
            }
        }
    }
</script>
