<template>
    <div class="table-responsive">
        <table
            :id="tableName"
            class="table table-striped table-bordered dt-responsive nowrap"
        >
            <thead>
                <tr>
                    <th
                        v-for="(label, index) in labels"
                        :key="index"
                    >
                        {{ label }}
                    </th>
                    <th
                        v-if="actions"
                    >
                        {{ actions.title }}
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="(item, index) in items"
                    :key="index"
                >
                    <td
                        v-for="(label, key) in labels"
                        :key="key"
                    >
                        {{ item[key] }}
                    </td>
                    <td v-if="actions">
                        <i
                            v-for="(btn, key) in actions.btn"
                            :key="key"
                            :class="btn.class"
                            :title="btn.title"
                            @click.prevent="$emit(btn.action, item)"
                        >
                            {{ btn.text }}
                        </i>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import datatable from 'datatables.net-bs4'
    export default {
        mounted() {
            this.table();
        },

        props: {
            labels: {
                type: Object,
                required: true,
            },
            items: {
                type: Array,
                default: [],
            },
            actions: {
                type: Object,
                default: () => ({}),
            }
        },

        data: () => ({
            tableName: `table_${Math.random().toString(36).substring(7)}`
        }),

        watch: {
            items() {
                this.table();
            },
        },

        methods: {
            table() {
                const elementTable = $(`#${this.tableName}`);
                if ($.fn.DataTable.isDataTable(elementTable) ) {
                    elementTable.DataTable().destroy();
                }
                this.$nextTick(() => {
                    elementTable.DataTable();
                });
            }
        }
    }
</script>
