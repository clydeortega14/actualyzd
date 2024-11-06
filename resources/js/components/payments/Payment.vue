<template>
    <div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Invoice #</th>
                        <th>Amount</th>
                        <th>Remarks</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="payment in payments" :key="payment.id">
                        <td>{{ payment.id }}</td>
                        <td>{{ payment.invoice_id }}</td>
                        <td>{{ payment.amount }}</td>
                        <td>{{ payment.remarks }}</td>
                        <td>
                            <span :class="payment.status === 'verified' ? 'badge badge-success' : 'badge badge-danger' ">{{ payment.status }}</span>
                        </td>
                        <td>
                            <button class="btn btn-outline-primary">verify</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    name: "Payment",
    data(){
        return {
            payments: []
        }
    },
    created(){

        this.getPayments();
    },
    methods: {
        getPayments(){
            this.payments = [
                {
                    id: 1,
                    invoice_id: 'INVOICE2411',
                    amount: 25000,
                    remarks: 'Done',
                    status: 'unverified',
                },
                {
                    id: 2,
                    invoice_id: 'INVOICE3122',
                    amount: 22000,
                    remarks: 'Done',
                    status: 'verified',
                }
            ]
        }
    }
}
</script>