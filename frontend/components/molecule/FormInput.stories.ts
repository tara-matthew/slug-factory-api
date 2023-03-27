import FormInput from "./FormInput.vue";
import {StoryFn} from "@storybook/vue3";

export default {
    title: "FormInput",
    component: { FormInput }
};

const Template: StoryFn = args => ({
    // Components used in your story `template` are defined in the `components` object
    components: { FormInput },
    // The story's `args` need to be mapped into the template through the `setup()` method
    setup () {
        // Story args can be spread into the returned object
        return { args };
    },
    // Then, the spread values can be accessed directly in the template
    template: "<div style='width: 200px;'><form-input v-bind='args'> </form-input></div>"
});

export const Primary = Template.bind({});
Primary.args = {
    elementId: "my-input",
    text: "My label"
};
