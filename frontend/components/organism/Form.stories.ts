import { Story, StoryFn } from "@storybook/vue3";
import Form from "~/components/organism/Form.vue";

export default {
    title: "Form",
    component: { Form }
};

const Template: StoryFn = args => ({
    // Components used in your story `template` are defined in the `components` object
    components: { Form },
    // The story's `args` need to be mapped into the template through the `setup()` method
    setup () {
        // Story args can be spread into the returned object
        return { args };
    },
    // Then, the spread values can be accessed directly in the template
    template: "<Form v-bind='args'> </Form>"
});

export const Primary = Template.bind({});
Primary.args = {
    inputs: [
        {
            text: "Input 1"
        },
        {
            text: "Input 2"
        }
    ],
    buttonText: "Sign up"
};
