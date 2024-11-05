<template>
    <div>
        <div class="d-flex justify-content-start mb-4">
            <button class="btn btn-secondary" v-on:click="$emit('return')"> return </button>
        </div>
        
        <div class="d-flex justify-content-between mb-4">
            <div>
                <p>To: {{ client.name }}</p>
                <p>Washington Street, San Roque Talisay City, 6045</p>
                <p>Cebu, Philippines</p>
                <p>123-456-789</p>
            </div>
            <div>
                <p><b>Invoice #:</b> INVOICE#2411</p>
                <p><b>Date Generated:</b> June 23, 2021</p>
                <p><b>Status:</b> <span class="badge badge-warning">unpaid</span></p>
            </div>
        </div>
        
        <div class="d-flex justify-content-end mb-2">
            <div>
                <button class="btn btn-outline-primary">Export PDF</button>
                <button class="btn btn-outline-secondary">Export to Excel</button>
            </div>
        </div>

        <div class="table-responsive mb-4">
            <table class="table">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="billing in billings" :key="billing.id">
                        <td>{{ billing.description }}</td>
                        <td>{{ billing.quantity }}</td>
                        <td>{{ billing.unit_price }}</td>
                        <td>{{ billing.total }}</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-right"><b>TOTAL</b></td>
                        <td>56000</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <hr>
        
        <div class="d-flex justify-content-end mb-2">
            <a :href="'/billings/client/INVOICE2411/payments'" class="btn btn-primary btn-lg">Pay Now</a>
        </div>
    </div>
</template>


<script>

export default {
    name: "ClientBillingDetail",
    props: {
        client: Object
    },
    data(){
        return {
            billings: [
                {
                    id: 1,
                    description: "Deluxe",
                    quantity: 1,
                    unit_price: 25000,
                    total: 25000
                },
                {
                    id: 2,
                    description: "Gold",
                    quantity: 1,
                    unit_price: 31000,
                    total: 31000
                },
            ]
        }
    }

}
</script>