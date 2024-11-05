<template>
    <div>
        <p class="lead mb-3 text-center">Please upload your payment referrence for confirmation</p>
        <form>
            <div class="form-group row">
                <label for="amount" class="col-form-label col-sm-3 text-md-right">Amount</label>
                <div class="col-sm-6">
                    <input type="text" name="amount" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="ref-no" class="col-form-label col-sm-3 text-md-right">Referrence #</label>
                <div class="col-sm-6">
                    <input type="text" name="ref_no" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="payment-proof" class="col-form-label text-md-right col-sm-3">Proof of payment</label>
                <div class="col-sm-6">
                    <input type="file" name="payment_proof">
                </div>
            </div>

            <div class="form-group row">
                <label for="remarks" class="col-form-label col-sm-3 text-md-right">Remarks</label>
                <div class="col-sm-6">
                    <input type="text" name="remarks" class="form-control">
                </div>
            </div>
            

            <div class="row">
                <div class="col-sm-6 offset-md-3">
                    <button class="btn btn-primary">Submit</button>
                    <button class="btn btn-danger ml-2">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</template>


<script>
export default {
    name: "PaymentForm"
}
</script>