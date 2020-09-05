<template>
    <div>
        <card
            class="stripe-card"
            :class="{ complete }"
            stripe="pk_test_51HBICnJudq0GhlmS69eyMnAa2TBxToPoZtLBmLkVHPYihlhfHMXrt2K8uSr5KsKXW7OSaMqW78aUaEqeeCKMOQuC00G4Wbuh1D"
            :options="stripeOptions"
            @change="change($event)"

        />

        <!-- Used to display form errors. -->
        <div id="card-errors" role="alert" v-text="errorMessage"></div>
    </div>
</template>

<script>
    import { Card, createToken } from "vue-stripe-elements-plus";

    export default {
        data() {
            return {
                complete: false,
                errorMessage: "",
                stripeOptions: {
                    // see https://stripe.com/docs/stripe.js#element-options for details
                    hidePostalCode: true
                },
                style: {
                    base: {
                        color: "#32325d",
                        fontFamily: '"Nunito", sans-serif',
                        fontSmoothing: "antialiased",
                        fontSize: "16px",
                        "::placeholder": {
                            color: "#aab7c4"
                        }
                    },
                    invalid: {
                        color: "#fa755a",
                        iconColor: "#fa755a"
                    }
                }
            };
        },
        components: { Card },

        methods: {
            change(event) {
                this.errorMessage = event.error ? event.error.message : "";
            }
        }
    };
</script>
