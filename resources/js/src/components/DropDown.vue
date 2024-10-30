<template>
    <div
        class="relative inline-block text-left">
        <div>
            <button
                @click.prevent="toggleDropdown"
                class="dropdown-menu">
                {{ selectedOption }}
            </button>
        </div>
        <div
            v-if="isOpen"
            class="absolute z-10 mt-2 w-full rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
            <div class="py-1" role="none">
                <div
                    v-for="option in displayedOptions"
                    :key="option"
                    @click="selectOption(option)"
                    class="cursor-pointer select-none relative px-3 py-1 text-gray-700 hover:bg-blue-100">
                    {{ option }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        value: {
            type: String,
            default: 'Qualification Assessment'
        }
    },
    data() {
        return {
            isOpen: false,
            selectedOption: 'Qualification Assessment',
            options: [
                'Qualification Assessment',
                'Needs Analysis',
                'Value Proposition',
                'Identifying Decision Makers',
                'Proposal/Price Quote',
                'Negotiation / Evaluation',
                'Closed Won',
                'Closed Lost',
                'Closed Competitor Win'
            ]
        }
    },
    methods: {
        toggleDropdown() {
            this.isOpen = !this.isOpen;
        },
        selectOption(option) {
            this.$emit('update:modelValue', option);
            this.selectedOption = option;
            this.isOpen = false;
        }
    },
    computed: {
        displayedOptions() {
            return this.options.map(option => {
                if (option.length > 24) {
                    return option.slice(0, 21) + '...';
                }
                return option;
            });
        }
    }
}
</script>

<style scoped>
.dropdown-menu {
    @apply text-center w-[13rem] rounded-md border border-gray-300
    shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700
    hover:bg-gray-50 focus:outline-none transition;
}
</style>
