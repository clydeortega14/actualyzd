<template>
    <div>
        <ul class="nav nav-pills nav-justified mb-5">
            <li class="nav-item">
                <a href="#" class="nav-link" :class="selected_nav === 'Billed' ? 'active' : ''" @click.prevent="clickNav('Billed')">Billed</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link" :class="selected_nav === 'Unbilled' ? 'active' : ''"@click.prevent="clickNav('Unbilled')">Unbilled</a>
            </li>
        </ul>

        <!-- Client Billing Summary -->
         <div v-if="show_billing_summary">
            <ClientBillingSummary v-on:show-client-detail="showClientDetail('San Miguel Corp')"/>
        </div>

        <!-- Client Billing Detail -->
         <div v-if="show_client_billing_detail">
            <ClientBillingDetail :client="client" v-on:return="clickReturn"/>
        </div>
    </div>
</template>


<script>

import ClientBillingDetail from './ClientBillingDetail.vue';
import ClientBillingSummary from './ClientBillingSummary.vue';


export default {
    name: "ClientBilling",
    data(){
        return {
            selected_nav: "Unbilled",
            show_billing_summary: true,
            show_client_billing_detail: false,
            client: {
                name: "",
                
            }
        }
    },
    components: {
        ClientBillingDetail,
        ClientBillingSummary
    },
    methods: {
        clickNav: function(nav) {
            this.selected_nav = nav;
        },
        showClientDetail: function(detail){
            this.client.name = detail;
            this.show_billing_summary = false;
            this.show_client_billing_detail = true;
        },
        clickReturn: function(){
            this.show_billing_summary = true;
            this.show_client_billing_detail = false;
        }
    }
}
</script>