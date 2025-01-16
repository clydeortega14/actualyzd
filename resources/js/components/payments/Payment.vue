<template>
    <div>

        <!-- Filtering -->


        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Invoice #</th>
                        <th>Amount</th>
                        <th>Remarks</th>
                        <th>Attachment</th>
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
                            Attachment
                        </td>
                        <td>
                            <span :class="payment.status === 'verified' ? 'badge badge-success' : 'badge badge-danger' ">{{ payment.status }}</span>
                        </td>
                        <td>
                            <button class="btn btn-outline-primary" @click.prevent="verifyPayment(payment.id)">verify</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>

import sweetAlert from '../../mixins/sweet-alert';
export default {
    name: "Payment",
    data(){
        return {
            payments: []
        }
    },
    mixins: [sweetAlert],
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
        },
        verifyPayment(payment_id){
            this.dialog(
                'Are you sure?',
                'You want to verify this payment?',
                'warning',
                'Cancel',
                'Verify Now'
            )
            .then(result => {

                if(result.isConfirmed){
                    let index = this.payments.findIndex(pay => pay.id === payment_id);
                    let find_payment = this.payments.find(pay => pay.id === payment_id);
                    
                    if(index > -1 && find_payment !== undefined ){
                        let verified_payment = {
                            id: find_payment.id,
                            invoice_id:  find_payment.invoice_id,
                            amount: find_payment.amount,
                            remarks: find_payment.remarks,
                            status: find_payment.status === 'verified' ? 'unverified' : 'verified'
                        }

                        this.payments.splice(index, 1, verified_payment)
                    }
                    
                }
            })
        }
    }
}
</script>