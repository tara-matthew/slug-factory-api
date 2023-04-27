import { StoryFn } from "@storybook/vue3";
import BaseGrid from "~/components/organism/BaseGrid.vue";
import BaseCard from "~/components/molecule/BaseCard.vue";
import BaseTitle from "~/components/atom/BaseTitle.vue";
import BaseButton from "~/components/atom/BaseButton.vue";

export default {
    components: { BaseCard },
    title: "Organism/BaseGrid",
    component: { BaseGrid }
};

const Template: StoryFn = args => ({
    // Components used in your story `template` are defined in the `components` object
    components: { BaseGrid, BaseCard, BaseTitle, BaseButton },
    // The story's `args` need to be mapped into the template through the `setup()` method
    setup () {
        // Story args can be spread into the returned object
        return { args };
    },
    // Then, the spread values can be accessed directly in the template
    template: `<BaseGrid v-bind='args'><template #default>${args.default}</template> </BaseGrid>`
});

export const Default = Template.bind({});
Default.args = {
    columns: 2,
    // Note: Have disabled inspections for this file as this showed as not imported
    default:
        "<BaseCard v-for='n in 8'> " +
            "<template #title> <BaseTitle tag='h2' :content='`My title ${n}`' /></template>" +
            "<template #content><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, " +
                "sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. " +
                "Ut enim ad minim veniam, quis nostrud exercitation     ullamco laboris</p></template>" +
            "<template #footer><BaseButton text='Go somewhere' /></template>" +
        "</BaseCard>"
};

