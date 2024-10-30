<template>
    <div class="flex flex-col">
        <div class="flex text-center">
            <input
                :class="{'border-red-500': errors.account_name}"
                v-model="localAccountData.accountName"
                placeholder="Account name"
                class="bg-transparent focus:outline-none border-b-2 border-gray-400 p-1 mb-4"
                type="text">
            <div
                class="text-red-400 ml-4 text-sm mt-4"
                v-if="errors.account_name">
                {{ errors.account_name }}
            </div>
        </div>
        <div class="flex">
            <input
                :class="{'border-red-500': errors.website}"
                v-model="localAccountData.website"
                placeholder="Website"
                class="bg-transparent focus:outline-none border-b-2 border-gray-400 p-1 mb-4"
                type="text">
            <div
                class="text-red-400 ml-4 text-sm mt-4"
                v-if="errors.website">
                {{ errors.website }}
            </div>
        </div>
        <div class="flex">
            <input
                :class="{'border-red-500': errors.phone}"
                v-model="localAccountData.phone"
                placeholder="Phone"
                class="bg-transparent focus:outline-none border-b-2 border-gray-400 p-1"
                type="text">
            <div
                class="text-red-400 ml-4 text-sm mt-4"
                v-if="errors.phone">
                {{ errors.phone }}
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        modelValue: {
            type: Object,
            default: () => ({
                accountName: '',
                website: '',
                phone: ''
            })
        },
        errors: {
            type: Object
        }
    },
    computed: {
        localAccountData: {
            get() {
                return this.modelValue;
            },
            set(value) {
                this.$emit('update:modelValue', value);
            }
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
