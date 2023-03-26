import Register from "~/components/page/Register.vue";
export default {
    title: "Register",
    component: { Register }
};

const Template = args => ({
    // Components used in your story `template` are defined in the `components` object
    components: { Register },
    // The story's `args` need to be mapped into the template through the `setup()` method
    setup () {
        // Story args can be spread into the returned object
        return { args };
    },
    // Then, the spread values can be accessed directly in the template
    template: "<Register> </Register>"
});

export const Primary = Template.bind({});
