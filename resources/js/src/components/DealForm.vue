<template>
    <div class="flex justify-between">
        <div>
            <input
                :class="{'border-red-500': errors.deal_name}"
                v-model="localDealData.dealName"
                placeholder="Deal name"
                class="bg-transparent focus:outline-none border-b-2 border-gray-400 p-1"
                type="text">
            <div
                class="text-red-400 mt-2 text-sm"
                v-if="errors.deal_name">
                {{ errors.deal_name }}
            </div>
        </div>
        <div class="flex">
            <h3 class="mr-3 mt-1 opacity-60">
                Stage
            </h3>
            <DropDown v-model="localDealData.stage"/>
            <div
                class="text-red-400 mt-2 text-sm"
                v-if="errors.stage">
                {{ errors.stage }}
            </div>
        </div>
    </div>
</template>

<script>
import DropDown from "./DropDown.vue";

export default {
    components: {DropDown},
    props: {
        modelValue: {
            type: Object,
            default: () => ({
                dealName: '',
                stage: ''
            })
        },
        errors: {
            type: Object
        }
    },
    computed: {
        localDealData: {
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
