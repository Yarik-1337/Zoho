<template>
    <div class="mt-[8rem]">
        <div class="shadow-lg w-[40rem] h-[33rem] font-semibold">
            <h2 class="text-center mt-12 text-xl opacity-80">
                Web Form for Zoho CRM Deals
            </h2>
            <div class="mx-14 mt-14">
                <h3 class="text-xl opacity-80 mb-5">
                    Deal information
                </h3>
                <DealForm
                    :errors="errors"
                    v-model="dealData"/>
            </div>
            <div class="mx-14 mt-8">
                <h3 class="text-xl opacity-80 mb-5">
                    Account information
                </h3>
                <AccountForm
                    :errors="errors"
                    v-model="accountData"/>
            </div>
            <div class="w-full flex justify-center mt-14">
                <Loader v-if="loader"/>
                <button
                    v-else
                    @click.prevent="onSubmit"
                    class="bg-blue-400 w-[12rem] py-1 rounded-sm text-white hover:scale-[105%] transition">
                    Send
                </button>
            </div>
        </div>
        <div
            v-if="okStatus"
            class="text-center mt-2 font-semibold text-green-600">
            Record added!
        </div>
        <div
            class="text-center mt-2 font-semibold text-red-500"
            v-if="error">
            {{ error }}
        </div>
    </div>
</template>

<script>
import DealForm from "./components/DealForm.vue";
import AccountForm from "./components/AccountForm.vue";
import {zohoStore} from "./store/zohoStore.js";
import Loader from "./UI/Loader.vue";
import {zohoSchema} from "./validators/validationSchema.js";

export default {
    components: {Loader, AccountForm, DealForm},
    data() {
        return {
            dealData: {
                dealName: '',
                stage: 'Qualification Assessment'
            },
            accountData: {
                accountName: '',
                website: '',
                phone: ''
            },
            okStatus: false,
            errors: {},
        }
    },
    methods: {
        async sendData() {
            const store = zohoStore();
            this.okStatus = false;
            try {
                await store.createRecord({
                    deal_name: this.dealData.dealName,
                    stage: this.dealData.stage,
                    account_name: this.accountData.accountName,
                    website: this.accountData.website,
                    phone: this.accountData.phone
                });
                this.dealData.dealName = '';
                this.accountData.phone = '';
                this.accountData.website = '';
                this.accountData.accountName = '';
                this.okStatus = true;
            } catch (error) {

            }
        },
        async onSubmit() {
            this.errors = {};
            try {
                await zohoSchema.validate(
                    {
                        deal_name: this.dealData.dealName,
                        stage: this.dealData.stage,
                        phone: this.accountData.phone,
                        website: this.accountData.website,
                        account_name: this.accountData.accountName,
                    },
                    {abortEarly: false}
                );

                await this.sendData();
            } catch (err) {
                err.inner.forEach((error) => {
                    this.errors[error.path] = error.message;
                });
            }
        },
    },
    computed: {
        loader() {
            const store = zohoStore();
            return store.loader;
        },
        error() {
            const store = zohoStore();
            return store.error;
        }
    },
    mounted() {
        const store = zohoStore();
        if (!store.token) {
            store.refreshToken();
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
