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
    default: "<BaseCard> <template #title> <BaseTitle tag='h2' content='My title'/></template>" +
        "<template #content><p>This is my description</p></template>" +
        "<template #footer><BaseButton text='Go somewhere' /></template></BaseCard>" +
        "<BaseCard> <template #title> <BaseTitle tag='h2' content='My title'/></template>" +
        "<template #content><p>This is my description</p></template>" +
        "<template #footer><BaseButton text='Go somewhere' /></template></BaseCard>" +
        "<BaseCard> <template #title> <BaseTitle tag='h2' content='My title'/></template>" +
        "<template #content><p>This is my description</p></template>" +
        "<template #footer><BaseButton text='Go somewhere' /></template></BaseCard>" +
        "<BaseCard> <template #title> <BaseTitle tag='h2' content='My title'/></template>" +
        "<template #content><p>This is my description</p></template>" +
        "<template #footer><BaseButton text='Go somewhere' /></template></BaseCard>",
};

// TODO use some variables to generate the cards rather than hardcoding
