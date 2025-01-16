<template>
    <div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Amount</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            INVOICE#2411
                            <p>Sept 23, 2024 - Dec 23, 2024</p>
                        </td>
                        <td>
                            <span class="badge badge-warning">Unpaid</span>
                        </td>
                        <td>25,000.00</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-info" v-on:click.prevent="$emit('show-client-detail')">
                                <i class="fa fa-info"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    name: "ClientBillingSummary"
}
</script>