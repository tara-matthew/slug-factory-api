<template>
    <form @submit.prevent="submitForm">
        <OrganismInputGroup class="mb-5" :inputs="inputs" :errors="errors" />
        <AtomBaseButton :text="buttonText" class="w-full" />
    </form>
</template>

<script setup lang="ts">
import { PropType } from "vue";
import { FormInput } from "~/types/FormInput";

defineProps({
    inputs: {
        type: Array as PropType<FormInput[]>,
        required: true
    },
    buttonText: {
        type: String,
        required: true
    },
    errors: {
        type: Object,
        required: false,
        default: undefined
    }
});

const emit = defineEmits(["form-submit"]);

function submitForm (event: object): void {
    emit("form-submit", event);
}
</script>
