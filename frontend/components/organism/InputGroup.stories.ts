import { Meta, StoryFn } from "@storybook/vue3";
import InputGroup from "~/components/organism/InputGroup.vue";

export default {
    title: "Organism/InputGroup",
    component: { InputGroup }
} as Meta;

const Template: StoryFn = args => ({
    // Components used in your story `template` are defined in the `components` object
    components: { InputGroup },
    // The story's `args` need to be mapped into the template through the `setup()` method
    setup () {
        // Story args can be spread into the returned object
        return { args };
    },
    // Then, the spread values can be accessed directly in the template
    template: "<InputGroup v-bind='args'> </InputGroup>"
});

export const Primary = Template.bind({});
Primary.args = {
    inputs: [
        {
            text: "Input 1",
            elementId: "input_1"
        },
        {
            text: "Input 2",
            elementId: "input_2"
        }
    ],
    errors: {
        input_1: [
            undefined
        ],
        input_2: [
            undefined
        ]
    }
};
