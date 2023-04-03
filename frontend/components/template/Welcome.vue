<template>
    <div class="w-1/2 m-auto min-h-screen flex flex-col items-center mt-7">
        <div class="w-1/2">
            <AtomBaseTitle tag="h1" :content="headerContent" class="text-center mb-4" />
            <OrganismBaseForm :errors="errors" :inputs="inputs" :button-text="buttonText" @form-submit="formSubmit" />
        </div>
    </div>
</template>

<script setup lang="ts">
import { PropType } from "vue";
import { FormInput } from "~/types/FormInput";

defineProps({
    headerContent: {
        type: String,
        required: true
    },
    inputs: {
        type: Array as PropType<FormInput[] >,
        required: true
    },
    buttonText: {
        type: String,
        required: true
    },
    errors: {
        type: Array,
        required: false,
        default: undefined
    }
});

const emit = defineEmits(["form-submit"]);

function formSubmit (event): void {
    emit("form-submit", event);
}

</script>
